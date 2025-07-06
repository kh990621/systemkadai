<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginProcessController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolGradeController;

Route::get('/', function () {
    return view('welcome');
})->name('home'); 


// web.php
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('admin.register.submit');



Route::get('/menu', function () {
    return view('menu');
})->name('menu');


Route::get('/student/grade-up', [StudentController::class, 'gradeUp'])->name('student.grade.up');
Route::post('/student/grade-up', [StudentController::class, 'gradeUp'])->name('student.grade.up');


Route::get('/student/register', [StudentController::class, 'create'])->name('student.register');

Route::post('/student/register', [StudentController::class, 'store'])->name('student.store');


Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');


Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');



// 成績登録
Route::get('/grades/create/{student}', [SchoolGradeController::class, 'create'])->name('grades.create');
Route::post('/grades/store/{student}', [SchoolGradeController::class, 'store'])->name('grades.store');


// 成績編集
Route::get('/grades/{grade}/edit', [SchoolGradeController::class, 'edit'])->name('grades.edit');
Route::put('/grades/{grade}', [SchoolGradeController::class, 'update'])->name('grades.update');


Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


Route::get('/students/{id}/grades', [StudentController::class, 'getGrades'])->name('students.grades');
