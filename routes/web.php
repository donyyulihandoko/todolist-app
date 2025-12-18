<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;

Route::get('/', [HomeController::class, 'dashboard'])->middleware('auth');

Route::resource('todolist', TodolistController::class)->middleware('auth');
// Route::middleware('auth')->controller(TodolistController::class)->group(function () {
//     Route::get('/todolist', 'index')->name('todolist.index');
//     Route::get('/todolist/create', 'create')->name('todolist.create');
//     Route::post('/todolist/store', 'store')->name('todolist.store');
//     Route::get('/todolist/{id}/edit', 'edit')->name('todolist.edit');
//     Route::put('/todolist/{id}/update', 'update')->name('todolist.update');
//     Route::delete('/todolist/{id}/destroy', 'destroy')->name('todolist.destroy');
// });
