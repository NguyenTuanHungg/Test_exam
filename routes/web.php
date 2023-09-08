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
