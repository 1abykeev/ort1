<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnterController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function() {
    return view('register');
});

Route::get('/login', function() {
    return view('login');
});


Route::post('/register-form', [EnterController::class, 'register']);
Route::post('/login-acc', [EnterController::class, 'login']);


Route::get('/profile/{encryptedId}', [EnterController::class, 'showProfile'])->name('profile.show');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile/{id}', [EnterController::class, 'showProfile'])->name('profile.show');
// });


Route::get('edit/{id}', [ProfileController::class, 'editUserInfo']);

Route::put('update-data/{id}', [ProfileController::class, 'updateUserInfo']);


