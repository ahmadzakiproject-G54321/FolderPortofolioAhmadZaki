<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            SkillSeeder::class,
            ProjectSeeder::class,
            CertificateSeeder::class,
            ServiceSeeder::class,
            SocialLinkSeeder::class,
            ReviewSeeder::class,
            StatisticSeeder::class,
            ContactSeeder::class,
            SettingSeeder::class,
        ]);
    }
}