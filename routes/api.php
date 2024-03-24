<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);



Route::get('/roles', [RolesController::class, 'index']);


Route::group( ['prefix' => 'user' ,'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);
    Route::post('{user}', [UserController::class, 'update']);
});

Route::group( ['prefix' => 'rate' ,'middleware' => 'auth:sanctum'], function () {
    Route::get('response/{user_response}/consultation/{consultation}', [UserController::class, 'show']);
});
