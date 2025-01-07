<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FillSurveyController;
use App\Http\Controllers\PageSurveyController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\UserController;
use App\Models\fillSurveys;
use Illuminate\Http\Request;
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

Route::redirect('/', 'survey');

Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout' ])->name('logout');

    Route::middleware('isUser')->group(function(){
        Route::get('survey', [PageSurveyController::class, 'userIndex'])->name('app.survey');

        Route::get('/survey/questions/{survey}', [PageSurveyController::class, 'userQuest'])->name('app.quest');

        Route::post('/survey/submit', [FillSurveyController::class, 'create'])->name('fill_survey.submit');

        Route::get('/survey/thankyou', [PageSurveyController::class, 'userThankyou'])->name('thankyou');
    });


    Route::middleware('isAdmin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('layanan')->group(function () {
            Route::get('', [SurveyController::class, 'index'])->name('admin.layanan');
            Route::post('create', [SurveyController::class, 'store'])->name('admin.layanan.create');
            Route::get('{survey}/edit', [SurveyController::class, 'edit'])->name('admin.layanan.edit');
            Route::put('{survey}/update', [SurveyController::class, 'update'])->name('admin.layanan.update');
            Route::delete('{survey}/delete', [SurveyController::class, 'delete'])->name('admin.layanan.delete');
        });

        Route::prefix('question')->group(function () {
            Route::get('', [SurveyQuestionController::class, 'index'])->name('admin.question');
            Route::post('/create', [SurveyQuestionController::class, 'create'])->name('admin.question.create');
        });

        Route::prefix('fill_surveys')->group(function () {
            Route::get('', [FillSurveyController::class, 'index'])->name('admin.fill_surveys');
        });

        Route::prefix('user')->group(function(){
            Route::get('', [UserController::class, 'index'])->name('user.index');
            Route::post('/create', [UserController::class, 'store'])->name('admin.user.create');
            Route::delete('{user}/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        });
    });
});


Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
        Route::post('/login', [AuthController::class, 'loginVerify'])->name('auth.login.process');
        Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/register', [AuthController::class, 'registerVerify'])->name('auth.register.process');
    });
});








// Route::middleware(['auth'])->group(function(){
//     Route::middleware('isAdmin')->prefix('admin')->group(function(){
//     });


// });
