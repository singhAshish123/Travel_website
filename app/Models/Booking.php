<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hotel_id',
        'room_id',
        'check_in',
        'check_out',
        'contact_name',
        'contact_email',
        'price',
        'guests',
        'status',

    ];
    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function bookings()
    {
        return $this->hasOne(Payment::class);
    }
}
