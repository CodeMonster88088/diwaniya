<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\PoemController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\Admin\AudioController as AdminAudioController;
use App\Http\Controllers\ArchiveController;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/audio', [AudioController::class, 'index'])
    ->name('audio.index');
Route::get('/archive', [ArchiveController::class, 'index'])
    ->name('archive.index');

Route::get('/archive/poems/{poem:slug}', [ArchiveController::class, 'showPoem'])
    ->name('archive.poems.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    //audio
    Route::get('/audio', [AdminAudioController::class, 'index'])
        ->name('admin.audio.index');
    Route::get('/audio/create', [AdminAudioController::class, 'create'])
        ->name('admin.audio.create');
    Route::post('/audio', [AdminAudioController::class, 'store'])
        ->name('admin.audio.store');
    Route::get('/audio/{audioRecording}/edit', [AdminAudioController::class, 'edit'])
        ->name('admin.audio.edit');

    Route::put('/audio/{audioRecording}', [AdminAudioController::class, 'update'])
        ->name('admin.audio.update');
    Route::delete('/audio/{audioRecording}', [AdminAudioController::class, 'destroy'])
        ->name('admin.audio.destroy');

    //photos
    Route::get('/photos', [PhotoController::class, 'index'])
        ->name('admin.photos.index');
    Route::get('/photos/create', [PhotoController::class, 'create'])
        ->name('admin.photos.create');

    Route::post('/photos', [PhotoController::class, 'store'])
        ->name('admin.photos.store');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])
        ->name('admin.photos.edit');

    Route::put('/photos/{photo}', [PhotoController::class, 'update'])
        ->name('admin.photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])
        ->name('admin.photos.destroy');
    //poems
    Route::get('/poems', [PoemController::class, 'index'])
        ->name('admin.poems.index');
    Route::get('/poems/create', [PoemController::class, 'create'])
        ->name('admin.poems.create');

    Route::post('/poems', [PoemController::class, 'store'])
        ->name('admin.poems.store');
    Route::get('/poems/{poem}/edit', [PoemController::class, 'edit'])
        ->name('admin.poems.edit');

    Route::put('/poems/{poem}', [PoemController::class, 'update'])
        ->name('admin.poems.update');
    Route::delete('/poems/{poem}', [PoemController::class, 'destroy'])
        ->name('admin.poems.destroy');
});


require __DIR__ . '/auth.php';
