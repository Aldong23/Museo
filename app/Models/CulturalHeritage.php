<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulturalHeritage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details',
        'sub_category',
        'latitude',
        'longitude',
        'location',
        'address',
        'area',
        'ownership',
        'description',
        'stories',
        'significance',
        'conservation',
        'references',
        'name_of_mapper',
        'date_profiled',        // date
        'other_common_name',
        'scientific_name',
        'classification_growth_habit',
        'classification_origin',
        'habitat',
        'indicate_visibility',
        'indicate_seasonability',
        'common_uses', // array
        'remarks',
        'classification',
        'special_notes',
        'time_of_year_most_seen',
        'category',
        'legislation_date',
        'existing_hazard_type',
        'summary',
        'attachment',
        'views'
    ];

    protected $casts = [
        'photo_details' => 'array',
        'common_uses' => 'array',
        'date_profiled' => 'date',
    ];
}
