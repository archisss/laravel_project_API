<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'typeOf', 'cellphone', 'api_token', 'avatar', 'facebookID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId(){
        return $this->id;
    }

    public function parkings(){
        return $this->hasMany(Parking::class);
    }

    public function cars(){
        return $this->hasMany(Car::class);
    }

    public function rentals(){
        return $this->hasMany(Rental::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
    
}
