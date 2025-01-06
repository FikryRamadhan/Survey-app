<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FillSurveyController;
use App\Http\Controllers\PageSurveyController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
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

Route::middleware('guest')->group(function(){
    Route::get('survey', [PageSurveyController::class, 'userIndex'])->name('app.survey');

    Route::get('/survey/questions/{survey}', [PageSurveyController::class, 'userQuest'])->name('app.quest');

    Route::post('/survey/submit', [FillSurveyController::class, 'create'])->name('fill_survey.submit');

    Route::get('/survey/thankyou', [PageSurveyController::class, 'userThankyou'])->name('thankyou');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('layanan')->group(function(){
    Route::get('', [SurveyController::class, 'index'])->name('admin.layanan');
});

Route::prefix('question')->group(function(){
    Route::get('', [SurveyQuestionController::class, 'index'])->name('admin.question');
});

Route::prefix('fill_surveys')->group(function(){
    Route::get('', [FillSurveyController::class, 'index'])->name('admin.fill_surveys');
});

// Route::middleware(['auth'])->group(function(){
//     Route::middleware('isAdmin')->prefix('admin')->group(function(){
//     });

    
// });
