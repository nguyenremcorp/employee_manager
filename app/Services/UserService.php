<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

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
     * function getUsersPaginate
     *
     * @param integer $perPage
     * @param array $options
     * @return void
     */
    public function getUsersPaginateService($perPage = 10, $options = []) 
    {
        return $this->userRepository->getUsersPaginate($perPage, $options);
    }

    /**
     * Summary of createUser
     * @param mixed $options
     * @return void
     */
    public function createUserAndProfileService($options) 
    {
        return $this->userRepository->createUser($options);
    }

    /**
     * Summary of updateUserProfile
     * @param mixed $user
     * @param mixed $userData
     * @param mixed $profileData
     * @return void
     */
    public function updateUserOrProfileService($user, $options = [])
    {
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
    }
}