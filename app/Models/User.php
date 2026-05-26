<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles;


    protected $fillable = [

        'name',

        'email',

        'password'

    ];


    protected $hidden = [

        'password',

        'remember_token'

    ];


    protected function casts(): array
    {

        return [

            'email_verified_at'
            =>
            'datetime',

            'password'
            =>
            'hashed',

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */


    // User → Profile
    public function profile()
    {

        return $this->hasOne(

            Profile::class

        );

    }



    // User → Articles
    public function articles()
    {

        return $this->hasMany(

            Article::class

        );

    }



    // User → Comments
    public function comments()
    {

        return $this->hasMany(

            Comment::class

        );

    }

}