<?php

use Illuminate\Support\Facades\Route;
use Modules\Train\App\Http\Controllers\TrainController;

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
    Route::resource('train', TrainController::class)->names('train');
});

Route::get('getAllTrain',[TrainController::class,'index']);
Route::post('editTrain/{$id}',[TrainController::class,'edit']);
