<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('serviceVoice', function () {
    return view('voice');
});
Route::get('serviceGuroo', function () {
    return view('guroo');
});
Route::get('serviceIctConsultancy', function () {
    return view('ict');
});
Route::get('serviceCommunication', function () {
    return view('communication');
});
Route::get('serviceCatchApp', function () {
    return view('maswerasei');
});
Route::get('serviceHealthy', function () {
    return view('healthy');
});
Route::get('sitedeveloper', function () {
   
    return view('developer');

});
Route::get('broadband', function () {
   
    return view('broadband');

});
Route::get('sports', function () {
   
    return view('sports');

});
 
Route::get('lead', function () {
   
    return view('lead');

});
Route::get('sitedeveloper',[Controller::class, 'sitedeveloper'])->name('sitedeveloper');
Route::get('download',[Controller::class, 'download'])->name('download');
Route::get('fetchLogs/{ipAddress}/{username}', [Controller::class, 'fetchLogs'])->name('fetchLogs');
Route::post('/add-user', [Controller::class, 'addUser']);
Route::get('catchapp.ai.co.zw', [Controller::class, 'catchappp']);
