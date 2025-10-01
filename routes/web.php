<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\Controller;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
