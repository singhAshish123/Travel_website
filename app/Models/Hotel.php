<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_name',
        'hotel_email',
        'address',
        'postal_code',
        'country_id',
        'state_id',
        'city_id',
        'total_rooms',
        'description',
        'logo',
        // Add any other attributes here
    ];
    public function selectedRoomTypes()
    {
        return $this->hasMany(SelectedRoomType::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
    public function hotelPhotos()
    {
        return $this->hasMany(HotelPhoto::class);
    }
    public function bookings()
    {
        return $this->hasOne(Booking::class);
    }

}
