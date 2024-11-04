<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectIniBosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/projects',[ProjectController::class, 'index']);
Route::get('/type',[ProjectController::class, 'show_type']);
Route::post('/projects',[ProjectController::class, 'store']);
Route::post('/projects/type',[ProjectController::class, 'store_type']);
Route::get('/projects/{id}',[ProjectController::class, 'show']);

Route::apiResource('test', ProjectIniBosController::class);
