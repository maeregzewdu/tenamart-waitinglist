<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $fillable = [
        'pharmacy', 
        'name', 
        'email', 
        'phone',
        'signup_source'
    ];
}
