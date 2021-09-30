<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers;
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

Route::get('/', function () {
    return view('layouts/admin/login');
});
Route::post('login','App\Http\Controllers\LoginController@login');

Route::get('/getevent', 'App\Http\Controllers\FullCalendarController@getEvent');
Route::post('/createevent','App\Http\Controllers\FullCalendarController@createEvent');
Route::post('/delete','App\Http\Controllers\FullCalendarController@deleteEvent');