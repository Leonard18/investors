<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'amount_invested', 'expected_return', 'total', 'commission_rate', 'plan_id', 'plan_title', 'status', 'expires_at',
    ];

    protected $cast = [
        'amount_invested' => 'float',
        'expected_return' => 'float',
        'total' => 'float',
        'commission_rate' => 'float',
        'expires_at' => 'datetime',
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }

    public function earning() {

        return $this->belongsTo(Earning::class);

    }
}
