<?php

use App\Http\Controllers\api\ConsultationApiController;
use App\Http\Controllers\api\GeneralQuestionController;
use App\Http\Controllers\api\RateController;
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



Route::get('/roles', [RolesController::class, 'index'])->middleware('auth:sanctum');


Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
     Route::get('/', [UserController::class, 'index']);
     Route::get('{user}', [UserController::class, 'show']);
     Route::post('{user}', [UserController::class, 'update']);
});


Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
     Route::post('{receiver}', [ConsultationApiController::class, 'store']);
     Route::post('{consultation}/answer', [ConsultationApiController::class, 'answer']);
});

Route::group(['prefix' => 'rate', 'middleware' => 'auth:sanctum'], function () {
     Route::post('consultation/{consultation}', [RateController::class, 'rate']);
});

Route::group(['prefix' => 'general-question', 'middleware' => 'auth:sanctum'], function () {
     Route::get('/', [GeneralQuestionController::class, 'index']);
     Route::get('/user/{user}', [GeneralQuestionController::class, 'show']);
     Route::post('/', [GeneralQuestionController::class, 'store']);
     Route::post('/{general_question}/reply', [GeneralQuestionController::class, 'reply']);
     Route::post('/reply/{reply}/rate', [GeneralQuestionController::class, 'rate']);
});
