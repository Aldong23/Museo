<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'suffix',
        'email',
        'employee_no',
        'password',
        'position',
        'last_seen',
        'profile',
        // for admin access
        'is_admin',
        'is_admin_staff',
        'is_technical',
        'is_clerical',
        'is_tourist_assistance'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['expires_at'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_seen' => 'datetime',
            'approved' => 'boolean',
            'is_visitor' => 'boolean',
            'is_admin' => 'boolean',
            'is_admin_staff' => 'boolean',
            'is_technical' => 'boolean',
            'is_clerical' => 'boolean',
            'is_tourist_assistance' => 'boolean',

        ];
    }

    public function restored()
    {
        return $this->hasMany(ArtifactsRestoration::class);
    }

    public function exhibits()
    {

        return $this->hasMany(ArtifactExhibit::class);
    }
}
