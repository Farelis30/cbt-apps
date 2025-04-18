<?php

use App\Http\Controllers\Admin\SiswaProfileController;
use App\Http\Controllers\Admin\GuruProfileController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SettingProfileController;
use App\Http\Controllers\Guru\SettingProfileGuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\Guru\UjianController as GuruUjianController;
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
    Route::middleware('siswa')->group(function () {
        Route::get('/home', [SiswaController::class, 'index'])->name('siswa.home');
        Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('siswa.jadwal');
        Route::get('/detail-ujian/{id}', [SiswaController::class, 'detailUjian'])->name('siswa.detail-ujian');
        Route::get('/mulai-ujian/{id}', [SiswaController::class, 'mulaiUjian'])->name('siswa.mulai-ujian');
        Route::get('/ujian/{soalId?}', [SiswaController::class, 'ujian'])->name('siswa.ujian');
        Route::post('/simpan-jawaban', [SiswaController::class, 'simpanJawaban'])->name('siswa.simpan-jawaban');
        Route::get('/selesai-ujian', [SiswaController::class, 'selesaiUjian'])->name('siswa.selesai-ujian');
        Route::get('/ujian-selesai', [SiswaController::class, 'ujianSelesai'])->name('siswa.ujian-selesai');
    });


    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

        Route::get('/admin/siswa', [SiswaProfileController::class, 'index'])->name('admin.siswa.index');
        Route::get('/admin/siswa/create', [SiswaProfileController::class, 'create'])->name('admin.siswa.create');
        Route::get('/admin/siswa/{id}/edit', [SiswaProfileController::class, 'edit'])->name('admin.siswa.edit');
        Route::post('/admin/siswa/import', [SiswaProfileController::class, 'import'])->name('admin.siswa.import');
        Route::get('/admin/siswa/template', [SiswaProfileController::class, 'downloadTemplate'])->name('admin.siswa.template');

        Route::get('/admin/guru', [GuruProfileController::class, 'index'])->name('admin.guru.index');
        Route::get('/admin/guru/create', [GuruProfileController::class, 'create'])->name('admin.guru.create');
        Route::get('/admin/guru/{id}/edit', [GuruProfileController::class, 'edit'])->name('admin.guru.edit');
        Route::post('/admin/guru/import', [GuruProfileController::class, 'import'])->name('admin.guru.import');
        Route::get('/admin/guru/template', [GuruProfileController::class, 'downloadTemplate'])->name('admin.guru.template');

        Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
        Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
        Route::get('/admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');

        Route::get('/admin/mapel', [MapelController::class, 'index'])->name('admin.mapel.index');
        Route::get('/admin/mapel/create', [MapelController::class, 'create'])->name('admin.mapel.create');
        Route::get('/admin/mapel/{id}/edit', [MapelController::class, 'edit'])->name('admin.mapel.edit');

        Route::get('/admin/ujian', [UjianController::class, 'index'])->name('admin.ujian.index');
        Route::get('/admin/ujian/create', [UjianController::class, 'create'])->name('admin.ujian.create');
        Route::get('/admin/ujian/{id}/edit', [UjianController::class, 'edit'])->name('admin.ujian.edit');

        Route::get('/admin/nilai', [NilaiController::class, 'index'])->name('admin.nilai.index');
        Route::get('/admin/nilai/{siswaId}/detail', [NilaiController::class, 'detail'])->name('admin.nilai.detail');
        Route::get('/admin/nilai/{id}/jawaban', [NilaiController::class, 'jawaban'])->name('admin.nilai.jawaban');

        Route::get('/admin/ujian/{id}/soal/', [UjianController::class, 'soal'])->name('admin.ujian.soal');
        Route::get('/admin/ujian/{id}/soal/create', [UjianController::class, 'createSoal'])->name('admin.ujian.soal.create');
        Route::get('/admin/ujian/{ujianId}/soal/{soalId}/edit', [UjianController::class, 'editSoal'])->name('admin.ujian.soal.edit');
        Route::post('/admin/soal/import', [UjianController::class, 'import'])->name('admin.soal.import');
        Route::get('/admin/soal/template', [UjianController::class, 'downloadTemplate'])->name('admin.soal.template');

        Route::get('/admin/setting', [SettingProfileController::class, 'index'])->name('admin.setting.index');
    });

    Route::middleware('guru')->group(function () {
        Route::get('/guru/dashboard', GuruDashboard::class)->name('guru.dashboard');

        Route::get('/guru/setting', [SettingProfileGuruController::class, 'index'])->name('guru.setting.index');

        Route::get('/guru/ujian', [GuruUjianController::class, 'index'])->name('guru.ujian.index');
        Route::get('/guru/ujian/create', [GuruUjianController::class, 'create'])->name('guru.ujian.create');
        Route::get('/guru/ujian/{id}/edit', [GuruUjianController::class, 'edit'])->name('guru.ujian.edit');

        Route::get('/guru/ujian/{id}/soal/', [GuruUjianController::class, 'soal'])->name('guru.ujian.soal');
        Route::get('/guru/ujian/{id}/soal/create', [GuruUjianController::class, 'createSoal'])->name('guru.ujian.soal.create');
        Route::get('/guru/ujian/{ujianId}/soal/{soalId}/edit', [GuruUjianController::class, 'editSoal'])->name('guru.ujian.soal.edit');
    });

});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
