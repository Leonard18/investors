<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $fillable = [
        'transaction_id', 'amount', 'due_date', 'user_id', 'plan_id', 'plan_title',
    ];

    protected $cast = [
        'amount' => 'float',
        'due_date' => 'string',
    ];


    public function user() {

        return $this->belongsTo(User::class);

    }


    // Earning relationship... 
    public function transactions() {

        return $this->hasMany(Transaction::class);

    }
}
