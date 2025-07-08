<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorRecord extends Model
{

    protected $fillable = [
        'visitor_id',
        'client_type',
        'control_no',
        'purpose',
        'approved_by'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
    
     public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
