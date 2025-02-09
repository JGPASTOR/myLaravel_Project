<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',

    ];


    protected $table = 'categories';

    protected $primaryKey = 'id';
}
