<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;



Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us');

Route::match(['post'], '/', [PageController::class, 'index'])->name('index');
Route::fallback([PageController::class, 'load']);
