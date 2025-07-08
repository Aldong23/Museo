<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntangibleCulturalHeritage extends Model
{
    protected $fillable = [

        'cultural_heritage_category',
        'cultural_heritage_type',
        'name',
        'photo_details', // array
        'type',
        'geographical_location',
        'related_domains',
        'summary_of_elements',
        'list_of_tangible_movable_heritage', //array
        'list_of_flora_fauna', //array
        'stories',
        'significance',
        'assessment_of_practice',
        'measures_and_description_dropdown', // array
        'measures_and_description_text',
        'supporting_documentation', //array
        'key_informat',
        'mappers',
        'date_profiled', //date
        'attachment_text',
        'attachment_image',
        'views'

    ];

    protected $casts = [
        'photo_details' => 'array', // array
        'list_of_tangible_movable_heritage' => 'array', //array
        'list_of_flora_fauna' => 'array', //array
        'supporting_documentation' => 'array', //array
        'date_profiled' => 'date', //date
    ];
}
