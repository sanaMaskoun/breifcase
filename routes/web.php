<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthStudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//login & register 
Route::post('login',[AuthController::class,'login'])->name('login');
Route::middleware('auth:sanctum')->post('logout',[AuthController::class,'logout']);


Route::get('/', function () {
    return view('master.app');
});


Route::get('/dashboard',function(){
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/chat',function(){
    return view('pages.chat');
})->name('chat');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
