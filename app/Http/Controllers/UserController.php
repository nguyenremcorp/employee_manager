<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Services\DepartmentService;
use App\Http\Requests\SearchUserRequest;
use App\Http\Requests\AdminCreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * 
     * @var UserService
     */
    protected UserService $userService;

    /**
     * 
     * @var DepartmentService
     */
    protected DepartmentService $departmentService;

    /**
     * Constructor method
     *
     * @param UserService $userService
     * @param DepartmentService $department
     */
    public function __construct(UserService $userService, DepartmentService $department)
    {
        $this->userService = $userService;
        $this->departmentService = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @param SearchUserRequest $request
     * @return View
     * 
     */
    public function index(SearchUserRequest $request): View
    {
        $input = $request->validated();

        $users = $this->userService->getUsersPaginateService(20, $input);
        $departments = $this->departmentService->deparmentListService();

        return view('users.list', compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $departments = $this->departmentService->deparmentListService();

        return view('users.create', compact('departments'));
    }

    /**
     * Save user and profile request
     *
     * @param AdminCreateUserRequest $request
     * @return RedirectResponse
     */
    public function store(AdminCreateUserRequest $request): RedirectResponse
    {
        try {
            $input = $request->validated();
            $this->userService->createUserAndProfileService($input);

            return redirect()
                ->route('users.create')
                ->with('success', __('messages.create_user.success'));
        } catch (\Exception $e) {
            Log::error('Error add user: ' . $e->getMessage());

            return redirect()
                ->route('users.create')
                ->with('error', __('messages.create_user.error'));
        }
    }

    /**
     * Get infomation of user
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $userLogin = Auth::user();

        if (
            $userLogin &&
            !$userLogin->isAdmin &&
            ($userLogin->id != $user->id)
        ) {
            abort(403, __('messages.auth.msg_403'));
        }

        // Get deparment list
        $departments = $this->departmentService->deparmentListService();

        return view('users.edit', compact('user', 'departments'));
    }

    /**
     * Update user and profile
     *
     * @param UpdateUserProfileRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserProfileRequest $request, User $user): RedirectResponse
    {
        $userUpdate = $user ?? Auth::user();

        try {
            $input = $request->validated();
            $this->userService->updateUserOrProfileService($userUpdate, $input);

            return redirect()
                ->route('user.show',  $userUpdate)
                ->with('success', __('messages.update_user.success'));
        } catch (\Exception $e) {
            Log::error('Error update user: ' . $e->getMessage());

            return redirect()
                ->route('user.show', $userUpdate)
                ->with('error', __('messages.update_user.error'));
        }
    }

    /**
     * Remove user
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $name = $user->name ?? '';

        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();

            return redirect()
                ->route('admin.list')
                ->with(
                    'success',
                    __(
                        'messages.delete_user.success',
                        ['name' => $name]
                    )
                );
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting user: ' . $e->getMessage());

            return redirect()
                ->route('admin.list')
                ->with(
                    'error',
                    __('messages.delete_user.error', ['name' => $name])
                );
        }
    }
}
