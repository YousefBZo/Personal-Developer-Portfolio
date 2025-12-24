<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Yousef Zaqout',
            'email' => 'zaqoutyousef@gmail.com',
            'password' => Hash::make('password123'),
            'bio' => 'Full Stack Laravel Developer specializing in backend development using PHP, Laravel, and MySQL. Experienced in building admin panels, authentication systems, and scalable web applications. Passionate learner, problem solver, and IT student with strong motivation to grow professionally.',
            'major' => 'Full Stack Laravel Developer',
        ]);
    }
}

