<?php

use App\Http\Controllers\Admin\SiswaProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Guru\Dashboard as GuruDashboard;
use App\Livewire\Login;
use App\Livewire\Siswa\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [SiswaController::class, 'index'])->name('siswa.home');
    Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('siswa.jadwal');
    Route::get('/detail-ujian', [SiswaController::class, 'detailUjian'])->name('siswa.detail-ujian');
    Route::get('/ujian', [SiswaController::class, 'ujian'])->name('siswa.ujian');
    Route::get('/ujian-selesai', [SiswaController::class, 'ujianSelesai'])->name('siswa.ujian-selesai');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

        Route::get('/admin/siswas', [SiswaProfileController::class, 'index'])->name('admin.siswas.index');
        Route::get('/admin/siswas/create', [SiswaProfileController::class, 'create'])->name('admin.siswas.create');
        Route::get('/admin/siswas/{id}/edit', [SiswaProfileController::class, 'edit'])->name('admin.siswas.edit');

        Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
        Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
        Route::get('/admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');

    });

    Route::middleware('guru')->group(function () {
        Route::get('/guru/dashboard', GuruDashboard::class)->name('guru.dashboard');
    });

});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
