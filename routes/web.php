<?php

use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Learning\LearningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Question\CategoryController;
use App\Http\Controllers\Question\QuestionController;
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




Route::middleware(['auth', 'verified'])->group(function (){

    //Dashboard routes
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    // Question routes
    Route::resource('question', QuestionController::class);
    Route::resource('question_categories', CategoryController::class)->only('index');

    // Exam routes
    Route::resource('exam', ExamController::class);
    Route::post('/exam/select_answer', [ExamController::class,'selectAnswer'])->name('exam.select_answer');
    Route::post('/exam/end', [ExamController::class,'end'])->name('exam.end');

    //Profile routes
    Route::resource('profile', ProfileController::class);

    //learning routes
    Route::resource('learning', LearningController::class);
});


