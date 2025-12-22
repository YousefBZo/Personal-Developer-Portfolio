<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::updateOrCreate(
            [
                'title' => 'Full Stack Developer (Laravel)',
                'company' => 'Areisto',
            ],
            [
                'start_date' => '2025-09-01',
                'end_date' => null,
                'description' => 'Proved my adaptability, quick learning, and dedication during my internship at Areisto. Earned the role of Scrum Master, leading agile ceremonies and ensuring smooth team collaboration. This experience sharpened my leadership and project management skills.',
            ]
        );
    }
}

