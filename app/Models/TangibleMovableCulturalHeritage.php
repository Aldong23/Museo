<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TangibleMovableCulturalHeritage extends Model
{
    protected $fillable = [

        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details', //array
        'type', //array
        'date_of_record', // date
        'length',
        'width',
        'arrangement',
        'office_of_origin',
        'contact_person',
        'description',
        'description_of_material', // array
        'remarks_1',
        'stories',
        'significance',
        'physical_condition', // array
        'remarks_2',
        'narration',
        'references',
        'mappers',
        'date_profiled', //date
        'date_produced',
        'estimated_age',
        'name_of_owner',
        'type_of_acquisition',
        'views'
    ];

    protected $casts = [
        'photo_details' => 'array', //array
        'type' => 'array', //array
        'date_of_record' => 'date', // date
        'date_produced' => 'date',
        'description_of_material' => 'array', // array
        'physical_condition' => 'array', // array
        'date_profiled' => 'date', //date
    ];
}
