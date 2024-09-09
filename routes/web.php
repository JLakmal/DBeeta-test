<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProgressController;

    Route::middleware('auth')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::patch('lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    Route::post('courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::patch('progress/{progress}', [ProgressController::class, 'update'])->name('progress.update');

    Route::middleware(['auth', 'role:instructor'])->group(function () {

    });

    Route::middleware(['auth', 'role:student'])->group(function () {
    });
});
