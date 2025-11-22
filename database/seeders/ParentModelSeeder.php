<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParentModel;
use Carbon\Carbon;

class ParentModelSeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            [
                'name_ar' => 'أحمد محمد',
                'name_en' => 'Ahmed Mohammed',
                'phone' => '967780236553',
                'email' => 'ahmed.mohammed@example.com',
                'national_id' => '1234567890',
                'job_title' => 'مهندس',
                'workplace' => 'شركة التقنية المحدودة',
                'mobile' => '966501234567',
                'gender' => 'male',
                'is_active' => true,
            ],
            [
                'name_ar' => 'أسماء محمد',
                'name_en' => 'Asmaa Mohammed',
                'phone' => '967780236554',
                'email' => 'asmaa.mohammed@example.com',
                'national_id' => '123456789',
                'job_title' => 'مدرسة',
                'workplace' => 'شركة التقنية المحدودة',
                'mobile' => '966501234564',
                'gender' => 'female',
                'is_active' => true,
                
            ],
            
        ];

        foreach ($parents as $parent) {
            ParentModel::create($parent);
        }
    }
}