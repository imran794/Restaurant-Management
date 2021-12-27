<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\MenuBuliderController;
use App\Http\Controllers\Backend\SliderController;


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



Route::get('dashboard',[DashboardController::class ,'index'])->name('dashboard');;

// Roles and Users
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

//profile

Route::get('profile',[ProfileController::class, 'Index'])->name('profile.index');
Route::post('profile/update',[ProfileController::class, 'ProfileUpdate'])->name('profile.update');

Route::get('password',[ProfileController::class, 'Password'])->name('password.index');
Route::post('password/update',[ProfileController::class, 'PasswordUpdate'])->name('password.update');

// Backup

Route::resource('backups', BackupController::class)->only('index','store','destroy');
Route::get('backup/{file_name}',[BackupController::class, 'Download'])->name('backup.download');
Route::delete('backups',[BackupController::class, 'Deleted'])->name('backups.deleted');


// Pages

Route::resource('pages', PageController::class);


// slider

Route::resource('sliders', SliderController::class);


// Menu

Route::resource('menus', MenuController::class)->except(['show']);


Route::group(['as'=> 'menus.',  'prefix' => 'menus/{id}/'], function() {
    Route::get('bulider',[MenuBuliderController::class, 'index'])->name('bulider');
    Route::post('order',[MenuBuliderController::class, 'Order'])->name('order');
    Route::get('item/create',[MenuBuliderController::class, 'ItemCreate'])->name('item.create');
    Route::post('item/store',[MenuBuliderController::class, 'ItemStore'])->name('item.store');
    Route::get('item/edit/{itemId}',[MenuBuliderController::class, 'ItemEdit'])->name('item.edit');
    Route::post('item/update/{itemId}',[MenuBuliderController::class, 'ItemUpdate'])->name('item.update');
    Route::delete('item/destroy/{itemId}',[MenuBuliderController::class, 'ItemDelete'])->name('item.destroy');
});


Route::group([ 'as' => 'setting.', 'prefix' => 'setting'], function() {
    Route::get('general',[SettingController::class, 'index'])->name('general');
    Route::put('general',[SettingController::class, 'GeneralUpdate'])->name('general.update');


    Route::get('apearance',[SettingController::class, 'Apearance'])->name('apearance');
    Route::put('apearance',[SettingController::class, 'ApearanceUpdate'])->name('apearance.update'); 


    Route::get('mail',[SettingController::class, 'Mail'])->name('mail');
    Route::put('mail',[SettingController::class, 'MailUpdate'])->name('mail.update');


    Route::get('socialite',[SettingController::class, 'Socialite'])->name('socialite');
    Route::put('socialite',[SettingController::class, 'SocialiteUpdate'])->name('socialite.update');


});
