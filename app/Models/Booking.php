<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'service_id',
        'user_id',
        'client_name',
        'client_phone',
        'service_user_id',
        'service_user_name',
        'service_user_phone',
        'service_user_address',
        'service_user_title',
        'service_user_price',
        'service_user_image',
        'status',

        'date',
        'time', 
        'message',
            
    ];

    protected $table = 'bookings'; 

    protected $primaryKey = 'id';

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
