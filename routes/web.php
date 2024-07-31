<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FrequentlyQuestionController;
use App\Http\Controllers\GeneralChatController;
use App\Http\Controllers\GeneralQuestionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TranslationCompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('locale/{lang}', [LangController::class, 'setLang'])->name('lang');

Route::get('/api/get-current-language', function () {
    return response()->json(['language' => session('locale', 'en')]);
});
Route::get('/', [NavbarController::class, 'home_client'])->name('home_client');
Route::get('/lawyer/home', [NavbarController::class, 'home_lawyer'])->name('home_lawyer')->middleware('auth:sanctum');
Route::get('/company/home', [NavbarController::class, 'home_company'])->name('home_company')->middleware('auth:sanctum');

Route::group(['prefix' => 'explore'], function () {
    Route::get('/lawyers', [NavbarController::class, 'explore_lawyer'])->name('explore_lawyer');

    Route::get('/translation-companies', [NavbarController::class, 'explore_translation_company'])->name('explore_translation_company');

});

Route::get('/library', [NavbarController::class, 'library'])->name('library');
Route::group(['prefix' => 'book', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/create', [NavbarController::class, 'create_book'])->name('create_book');
    Route::post('/download', [NavbarController::class, 'download_book'])->name('download_book');
    Route::get('/delete/{book}', [NavbarController::class, 'delete_book'])->name('delete_book');

});
Route::get('library/show/{book_encode_id}', [NavbarController::class, 'show_book'])->name('show_book');


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

Route::get('/request-to-join', [JoinController::class, 'request_to_join'])->name('request_to_join');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/lawyer', [DashboardController::class, 'lawyer_dashboard'])->name('lawyer_dashboard');
    Route::get('/translation-company', [DashboardController::class, 'company_dashboard'])->name('company_dashboard');
    Route::get('/admin', [DashboardController::class, 'admin_dashboard'])->name('admin_dashboard');

});

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list_clients');
    Route::get('/{client_encoded_id}/show', [ClientController::class, 'show'])->name('show_client');
    Route::get('/{client_encoded_id}/details', [ClientController::class, 'details'])->name('details_client');

    Route::get('/edit/{client_encoded_id}', [ClientController::class, 'edit'])->name('edit_client');
    Route::post('/update/{client}', [ClientController::class, 'update'])->name('update_client');

});

Route::group(['prefix' => 'general-question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/index', [GeneralQuestionController::class, 'list_admin'])->name('list_admin_general_questions');
    Route::get('/{question_encoded_id}/show', [GeneralQuestionController::class, 'show'])->name('show_general_question');
    Route::get('/{question_encoded_id}/details', [GeneralQuestionController::class, 'show_client'])->name('show_client_general_question');

    Route::get('list/{user_encoded_id?}', [GeneralQuestionController::class, 'index'])->name('list_general_questions');
    Route::get('/create', [GeneralQuestionController::class, 'create'])->name('create_general_question');
    Route::post('store', [GeneralQuestionController::class, 'store'])->name('save_general_question');
    Route::get('/reply/{encoded_general_question}', [GeneralQuestionController::class, 'reply'])->name('reply_general_question');
    Route::post('/reply/{general_question}', [GeneralQuestionController::class, 'store_reply'])->name('store_reply_general_question');

});
Route::get('general-question', [GeneralQuestionController::class, 'home'])->name('home_general_questions');

Route::group(['prefix' => 'lawyer', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LawyerController::class, 'index'])->name('list_lawyers');

    Route::get('/{lawyer_encoded_id}/show', [LawyerController::class, 'show'])->name('show_lawyer');
    Route::get('/{lawyer_encoded_id}/details', [LawyerController::class, 'details'])->name('details_lawyer');
    Route::get('contact/{receiver_encoded_id}', [LawyerController::class, 'contact'])->name('contact_lawyer');
    Route::post('{lawyer_encode_id}/toggle-status', [LawyerController::class, 'toggle_status'])->name('toggle_status');

    // Route::get('/edit/{encodedId}', [LawyerController::class, 'edit'])->name('edit_lawyer');
    // Route::post('/update/{lawyer}', [LawyerController::class, 'update'])->name('update_lawyer');
});

Route::group(['prefix' => 'translation-company', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TranslationCompanyController::class, 'index'])->name('list_companies');
    Route::get('/{company_encoded_id}/show', [TranslationCompanyController::class, 'show'])->name('show_company');
    Route::get('/{company_encoded_id}/details', [TranslationCompanyController::class, 'details'])->name('details_company');

    Route::get('/{company_encoded_id}/send_request', [TranslationCompanyController::class, 'send_request'])->name('send_request');
    Route::post('/{company_encoded_id}/store_request', [TranslationCompanyController::class, 'store_request'])->name('store_request');

    Route::get('{company_encoded_id}/contact', [TranslationCompanyController::class, 'contact'])->name('contact_company');

});

