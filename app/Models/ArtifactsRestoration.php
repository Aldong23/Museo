<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtifactsRestoration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'artifact_id',
        'valid_id',
        'fname',
        'mname',
        'lname',
        'suffix',
        'contact_no',
        'email',
        'date_released', //date
        'conservation_status_before', //array
        'artifacts_before', //array
        'remarks_before',
        'date_restored', //date
        'conservation_status_after', //array
        'artifacts_after', //array
        'remarks_after',
        'status',
        'released_by',
        'received_by'
    ];


    protected $casts = [
        'conservation_status_before' => 'array',
        'artifacts_before' => 'array',
        'conservation_status_after' => 'array',
        'artifacts_after' => 'array',
        'date_released' => 'date:Y-m-d',
        'date_restored' => 'date:Y-m-d',
    ];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function releasedBy()
    {

        return $this->belongsTo(User::class, 'released_by');
    }

    public function receivedBy()
    {

        return $this->belongsTo(User::class, 'received_by');
    }
}
