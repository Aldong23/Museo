<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Artifact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'artifact_no',
        'category',
        'type',
        'name',
        'date_photograph',
        'owned_by',
        'donated_by',
        'description',
        'story',
        'collections',
        'views',
        'date_profiled',
        'remarks',
        'status',
    ];

    protected $casts = [
        'date_photograph' => 'date',
        'date_profiled' => 'date',
        'collections' => 'array',
    ];

    public function restorations()
    {

        return $this->hasMany(ArtifactsRestoration::class);
    }

    public function contributor()
    {

        return $this->hasOne(Contributor::class);
    }
}
