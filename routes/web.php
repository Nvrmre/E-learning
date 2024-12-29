<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Models\Course;
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


    Route::get('/user', [AdminController::class, 'index'])->name('profile.index');
    Route::get('/user/create', [AdminController::class, 'create'])->name('profile.create');
    Route::post('/user', [AdminController::class, 'store'])->name('profile.store');
    Route::get('/user/{user}/edit', [AdminController::class, 'edit'])->name('profile.edit');
    Route::put('/user/{user}', [AdminController::class, 'update'])->name('profile.update');
    Route::delete('/user/{user}', [AdminController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
