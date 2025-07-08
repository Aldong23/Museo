<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CulturalInstitutions extends Model
{
    protected $fillable = [
        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details', //json
        'city',
        'province',
        'location',
        'type_of_cultural_institutions',
        'remarks_image',
        'remarks_text',
        'narrative_description',
        'stories',
        'significance',
        'supporting_documentation', // array
        'key_informats',
        'mappers',
        'date_profiled', //date
        'farmers_association', // array

        //attri for association
        'assessment',

        'organizational_chart',
        'views'
    ];

    protected $casts = [
        'photo_details' => 'array',
        'supporting_documentation' => 'array',
        'farmers_association' => 'array',
        'date_profiled' => 'date',

        'organizational_chart' => 'array'
    ];
}
