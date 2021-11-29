<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

//Admin Routes
Route::middleware(['admin'])->group(function () {
    //Index
    Route::get('/admin', [AdminController::class, 'index']);

    //Warnings
    Route::get('/admin/get_user_warning', [AdminController::class, 'getUserWarning']);
    Route::put('/admin/update_user_warning', [AdminController::class, 'updateUserWarning']);

    //Delete User
    Route::get('/admin/get_user', [AdminController::class, 'getUser']);
    Route::delete('/admin/delete_user/{id}', [AdminController::class, 'deleteUser']);

    //Announcements
    Route::get('/admin/announcement/show', [AdminController::class, 'getAnnouncements']);
    Route::post('/admin/announcement/create/', [AdminController::class, 'createAnnouncement']);
    Route::delete('/admin/announcement/delete/{id}/', [AdminController::class, 'deleteAnnouncement']);

    //FAQS
    Route::get('/admin/faq/show', [AdminController::class, 'getFAQs']);
    Route::post('/admin/faq/create/', [AdminController::class, 'createFAQ']);
    Route::delete('/admin/faq/delete/{id}/', [AdminController::class, 'deleteFAQ']);
});