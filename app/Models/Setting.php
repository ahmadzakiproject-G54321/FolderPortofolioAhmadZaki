<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'admin_favicon',
        'primary_color',
        'secondary_color',
        'footer_text',
    ];

    public static function current(): self
    {
        return static::first() ?? new static([
            'site_name' => 'Portofolio Ahmad Zaki',
            'primary_color' => '#2563eb',
            'secondary_color' => '#1e293b',
            'footer_text' => '© ' . date('Y') . ' Ahmad Zaki. Seluruh hak cipta dilindungi.',
        ]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (!empty($this->logo)) {
            if (file_exists(public_path('storage/' . $this->logo)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($this->logo)) {
                return asset('storage/' . $this->logo);
            }
            if (file_exists(public_path($this->logo))) {
                return asset($this->logo);
            }
        }
        return null;
    }

    public function getFaviconUrlAttribute(): string
    {
        if (!empty($this->favicon)) {
            if (file_exists(public_path('storage/' . $this->favicon)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($this->favicon)) {
                return asset('storage/' . $this->favicon);
            }
            if (file_exists(public_path($this->favicon))) {
                return asset($this->favicon);
            }
        }
        return asset('assets/site-favicon.svg');
    }

    public function getAdminFaviconUrlAttribute(): string
    {
        if (!empty($this->admin_favicon)) {
            if (file_exists(public_path('storage/' . $this->admin_favicon)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($this->admin_favicon)) {
                return asset('storage/' . $this->admin_favicon);
            }
            if (file_exists(public_path($this->admin_favicon))) {
                return asset($this->admin_favicon);
            }
        }
        return asset('assets/admin-favicon.svg');
    }

    public static function getFaviconMimeType(?string $url): string
    {
        if (empty($url)) {
            return 'image/svg+xml';
        }
        $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        return match ($ext) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            default => 'image/x-icon',
        };
    }
}