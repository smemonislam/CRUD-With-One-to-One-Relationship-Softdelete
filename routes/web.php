<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('user/trashed', [UserController::class, 'trashed'])->name('user.trashed');
Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::resource('user', UserController::class);


Route::get('profile/trashed', [ProfileController::class, 'trashed'])->name('profile.trashed');
Route::get('profile/restore/{id}', [ProfileController::class, 'restore'])->name('profile.restore');
Route::delete('profile/delete/{id}', [ProfileController::class, 'delete'])->name('profile.delete');

Route::resource('profile', ProfileController::class);
