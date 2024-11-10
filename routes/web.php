<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::post('/register', [RegisterController::class, 'register']);



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/verify-otp-login', [LoginController::class, 'verifyOTP']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/session-test', function () {
    return view('session-test');
});



Route::middleware('auth')->group(function () {
    Route::get('/main', [TransferController::class, 'showTransferPage'])->name('main');
    Route::post('/fetch-data', [TransferController::class, 'fetchData']);
    Route::post('/send-otp', [TransferController::class, 'sendOTP']);
    Route::post('/verify-otp', [TransferController::class, 'verifyOTP']);
    Route::get('/load-session', [TransferController::class, 'loadSession'])->name('transfer.loadSession');
    Route::post('/complete-transfer', [TransferController::class, 'completeTransfer']);
    Route::post('/save-session-data', [TransferController::class, 'saveSessionData']);
    Route::post('/update-status', [TransferController::class, 'updateStatus']);
    Route::post('/create-transfer-record', [TransferController::class, 'createTransferRecord']);
    Route::post('/resume-transfer/{id}', [TransferController::class, 'resumeTransfer']);
    Route::get('/check-verification-completion', [TransferController::class, 'checkVerificationCompletion'])->name('checkVerificationCompletion');

});



Route::middleware(['auth'])->group(function () {
    Route::get('/company-dashboard', [CompanyController::class, 'showDashboard'])->name('company.dashboard');
    Route::post('/send-email-verification-otp', [CompanyController::class, 'sendEmailVerificationOTP'])->name('company.sendEmailVerificationOTP');
    Route::post('/verify-email-otp', [CompanyController::class, 'verifyEmailOTP'])->name('company.verifyEmailOTP');
    Route::post('/update-profile', [CompanyController::class, 'updateProfile'])->name('company.updateProfile');
    
});
