<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = [
        'visitor_record_id',
        'name',
        'control_no',
        'client',
        'lang',
        'sex',
        'age',
        'religion',
        'email',
        'purpose',
        'q1',
        'q2',
        'q3',
        'satisfaction_0',
        'satisfaction_1',
        'satisfaction_2',
        'satisfaction_3',
        'satisfaction_4',
        'satisfaction_5',
        'satisfaction_6',
        'satisfaction_7',
        'satisfaction_8',
        'optional',
        'current_date'
    ];

    // protected $casts = [
    //     'q1' => 'array',
    //     'q2' => 'array',
    //     'q3' => 'array',
    // ];

    public function visitor_record()
    {
        return $this->belongsTo(VisitorRecord::class);
    }
}
