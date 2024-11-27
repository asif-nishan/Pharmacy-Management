<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'title',
        'company',
        'address',
        'email',
        'phone_number',
        'status',
    ];
}
