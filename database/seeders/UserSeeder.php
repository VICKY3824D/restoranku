<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'fullname' => 'Administrator',
                'email' => 'admin@example.com',
                'phone' => '081234567890',
                'role_id' => 1,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'kasir1',
                'password' => Hash::make('password'),
                'fullname' => 'Administrator',
                'email' => 'kasir1@example.com',
                'phone' => '081234567891',
                'role_id' => 2,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        DB::table('users')->insert($users);
    }
}
