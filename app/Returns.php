<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'deposit_id', 'return_date',
    ];

    protected $casts = [
        'amount' => 'float',
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }
}
