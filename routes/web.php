<?php

/* Authentication Routes */
Auth::routes();
Route::get('/profil/', 'Auth\UserProfileController@index');

/* Home */
Route::get('/', 'HomeController@index');

/* Ticker Stuff */
//Route::redirect('/', '/ticker');
Route::resource('/post', 'PostController');
Route::resource('/ticker', 'TickerController');
Route::post('/ticker/{ticker}/addpost', 'TickerController@add_post');
Route::delete('/ticker/{ticker}/{post}', 'TickerController@delete_post');
Route::patch('/ticker/{ticker}/{post}', 'TickerController@edit_post');
Route::get('/ticker/{ticker}/refresh', 'TickerController@get_live_posts');
Route::get('/ticker/{tickerID}/preview', 'TickerController@preview');


/* FlundrCMS Default Routes */
Route::get('/admin', 'FlundrCMS\FlundrController@index');
Route::resource('/admin/user', 'FlundrCMS\UserController');

