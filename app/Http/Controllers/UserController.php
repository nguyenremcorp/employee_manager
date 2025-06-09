<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Services\UserService;
use App\Http\Requests\SearchUserRequest;
use App\Http\Requests\AdminCreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchUserRequest $request)
    {
        $input = $request->validated();
        $users = $this->service->getUsersPaginateService(20, $input);

        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::select('id', 'name')->get(); // hardCode

        return view('users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateUserRequest $request)
    {
        try {
            $input = $request->validated();
            $this->service->createUserAndProfileService($input);

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
     * Display the specified resource.
     */
    public function show(User $user)
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
        $departments = Department::select('id', 'name')->get(); // hardCode

        return view('users.edit', compact('user', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, User $user)
    {
        $userUpdate = $user ?? Auth::user();

        try {
            $input = $request->validated();
            $this->service->updateUserOrProfileService($userUpdate, $input);

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
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
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
                    __('messages.delete_user.success', 
                    ['name' => $name])
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
