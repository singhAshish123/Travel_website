<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\DataTables\HotelsDataTable;
use App\DataTables\PostsDataTable;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\SelectedRoomType;
use App\Models\Facility;
use App\Models\HotelPhoto;





class HotelController extends Controller
{
    public function hotel(HotelsDataTable $data){
        return $data->render('admin.hotels.hotel');
    }
    public function hotel_create(){
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $roomtypes = RoomType::all();

        return view('admin.hotels.hotel_create',compact('countries','states','cities','roomtypes'));
    }
    public function hotel_submit(Request $req)
{
    $req->validate([
        'hotel_name' => 'required',
        'hotel_email' => 'required|email',
        'address' => 'required',
        'postal_code' => 'required',
        'country_id' => 'required',
        'state_id' => 'required',
        'city_id' => 'required',
        'description' => 'required',
        'total_rooms' => 'required',
        'one_room_price' => 'required',
        'room_types' => 'required',
        'logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:4096',
        'image' => 'required',
    ]);

    $ext = $req->file('logo')->extension();
    $imageName = date('YmdHis').'.'.$ext;
    // $req->move(storage_path('app/public/images/'),$imageName);
    $req->file('logo')->move(storage_path('app/public/images/'),$imageName);

    $imageUrl = $imageName;

    $country = Country::find($req->input('country_id'));
    $state = State::find($req->input('state_id'));
    $city = City::find($req->input('city_id'));

    $countryName = $country ? $country->name : '';
    $stateName = $state ? $state->name : '';
    $cityName = $city ? $city->name : '';

    $data = array_merge(
        $req->only('hotel_name', 'hotel_email', 'address', 'postal_code', 'description', 'total_rooms'),
        ['logo' => $imageUrl, 'country_id' => $countryName, 'state_id' => $stateName, 'city_id' => $cityName]
    );

    $hotel = Hotel::create($data);

    $roomTypes = $req->input('room_types', []);
    foreach ($roomTypes as $roomTypeId) {
        $selectedRoomType = new SelectedRoomType();
        $selectedRoomType->hotel_id = $hotel->id;
        $selectedRoomType->room_type_id = $roomTypeId;
        $selectedRoomType->total_rooms = $hotel->total_rooms;
        $selectedRoomType->one_room_price = $req->one_room_price;
        $selectedRoomType->total_price = $req->total_rooms * $req->one_room_price;
        $selectedRoomType->save();
    }
    $price=$req->total_rooms * $req->one_room_price;
    $facilities = $req->input('facilities', []);

    foreach ($facilities as $facilityDesc) {
        $facility = new Facility();
        $facility->hotel_id = $hotel->id;
        $facility->facilities = $facilityDesc;
        $facility->save();
    }
    
    $hotelImages = $req->file('image', []);

    foreach ($hotelImages as $image) {
        $ext = $image->extension();
        $imageName = date('YmdHis') . '_' . uniqid() . '.' . $ext;

        $image->move(storage_path('app/public/hotel_image/'), $imageName);

        $hotelPhoto = new HotelPhoto();
        $hotelPhoto->hotel_id = $hotel->id;
        $hotelPhoto->image = $imageName;
        $hotelPhoto->save();
    }
    
    
    
    return redirect()->back()->with('success', 'Data added successfully!',compact('price'));
}

    public function edit($id){
        $hotel =  Hotel::where('id',$id)->first();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $imageUrl = asset('storage/images/' . $hotel->logo);


        return view('admin.hotels.hotel_edit',compact('hotel','imageUrl','countries','states','cities'));
    }
    public function delete($id)
    {
        $hotel = Hotel::find($id);
       
       

        if (!$hotel) {
            
            return redirect()->back()->with('error', 'Hotel not found');
        }
        if ($hotel->logo) {
            $imagePath = storage_path('app/public/images/' . $hotel->logo);
            
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

     
       
        
        $hotel->selectedRoomTypes()->delete();

        $hotel->facilities()->delete();
        
        
        $hotel->hotelPhotos()->delete();
       
        
        $hotel->delete();

        return redirect()->route('hotel')->with('success', 'Hotel deleted successfully');
    }

    public function update(Request $req, $id)
    {
        // Validate the submitted form data
        $req->validate([
            'hotel_name' => 'required',
            'hotel_email' => 'required|email',
            'address' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'total_rooms' => 'required',
            
        ]);

        $hotel = Hotel::findOrFail($id);

        if ($req->hasFile('logo')) {

            $image = $req->file('logo');

            if ($hotel->logo) {
                $previousImagePath = storage_path('app/public/images/' . $hotel->logo);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }    
            }
            $ext = $req->file('logo')->extension();
            $imageName = date('YmdHis').'.'.$ext;
            
            $req->file('logo')->move(storage_path('app/public/images/'),$imageName);

            $hotel->logo = $imageName;
        }
       
    
        $data = array_merge(
            $req->only('hotel_name', 'hotel_email', 'address', 'postal_code', 'country_id', 'state_id', 'city_id', 'description', 'total_rooms'),
            ['logo' => $hotel->logo]
        );
        // dd($req->country_id);
    
        // Update the hotel with the merged data
        $hotel->update($data);
    
        return redirect()->route('hotel')->with('success', 'Hotel updated successfully');
    }
    public function index()
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('welcome', $data);
    }
    public function fetchState(Request $request)
    {
        // dd($request->all());
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
  

}
