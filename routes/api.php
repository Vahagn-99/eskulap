<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\Api\NewsController::class)->prefix('news')->group(function() {
    Route::get('/', 'index');
    Route::get('/{news}/show', 'show');
});

Route::controller(\App\Http\Controllers\Api\CommentController::class)
    ->middleware(['auth:sanctum'])
    ->prefix('comments')
    ->group(function() {
        Route::post('/', 'store');
});
