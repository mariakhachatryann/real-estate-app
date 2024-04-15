<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FeatureController;
use Illuminate\Http\Request;
use App\Models\Admin;

Route::resource('properties', PropertyController::class);
Route::resource('features', FeatureController::class);

Route::post('/file-upload', [PropertyController::class, 'uploadPropertyImage'])->name('fileUpload');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/loginReg', [UserController::class, 'loginRegView'])->name('loginView');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth:user'])->group(function () {
    Route::get('/myProperties', [PropertyController::class, 'getUserProperties'])->name('myProperties');
    Route::get('/myProfile', [UserController::class, 'myProfile'])->name('myProfile');
    Route::post('/updateMyProfile', [UserController::class, 'updateInfo'])->name('update');
    Route::match(['get', 'post'], '/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
});
