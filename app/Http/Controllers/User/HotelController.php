<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Models\HotelUser;
use App\Models\RoomType;
use App\Models\SelectedRoomType;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function hotelDetails(Hotel $hotel){
        $hotel->load([
            'hotelPhotos',
            'facilities',
            'selectedRoomTypes.roomType'
        ])->loadSum('selectedRoomTypes','total_rooms');
      
        return view('front.hotel_detail',compact('hotel'));
    }


    public function bookHotel($id){
        $hotel = Hotel::find($id);
       
        
        $hotel->load([
            'selectedRoomTypes.roomType'
        ]);
       
        return view('front.book_hotel',compact('hotel'));
        
    }


    public function bookHotelSubmit(Request $request,$id){
        
        $request->validate([
            'check_in'=> 'required',
            'check_out'=> 'required',
            'room_id'=> 'required',
            'guests'=> 'required',
            'price'=> 'required',
        ]);

       $data = Hotel::find($id);
       $hotel_id = $data->id;
       $user_id = Auth::user()->id;
       $email = 'contact@test.com';
       $name = 'Test';
       $data_insert = array_merge($request->only('check_in','check_out','guests','price','room_id'),[
        'user_id' => $user_id,
        'hotel_id' => $hotel_id,
        'contact_name' => $name,
        'contact_email' => $email,
        'status' => 'Pending',
       ]);

      $booking = Booking::create($data_insert);
      return redirect()->route('payments',$booking->id);
    }

    public function payments($id){
        $booking = Booking::find($id);
        return view('front.payment',compact('booking'));
    }

    public function paymentSubmit(Request $request, $id){
        $booking = Booking::find($id);
        $booking_id = $booking->id;
        $hotel_id = $booking->hotel_id;

        $data_insert = array_merge($request->only('name','email'),[
            'booking_id' => $booking_id,
            'hotel_id' => $hotel_id,
            'status' => 1,
        ]);
        Payment::create($data_insert);
        if($data_insert['status'] == 1){
            $booking->status = 'Paid';
            $booking->update();
        }
        return redirect()->back()->with('success','payment is successfull');
    }
}