Route::group(['prefix' => 'invoice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [InvoiceController::class, 'bills_client'])->name('list_invoices');
    Route::get('/{invoice_encode_id}/show', [InvoiceController::class, 'show_client'])->name('show_client_invoices');

});
Route::get('bills/list', [InvoiceController::class, 'bills_admin'])->name('bills_admin')->middleware('auth:sanctum');
Route::get('bills/{bill_encode_id}/show', [InvoiceController::class, 'show'])->name('bill_show')->middleware('auth:sanctum');

Route::get('bills', [InvoiceController::class, 'bills_dashboard'])->name('bills_dashboard')->middleware('auth:sanctum');

Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
    Route::get('list/{receiver_encoded_id?}', [ConsultationController::class, 'index'])->name('list_consultations');
    Route::get('create/{receiver_encoded_id}', [ConsultationController::class, 'create'])->name('create_consultation');
    Route::post('store/{receiver}', [ConsultationController::class, 'store'])->name('store_consultation');
    Route::get('reviews', [ConsultationController::class, 'reviews'])->name('reviews');
    Route::get('{consultation_encode_id}/details', [ConsultationController::class, 'show'])->name('details_consultation');
    Route::get('{consultation_encode_id}/show', [ConsultationController::class, 'show_client'])->name('show_client_consultation');
    Route::post('{consultation_encode_id}/answer', [ConsultationController::class, 'answer'])->name('answer_consultation');
    Route::post('{consultation_encode_id}/closed', [ConsultationController::class, 'closed'])->name('closed_consultation');

});
Route::get('list/reviews', [ConsultationController::class, 'reviews_list_admin'])->name('list_reviews')->middleware('auth:sanctum');

Route::group(['prefix' => 'case', 'middleware' => 'auth:sanctum'], function () {
    Route::get('list/{receiver_encoded_id?}', [CaseController::class, 'index'])->name('list_cases');
    Route::get('{case_encode_id}/show', [CaseController::class, 'show'])->name('show_case');
    Route::get('{case_encode_id}/show/profile', [CaseController::class, 'show_client'])->name('show_client_case');
    Route::get('{case_encode_id}/details', [CaseController::class, 'details'])->name('details_case');
    Route::post('{case_encode_id}/accept', [CaseController::class, 'accept_case'])->name('accept_case');
    Route::post('{case_encode_id}/reject', [CaseController::class, 'reject_case'])->name('reject_case');
    Route::get('/create/{template_encode_id}/{receiver_encode_id}', [CaseController::class, 'create'])->name('create_case');
    Route::post('/store/{template_encode_id}/{receiver_encode_id}', [CaseController::class, 'store'])->name('store_case');
    Route::post('{case_encode_id}/closed', [CaseController::class, 'closed'])->name('closed_case');


});

Route::group(['prefix' => 'document', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [DocumentController::class, 'index'])->name('list_documents');
    Route::get('list-requests/{receiver_encoded_id?}', [DocumentController::class, 'index_requests'])->name('list_requests');
    Route::get('request/{request_encoded_id}/show', [DocumentController::class, 'show_requests'])->name('show_requests');
    Route::get('request/{request_encoded_id}/details', [DocumentController::class, 'show_client_request'])->name('show_client_request');
    Route::post('{request_encode_id}/closed', [DocumentController::class, 'closed'])->name('closed_request');
    Route::post('{request_encode_id}/accept', [DocumentController::class, 'accept'])->name('accept_request');
    Route::post('{document_encode_id}/payment', [DocumentController::class, 'payment_approval'])->name('payment_approval');


});

Route::group(['prefix' => 'template', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TemplateController::class, 'index'])->name('list_template');
    Route::get('/create', [TemplateController::class, 'create'])->name('create_template');
    Route::post('/', [TemplateController::class, 'store'])->name('store_template');
    Route::get('/delete/{template}', [TemplateController::class, 'destroy'])->name('delete_template');
});

Route::group(['prefix' => 'frequently-question'], function () {
    Route::get('/', [FrequentlyQuestionController::class, 'page'])->name('page_frequently_question');
});

Route::group(['prefix' => 'chat/dashboard/group', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/', [ChatController::class, 'group'])->name('group');
    Route::get('/{group_encoded_id}', [ChatController::class, 'group_form'])->name('group_form');
});

