<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/radcheck', [Controller::class, 'addRadCheck']);
Route::get('/radcheck/all', [Controller::class, 'index']);
Route::get('/radcheck/get/{username}', [Controller::class, 'show']);

Route::put('/radcheck/update/{username}', [Controller::class, 'update']);
Route::delete('/radcheck/delete/{username}', [Controller::class, 'destroy']);