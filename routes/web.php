<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralQuestionController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('auth.login');
})->name('login');



Route::get('/dashboard',[DashboardController::class , 'adminDashboard'])->name('dashboard')->middleware('auth:sanctum');
Route::get('/admin/profits',[DashboardController::class , 'adminProfits'])->middleware('auth:sanctum');
Route::get('/admin/numberOfSubscribers',[DashboardController::class , 'numberOfSubscribers'])->middleware('auth:sanctum');

Route::get('/dashboard/lawyer',[DashboardController::class , 'lawyerDashboard'])->name('dashboardLawyer')->middleware('auth:sanctum');
Route::get('/lawyer/profits',[DashboardController::class , 'lawyerProfits'])->middleware('auth:sanctum');
Route::get('/lawyer/numberOfClients',[DashboardController::class , 'numberOfClients'])->middleware('auth:sanctum');

Route::group(['prefix' => 'practice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PracticeController::class, 'index'])->name('list_practieces');
    Route::get('/create', [PracticeController::class, 'create'])->name('add_practiece');
    Route::post('/store', [PracticeController::class, 'store'])->name('store_practiece');
    Route::get('/edit/{practice}', [PracticeController::class, 'edit'])->name('edit_practiece');
    Route::post('/update/{practice}', [PracticeController::class, 'update'])->name('update_practiece');
    Route::get('/delete/{practice}', [PracticeController::class, 'destroy'])->name('delete_practiece');
});

Route::group(['prefix' => 'lawyer', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LawyerController::class, 'index'])->name('list_lawyers');
    // Route::get('/create', [LawyerController::class, 'create'])->name('add_lawyer');
    // Route::post('/store', [LawyerController::class, 'store'])->name('store_lawyer');
    Route::get('/{lawyer}/show', [LawyerController::class, 'show'])->name('show_lawyer');
    Route::get('/edit/{lawyer}', [LawyerController::class, 'edit'])->name('edit_lawyer');
    Route::post('/update/{lawyer}', [LawyerController::class, 'update'])->name('update_lawyer');
    // Route::get('/delete/{lawyer}', [LawyerController::class, 'destroy'])->name('delete_lawyer');
    Route::post('{lawyer}/toggle-status', [LawyerController::class, 'toggleStatus'])->name('toggleStatus');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list_clients');
    Route::get('/{client}/show', [ClientController::class, 'show'])->name('show_client');

});

Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{user?}', [ConsultationController::class,  'index'])->name('list_consultations');
    Route::get('/{consultation}/show', [ConsultationController::class, 'show'])->name('show_consultation');
    Route::post('{consultation}/answer', [ConsultationController::class, 'answer'])->name('answer_consultation');

});

Route::group(['prefix' => 'general_question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{user?}', [GeneralQuestionController::class,  'index'])->name('list_general_questions');
    Route::get('/{general_question}/show', [GeneralQuestionController::class, 'show'])->name('show_general_question');

});

Route::group(['prefix' => 'join_us', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [JoinUsController::class,  'index'])->name('list_join_us');

});
Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ChatController::class,  'chat'])->name('chat');

    Route::get('{receiver}', [ChatController::class,  'chat_form'])->name('chat_form');
    Route::post('{receiver}', [ChatController::class,  'send_message_to_user'])->name('send_message_to_user');

    Route::get('/group/{group}', [ChatController::class,  'group_form'])->name('group_form');
    Route::post('/group/{group}', [ChatController::class,  'send_message_to_group'])->name('send_message_to_group');

});



 Route::get('/suggestion', [SuggestionController::class, 'index'])->name('list_suggestion');
 Route::get('/notification/clear-all', [LawyerController::class, 'clear_all'])->name('notification_clear_all');



Auth::routes();
