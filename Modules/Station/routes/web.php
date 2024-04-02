<?php

use Illuminate\Support\Facades\Route;
use Modules\Station\App\Http\Controllers\StationController;

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

Route::group([], function () {
    Route::resource('station', StationController::class)->names('station');
});
