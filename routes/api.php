<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectIniBosController;
use App\Http\Controllers\ProjectTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/type', [ProjectTypeController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::post('/projects/type', [ProjectTypeController::class, 'store_type']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::post('/projects/logo', [ProjectController::class, 'store_logo']);
Route::get('/medias', [MediaController::class, 'index']);
Route::post('/medias', [MediaController::class, 'store']);

// Route::apiResource('test', ProjectIniBosController::class);
