<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/create_user', [UserController::class, 'create'])->name('create_user');
    Route::get('/get_user', [UserController::class, 'find'])->name('get_user');
    Route::put('/edit_user', [UserController::class, 'edit'])->name('edit_user');
    Route::delete('/delete_user', [UserController::class, 'delete'])->name('delete_user');
});

require __DIR__.'/auth.php';
