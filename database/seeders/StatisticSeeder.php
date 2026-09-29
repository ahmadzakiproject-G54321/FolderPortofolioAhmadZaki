<?php

namespace Database\Seeders;

use App\Models\Statistic;
use App\Models\Project;
use App\Models\Review;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $profile = Profile::first();
        $publishedProjectsCount = Project::where('status', 'Published')->count();
        $approvedReviewsCount = Review::where('is_approved', true)->count();

        // Bersihkan data lama jika menggunakan judul bahasa Inggris
        Statistic::whereIn('title', [
            'Projects Completed',
            'Years Experience',
            'Happy Clients',
            'REST APIs Built'
        ])->delete();

        $items = [
            [
                'title' => 'Proyek Selesai',
                'number' => $publishedProjectsCount > 0 ? $publishedProjectsCount : 7,
                'suffix' => '+',
                'icon' => 'bi-folder-check',
                'sort_order' => 1,
            ],
            [
                'title' => 'Tahun Pengalaman',
                'number' => ($profile && $profile->experience_years > 0) ? $profile->experience_years : 3,
                'suffix' => '+',
                'icon' => 'bi-briefcase',
                'sort_order' => 2,
            ],
            [
                'title' => 'Klien Puas',
                'number' => $approvedReviewsCount > 0 ? $approvedReviewsCount : 3,
                'suffix' => '+',
                'icon' => 'bi-emoji-smile',
                'sort_order' => 3,
            ],
            [
                'title' => 'REST API Dibangun',
                'number' => ($profile && $profile->rest_api_count > 0) ? $profile->rest_api_count : 15,
                'suffix' => '+',
                'icon' => 'bi-cpu',
                'sort_order' => 4,
            ],
        ];

        foreach ($items as $item) {
            $existing = Statistic::where('title', $item['title'])->first();
            if ($existing) {
                // Pertahankan suffix yang sudah diset user (termasuk jika dikosongkan/null)
                $item['suffix'] = $existing->suffix;
                if ($existing->number > 0) {
                    $item['number'] = $existing->number;
                }
            }

            Statistic::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
