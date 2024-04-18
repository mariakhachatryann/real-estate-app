<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\UserFavoritesController;

Route::resource('properties', PropertyController::class);
Route::resource('features', FeatureController::class);

Route::post('/file-upload', [PropertyController::class, 'uploadPropertyImage'])->name('fileUpload');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/loginReg', [UserController::class, 'loginRegView'])->name('loginView');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::match(['get', 'post'], '/search', [PropertyController::class, 'search'])->name('search');

Route::middleware(['auth:user'])->group(function () {
    Route::get('/my-properties', [PropertyController::class, 'getUserProperties'])->name('myProperties');
    Route::get('/my-profile', [UserController::class, 'myProfile'])->name('myProfile');
    Route::post('/update-profile', [UserController::class, 'updateInfo'])->name('update');
    Route::get('/change-password', [UserController::class, 'changePasswordView'])->name('changePasswordView');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::get('/my-favorites', [UserFavoritesController::class, 'index'])->name('favorites');
    Route::post('/my-favorites', [UserFavoritesController::class, 'store'])->name('favorites');
    Route::delete('/my-favorites/{propertyId}', [UserFavoritesController::class, 'remove'])->name('remove');
});
