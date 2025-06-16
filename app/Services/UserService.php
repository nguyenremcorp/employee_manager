<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Exception;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * __construct function
     *
     * @param UserRepositoryInterface $userRepoInterface
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get paginated list of users
     *
     * @param int $perPage
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function getUsersPaginateService(int $perPage = 10, array $options = []): LengthAwarePaginator
    {
        return $this->userRepository->getUsersPaginate($perPage, $options);
    }

    /**
     * Create user and profile
     * 
     * @param array $options
     * @return User|null
     */
    public function createUserAndProfileService(array $options): ?User
    {
        try {
            return $this->userRepository->createUser($options);
        } catch (Exception $e) {
            Log::error('Create User Failed: ' . $e->getMessage());

            return null;
        }
    }

    /**
     * Update user or profile
     * 
     * @param User $user
     * @param array $userData
     * @param array $profileData
     * @return User|null
     */
    public function updateUserOrProfileService(User $user, array $options = []): ?User
    {
        try {
            $userData = [
                'name' => $options['name'] ?? '',
                'role' => $options['role'] ?? '',
            ];

            $profileData = [
                'user_id' => $user->id,
                'address' => $options['address'] ?? null,
                'date_of_birth' => $options['date_of_birth'] ?? null,
                'gender' => $options['gender'] ?? null,
                'phone' => $options['phone'] ?? null,
                'position' => $options['position'] ?? null,
                'cccd' => $options['cccd'] ?? null,
                'cccd_date' => $options['cccd_date'] ?? null,
                'marital_status' => $options['marital_status'] ?? null,
                'start_date' => $options['start_date'] ?? null,
                'department_id' => $options['department'] ?? null,
            ];

            return $this->userRepository->updateUserProfile($user, $userData, $profileData);
        } catch (Exception $e) {
            Log::error('Update User Failed: ' . $e->getMessage());

            return null;
        }
    }
}