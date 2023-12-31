<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserExamController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('admin', [TopicController::class, 'index'])->name('admin');
    Route::get('add', [TopicController::class, 'add'])->name('add');
    Route::post('add_topic', [TopicController::class, 'store'])->name('add_topic');
    Route::get('update/{id}', [TopicController::class, 'update'])->name('edit');
    Route::put('update/{id}', [TopicController::class, 'updateTopic'])->name('update');
    Route::delete('delete_topic/{id}', [TopicController::class, 'deleteTopic'])->name('delete_topic');
    Route::post('insert_cate', [TopicController::class, 'insertCategory'])->name('insert_cate');
    Route::get('add_cate', [TopicController::class, 'addCategory'])->name('add_Cate');
    Route::delete('deleteCate/{id}', [TopicController::class, 'deleteCategory'])->name('deleteCate');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register_index'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('exam/{id}', [UserExamController::class, 'startExam'])->name('exam');
Route::post('submit/{id}', [UserExamController::class, 'submitExam'])->name('submit');
Route::get('result/{id}', [UserExamController::class, 'showResult'])->name('result');
Route::get('history', [UserExamController::class, 'resultHistory'])->name('history');
Route::get('user_exam_answers/{id}', [UserExamController::class, 'userExamAnswers'])->name('user_exam_answers');
Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('google');
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/get-topics/{id}', [TopicController::class, 'getTopicsByCategory'])->name('get-topics');