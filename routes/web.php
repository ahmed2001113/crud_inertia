<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
Route::middleware('auth')->group(function(){
    Route::get('/', [TaskController::class,'index'])->name('home');
    Route::resource('/tasks', TaskController::class);
    Route::get('category/{category}/tasks', [TaskController::class,'getTasksByCategory'])->name('category.tasks');
    Route::get('order/{column}/{direction}/tasks', [TaskController::class,'getTasksOrderedBy'])->name('order.tasks');
    Route::get('search/tasks', [TaskController::class,'getTasksByTerm'])->name('search.tasks');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/profile', [AuthController::class,'profile'])->name('profile');
    Route::get('/user/notifications', [AuthController::class,'notifications'])->name('notification');
    Route::get('read/{id}/notification', [AuthController::class,'makeNotificationAsRead'])->name('read.notification');
    Route::get('delete/{id}/notification', [AuthController::class,'deleteNotification'])->name('delete.notification');
    Route::post('/profile', [AuthController::class,'updateProfileImage'])->name('profile');
    Route::get('/email/verify',[AuthController::class,'emailVerification'] )->name('verification.notice');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with([
            'message' => 'email or password dont match',
            'class' => 'alert alert-danger',
        ]);
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/')->with([
            'message' => 'email or password dont match',
            'class' => 'alert alert-danger',
        ]);
    })->middleware(['auth', 'signed'])->name('verification.verify');
});


Route::middleware('guest')->group(function(){
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'store'])->name('register');
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'auth'])->name('login');
});

