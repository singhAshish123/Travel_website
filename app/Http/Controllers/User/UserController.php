<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(){
        $hotel = Hotel::all();
        return view('front.home',compact('hotel'));
    }

    public function login(){
        return view('front.login');
    }

    public function register(){
        return view('front.register');
    }

    public function registerSubmit(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'cpassword' => 'required_with:password|same:password|min:6',
            'profile_img' => 'required',
            'phone_no' => 'required'
        ]);
     
        $ext = $req->file('profile_img')->extension();
        $image_name = date('YmdHis').'.'.$ext;
        $req->file('profile_img')->move(storage_path('app/public/user_img'),$image_name);

        $user = User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'profile_img' => $image_name,
            'phone_no' => $req->input('phone_no'),
            'status' => 1
        ]);
        

       return redirect()->back()->with('success','you registered successfully!');
       
    }

    public function loginSubmit(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        
        $credential = [
            'email' => $req->email,
            'password' => $req->password
        ];
        if(Auth::attempt($credential) ) {
            if(Auth::user()->status == 1){
                return redirect()->route('home');
            }
            else {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact the administrator!');
            }
            
        } 
        return redirect()->back()->with('error', 'Login credential is invalid.');
    }

    public function userProfile(){
        return view('front.profile');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('userLogin');
    }

    public function forgetPassword(){
        return view('front.forget_password');
    }

    public function forgetPasswordSubmit(Request $req){
        $req->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $req->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('front.email', ['token' => $token], function($message) use($req){
            $message->to($req->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
         

    }
    public function resetPassword($token){
        return view('front.reset_password',compact('token'));
    }

    public function resetPasswordSubmit(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|',
              'cpassword' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect()->route('userLogin')->with('message', 'Your password has been changed!');
      }

      public function updateProfile(Request $req){
      
        $id = auth()->user()->id;  
        $user = User::findOrFail($id);
       
       
        if ($req->hasFile('profile_img')) {
            
            $image = $req->file('profile_img');

            if ($user->profile_img) {
                $previousImagePath = storage_path('app/public/user_img/'.$user->profile_img);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $ext = $req->file('profile_img')->extension();
            $imageName = date('YmdHis').'.'.$ext;

           $req->file('profile_img')->move(storage_path('app/public/user_img/'),$imageName); 
           
           $user->profile_img = $imageName;
        }
    
        $data = array_merge(
            $req->only('name', 'email', 'phone_no' ),
            ['profile_img' => $user->profile_img]
        );
        $user->update($data);
        return redirect()->back()->with('success', 'profile updated successfully');
      }
}
