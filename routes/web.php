<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GeneralQuestionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\NavbarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('locale/{lang}', [LangController::class, 'setLang'])->name('lang');
Route::get('/', [NavbarController::class, 'home'])->name('home');

Route::group(['prefix' => 'explore'], function () {
    Route::get('/lawyers', [NavbarController::class, 'explore_lawyer'])->name('explore_lawyer');

    Route::get('/translation-companies', [NavbarController::class, 'explore_translation_company'])->name('explore_translation_company');

});

Route::get('/library', [NavbarController::class, 'library'])->name('library');
Route::post('/download', [NavbarController::class, 'download_book'])->name('download_book')->middleware('auth:sanctum');;;


Route::get('/about-us', function () {
    return view('pages.about');
})->name('about');

Route::group(['prefix' => 'join'], function () {
    Route::get('/lawyer', [JoinController::class, 'join_lawyer'])->name('join_lawyer');
    Route::post('/lawyer', [JoinController::class, 'store_join_lawyer'])->name('store_join_lawyer');

    Route::get('/client', [JoinController::class, 'join_client'])->name('join_client');
    Route::post('/client', [JoinController::class, 'store_join_client'])->name('store_join_client');

    Route::get('/translation-company', [JoinController::class, 'join_translation_company'])->name('join_translation_company');
    Route::post('/translation-company', [JoinController::class, 'store_join_translation_company'])->name('store_join_translation_company');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list_clients');
    Route::get('/{client_encoded_id}/show', [ClientController::class, 'show'])->name('show_client');
    Route::get('/edit/{client_encoded_id}', [ClientController::class, 'edit'])->name('edit_client');
    Route::post('/update/{client}', [ClientController::class, 'update'])->name('update_client');

});

Route::group(['prefix' => 'general-question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('list/{user_encoded_id?}', [GeneralQuestionController::class, 'index'])->name('list_general_questions');
    Route::get('/create', [GeneralQuestionController::class, 'create'])->name('create_general_question');
    Route::post('store', [GeneralQuestionController::class, 'store'])->name('save_general_question');
    // Route::get('/{question_encoded_id}/show', [GeneralQuestionController::class, 'show'])->name('show_general_question');

});

// Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard')->middleware('auth:sanctum');
// Route::get('/admin/profits', [DashboardController::class, 'adminProfits'])->middleware('auth:sanctum');
// Route::get('/admin/numberOfSubscribers', [DashboardController::class, 'numberOfSubscribers'])->middleware('auth:sanctum');

// Route::get('/dashboard/lawyer', [DashboardController::class, 'lawyerDashboard'])->name('dashboardLawyer')->middleware('auth:sanctum');
// Route::get('/lawyer/profits', [DashboardController::class, 'lawyerProfits'])->middleware('auth:sanctum');
// Route::get('/lawyer/numberOfClients', [DashboardController::class, 'numberOfClients'])->middleware('auth:sanctum');

// Route::group(['prefix' => 'practice', 'middleware' => 'auth:sanctum'], function () {
//     Route::get('/', [PracticeController::class, 'index'])->name('list_practieces');
//     Route::get('/create', [PracticeController::class, 'create'])->name('add_practiece');
//     Route::post('/store', [PracticeController::class, 'store'])->name('store_practiece');
//     Route::get('/edit/{encodedId}', [PracticeController::class, 'edit'])->name('edit_practiece');
//     Route::post('/update/{practice}', [PracticeController::class, 'update'])->name('update_practiece');
//     Route::get('/delete/{practice}', [PracticeController::class, 'destroy'])->name('delete_practiece');
// });

Route::group(['prefix' => 'lawyer', 'middleware' => 'auth:sanctum'], function () {
// Route::get('/', [LawyerController::class, 'index'])->name('list_lawyers');
// Route::get('/create', [LawyerController::class, 'create'])->name('add_lawyer');
// Route::post('/store', [LawyerController::class, 'store'])->name('store_lawyer');
    Route::get('/{lawyer_encoded_id}/show', [LawyerController::class, 'show'])->name('show_lawyer');
// Route::get('/edit/{encodedId}', [LawyerController::class, 'edit'])->name('edit_lawyer');
// Route::post('/update/{lawyer}', [LawyerController::class, 'update'])->name('update_lawyer');
// Route::get('/delete/{lawyer}', [LawyerController::class, 'destroy'])->name('delete_lawyer');
// Route::post('{lawyer}/toggle-status', [LawyerController::class, 'toggleStatus'])->name('toggleStatus');
});

Route::group(['prefix' => 'invoice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('list_invoices');

});

Route::group(['prefix' => 'document', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [DocumentController::class, 'index'])->name('list_documents');
    Route::get('create/{receiver_encoded_id}', [DocumentController::class, 'create'])->name('create_document');
    Route::post('store/{receiver}', [DocumentController::class, 'store'])->name('store_document');
    // Route::get('/{encodedId}/show', [ConsultationController::class, 'show'])->name('show_consultation');
    // Route::post('{consultation}/answer', [ConsultationController::class, 'answer'])->name('answer_consultation');

});
Route::get('contact/{receiver_encoded_id}' , [ChatController::class, 'contact'])->name('comtact')->middleware('auth:sanctum');

Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ChatController::class, 'chat'])->name('chat');

    Route::get('{receiver_encoded_id}', [ChatController::class, 'chat_form'])->name('chat_form');
    Route::post('{receiver_encoded_id}', [ChatController::class, 'send_message_to_user'])->name('send_message_to_user');

    // Route::get('/group/{encodedId}', [ChatController::class, 'group_form'])->name('group_form');
    // Route::post('/group/{encodedId}', [ChatController::class, 'send_message_to_group'])->name('send_message_to_group');

    Route::get('/attachments/{encodedIdReceiver}', [ChatController::class, 'attachments'])->name('attachments');
    // Route::get('/attachments/group/{encodedIdGroup}', [ChatController::class, 'attachments_group'])->name('attachments_group');

});

// Route::group(['prefix' => 'group', 'middleware' => 'auth:sanctum'], function () {
//     Route::get('/create', [GroupController::class, 'create'])->name('add_group');
//     Route::post('/store', [GroupController::class, 'store'])->name('store_group');
//     Route::get('/edit/{encodedId}', [GroupController::class, 'edit'])->name('edit_group');
//     Route::post('/update/{group}', [GroupController::class, 'update'])->name('update_group');
// });

// Route::group(['prefix' => 'general-chat', 'middleware' => 'auth:sanctum'], function () {
//     Route::get('/', [GeneralChatController::class, 'create'])->name('add_general_chat');
//     Route::post('/', [GeneralChatController::class, 'store'])->name('store_general_chat');
//     Route::get('{encoded_general_chat}', [GeneralChatController::class, 'edit'])->name('edit_general_chat');
//     Route::post('{general_chat}', [GeneralChatController::class, 'update'])->name('update_general_chat');
// });

// Route::get('/suggestion', [SuggestionController::class, 'index'])->name('list_suggestion')->middleware('auth:sanctum');
// Route::get('/invoice', [InvoiceController::class, 'index'])->name('list_invoice')->middleware('auth:sanctum');
// Route::get('/notification/clear-all', [LawyerController::class, 'clear_all'])->name('notification_clear_all')->middleware('auth:sanctum');

// Route::get('error', function () {
return 'payment failed';
// });
