<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'Clients@index');

//Route::get('/index', 'Clients@main');

Route::group(['prefix' => '/zain'], function () {

    Route::get('/verify', 'Clients@verifyUser');
//    Route::post('/verify/step1', 'Clients@verifyPhoneNumber');
//
//    Route::get('/verifycode', 'Clients@verifyCodePage');
//    Route::post('/verify/step2', 'Clients@codeVerify');
//
//    Route::post('/sendagain', 'Clients@sendAgain');
});
