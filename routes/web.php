<?php

use App\Http\Controllers\Backend\{UserController, ChangePasswordController, CountryController, StateController, CityController, DepartmentController};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::post('users/{user}/change-password', [ChangePasswordController::class, 'change_password'])->name('users.change.password');
Route::resource('countries', CountryController::class);
Route::resource('states', StateController::class);
Route::resource('cities', CityController::class);
Route::resource('departments', DepartmentController::class);

Route::get('{any}', function() {
    return view('employees.index');
})->where('any', '.*');