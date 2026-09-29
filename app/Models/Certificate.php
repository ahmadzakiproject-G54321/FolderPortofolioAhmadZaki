<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'issue_date',
        'certificate_image',
        'certificate_file',
        'credential_url',
        'sort_order',
    ];

    public function getCertificateImageUrlAttribute(): string
    {
        if (!empty($this->certificate_image)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->certificate_image) || file_exists(public_path('storage/' . $this->certificate_image))) {
                return asset('storage/' . $this->certificate_image);
            }
            if (file_exists(public_path($this->certificate_image))) {
                return asset($this->certificate_image);
            }
            if (file_exists(public_path('assets/' . basename($this->certificate_image)))) {
                return asset('assets/' . basename($this->certificate_image));
            }
            if (filter_var($this->certificate_image, FILTER_VALIDATE_URL)) {
                return $this->certificate_image;
            }
            return asset('storage/' . $this->certificate_image);
        }

        return 'https://images.unsplash.com/photo-1607252650355-f7fd0460ccdb?q=80&w=800&auto=format&fit=crop';
    }

    public function getCertificateFileUrlAttribute(): ?string
    {
        if (!empty($this->certificate_file)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->certificate_file) || file_exists(public_path('storage/' . $this->certificate_file))) {
                return asset('storage/' . $this->certificate_file);
            }
            if (file_exists(public_path($this->certificate_file))) {
                return asset($this->certificate_file);
            }
            return asset('storage/' . $this->certificate_file);
        }

        return null;
    }
}