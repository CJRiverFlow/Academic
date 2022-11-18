<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FetchCoursesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EmailController;

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

Route::get('/', [CoursesController::class, 'index'])->name('home');
Route::get('/email', [EmailController::class, 'email'])->name('email');
Route::post('/email', [EmailController::class, 'emailPost']);
Route::get('/courses', FetchCoursesController::class)->name('courses');
