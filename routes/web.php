<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->namespace('App\Http\Controllers\admin')->group(function(){
    
    Route::match(['get','post'],'/login','adminController@login');
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard','adminController@dashboard');
        //update admin password
        Route::match(['get','post'],'update-admin-password','adminController@updateAdminPassword');
        //update admin details
        Route::match(['get','post'],'update-admin-details','adminController@updateAdminDetails');
        Route::post('/check-current-password','adminController@checkAdminPassword');
       
        //update vendor details
        Route::match(['get','post'],'update-vendor-details/{slug}','adminController@updateVendorDetails');

        //view admins / subadmins/ vendors
        Route::get('admins/{type?}','adminController@admins');

        //view vendor details
        Route::get('view-vendor-details/{id}','adminController@viewVendorDetails');

        //update admin status
        Route::post('update-admin-status','adminController@updateAdminStatus');

        //admin logout
        Route::get('logout' , 'adminController@logout');
    });
    
});

