<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? new Profile();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first() ?? new Profile();

        // Pre-normalize URLs if user omitted https://
        foreach (['github', 'linkedin', 'instagram'] as $urlField) {
            $val = trim((string) $request->input($urlField, ''));
            if ($val !== '' && (str_contains($val, '.') || str_contains($val, '/')) && !preg_match('~^[a-zA-Z][a-zA-Z0-9+.-]*://~', $val)) {
                $request->merge([$urlField => 'https://' . ltrim($val, '/')]);
            }
        }

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|max:4096',
            'short_description' => 'nullable|string|max:1000',
            'about' => 'nullable|string',
            'career_objective' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'maps_embed' => 'nullable|string|max:2000',
            'github' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:50',
            'resume_file' => 'nullable|mimes:pdf|max:8192',
            'languages' => 'nullable|array',
            'languages.*.name' => 'nullable|string|max:100',
            'languages.*.percentage' => 'nullable|numeric|min:0|max:100',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'github.url' => 'Format URL GitHub tidak valid (contoh: https://github.com/username).',
            'linkedin.url' => 'Format URL LinkedIn tidak valid (contoh: https://linkedin.com/in/username).',
            'instagram.url' => 'Format URL Instagram tidak valid (contoh: https://instagram.com/username).',
            'profile_photo.image' => 'File foto profil harus berupa file gambar.',
            'profile_photo.max' => 'Ukuran file foto profil maksimal 4MB.',
            'resume_file.mimes' => 'File resume/CV harus berformat PDF.',
            'resume_file.max' => 'Ukuran file resume/CV maksimal 8MB.',
            'languages.*.percentage.numeric' => 'Persentase penguasaan bahasa harus berupa angka (0 - 100).',
            'languages.*.percentage.min' => 'Persentase penguasaan bahasa minimal 0%.',
            'languages.*.percentage.max' => 'Persentase penguasaan bahasa maksimal 100%.',
        ]);

        // Process languages list
        $rawLanguages = $request->input('languages', []);
        $cleanLanguages = [];
        if (is_array($rawLanguages)) {
            foreach ($rawLanguages as $lang) {
                $name = trim($lang['name'] ?? '');
                $pct = isset($lang['percentage']) && $lang['percentage'] !== '' ? (int) $lang['percentage'] : null;
                if ($name !== '' && $pct !== null) {
                    $cleanLanguages[] = [
                        'name' => $name,
                        'percentage' => max(0, min(100, $pct)),
                    ];
                }
            }
        }
        $data['languages'] = $cleanLanguages;

        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo && Storage::disk('public')->exists($profile->profile_photo)) {
                Storage::disk('public')->delete($profile->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile', 'public');
        } else {
            unset($data['profile_photo']);
        }

        if ($request->hasFile('resume_file')) {
            if ($profile->resume_file && Storage::disk('public')->exists($profile->resume_file)) {
                Storage::disk('public')->delete($profile->resume_file);
            }
            $data['resume_file'] = $request->file('resume_file')->store('resume', 'public');
        } else {
            unset($data['resume_file']);
        }

        $profile->fill($data)->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil disimpan.');
    }
}
