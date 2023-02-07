<?php

use App\Http\Controllers\TickerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\FlundrCMS\FlundrController;
use App\Http\Controllers\FlundrCMS\UserController;
use App\Http\Controllers\Auth\UserProfileController;

/* Authentication and Userprofile Routes */
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => true, // Password Reset Routes...
  'verify' => true, // Email Verification Routes...
]);


/* Home */
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/ticker');
});

Route::get('/profil', [UserProfileController::class,'index'])->name('profile');
Route::get('/profil/edit', [UserProfileController::class,'edit'])->name('profile.edit');
Route::patch('/profil', [UserProfileController::class,'update'])->name('profile.update');
Route::patch('/profil/thumbnail', [UserProfileController::class,'add_thumbnail']);

Route::resource('/post', PostController::class);
Route::resource('/ticker', TickerController::class);
Route::resource('/attachment', AttachmentController::class);

Route::patch('/ticker/{ticker}/reorder', [TickerController::class,'reorder_posts']);
Route::get('/ticker/{ticker}/refresh', [TickerController::class,'get_live_posts']);
Route::get('/ticker/{ticker}/info', [TickerController::class,'get_info']);
Route::patch('/ticker/{ticker}/reset_info', [TickerController::class,'reset_info']);
Route::get('/ticker/{tickerID}/preview', [TickerController::class,'preview']);

Route::get('/admin', [FlundrController::class,'index'])->name('admin.home');
Route::resource('/admin/user', UserController::class);
