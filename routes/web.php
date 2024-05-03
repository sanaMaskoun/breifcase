<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralQuestionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT', 12);

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('locale/{lang}',[LangController::class , 'setLang'])->name('lang');

Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard')->middleware('auth:sanctum');
Route::get('/admin/profits', [DashboardController::class, 'adminProfits'])->middleware('auth:sanctum');
Route::get('/admin/numberOfSubscribers', [DashboardController::class, 'numberOfSubscribers'])->middleware('auth:sanctum');

Route::get('/dashboard/lawyer', [DashboardController::class, 'lawyerDashboard'])->name('dashboardLawyer')->middleware('auth:sanctum');
Route::get('/lawyer/profits', [DashboardController::class, 'lawyerProfits'])->middleware('auth:sanctum');
Route::get('/lawyer/numberOfClients', [DashboardController::class, 'numberOfClients'])->middleware('auth:sanctum');

Route::group(['prefix' => 'practice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PracticeController::class, 'index'])->name('list_practieces');
    Route::get('/create', [PracticeController::class, 'create'])->name('add_practiece');
    Route::post('/store', [PracticeController::class, 'store'])->name('store_practiece');
    Route::get('/edit/{encodedId}', [PracticeController::class, 'edit'])->name('edit_practiece');
    Route::post('/update/{practice}', [PracticeController::class, 'update'])->name('update_practiece');
    Route::get('/delete/{practice}', [PracticeController::class, 'destroy'])->name('delete_practiece');
});

Route::group(['prefix' => 'lawyer', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LawyerController::class, 'index'])->name('list_lawyers');
    // Route::get('/create', [LawyerController::class, 'create'])->name('add_lawyer');
    // Route::post('/store', [LawyerController::class, 'store'])->name('store_lawyer');
    Route::get('/{encodedId}/show', [LawyerController::class, 'show'])->name('show_lawyer');
    Route::get('/edit/{encodedId}', [LawyerController::class, 'edit'])->name('edit_lawyer');
    Route::post('/update/{lawyer}', [LawyerController::class, 'update'])->name('update_lawyer');
    // Route::get('/delete/{lawyer}', [LawyerController::class, 'destroy'])->name('delete_lawyer');
    Route::post('{lawyer}/toggle-status', [LawyerController::class, 'toggleStatus'])->name('toggleStatus');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list_clients');
    Route::get('/{encodedId}/show', [ClientController::class, 'show'])->name('show_client');

});

Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{encodedId?}', [ConsultationController::class, 'index'])->name('list_consultations');
    Route::get('/{encodedId}/show', [ConsultationController::class, 'show'])->name('show_consultation');
    Route::post('{consultation}/answer', [ConsultationController::class, 'answer'])->name('answer_consultation');

});

Route::group(['prefix' => 'general_question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{encodedId?}', [GeneralQuestionController::class, 'index'])->name('list_general_questions');
    Route::get('/{encodedId}/show', [GeneralQuestionController::class, 'show'])->name('show_general_question');

});

Route::group(['prefix' => 'join_us', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [JoinUsController::class, 'index'])->name('list_join_us');

});

Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ChatController::class, 'chat'])->name('chat');

    Route::get('{encodedId}', [ChatController::class, 'chat_form'])->name('chat_form');
    Route::post('{encodedId}', [ChatController::class, 'send_message_to_user'])->name('send_message_to_user');

    Route::get('/group/{encodedId}', [ChatController::class, 'group_form'])->name('group_form');
    Route::post('/group/{encodedId}', [ChatController::class, 'send_message_to_group'])->name('send_message_to_group');

    Route::get('/attachments/{encodedIdReceiver}', [ChatController::class, 'attachments'])->name('attachments');
    Route::get('/attachments/group/{encodedIdGroup}', [ChatController::class, 'attachments_group'])->name('attachments_group');

});

Route::group(['prefix' => 'group', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/create', [GroupController::class, 'create'])->name('add_group');
    Route::post('/store', [GroupController::class, 'store'])->name('store_group');
    Route::get('/edit/{encodedId}', [GroupController::class, 'edit'])->name('edit_group');
    Route::post('/update/{group}', [GroupController::class, 'update'])->name('update_group');
});

Route::get('/suggestion', [SuggestionController::class, 'index'])->name('list_suggestion');
Route::get('/notification/clear-all', [LawyerController::class, 'clear_all'])->name('notification_clear_all');

Route::get('error', function () {
    return 'payment failed';
});

Auth::routes();
