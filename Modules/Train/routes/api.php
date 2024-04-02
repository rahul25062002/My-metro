<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Train\App\Http\Controllers\TrainController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('train', fn (Request $request) => $request->user())->name('train');
});

Route::post('setTrain',[TrainController::class,'create']);
Route::get('getTrains',function (){
   return view('admin/myTheme/pages/listTrain');
});
