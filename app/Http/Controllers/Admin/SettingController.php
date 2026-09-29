<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::current();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();

        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png,svg,jpg,jpeg|max:1024',
            'admin_favicon' => 'nullable|file|mimes:ico,png,svg,jpg,jpeg|max:1024',
            'primary_color' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/'],
            'secondary_color' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/'],
            'footer_text' => 'nullable|string|max:500',
        ], [
            'site_name.required' => 'Nama website wajib diisi.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran file logo maksimal 2MB.',
            'favicon.mimes' => 'Format favicon harus berupa .ico, .png, .svg, atau .jpg.',
            'admin_favicon.mimes' => 'Format icon tab admin harus berupa .ico, .png, .svg, atau .jpg.',
            'primary_color.regex' => 'Format warna primer harus berupa kode HEX (contoh: #2563EB).',
            'secondary_color.regex' => 'Format warna sekunder harus berupa kode HEX (contoh: #1E293B).',
        ]);

        // Hapus logo jika diminta
        if ($request->boolean('remove_logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = null;
        } elseif ($request->hasFile('logo')) {
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings/logo', 'public');
        } else {
            unset($data['logo']);
        }

        // Hapus favicon frontend jika diminta
        if ($request->boolean('remove_favicon')) {
            if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = null;
        } elseif ($request->hasFile('favicon')) {
            if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('settings/favicon', 'public');
        } else {
            unset($data['favicon']);
        }

        // Hapus icon tab admin jika diminta
        if ($request->boolean('remove_admin_favicon')) {
            if ($setting->admin_favicon && Storage::disk('public')->exists($setting->admin_favicon)) {
                Storage::disk('public')->delete($setting->admin_favicon);
            }
            $data['admin_favicon'] = null;
        } elseif ($request->hasFile('admin_favicon')) {
            if ($setting->admin_favicon && Storage::disk('public')->exists($setting->admin_favicon)) {
                Storage::disk('public')->delete($setting->admin_favicon);
            }
            $data['admin_favicon'] = $request->file('admin_favicon')->store('settings/admin_favicon', 'public');
        } else {
            unset($data['admin_favicon']);
        }

        $setting->fill($data)->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan website berhasil diperbarui.');
    }

    public function linkStorage()
    {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Jika symlink sudah ada dan valid
        if (file_exists($link)) {
            return redirect()->route('admin.settings.edit')->with('success', 'Folder storage sudah terhubung.');
        }

        // Coba buat symlink secara aman jika fungsi symlink diizinkan di PHP
        if (function_exists('symlink')) {
            try {
                @symlink($target, $link);
                if (file_exists($link)) {
                    return redirect()->route('admin.settings.edit')->with('success', 'Symbolic link storage berhasil dibuat di server!');
                }
            } catch (\Throwable $e) {
                // Lanjut ke penanganan route fallback
            }
        }

        // Jika fungsi symlink/exec dinonaktifkan oleh Rumahweb, route fallback di web.php sudah aktif otomatis
        return redirect()->route('admin.settings.edit')->with('success', 'Hosting Rumahweb membatasi fungsi exec/symlink, tetapi rute otomatis Laravel (/storage/*) sudah aktif. Seluruh icon dan gambar upload Anda tetap tampil sempurna.');
    }
}
