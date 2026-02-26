<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::resource('blogs', BlogController::class);
Route::resource('students', StudentController::class)->except(['create', 'edit']);

