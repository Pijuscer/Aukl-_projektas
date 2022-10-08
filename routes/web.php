<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\CareController;
use App\Http\Controllers\Controller;

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
Route::get('/add_prices/edit/{id}', [PricesController::class, 'editForm']);
Route::post('/add_prices/edit/{id}', [PricesController::class, 'edit']);
Route::get('/add_prices/remove/ask/{id}', [PricesController::class, 'removeForm']);
Route::get('/add_prices/remove/{id}', [PricesController::class, 'remove']);

Route::get('/cares', [CareController::class, 'viewForm']);
Route::post('/cares', [CareController::class, 'store']);
Route::get('/add_cares', [CareController::class, 'index']);
Route::get('/add_cares/edit/{id}', [CareController::class, 'editForm']);
Route::post('/add_cares/edit/{id}', [CareController::class, 'edit']);
Route::get('/add_cares/remove/ask/{id}', [CareController::class, 'removeForm']);
Route::get('/add_cares/remove/{id}', [CareController::class, 'remove']);

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
