<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('get.positions');
Route::post('/auth/login', [Controllers\AuthController::class, 'login'])->name("login");
Route::get('/auth/user', [Controllers\AuthController::class, 'user'])->name("user");
Route::get('/search-skills', [Controllers\HomeController::class, 'searchSkills'])->name('search.skills');
Route::get('/search-portfolios', [Controllers\HomeController::class, 'searchPortfolios'])->name('search.portfolios');
Route::get('/get-languages', [Controllers\HomeController::class, 'getLanguages'])->name('get.languages');
Route::post('/save-resume', [Controllers\HomeController::class, 'saveResume'])->name("save.resume");

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/get-resume', [Controllers\Admin\ResumeController::class, 'getResume'])->name('admin.get.resume');
    Route::get('/positions', [Controllers\Admin\PositionController::class, 'index'])->name('admin.positions');
    Route::get('/resumes', [Controllers\Admin\ResumeController::class, 'index'])->name('admin.resumes');
    Route::post('/update-resume', [Controllers\HomeController::class, 'updateResume'])->name("update.resume");
    Route::get('/search-resumes', [Controllers\Admin\ResumeController::class, 'searchResume'])->name("admin.search.resumes");
    Route::get('/search-positions', [Controllers\Admin\PositionController::class, 'searchPosition'])->name("admin.search.positions");
});
