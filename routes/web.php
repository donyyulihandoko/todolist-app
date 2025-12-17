<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;

Route::get('/', [HomeController::class, 'dashboard'])->middleware('auth');

Route::resource('todolist', TodolistController::class)->middleware('auth');
