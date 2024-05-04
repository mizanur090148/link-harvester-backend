<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlController;

// Resourceful routing for URLs
Route::resource('urls', UrlController::class)->only([
    'index', 'store'
]);

// Custom route for searching URLs
Route::get('urls/search', [UrlController::class, 'search'])->name('urls.search');
