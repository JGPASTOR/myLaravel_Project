<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'provider_id',
        'provider_name',
        'provider_phone',
        'provider_address',
        'status',

        'image',
        'title',
        'price',

    ];


    protected $table = 'services';

    protected $primaryKey = 'id';
    
}


