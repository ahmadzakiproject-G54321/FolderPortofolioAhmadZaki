<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'profession',
        'profile_photo',
        'short_description',
        'about',
        'career_objective',
        'languages',
        'experience_years',
        'rest_api_count',
        'email',
        'phone',
        'address',
        'maps_embed',
        'github',
        'linkedin',
        'instagram',
        'whatsapp',
        'resume_file',
    ];

    protected $casts = [
        'languages' => 'array',
    ];

    public function getLanguagesListAttribute(): array
    {
        if (is_array($this->languages)) {
            return $this->languages;
        }

        return [
            ['name' => 'Bahasa Indonesia (Fasih)', 'percentage' => 100],
            ['name' => 'Bahasa Minang (Bahasa Asli)', 'percentage' => 100],
            ['name' => 'Bahasa Inggris (Teknis)', 'percentage' => 75],
        ];
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if (!empty($this->profile_photo)) {
            // Cek jika tersimpan di folder public/storage (hasil upload)
            if (file_exists(public_path('storage/' . $this->profile_photo)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($this->profile_photo)) {
                return asset('storage/' . $this->profile_photo);
            }
            // Cek jika tersimpan langsung di folder public
            if (file_exists(public_path($this->profile_photo))) {
                return asset($this->profile_photo);
            }
            // Cek jika berupa URL eksternal
            if (filter_var($this->profile_photo, FILTER_VALIDATE_URL)) {
                return $this->profile_photo;
            }
        }
        return asset('assets/profile.png');
    }

    public function getHasResumeAttribute(): bool
    {
        return !empty($this->resume_file) && (
            \Illuminate\Support\Facades\Storage::disk('public')->exists($this->resume_file) ||
            file_exists(public_path('storage/' . $this->resume_file)) ||
            file_exists(public_path($this->resume_file))
        );
    }

    public function getResumeUrlAttribute(): ?string
    {
        if ($this->has_resume) {
            return route('cv.download');
        }
        return null;
    }

    public function getInitialsAttribute(): string
    {
        $name = trim($this->full_name ?? 'Ahmad Zaki');
        $words = array_values(array_filter(preg_split('/\s+/', $name)));
        if (count($words) >= 2) {
            return strtoupper(mb_substr($words[0], 0, 1) . mb_substr($words[1], 0, 1));
        } elseif (count($words) === 1 && mb_strlen($words[0]) > 0) {
            return strtoupper(mb_substr($words[0], 0, min(2, mb_strlen($words[0]))));
        }
        return 'AZ';
    }

    public function getFirstNameAttribute(): string
    {
        $name = trim($this->full_name ?? 'Ahmad');
        $words = array_values(array_filter(preg_split('/\s+/', $name)));
        return $words[0] ?? 'Ahmad';
    }

    public function getMapsIframeUrlAttribute(): string
    {
        if (!empty($this->maps_embed)) {
            if (preg_match('/src="([^"]+)"/', $this->maps_embed, $matches)) {
                return $matches[1];
            }
            if (filter_var($this->maps_embed, FILTER_VALIDATE_URL)) {
                return $this->maps_embed;
            }
        }

        $address = !empty($this->address) ? $this->address : 'Pesisir Selatan, Sumatera Barat';
        return 'https://maps.google.com/maps?q=' . urlencode($address) . '&t=&z=13&ie=UTF8&iwloc=&output=embed';
    }
}