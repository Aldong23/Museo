<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtifactExhibit extends Model
{
    protected $fillable = [
        'user_id',
        'program_name',
        'subject_activity',
        'province',
        'municipality',
        'barangay',
        'address',
        'start_date', // date
        'end_date', // date
        'description',
        'remarks',
        'artifacts_id', // array
        'status',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'artifacts_id' => 'array',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
