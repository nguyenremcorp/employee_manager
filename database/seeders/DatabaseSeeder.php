<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Enum\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo danh sách các phòng ban
        $departments = ['Kinh Doanh', 'Kế Toán', 'Nhân sự', 'Kỹ thuật', 'Chăm sóc khách hàng', 'Quản lý'];
        $departmentIds = [];

        foreach ($departments as $dept) {
            $department = Department::create(['name' => $dept]);
        }

        $departmentIds = Department::pluck('id')->toArray();

        /*
         * Tạo 50 member role là user
         * 5 user đầu tiên có vai trò là admin, còn lại là role user
         */
        for ($i = 1; $i <= 100; $i++) {
            $role = $i <= 5 ? 'admin' : 'user';

            $user = User::create([
                'name' => "User Test$i",
                'email' => "user$i@example.com",
                'role' => $role,
                'password' => Hash::make('Password1')
            ]);

            $address = rand(10, 100) . " Nguyễn Đình Chiểu, Phường 1, Quận 3, TP.HCM";
            $startDate = now()->subYears(rand(0, 5))->format('Y-m-d');
            $randomDate = now()->subYears(rand(20, 35))->format('Y-m-d');

            Profile::create([
                'user_id' => $user->id,
                'address' => $address,
                'phone' => '0' . rand(100000000, 999999999),
                'date_of_birth' => $randomDate,
                'department_id' => $departmentIds[array_rand($departmentIds)],
                'gender' => fake()->randomElement(get_values('gender')),
                'position' => fake()->randomElement([
                    'Nhân viên',
                    'Trưởng Phòng ',
                    'Phó Phòng',
                    'Giám đốc',
                ]), // Cho nhập tự do 
                'cccd' => rand(10000000000, 99999999999),
                'cccd_date' => $randomDate,
                'marital_status' => fake()->randomElement(get_values('marital')),
                'start_date' => $startDate,
            ]);
        }
    }
}
