<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photo = file_exists(storage_path('app/public/profile/q9NWjcxPzXzibxlPB23Iv6Of6AwFr2E3nkCPPNDS.jpg'))
            ? 'profile/q9NWjcxPzXzibxlPB23Iv6Of6AwFr2E3nkCPPNDS.jpg'
            : 'assets/profile.png';

        $resume = file_exists(storage_path('app/public/resume/CvAhmadZaki.pdf'))
            ? 'resume/CvAhmadZaki.pdf'
            : 'resume/CV_Ahmad_Zaki.pdf';

        Profile::updateOrCreate(
            ['id' => 1],
            [
                'full_name' => 'Ahmad Zaki',
                'profession' => 'Backend Web Developer | Laravel & PHP Specialist',
                'profile_photo' => $photo,

                'short_description' => 'Software Engineer & Web Developer yang berfokus pada arsitektur backend modern, performa tinggi, perancangan RESTful API, dan optimasi basis data relasional.',

                'about' => 'Saya adalah lulusan Sistem Komputer dari STMIK Jayanusa Padang dengan fokus keahlian pada Backend Development menggunakan Laravel, PHP, dan MySQL. Saya memiliki pengalaman dalam membangun berbagai sistem berbasis web seperti sistem inventaris barang, apotek, sistem absensi, e-commerce, hingga integrasi monitoring IoT menggunakan ESP32 dan Telegram Bot. Saya selalu berkomitmen menghasilkan kode yang bersih, scalable, dan aman sesuai standar industri.',

                'career_objective' => 'Berkomitmen untuk terus berkembang dan berkontribusi sebagai Backend Software Engineer profesional dalam merancang dan membangun arsitektur sistem web yang handal, efisien, aman, dan scalable untuk memberikan dampak positif nyata bagi pengguna dan bisnis.',

                'languages' => [
                    ['name' => 'Bahasa Indonesia (Fasih)', 'percentage' => 90],
                    ['name' => 'Bahasa Minang (Bahasa Asli)', 'percentage' => 100],
                    ['name' => 'Bahasa Inggris (Teknis)', 'percentage' => 75],
                ],

                'experience_years' => 3,
                'rest_api_count' => 15,

                'email' => 'ahmadzakiproject@gmail.com',
                'phone' => '081261514108',
                'address' => 'Bantar Gebang',
                'maps_embed' => 'google.com/maps/place/Kec.+Bantar+Gebang,+Kota+Bks,+Jawa+Barat/@-6.3361301,106.9509285,13z/data=!3m1!4b1!4m6!3m5!1s0x2e6993cd1cfd5131:0xbc41a51ae9cf5e0e!8m2!3d-6.3414752!4d106.9898519!16s%2Fg%2F12314d3x?authuser=0&entry=tts&g_ep=EgoyMDI2MDkyMy4wIPu8ASoASAFQAw%3D%3D&skid=fa6457ee-d34a-4cfb-8cbd-d5762061e8e4',

                'github' => 'https://github.com/ahmadzakiproject',
                'linkedin' => 'https://linkedin.com/in/ahmadzakiproject',
                'instagram' => 'https://instagram.com/ahmadzaki1862',
                'whatsapp' => 'https://wa.me/+6281261514108',

                'resume_file' => $resume,
            ]
        );
    }
}