<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlController;

// Route::get('url', [UrlController::class, 'index']);
// Route::post('url', [UrlController::class, 'store']);


Route::apiResource('url', UrlController::class)->only(['index', 'store']);