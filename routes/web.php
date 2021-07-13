<?php

use App\Events\RealtimeEcho;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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
    return view('welcome');
});

Route::get('/realtimeecho', function(){
    (function($count){
        echo $count;
        is_null($count) ? Redis::set('count', 0) : Redis::set('count', $count+1);
    })(Redis::get('count'));
    broadcast(new RealtimeEcho);
});
