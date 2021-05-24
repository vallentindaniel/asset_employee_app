<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CostCenterController;
use App\Http\Controllers\DashboardController;
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
    return redirect('login');
});

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register');
Route::get('/verify-email', [AuthController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');
Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('resend-verify-email', [AuthController::class, 'resendVerifyEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::match(['get', 'post'], '/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::match(['get', 'post'], '/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.view');
    Route::match(['get', 'post'], '/edit-profile', [ProfileController::class, 'editProfile'])->name('profile.edit');

    #CostCenter
    Route::get('/cost-center', [CostCenterController::class, 'index'])->name('costCenter.all');
    Route::post('/cost-center/update/{id}', [CostCenterController::class, 'update']);
    Route::get('/cost-center/delete/{id}', [CostCenterController::class, 'destroy']);
    Route::get('/cost-center/{id}', [CostCenterController::class, 'show'])->name('costCenter.view.id');


    Route::middleware(['admin'])->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users.all');
        Route::post('/user/update', [AdminController::class, 'updateUser'])->name('users.update');
        Route::post('/user-update/{id}', [AdminController::class, 'updateUserAjax'])->name('users.update-ajax');
        Route::post('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    });



    #Asset
    Route::get('/asset', [AssetController::class, 'index'])->name('assets.all');
    Route::post('/add-asset', [AssetController::class, 'store']);
    Route::post('/edit-asset/', [AssetController::class, 'update'])->name('assets.update');
    Route::post('/delete-asset/', [AssetController::class, 'destroy'])->name('assets.delete');

    Route::get('/asset/{asset_id}/{employee_id}', [AssetController::class, 'show'])->name('assets.view');


});
