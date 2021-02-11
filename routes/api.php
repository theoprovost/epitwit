<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/timeline','App\Http\Controllers\Api\Timeline\TimelineController@index');
Route::post('/tweets','App\Http\Controllers\Api\Tweets\TweetController@store');