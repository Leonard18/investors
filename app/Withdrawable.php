<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawable extends Model
{
    protected $fillable = [
        'user_id', 'earning', 'amount', 'date_earned',
    ];

    protected $cast = [
        'amount' => 'float',
        'date_earned' => 'datetime',
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }
}
