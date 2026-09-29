<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Laravel Web Development',
                'icon' => 'bi bi-code-slash',
                'description' => 'Membangun aplikasi web yang tangguh, scalable, dan modern menggunakan framework Laravel dengan clean architecture.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'REST API Development',
                'icon' => 'bi bi-plugin',
                'description' => 'Merancang dan mengimplementasikan RESTful API yang cepat, aman, terstandarisasi JSON, serta mudah diintegrasikan dengan mobile app maupun frontend modern.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Database Design & Optimization',
                'icon' => 'bi bi-database-fill',
                'description' => 'Perancangan skema relasional MySQL, normalisasi tabel, pembuatan relasi data yang efisien, dan optimasi query berkecepatan tinggi.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'CRUD & Management System',
                'icon' => 'bi bi-card-checklist',
                'description' => 'Pengembangan modul data master, inventaris barang, kasir (POS), kesiswaan, perpustakaan, hingga pelaporan otomatis PDF & Excel.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Authentication & Access Control',
                'icon' => 'bi bi-shield-lock-fill',
                'description' => 'Implementasi sistem otentikasi aman, proteksi CSRF/XSS, manajemen role dan permission bertingkat (multi-role authorization).',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Admin Dashboard & Analytics',
                'icon' => 'bi bi-speedometer2',
                'description' => 'Pembuatan dashboard admin interaktif dengan ringkasan statistik, grafik tren data real-time, dan manajemen konten terpadu.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'IoT & Hardware Integration',
                'icon' => 'bi bi-cpu-fill',
                'description' => 'Integrasi perangkat mikrokontroler ESP32 / Arduino dengan server web dan notifikasi instan Telegram Bot secara real-time.',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}