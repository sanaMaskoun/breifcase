<?php

use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ChatApiController;
use App\Http\Controllers\api\ConsultationApiController;
use App\Http\Controllers\api\GeneralQuestionApiController;
use App\Http\Controllers\api\RateController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SuggestionController;
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

// Route::post('/pusher/auth', function () {
//     return true;
// })->name('pusher.auth');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('pusher/auth', [AuthApiController::class, 'pusherAuth'])->name('pusherAuth');

Route::post('checkout/{lawyer}', [FatoorahController::class, 'checkout']);
Route::get('callback', [FatoorahController::class, 'callback']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::get('/roles', [RolesController::class, 'index'])->middleware('auth:sanctum');

Route::get('/messages',[UserController::class, 'get_messages'])->middleware('auth:sanctum');

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
    Route::get('/', [GeneralQuestionApiController::class, 'index']);
    Route::get('/user/{user}', [GeneralQuestionApiController::class, 'show']);
    Route::post('/', [GeneralQuestionApiController::class, 'store']);
    Route::post('/{general_question}/reply', [GeneralQuestionApiController::class, 'reply']);
    Route::post('/reply/{reply}/rate', [GeneralQuestionApiController::class, 'rate']);
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/get_message_in_chat/{receiver}', [ChatApiController::class, 'get_message_in_chat']);
    Route::get('/get_message_in_group/{group}', [ChatApiController::class, 'get_message_in_group']);
    Route::post('/send_message_to_user/{receiver}', [ChatApiController::class, 'send_message_to_user']);
    Route::post('/send_message_to_group/{group}', [ChatApiController::class, 'send_message_to_group']);
    Route::get('/attachments_chat/{receiver}', [ChatApiController::class, 'attachments_chat']);
    Route::get('/attachments_group/{group}', [ChatApiController::class, 'attachments_group']);

});

Route::post('/suggestion', [SuggestionController::class, 'store'])->middleware('auth:sanctum');

Route::group(['prefix' => 'invoice', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [InvoiceController::class, 'store']);
});
Route::group(['prefix' => 'group', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [ChatApiController::class, 'create_group']);
});




Route::get('/pusher_config', [AuthApiController::class, 'getPusherConfig'])->middleware('auth:sanctum');
