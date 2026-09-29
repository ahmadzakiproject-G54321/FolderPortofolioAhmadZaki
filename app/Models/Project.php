<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'technology',
        'github_url',
        'demo_url',
        'featured',
        'status',
        'sort_order',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->thumbnail) || file_exists(public_path('storage/' . $this->thumbnail))) {
                return asset('storage/' . $this->thumbnail);
            }
            if (file_exists(public_path($this->thumbnail))) {
                return asset($this->thumbnail);
            }
            if (file_exists(public_path('assets/' . basename($this->thumbnail)))) {
                return asset('assets/' . basename($this->thumbnail));
            }
            if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
                return $this->thumbnail;
            }
            return asset('storage/' . $this->thumbnail);
        }

        return 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=800&auto=format&fit=crop';
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}