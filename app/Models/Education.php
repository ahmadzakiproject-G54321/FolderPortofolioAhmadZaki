<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $fillable = [
        'institution',
        'education_level',
        'degree',
        'major',
        'start_year',
        'end_year',
        'gpa',
        'description',
        'sort_order',
    ];
}