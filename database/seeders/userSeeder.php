<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'عوض لشرم',
            'phone' => '967780236551',
            'password' => '12121212',
            'user_type' => 'employee',
            'is_active' => true,
        ]);
        User::create([
            'name' => 'عوض لشرم',
            'phone' => '967780236552',
            'password' => '12121212',
            'user_type' => 'employee',
            'is_active' => false,
        ]);
        
    }
}
