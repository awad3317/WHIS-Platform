<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createStudent = Permission::create([
            'name' => 'create_student',
            'display_name' => 'تسجيل طالب ', 
            'description' => 'تسجيل طالب جديد في النظام', 
        ]);
        $viewStudent = Permission::create([
            'name' => 'view_students',
            'display_name' => 'عرض الطلاب', 
            'description' => 'عرض معلومات طلاب',
        ]);
    }
}
