<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NewsController;
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
Route::get('/teachers',[TeacherController::class,'index']);
Route::get('/add/teachers',[TeacherController::class,'addTeacherForm'])->name('addTeacherForm');
Route::get('/students',[StudentController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news',[NewsController::class,'index']);
Route::get('/create',[CreateController::class,'index']);
