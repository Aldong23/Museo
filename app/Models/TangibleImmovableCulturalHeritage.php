<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TangibleImmovableCulturalHeritage extends Model
{
    protected $fillable = [
        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details',
        'type',
        'ownership',
        'location',
        'address',
        'latitude',
        'longitude',
        'year_constructed',
        'area',
        'structure',
        'estimated_age',
        'ownership_jurisdiction',
        'declaration_legislation',
        //
        'description',
        'stories',
        'significance',
        'conservation',
        'condition_of_structure',
        'remarks_1',
        'integrity_of_structure',
        'remarks_2',
        'list_of_cultural_props',
        'references',
        'name_of_mapper',
        'date_profiled',
        'views'
    ];

    protected $casts = [
        'photo_details' => 'array',
        'list_of_cultural_props' => 'array',
        'date_profiled' => 'date',
    ];
}
