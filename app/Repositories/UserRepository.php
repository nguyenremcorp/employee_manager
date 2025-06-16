<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    /**
     * implements function getUsersPaginate of UserRepositoryInterface
     *
     * @param int $perPage
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function getUsersPaginate(int $perPage = 10, array $options = []): LengthAwarePaginator
    {
        $query = User::with([
            'profile',
            'profile.department'
        ]);

        $searchBy = $options['search_by'] ?? 'name'; // Default search theo tên

        // search theo tên, email
        if (!empty($options['keyword']) && $searchBy) {
            if ($searchBy == 'phone') {
                $query->whereHas('profile', function ($query2) use ($options) {
                    $query2->where('phone', 'like', '%' . trim($options['keyword']) . '%');
                });
            } else {
                $query->where($searchBy, 'like', '%' . trim($options['keyword']) . '%');
            }
        }

        if (!empty($options['department'])) {
            $query->whereHas('profile', function ($q) use ($options) {
                $q->where('department_id', $options['department']);
            });
        }

        if (!empty($options['marital_status'])) {
            $query->whereHas('profile', function ($q) use ($options) {
                $q->where('marital_status', $options['marital_status']);
            });
        }

        if (!empty($options['gender'])) {
            $query->whereHas('profile', function ($q) use ($options) {
                $q->where('gender', $options['gender']);
            });
        }

        return $query->paginate($perPage)->appends($options);
    }

    /**
     * implements function createUser
     * 
     * @param array $options
     * @return User|null
     */
    public function createUser(array $options = []): ?User
    {
        // Create user
        return DB::transaction(function () use ($options) {
            $user = User::create([
                'name' => $options['name'],
                'email' => $options['email'],
                'password' => Hash::make($options['password']),
                'role' => $options['role']
            ]);

            $user->profile()->create([
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
            ]);

            $user->save();

            return $user->load('profile');
        });
    }

    /**
     * Update user and profile of user
     * 
     * @param User $user
     * @param array $userData
     * @param array $profileData
     * @return User|null
     */
    public function updateUserProfile(User $user, array $userData = [], array $profileData = []): ?User
    {
        // Update user and profile
        return DB::transaction(function () use ($user, $userData, $profileData) {
            $user->update(array_filter($userData));
            $filterProfileData = array_filter($profileData);

            if (!empty($filterProfileData)) {
                $user->profile()->updateOrCreate(['user_id' => $user->id], $filterProfileData);
            }

            return $user->load('profile');
        });
    }
}