<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::resource('blogs', BlogController::class);

