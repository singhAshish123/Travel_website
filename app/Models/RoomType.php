<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    public function selectedRooms()
    {
        return $this->hasMany(SelectedRoomType::class);
    }
}
