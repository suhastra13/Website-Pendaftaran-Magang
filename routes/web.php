<?php

use App\Models\PendaftaranMagang;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Kalau sudah login, langsung arahkan ke dashboard sesuai role
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    // Kalau belum login, tampilkan landing page
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            $total       = PendaftaranMagang::count();
            $pending     = PendaftaranMagang::where('status', 'pending')->count();
            $diterima    = PendaftaranMagang::where('status', 'diterima')->count();
            $ditolak     = PendaftaranMagang::where('status', 'ditolak')->count();
            $terbaru     = PendaftaranMagang::latest()->take(5)->get();

            return view('admin.dashboard', compact('total', 'pending', 'diterima', 'ditolak', 'terbaru'));
        })->name('dashboard');

        Route::get('/pendaftar', [AdminPendaftaranController::class, 'index'])
            ->name('pendaftar.index');

        Route::get('/pendaftar/export', [AdminPendaftaranController::class, 'export'])
            ->name('pendaftar.export');

        Route::get('/pendaftar/{id}', [AdminPendaftaranController::class, 'show'])
            ->name('pendaftar.show');

        Route::post('/pendaftar/{id}/status', [AdminPendaftaranController::class, 'updateStatus'])
            ->name('pendaftar.updateStatus');

        // 👇 PERBAIKAN DI SINI
    });


Route::middleware(['auth'])->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.index');

    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');

    Route::get(
        '/pendaftaran/surat/{pendaftaran}',
        [PendaftaranController::class, 'suratPenerimaan']
    )->name('pendaftaran.surat');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
