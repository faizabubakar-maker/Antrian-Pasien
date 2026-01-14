<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD (opsional)
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', fn () => view('auth.forgot'))
    ->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    Password::sendResetLink($request->only('email'));
    return back()->with('status', 'Link reset dikirim ke email');
});

/*
|--------------------------------------------------------------------------
| USER (AUTH)
|--------------------------------------------------------------------------
*/
Route::get('/antrian/check-status',
    [AntrianController::class, 'checkStatus']
)->name('antrian.checkStatus');
Route::middleware('auth')->group(function () {

    /*
    |--------------------------
    | USER DASHBOARD
    |--------------------------
    */
    Route::get('/dashboard', [AntrianController::class, 'userDashboard'])
        ->name('user.dashboard');

    /*
    |--------------------------
    | ANTRIAN USER
    |--------------------------
    */
    Route::get('/antrian/create', [AntrianController::class, 'create'])
        ->name('antrian.create');

    Route::post('/antrian', [AntrianController::class, 'store'])
        ->name('antrian.store');

    Route::get('/antrian', [AntrianController::class, 'index'])
        ->name('antrian.index');

    Route::patch('/antrian/{antrian}/cancel',
        [AntrianController::class, 'cancel']
    )->name('antrian.cancel');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:admin')->group(function () {

        /*
        |--------------------------
        | ADMIN DASHBOARD
        |--------------------------
        */
        Route::get('/admin/dashboard', fn () => view('admin.dashboard'))
            ->name('admin.dashboard');

        /*
        |--------------------------
        | POLI CRUD
        |--------------------------
        */
        Route::resource('/admin/polis', PoliController::class)
            ->names('admin.polis');

        /*
        |--------------------------
        | DOKTER CRUD
        |--------------------------
        */
        Route::resource('/admin/dokters', DokterController::class)
            ->names('admin.dokters');

        /*
        |--------------------------
        | QUEUE MANAGEMENT
        |--------------------------
        */
        Route::get('/admin/queue', [QueueController::class, 'index'])
            ->name('admin.queue.index');

        Route::patch('/admin/queue/{antrian}/status',
            [QueueController::class, 'updateStatus']
        )->name('admin.queue.updateStatus');

        Route::post('/admin/queue/call-next/{dokter}',
            [QueueController::class, 'callNext']
        )->name('admin.queue.callNext');
    });
});