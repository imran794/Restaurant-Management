<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;



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



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'home']);

Auth::routes();


Route::get('/login/{provider}',[LoginController::class, 'redirectToProvider'])->name('login.provider');
Route::get('/login/{provider}/callback',[LoginController::class, 'handelProviderCallback'])->name('login.callback');




Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('{slug}',[PageController::class, 'index'])->name('page');

Route::post('reservation',[ReservationController::class, 'Store'])->name('reservation.store');



// contact

Route::post('contact/store',[ContactController::class, 'Store'])->name('contact.store');


