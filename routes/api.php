<?php

use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\ChatApiController;
use App\Http\Controllers\api\ClientApiController;
use App\Http\Controllers\api\CompanyApiController;
use App\Http\Controllers\api\ConsultationApiController;
use App\Http\Controllers\api\FrequentlyQuestionApiController;
use App\Http\Controllers\api\GeneralChatApiController;
use App\Http\Controllers\api\GeneralQuestionApiController;
use App\Http\Controllers\api\GroupApiController;
use App\Http\Controllers\api\LanguageApiController;
use App\Http\Controllers\api\LawyerApiController;
use App\Http\Controllers\Api\LibraryApiController;
use App\Http\Controllers\api\PracticeApiController;
use App\Http\Controllers\api\SuggestionApiController;
use App\Http\Controllers\Api\TemplateApiController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\FatoorahController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NewsController;
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
Route::get('/pusher_config', [AuthApiController::class, 'getPusherConfig'])->middleware('auth:sanctum');



Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthApiController::class, 'logout']);



Route::group(['prefix' => 'lawyer', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LawyerApiController::class, 'index']);
    Route::get('{user}', [LawyerApiController::class, 'show']);
    Route::post('{user}', [LawyerApiController::class, 'update']);

});

Route::post('/company/{user}', [CompanyApiController::class, 'update'])->middleware('auth:sanctum');

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientApiController::class, 'index']);
    Route::get('{user}', [ClientApiController::class, 'show']);
    Route::post('{user}', [ClientApiController::class, 'update']);


});


Route::group(['prefix' => 'practice'], function () {
    Route::get('/', [PracticeApiController::class, 'index']);

});

Route::group(['prefix' => 'language'], function () {
    Route::get('/', [LanguageApiController::class, 'index']);

});

Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
    Route::post('{receiver}', [ConsultationApiController::class, 'store']);
    Route::post('{consultation}/answer', [ConsultationApiController::class, 'answer']);
    Route::post('{consultation}/rate', [ConsultationApiController::class, 'rate']);

});

Route::group(['prefix' => 'general-question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [GeneralQuestionApiController::class, 'index']);
    Route::get('/user/{user}', [GeneralQuestionApiController::class, 'show']);
    Route::post('/', [GeneralQuestionApiController::class, 'store']);
    Route::post('/{general_question}/reply', [GeneralQuestionApiController::class, 'reply']);
    Route::post('/reply/{reply}/rate', [GeneralQuestionApiController::class, 'rate']);
});


Route::group(['prefix' => 'invoice', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [InvoiceController::class, 'store']);
});

Route::group(['prefix' => 'frequently-question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [FrequentlyQuestionApiController::class, 'index']);
});

Route::group(['prefix' => 'news', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [NewsController::class, 'index']);
});

Route::group(['prefix' => 'suggestion', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [SuggestionApiController::class, 'index']);
    Route::post('/', [SuggestionApiController::class, 'store']);
});


Route::group(['prefix' => 'template', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TemplateApiController::class, 'index']);
    Route::post('/', [TemplateApiController::class, 'store']);
});


Route::group(['prefix' => 'library', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LibraryApiController::class, 'index']);
    Route::post('/', [LibraryApiController::class, 'store']);
});


Route::get('/messages',[UserController::class, 'get_messages'])->middleware('auth:sanctum');



Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/get_message_in_chat/{receiver}', [ChatApiController::class, 'get_message_in_chat']);
    Route::get('/get_message_in_group/{group}', [ChatApiController::class, 'get_message_in_group']);
    Route::post('/send_message_to_user/{receiver}', [ChatApiController::class, 'send_message_to_user']);
    Route::post('/send_message_to_group/{group}', [ChatApiController::class, 'send_message_to_group']);
    Route::get('/attachments_chat/{receiver}', [ChatApiController::class, 'attachments_chat']);
    Route::get('/attachments_group/{group}', [ChatApiController::class, 'attachments_group']);

});

Route::group(['prefix' => 'group', 'middleware' => 'auth:sanctum'], function () {
    Route::get('for-user/{user}', [GroupApiController::class, 'index']);

    Route::post('/', [GroupApiController::class, 'store']);
    Route::post('{group}', [GroupApiController::class, 'update']);
});

Route::group(['prefix' => 'general-chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('for-user/{user}', [GeneralChatApiController::class, 'index']);
    Route::post('/', [GeneralChatApiController::class, 'store']);
    Route::post('{general_chat}', [GeneralChatApiController::class, 'update']);
});







//test
Route::post('checkout/{lawyer}', [FatoorahController::class, 'checkout'])->middleware('auth:sanctum');
Route::get('callback', [FatoorahController::class, 'callback']);
