<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignificantPersonalities extends Model
{

    // public $type;

    protected $fillable = [
        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details',
        'date_of_birth',
        'date_of_death',
        'age',
        'prominence',
        'birthplace',
        'present_address',
        'biography',
        'significance',
        'references',
        'mapper',
        'date_profiled',
        'attachment',
        'views'
    ];

    protected $casts = [
        'photo_details' => 'array',
        'date_profiled' => 'date',
        'date_of_birth' => 'date',
        'date_of_death' => 'date',
        'attachment' => 'array'
    ];
}
