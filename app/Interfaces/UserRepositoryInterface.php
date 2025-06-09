<?php
namespace App\Interfaces;

interface UserRepositoryInterface 
{
    /**
     * Get list user 
     *
     * @param integer $perPage
     * @param array $options
     * @return void
     */
    public function getUsersPaginate($perPage = 10, $options = []);

    /**
     * Create user
     * @param array $options
     * @return void
     */
    public function createUser($options = []);

    /**
     * Update user and profile of user
     * @param mixed $user
     * @param mixed $userData
     * @param mixed $profileData
     * @return void
     */
    public function updateUserProfile($user, $userData = [], $profileData = []);
}