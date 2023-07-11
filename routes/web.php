<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\HotelController;





Route::group(['middleware' => ['web']],function(){
    Route::get('/',[UserController::class,'index'])->name('home');
    Route::get('user-login',[UserController::class,'login'])->name('userLogin');
    Route::get('register',[UserController::class,'register'])->name('register');
    Route::post('register_submit',[UserController::class,'registerSubmit'])->name('registerSubmit');
    Route::post('login_submit',[UserController::class,'loginSubmit'])->name('loginSubmit');
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::get('user-profile',[UserController::class,'userProfile'])->name('userProfile')->middleware('auth');
    Route::get('forget-password',[UserController::class,'forgetPassword'])->name('forgetPassword');
    Route::get('hotel-details/{hotel}',[HotelController::class,'hotelDetails'])->name('hotelDetails');
    Route::post('forget-password/submit',[UserController::class,'forgetPasswordSubmit'])->name('forgetPasswordSubmit');
    Route::get('reset-password/{token}',[UserController::class,'resetPassword'])->name('resetPassword');
    Route::post('reset-password/submit',[UserController::class,'resetPasswordSubmit'])->name('resetPasswordSubmit');
    Route::post('profile_submit',[UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('book-hotel/{id}',[HotelController::class,'bookHotel'])->name('bookHotel')->middleware('auth');
    Route::post('book-hotel/submit/{id}',[HotelController::class,'bookHotelSubmit'])->name('bookHotelSubmit');
    Route::get('payment/{id}',[HotelController::class,'payments'])->name('payments');
    Route::post('payment/submit/{id}',[HotelController::class,'paymentSubmit'])->name('paymentSubmit');
});


