<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = ['subject', 'description', 'user_id'];


    // Relationship between users.. 
    public function user() {

        return $this->belongsTo(User::class);

    }
}
