<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $favicon = file_exists(storage_path('app/public/settings/favicon/0S97bNrVWDfQMVNYLaGrCBZg1bP3lUf0NP0Vu7Os.jpg'))
            ? 'settings/favicon/0S97bNrVWDfQMVNYLaGrCBZg1bP3lUf0NP0Vu7Os.jpg'
            : null;

        $adminFavicon = file_exists(storage_path('app/public/settings/admin_favicon/4POSOExej7TYu5sjOu5cij4gTIOEM2NarsDX2Cy6.jpg'))
            ? 'settings/admin_favicon/4POSOExej7TYu5sjOu5cij4gTIOEM2NarsDX2Cy6.jpg'
            : null;

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name'       => 'Portofolio Ahmad Zaki',
                'logo'            => 'logo/logo.png',
                'favicon'         => $favicon,
                'admin_favicon'   => $adminFavicon,
                'primary_color'   => '#2563EB',
                'secondary_color' => '#1E293B',
                'footer_text'     => '© 2026 Ahmad Zaki. Seluruh hak cipta dilindungi.',
            ]
        );
    }
}