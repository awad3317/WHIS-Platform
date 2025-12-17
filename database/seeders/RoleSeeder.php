<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Parent',
            'display_name' => 'ولي امر',
        ]);
        Role::create([
            'name' => 'Employee',
            'display_name' => 'موظف',
        ])->permissions()->attach([1, 2]);
    }
}
