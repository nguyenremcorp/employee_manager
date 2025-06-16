<?php

namespace App\Interfaces;

use App\Models\User;
use \Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Get list user has paginate
     *
     * @param int $perPage
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function getUsersPaginate(int $perPage = 10, array $options = []): LengthAwarePaginator;

    /**
     * Create user
     * 
     * @param array $options
     * @return User|null
     */
    public function createUser(array $options = []): ?User;

    /**
     * Update user and profile
     * 
     * @param User $user
     * @param array $userData
     * @param array $profileData
     * @return User|null
     */
    public function updateUserProfile(User $user, array $userData = [], array $profileData = []): ?User;
}