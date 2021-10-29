<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\UserController;
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

Route::post('authorization', [UserController::class, 'authorization']);
Route::post('registration', [UserController::class, 'registration']);

Route::get('folders', [FolderController::class, 'index']);
Route::get('folders/{folder}', [FolderController::class, 'show']);
Route::patch('folders/{folder}', [FolderController::class, 'update']);
