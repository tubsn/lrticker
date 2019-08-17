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


Route::redirect('/', '/ticker');
Route::resource('/ticker', 'TickerController');
Route::post('/ticker/{ticker}/addpost', 'TickerController@add_post');
Route::delete('/ticker/{ticker}/{post}', 'TickerController@delete_post');
Route::patch('/ticker/{ticker}/{post}', 'TickerController@edit_post');
Route::get('/ticker/{ticker}/refresh', 'TickerController@get_live_posts');

/* FlundrCMS Default Routes */
Route::get('/admin', 'FlundrCMS\FlundrController@index');
Route::resource('/admin/user', 'FlundrCMS\UserController');