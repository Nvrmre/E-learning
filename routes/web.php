<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulController;


Route::get('/', function () {
    return view('index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/classrooms', ClassroomController::class);
    Route::resource('/courses', CourseController::class);
    // Route::resource('/tugas', TugasController::class);
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');


    //Ujian
    Route::resource('exams', ExamController::class);
    Route::resource('quizzes', QuizController::class);
    Route::get('/exams/{exam}/exam_scores', [ExamScoreController::class, 'index'])->name('exam_scores.index');
    Route::get('/exams/{exam}/exam_scores/create', [ExamScoreController::class, 'create'])->name('exam_scores.create');
    Route::post('/exams/{exam}/exam_scores', [ExamScoreController::class, 'store'])->name('exam_scores.store');
    Route::resource('exam_scores', ExamScoreController::class);
});

Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

// Halaman untuk mengerjakan kuis (hanya untuk siswa yang sudah login)
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
});

// Halaman untuk membuat kuis, hanya admin dan guru
Route::middleware(['auth', 'role:admin,guru'])->group(function () {
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::get('quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');

    // halaman modul pembelajaran
    Route::get('/modul', [ModulController::class, 'showAllModul'])->name('modul.index');
    Route::get('/modul/create', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/modul', [ModulController::class, 'store'])->name('modul.store');
    Route::get('/modul/{modul}/edit', [ModulController::class, 'edit'])->name('modul.edit');
    Route::put('/modul/{modul}', [ModulController::class, 'update'])->name('modul.update');
    Route::delete('/modul/{modul}', [ModulController::class, 'destroy'])->name('modul.destroy');
});


require __DIR__ . '/auth.php';
