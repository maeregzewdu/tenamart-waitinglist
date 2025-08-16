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
        'signup_source',
        'utm_source','utm_medium','utm_campaign','utm_term','utm_content',
    ];
}
