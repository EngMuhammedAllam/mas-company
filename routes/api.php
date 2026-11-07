<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/sensors/ingest', [App\Http\Controllers\Api\SensorApiController::class, 'ingest'])
    ->middleware(['auth:sanctum', 'throttle:10,1']);
