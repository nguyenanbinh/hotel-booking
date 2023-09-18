<?php

use App\Http\Controllers\Backend\RoomTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'index']);


Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'userProfilerStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'changePasswordStore'])->name('password.change.store');

});

require __DIR__.'/auth.php';

// Admin Group Middleware
Route::middleware(['auth','roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    // RoomType All Route
    Route::controller(RoomTypeController::class)->group(function(){
        Route::get('/room/type/list', 'getRoomType')->name('room.type.list');
        Route::get('/add/room/type', 'createRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'storeRoomType')->name('room.type.store');

    });
}); // End Admin Group Middleware

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

