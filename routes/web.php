<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\StudentController;



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
    return redirect()->action([HomeController::class, 'index']);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Route::get('/user.get_data',[UserController::class, 'get_data'])->name('get_data');
Route::resource('users', UsersController::class);
Route::resource('courses', CourseController::class);
Route::resource('articles', ArticleController::class);
Route::resource('students', StudentController::class);
