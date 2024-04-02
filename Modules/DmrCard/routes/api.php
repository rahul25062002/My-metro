<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\DmrCard\App\Http\Controllers\DmrCardController;

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
    Route::get('dmrcard', fn (Request $request) => $request->user())->name('dmrcard');
});

Route::post('newCard',[DmrCardController::class,'create']);
