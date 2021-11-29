<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizFeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;

Route::middleware(['user'])->group(function () {
    //Announcements
    Route::get('/announcements', [AnnouncementController::class, 'index']);
    Route::get('/announcements/show', [AnnouncementController::class, 'show']);

    //Quiz Routes
    Route::get('/quiz', [QuizController::class, 'index']);
    Route::get('/quiz/show', [QuizController::class, 'show']);
    Route::post('/quiz/create', [QuizController::class, 'create']);
    Route::delete('/quiz/delete/{id}', [QuizController::class, 'delete']);
    Route::post('/quiz/favourite', [QuizController::class, 'favourite']);
    Route::delete('/quiz/unfavourite/{id}', [QuizController::class, 'unfavourite']);

    //Quiz Feedback Routes
    Route::get('/quiz_feedback/show/{id}', [QuizFeedbackController::class, 'show']);
    Route::post('/quiz_feedback/create', [QuizFeedbackController::class, 'create']);
    Route::delete('/quiz_feedback/delete/{id}', [QuizFeedbackController::class, 'delete']);
    Route::post('/quiz_feedback/favourite', [QuizFeedbackController::class, 'favourite']);
    Route::delete('/quiz_feedback/unfavourite/{id}', [QuizFeedbackController::class, 'unfavourite']);

    //Profile Routes
    Route::get('/profile/{username}', [ProfileController::class, 'index']);
    Route::get('/profile/info/{username}', [ProfileController::class, 'usersInfo']);
    Route::post('/profile/support', [ProfileController::class, 'support']);
    Route::delete('/profile/unsupport/{id}', [ProfileController::class, 'unsupport']);
    Route::put('/profile/change/username', [ProfileController::class, 'changeUsername']);
    Route::get('/profile/check/usernameExists/{username}', [ProfileController::class, 'checkIfUsernameExists']);
    Route::put('/profile/change/password', [ProfileController::class, 'changePassword']);
});