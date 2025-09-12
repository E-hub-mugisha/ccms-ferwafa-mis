<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerTransferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\StaffController;
use App\Models\PlayerTransfer;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clubs', ClubController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('matches', MatchesController::class);
    Route::resource('fixtures', FixtureController::class);
    Route::get('/fixtures/calendar', [FixtureController::class, 'calendar'])->name('fixtures.calendar');
    Route::resource('licenses', LicenseController::class);

    Route::resource('/stadiums', StadiumController::class);
    Route::resource('/player_transfers', PlayerTransferController::class);
Route::get('/transfers/{id}/approve', [PlayerTransferController::class, 'approve'])->name('transfers.approve');
Route::get('/transfers/{id}/reject', [PlayerTransferController::class, 'reject'])->name('transfers.reject');
Route::get('/transfer-report/pdf', [PlayerTransferController::class, 'downloadPdf'])->name('transfers.pdf');
});

require __DIR__.'/auth.php';
