<?php

use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Question\QuestionController;
use App\Models\Exam\Exam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Auth::user() ? Redirect::route('dashboard') : Inertia::render('Auth/Login');
});

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact',function (){
    return Inertia::render('Contact');
});
require __DIR__.'/auth.php';

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});


// Question routes

Route::middleware(['auth', 'verified'])->group(function (){
    Route::resource('question', QuestionController::class);
});

// Exam routes

Route::middleware(['auth', 'verified'])->group(function (){
    Route::resource('exam', ExamController::class);
    Route::post('/exam/select_answer', [ExamController::class,'selectAnswer'])->name('exam.select_answer');
    Route::post('/exam/end', [ExamController::class,'end'])->name('exam.end');
});

