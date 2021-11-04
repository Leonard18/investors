<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'country', 'avatar', 'password',
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

    
    public function deposits() {

        return $this->hasMany(Deposit::class);

    }

    public function transactions() {

        return $this->hasMany(Transaction::class);

    }

    public function earnings() {

        return $this->hasMany(Earning::class);

    }
    

    public function withdrawables() {

        return $this->hasMany(Withdrawable::class);

    }

    public function returns() {

        return $this->hasMany(Returns::class);

    }

    public function plans() {

        return $this->hasMany(Plans::class);

    }



}
