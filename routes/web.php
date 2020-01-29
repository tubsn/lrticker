<?php

/* Authentication and Userprofile Routes */
Auth::routes(['register' => false]);

Route::get('/profil', 'Auth\UserProfileController@index')->name('profile');
Route::get('/profil/edit', 'Auth\UserProfileController@edit')->name('profile.edit');
Route::patch('/profil', 'Auth\UserProfileController@update')->name('profile.update');
Route::patch('/profil/thumbnail', 'Auth\UserProfileController@add_thumbnail');

/* Home */
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/ticker');
});
/* Ticker Stuff */
//Route::redirect('/', '/ticker');
Route::resource('/post', 'PostController');
Route::resource('/ticker', 'TickerController');
Route::resource('/attachment', 'AttachmentController');

Route::patch('/ticker/{ticker}/reorder', 'TickerController@reorder_posts');
Route::get('/ticker/{ticker}/refresh', 'TickerController@get_live_posts');
Route::get('/ticker/{tickerID}/preview', 'TickerController@preview');

/* FlundrCMS Default Routes */
Route::get('/admin', 'FlundrCMS\FlundrController@index')->name('admin.home');
Route::resource('/admin/user', 'FlundrCMS\UserController');

