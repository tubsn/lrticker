<?php

/*
Restful
GET  /user index
GET /user/create
POST /user store
GET /user/1 show
GET /user/id/edit edit
PATCH /user/id update
DELETE /user/id destroy

LEARN!!!!
index create store show edit update destroy
*/


/* Authentication Routes */
Auth::routes();
Route::get('/profil/', 'Auth\UserProfileController@index');

/* Home */
Route::get('/', 'HomeController@index');

/* Ticker Stuff */
//Route::redirect('/', '/ticker');
Route::resource('/ticker', 'TickerController');
Route::post('/ticker/{ticker}/addpost', 'TickerController@add_post');
Route::delete('/ticker/{ticker}/{post}', 'TickerController@delete_post');
Route::patch('/ticker/{ticker}/{post}', 'TickerController@edit_post');
Route::get('/ticker/{ticker}/refresh', 'TickerController@get_live_posts');
Route::get('/ticker/{tickerID}/preview', 'TickerController@preview');

/* Post Stuff */
Route::resource('/post', 'PostController');

/* FlundrCMS Default Routes */
Route::get('/admin', 'FlundrCMS\FlundrController@index');
Route::resource('/admin/user', 'FlundrCMS\UserController');

