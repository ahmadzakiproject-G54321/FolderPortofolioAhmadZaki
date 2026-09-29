<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // ===========================
            // Backend
            // ===========================
            [
                'category' => 'Backend',
                'skill_name' => 'Laravel',
                'level' => 95,
                'icon' => 'devicon-laravel-original colored',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'category' => 'Backend',
                'skill_name' => 'PHP',
                'level' => 92,
                'icon' => 'devicon-php-plain colored',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'category' => 'Backend',
                'skill_name' => 'RESTful API',
                'level' => 90,
                'icon' => 'bi bi-cloud-arrow-up',
                'sort_order' => 3,
                'is_active' => true,
            ],

            // ===========================
            // Database
            // ===========================
            [
                'category' => 'Database',
                'skill_name' => 'MySQL',
                'level' => 90,
                'icon' => 'devicon-mysql-original colored',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'category' => 'Database',
                'skill_name' => 'PostgreSQL',
                'level' => 82,
                'icon' => 'devicon-postgresql-plain colored',
                'sort_order' => 5,
                'is_active' => true,
            ],

            // ===========================
            // Frontend
            // ===========================
            [
                'category' => 'Frontend',
                'skill_name' => 'HTML5',
                'level' => 95,
                'icon' => 'devicon-html5-plain colored',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'category' => 'Frontend',
                'skill_name' => 'CSS3',
                'level' => 90,
                'icon' => 'devicon-css3-plain colored',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'category' => 'Frontend',
                'skill_name' => 'JavaScript',
                'level' => 85,
                'icon' => 'devicon-javascript-plain colored',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'category' => 'Frontend',
                'skill_name' => 'Bootstrap',
                'level' => 92,
                'icon' => 'devicon-bootstrap-plain colored',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'category' => 'Frontend',
                'skill_name' => 'Tailwind CSS',
                'level' => 86,
                'icon' => 'devicon-tailwindcss-original colored',
                'sort_order' => 10,
                'is_active' => true,
            ],

            // ===========================
            // Mobile
            // ===========================
            [
                'category' => 'Mobile',
                'skill_name' => 'React Native',
                'level' => 82,
                'icon' => 'devicon-react-original colored',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'category' => 'Mobile',
                'skill_name' => 'Android Studio',
                'level' => 80,
                'icon' => 'devicon-androidstudio-plain colored',
                'sort_order' => 12,
                'is_active' => true,
            ],

            // ===========================
            // Tools
            // ===========================
            [
                'category' => 'Tools',
                'skill_name' => 'Git & GitHub',
                'level' => 90,
                'icon' => 'devicon-git-plain colored',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'category' => 'Tools',
                'skill_name' => 'Visual Studio Code',
                'level' => 95,
                'icon' => 'devicon-vscode-plain colored',
                'sort_order' => 14,
                'is_active' => true,
            ],
            [
                'category' => 'Tools',
                'skill_name' => 'Postman (API Testing)',
                'level' => 90,
                'icon' => 'devicon-postman-plain colored',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'category' => 'Tools',
                'skill_name' => 'Arduino IDE / ESP32',
                'level' => 85,
                'icon' => 'devicon-arduino-plain colored',
                'sort_order' => 16,
                'is_active' => true,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['skill_name' => $skill['skill_name']],
                $skill
            );
        }
    }
}