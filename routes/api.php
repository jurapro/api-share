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

Route::post('authorization', [UserController::class, 'authorization'])->withoutMiddleware(['auth:api']);
Route::post('registration', [UserController::class, 'registration'])->withoutMiddleware(['auth:api']);


Route::prefix('folders')->group(function () {
    Route::get('/', [FolderController::class, 'index']);
    Route::post('/', [FolderController::class, 'create']);

    Route::get('/{folder}', [FolderController::class, 'show']);
    Route::patch('/{folder}', [FolderController::class, 'update']);

    Route::post('/{folder}/files', [FolderController::class, 'uploads']);
});



