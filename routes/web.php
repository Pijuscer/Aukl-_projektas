<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricesController;

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
Route::get('/about', function () {
    return view('about');
});

Route::get('/prices', [PricesController::class, 'viewForm']);
Route::post('/prices', [PricesController::class, 'store']);
Route::get('/add_prices', [PricesController::class, 'index']);

Route::get('/cares', function () {
    return view('cares');
});
Route::get('/working_days', function () {
    return view('working_days');
});
Route::get('/profiles', function () {
    return view('profiles');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
