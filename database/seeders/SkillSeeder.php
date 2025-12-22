<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Java-related skills - Advanced
            ['name' => 'Java', 'level' => 'Advanced'],
            ['name' => 'Java Database Connectivity (JDBC)', 'level' => 'Advanced'],
            ['name' => 'JavaFX', 'level' => 'Advanced'],

            // Other skills - Expert
            ['name' => 'Full-Stack Development', 'level' => 'Expert'],
            ['name' => 'Back-End Web Development', 'level' => 'Expert'],
            ['name' => 'JSON', 'level' => 'Expert'],
            ['name' => 'Data Structures', 'level' => 'Expert'],
            ['name' => 'Object-Oriented Programming (OOP)', 'level' => 'Expert'],
            ['name' => 'Web Development', 'level' => 'Expert'],
            ['name' => 'Design Patterns', 'level' => 'Expert'],
            ['name' => 'MySQL', 'level' => 'Expert'],
            ['name' => 'SQL', 'level' => 'Expert'],
            ['name' => 'HTML5', 'level' => 'Expert'],
            ['name' => 'CSS', 'level' => 'Expert'],
            ['name' => 'PHP', 'level' => 'Expert'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                ['level' => $skill['level']]
            );
        }
    }
}

