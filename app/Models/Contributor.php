<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $fillable = [
        'artifact_id',
        'fname',
        'mname',
        'lname',
        'suffix',
        'sex',
        'contact_no',
        'email',
        'province',
        'municipality',
        'barangay',
        'address',
    ];

    public function artifact()
    {

        return $this->belongsTo(Artifact::class);
    }
}
