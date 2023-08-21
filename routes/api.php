<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::post('/store', [LinkController::class, 'store']);

Route::get('/get-list', [LinkController::class, 'getList']);

Route::get('/get/{id}', [LinkController::class, 'get']);

Route::patch(
    '/update/{id}',
    [LinkController::class, 'update']
);

Route::delete(
    '/delete/{id}',
    [LinkController::class, 'destroy']
);
