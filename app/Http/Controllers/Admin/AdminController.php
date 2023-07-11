<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UsersDataTable;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

use function Termwind\style;

class AdminController extends Controller
{
  
    public function login()
    {
        return view('admin.login');
    }

    public function admin_login_submit(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('admin')->attempt($credential)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Information is not correct!');
        }

    }
    public function dashboard(){
        $total_users = User::count();
        $registered_hotels = Hotel::count();
        $total_bookings = Booking::count();
        return view('admin.home',compact('total_users','registered_hotels','total_bookings'));
    }
    public function users(UsersDataTable $data){
        $users = User::all();
        return $data->render('admin.user.user',compact('users'));
    }
    public function activeButtons($id){
        $users = User::find($id);
        
        if($users->status == 0){
            $users->status = 1;
            $users->save();
         }
         
       
        return redirect()->back();

    }
    public function inactiveButtons($id){
        $users = User::find($id);
        
        if($users->status == 1){
            $users->status = 0;
         }
         
        $users->save();
        return redirect()->back();

    }
    
    public function logout()
     {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
