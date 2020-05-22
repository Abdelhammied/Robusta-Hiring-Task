<?php

use App\Models\Seat;
use App\Models\Station;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('test', function(){
    return ;
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('search', 'SearchController@search')->name('search');

Route::group(['namespace' => 'Seat'], function(){
    Route::get('/seats', 'SeatController@index')->name('seat.index');

    Route::get('trip-seat/{seat}', 'ReservationController@showReservationForm');
    Route::post('/seat/{seat}/reserve', 'ReservationController@confirmSeatReservation')->name('confirm-reserve-seat');
    
    Route::get('crossover-seat/{seat}', 'ReservationController@reserveCrossoverSeat');
});