Route::group(['prefix' => 'chat/dashboard/forum', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ChatController::class, 'general_chat'])->name('general_chat');
    Route::get('/{general_chat_encoded_id}', [ChatController::class, 'general_chat_form'])->name('general_chat_form');

});

Route::get('chat/client', [ChatController::class, 'chat_client'])->name('chat_client');

Route::group(['prefix' => 'chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('{receiver_encoded_id}', [ChatController::class, 'chat_client_form'])->name('chat_client_form');

    Route::get('/dashboard/translation-company', [ChatController::class, 'chat_company_dashboard'])->name('chat_company_dashboard');
    Route::get('/dashboard/translation-company/{client_encoded_id}', [ChatController::class, 'chat_company_form'])->name('chat_company_form');

    Route::get('/dashboard/lawyer', [ChatController::class, 'chat_lawyer_dashboard'])->name('chat_lawyer_dashboard');
    Route::get('/dashboard/{receiver_encoded_id}', [ChatController::class, 'lawyer_form_dashboard'])->name('lawyer_form_dashboard');

    Route::post('{receiver_encoded_id}', [ChatController::class, 'send_message_to_user'])->name('send_message_to_user');
    Route::post('/group/{group_encoded_id}', [ChatController::class, 'send_message_to_group'])->name('send_message_to_group');

    Route::get('/attachments/{encodedIdReceiver}', [ChatController::class, 'attachments'])->name('attachments');
    Route::get('/attachments/group/{encodedIdGroup}', [ChatController::class, 'attachments_group'])->name('attachments_group');

});

Route::get('/dashboard-contact', [ChatController::class, 'contact'])->name('contact_dashboard')->middleware('auth:sanctum');
Route::get('/contact-client', [ChatController::class, 'contact_client'])->name('contact_client')->middleware('auth:sanctum');
Route::get('/contact-client/{receiver_encoded_id}', [ChatController::class, 'form_contact_client'])->name('form_contact_client')->middleware('auth:sanctum');

Route::group(['prefix' => 'suggestions', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [SuggestionController::class, 'index'])->name('list_suggestions');
    Route::get('/{suggestion_encode_id}', [SuggestionController::class, 'show'])->name('show_suggestion');

});

Route::group(['prefix' => 'practice', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PracticeController::class, 'index'])->name('list_practieces');
    Route::get('/create', [PracticeController::class, 'create'])->name('add_practiece');
    Route::post('/store', [PracticeController::class, 'store'])->name('store_practiece');
    Route::get('/delete/{practice}', [PracticeController::class, 'destroy'])->name('delete_practiece');
});

Route::group(['prefix' => 'language', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [LanguageController::class, 'index'])->name('list_languages');
    Route::get('/create', [LanguageController::class, 'create'])->name('add_language');
    Route::post('/store', [LanguageController::class, 'store'])->name('store_language');
    Route::get('/delete/{language}', [LanguageController::class, 'destroy'])->name('delete_language');
});

Route::group(['prefix' => 'news', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [NewsController::class, 'list'])->name('list_news');
    Route::get('/create', [NewsController::class, 'create'])->name('add_news');
    Route::post('/store', [NewsController::class, 'store'])->name('store_news');
    Route::get('/delete/{news}', [NewsController::class, 'destroy'])->name('delete_news');
});
Route::get('news/{news_encode_id}/show', [NewsController::class, 'show'])->name('show_news');
Route::get('news/{news_encode_id}/details', [NewsController::class, 'details'])->name('details_news_client');

Route::group(['prefix' => 'group', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/create', [GroupController::class, 'create'])->name('add_group');
    Route::post('/store', [GroupController::class, 'store'])->name('store_group');
    Route::get('/edit/{group_encoded_id}', [GroupController::class, 'edit'])->name('edit_group');
    Route::post('/update/{group}', [GroupController::class, 'update'])->name('update_group');
});

Route::group(['prefix' => 'general-chat', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [GeneralChatController::class, 'create'])->name('add_general_chat');
    Route::post('/', [GeneralChatController::class, 'store'])->name('store_general_chat');
    Route::get('{general_chat_encoded_id}', [GeneralChatController::class, 'edit'])->name('edit_general_chat');
    Route::post('{general_chat}', [GeneralChatController::class, 'update'])->name('update_general_chat');
});

Route::get('/notification/clear-all', [LawyerController::class, 'clear_all'])->name('notification_clear_all')->middleware('auth:sanctum');

Route::post('rating/{document_encode_id}' , [DocumentController::class, 'rating'])->name('rating')->middleware('auth:sanctum');


Route::get('error', function () {
return 'payment failed';
});
