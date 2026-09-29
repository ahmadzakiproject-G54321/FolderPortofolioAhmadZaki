<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'platform' => 'GitHub',
                'icon' => 'bi bi-github',
                'url' => 'https://github.com/ahmadzakiproject',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'platform' => 'LinkedIn',
                'icon' => 'bi bi-linkedin',
                'url' => 'https://linkedin.com/in/ahmadzakiproject',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'platform' => 'WhatsApp',
                'icon' => 'bi bi-whatsapp',
                'url' => 'https://wa.me/+6281261514108',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'platform' => 'Instagram',
                'icon' => 'bi bi-instagram',
                'url' => 'https://instagram.com/ahmadzaki1862',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'platform' => 'Email',
                'icon' => 'bi bi-envelope-fill',
                'url' => 'mailto:ahmadzakiproject@gmail.com',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }
}