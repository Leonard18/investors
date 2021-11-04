<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'plan_id', 'status', 'plan_title',
    ];

    protected $cast = [
        'amount' => 'float',
    ];
    

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function returns() {

        return $this->hasMany(Returns::class);

    }
}
