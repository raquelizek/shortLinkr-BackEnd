<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::prefix('link')->group(function () {

    Route::post('/store', [LinkController::class, 'store']);

    Route::get('/list', [LinkController::class, 'all']);

    Route::get('/{id}', [LinkController::class, 'getById']);

    Route::get('/get/{identifier}', [LinkController::class, 'get']);

    Route::patch(
        '/update/{id}',
        [LinkController::class, 'update']
    );

    Route::delete(
        '/delete/{id}',
        [LinkController::class, 'destroy']
    );

});

Route::prefix('access')->group(function () {

    Route::post('/store', [AccessController::class, 'store']);

    Route::get('/list', [AccessController::class, 'all']);

    Route::get('/get/{id}', [AccessController::class, 'get']);

    Route::get('/', [AccessController::class, 'getAccess']);

    Route::patch(
        '/update/{id}',
        [AccessController::class, 'update']
    );

    Route::delete(
        '/delete/{id}',
        [AccessController::class, 'destroy']
    );

});
