<?php

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\GeneralQuestionController;
use App\Http\Controllers\JoinUsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard')->middleware('auth:sanctum');


Route::group(['prefix' => 'practices', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [PracticeController::class, 'index'])->name('list_practieces');
    Route::get('/create', [PracticeController::class, 'create'])->name('add_practiece');
    Route::post('/store', [PracticeController::class, 'store'])->name('store_practiece');
    Route::get('/edit/{practice}', [PracticeController::class, 'edit'])->name('edit_practiece');
    Route::post('/update/{practice}', [PracticeController::class, 'update'])->name('update_practiece');
    Route::get('/delete/{practice}', [PracticeController::class, 'destroy'])->name('delete_practiece');
});

Route::group(['prefix' => 'employee', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('list_employees');
    Route::get('/create', [EmployeeController::class, 'create'])->name('add_employee');
    Route::get('/{employee}/show', [EmployeeController::class, 'show'])->name('show_employee');
    Route::post('/store', [EmployeeController::class, 'store'])->name('store_employee');
    Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('edit_employee');
    Route::post('/update/{employee}', [EmployeeController::class, 'update'])->name('update_employee');
    Route::get('/delete/{employee}', [EmployeeController::class, 'destroy'])->name('delete_employee');
});

Route::group(['prefix' => 'client', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('list_clients');
    Route::get('/{client}/show', [ClientController::class, 'show'])->name('show_client');

});

Route::group(['prefix' => 'consultation', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ConsultationController::class,  'index'])->name('list_consultations');
    Route::get('/{consultation}/show', [ConsultationController::class, 'show'])->name('show_consultation');

});

Route::group(['prefix' => 'general_question', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [GeneralQuestionController::class,  'index'])->name('list_general_questions');
    Route::get('/{general_question}/show', [GeneralQuestionController::class, 'show'])->name('show_general_question');

});

Route::group(['prefix' => 'join_us', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [JoinUsController::class,  'index'])->name('list_join_us');

});



// Route::get('/chat', [ChatController::class, 'index'])->name('chat');

Auth::routes();
