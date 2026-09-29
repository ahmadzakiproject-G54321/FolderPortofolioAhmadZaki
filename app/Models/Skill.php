<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'category',
        'skill_name',
        'level',
        'icon',
        'sort_order',
        'is_active',
    ];
}