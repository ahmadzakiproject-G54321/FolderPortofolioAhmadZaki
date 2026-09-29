<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'title',
        'number',
        'suffix',
        'icon',
        'sort_order',
    ];
}