<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Hotel\HotelController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use PHPUnit\Framework\Attributes\Group;


Route::group(['middleware' => ['web']], function () {
    
   
    Route::get('login',[AdminController::class,'login'])->name('login')->middleware('guest:admin');
    
    Route::post('login-submit',[AdminController::class,'admin_login_submit'])->name('admin_login_submit');  
    Route::get('admin-logout',[AdminController::class,'logout'])->name('admin_logout');
Route::middleware(['admin:admin'])->group(function () {
     Route::get('/', function () {
        return view('admin.home');
    })->name('admin.home');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');  
    Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotel_edit');
    Route::get('/hotels/{id}/delete', [HotelController::class, 'delete'])->name('hotel_delete');
    Route::put('/hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::get('dependent-dropdown', [HotelController::class, 'index']);
    Route::post('fetch-states', [HotelController::class, 'fetchState'])->name('fetch-states');
    Route::post('fetch-cities', [HotelController::class, 'fetchCity'])->name('fetch-cities');
    Route::get('hotel',[HotelController::class,'hotel'])->name('hotel');
Route::get('hotel_create',[HotelController::class,'hotel_create'])->name('hotel_create');
Route::post('hotel_submit',[HotelController::class,'hotel_submit'])->name('hotel_submit');
});
    
});
Route::get('post',[HotelController::class,'post'])->name('hotel_post');
Route::get('users',[AdminController::class,'users'])->name('users');

Route::get('active-button/{id}',[AdminController::class,'activeButtons'])->name('activeButtons');
Route::get('inactive-button/{id}',[AdminController::class,'inactiveButtons'])->name('inactiveButtons');