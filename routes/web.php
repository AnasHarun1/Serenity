<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CapsuleController;
use Illuminate\Support\Facades\Artisan;



// Article
Route::get('/library', [ArticleController::class, 'index'])->name('library.index');
Route::get('/library/{slug}', [ArticleController::class, 'show'])->name('library.show');

// Features
Route::get('/report/download', [FeatureController::class, 'downloadReport'])->name('report.download');
Route::get('/sos', [FeatureController::class, 'sos'])->name('features.sos');
Route::resource('capsule', CapsuleController::class);

Route::middleware(['auth'])->group(function () {
   
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/toggle', [ChatController::class, 'toggleMode'])->name('chat.toggle');
    Route::post('/chat/clear', [ChatController::class, 'clearChat'])->name('chat.clear');

    
    Route::resource('journal', JournalController::class);
});


Route::get('/mood/check-in', [MoodController::class, 'create'])->name('mood.create');
Route::post('/mood/store', [MoodController::class, 'store'])->name('mood.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/dashboard/mission/complete', [DashboardController::class, 'completeMission'])
    ->middleware(['auth', 'verified'])
    ->name('mission.complete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Journal Routes
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/journal/create', [JournalController::class, 'create'])->name('journal.create');
    Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');
    Route::get('/journal/{id}', [JournalController::class, 'show'])->name('journal.show');
});


Route::get('/run-migration', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration run successfully! <br>' . nl2br(Artisan::output());
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});



Route::get('/run-seeder', function () {
    try {
        Artisan::call('db:seed', ['--force' => true]);
        return 'Seeder run successfully! <br>' . nl2br(Artisan::output());
    } catch (\Exception $e) {
        return 'Seeder failed: ' . $e->getMessage();
    }
});
Route::get('/force-fix-db', function () {
    try {
        if (!\Illuminate\Support\Facades\Schema::hasColumn('moods', 'sleep_hours')) {
             \Illuminate\Support\Facades\Schema::table('moods', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->decimal('sleep_hours', 4, 1)->nullable()->after('emoji_level');
            });
            return 'Column sleep_hours added successfully!';
        }
        return 'Column sleep_hours already exists!';
    } catch (\Exception $e) {
        return 'Fix failed: ' . $e->getMessage();
    }
});

// ---------------------------------

require __DIR__ . '/auth.php';
