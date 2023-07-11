<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'hotel_id',
        'name',
        'email',
        'status',
    ];
    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }
}
