<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Pest\Mutate\Mutators\Visibility\FunctionPublicToProtected;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

class Visitor extends Authenticatable
{

    use  Notifiable;
    use SoftDeletes;

    protected $table = 'visitors';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'suffix',
        'sex',
        'birthday',
        'age',
        'email',
        'religion',
        'province',
        'city',
        'barangay',
        'street',
        'house_no',
        'contact_no',
        'expires_at',
    ];

    public function visitor()
    {
        return $this->hasOne(Visitor::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }



    public function visitorRecords()
    {
        return $this->hasMany(VisitorRecord::class);
    }

}
