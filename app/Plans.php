<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'body', 'commission_rate', 'investment_range'
    ];

    protected $cast = [
        'commission_rate' => 'float',
    ];

}
