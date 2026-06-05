<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranPublicController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\AdminKonsultasiController;
use App\Http\Controllers\AdminNilaiController;


Route::get('/', function () {
    return view('home');
});

Route::get('/beranda', function () {
    return view('beranda');
});

//beranda home
Route::get('/beranda', [HomeController::class, 'index']);
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.detail');

//siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
Route::post('/siswa/{id}/reset-password', [SiswaController::class, 'resetPassword'])->name('siswa.resetPassword');
Route::get('/siswa/jadwal', [SiswaDashboardController::class, 'jadwal']);
Route::get('/siswa/materi', [SiswaDashboardController::class, 'materi']);
Route::get('/siswa/nilai', [SiswaDashboardController::class, 'nilai']);
Route::get('/siswa/profil', [App\Http\Controllers\SiswaController::class, 'profil']);
Route::post('/siswa/profil/update', [App\Http\Controllers\SiswaController::class, 'updateProfil']);


//kelas
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

//guru
Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
Route::post('/guru/{id}/reset-password', [GuruController::class, 'resetPassword'])->name('guru.resetPassword');
Route::get('/guru/jadwal', [App\Http\Controllers\GuruDashboardController::class, 'jadwal']);
Route::get('/guru/materi', [GuruDashboardController::class, 'materi']);
Route::post('/guru/materi/store', [GuruDashboardController::class, 'storeMateri']);
Route::get('/guru/materi/delete/{id}', [GuruDashboardController::class, 'deleteMateri']);
Route::get('/guru/materi/edit/{id}', [GuruDashboardController::class, 'editMateri']);
Route::post('/guru/materi/update/{id}', [GuruDashboardController::class, 'updateMateri']);
Route::get('/guru/profil', [GuruController::class, 'profil']);
Route::post('/guru/profil', [GuruController::class, 'updateProfil']);
Route::get('/guru/nilai', [GuruDashboardController::class, 'nilai']);
Route::post('/guru/nilai/store', [GuruDashboardController::class, 'storeNilai']);
Route::get('/guru/nilai/delete/{id}', [GuruDashboardController::class, 'destroyNilai']);

//mapel
Route::get('/mapel', [MataPelajaranController::class, 'index'])->name('mapel.index');
Route::post('/mapel', [MataPelajaranController::class, 'store'])->name('mapel.store');
Route::get('/mapel/{id}/edit', [MataPelajaranController::class, 'edit'])->name('mapel.edit');
Route::put('/mapel/{id}', [MataPelajaranController::class, 'update'])->name('mapel.update');
Route::delete('/mapel/{id}', [MataPelajaranController::class, 'destroy'])->name('mapel.destroy');


//jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

//materi
Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
Route::get('/materi/{id}/download', [MateriController::class, 'download'])->name('materi.download');

//pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
Route::post('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
Route::post('/pembayaran/bayar-tunai/{id}', [PembayaranController::class, 'bayarTunai'])->name('pembayaran.bayarTunai');
Route::post('/pembayaran/reminder', [PembayaranController::class, 'kirimReminder'])->name('pembayaran.reminder');

// tagihan
Route::get('/tagihan', [PembayaranController::class, 'tagihan'])->name('tagihan.index');
Route::post('/tagihan', [PembayaranController::class, 'store'])->name('tagihan.store');
Route::get('/tagihan/{id}/edit', [PembayaranController::class, 'tagihanEdit'])->name('tagihan.edit');
Route::put('/tagihan/{id}', [PembayaranController::class, 'tagihanUpdate'])->name('tagihan.update');
Route::delete('/tagihan/{id}', [PembayaranController::class, 'tagihanDestroy'])->name('tagihan.destroy');

//notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi/clear', [NotifikasiController::class, 'clearAll'])->name('notifikasi.clear');

//user perndaftaran
Route::get('/daftar', [PendaftaranPublicController::class, 'index'])->name('daftar.index');
Route::post('/daftar', [PendaftaranPublicController::class, 'store'])->name('daftar.store');
Route::get('/cek-status', [PendaftaranPublicController::class, 'cekStatus'])->name('cek-status');
Route::post('/cek-status', [PendaftaranPublicController::class, 'cekStatusProses'])->name('cek-status.proses');

//pendaftaran admin
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran/{id}/terima', [PendaftaranController::class, 'simpanTerima'])->name('pendaftaran.simpanTerima');
Route::put('/pendaftaran/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('pendaftaran.tolak');


//login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/ubah-password', [AuthController::class, 'ubahPassword'])->middleware('auth');
Route::get('/profil', function () {
    if (auth()->user()->level != 'admin') return redirect('/');
    return view('profil_admin');
})->middleware('auth')->name('admin.profil');


//halaman siswa user
Route::get('/siswa-dashboard', [SiswaDashboardController::class, 'index']);
Route::get('/siswa/pembayaran', [SiswaDashboardController::class, 'pembayaran'])->name('siswa.pembayaran');
Route::post('/siswa/pembayaran/upload', [SiswaDashboardController::class, 'upload'])->name('siswa.pembayaran.upload');
Route::get('/siswa/toggle-parent', [SiswaDashboardController::class, 'toggleParent'])->name('siswa.toggle-parent');
Route::get('/siswa/parent-dashboard', [SiswaDashboardController::class, 'parentDashboard'])->name('siswa.parent-dashboard');

//halaman guru
Route::get('/guru-dashboard', [GuruDashboardController::class, 'index']);

Route::get('/test-wa', function () {
    $phone = request('phone');
    if (!$phone) return "Gunakan format: /test-wa?phone=08xxxxxxxxx";
    $wa = new \App\Services\WhatsAppService();
    $sent = $wa->sendMessage($phone, "Halo! Ini adalah pesan tes dari aplikasi Bimbel Mentari.");
    return $sent ? "✅ Berhasil dikirim ke $phone!" : "❌ Gagal. Cek log.";
});

// ====================================================
// MODUL BARU: KONSULTASI ORANG TUA & GURU (100% MODULAR)
// ====================================================
Route::get('/siswa/parent/konsultasi', [KonsultasiController::class, 'indexSiswa']);
Route::post('/siswa/parent/konsultasi', [KonsultasiController::class, 'storeSiswa']);
Route::get('/guru/konsultasi', [KonsultasiController::class, 'indexGuru']);
Route::post('/guru/konsultasi/{id}/balas', [KonsultasiController::class, 'updateGuru']);

// ====================================================
// MODUL ARSIP ABSENSI (SEDERHANA)
// ====================================================
use App\Http\Controllers\ArsipAbsensiController;
Route::get('/guru/arsip-absensi', [ArsipAbsensiController::class, 'indexGuru']);
Route::get('/admin/arsip-absensi', [ArsipAbsensiController::class, 'indexAdmin']);
Route::post('/arsip-absensi/store', [ArsipAbsensiController::class, 'store']);
Route::delete('/arsip-absensi/{id}', [ArsipAbsensiController::class, 'destroy']);


// ====================================================
// MODUL ADMIN: KONSULTASI & NILAI
// ====================================================
Route::get('/admin/konsultasi', [AdminKonsultasiController::class, 'index'])->name('admin.konsultasi');
Route::delete('/admin/konsultasi/{id}', [AdminKonsultasiController::class, 'destroy'])->name('admin.konsultasi.destroy');

Route::get('/admin/nilai', [AdminNilaiController::class, 'index'])->name('admin.nilai');
Route::put('/admin/nilai/{id}', [AdminNilaiController::class, 'update'])->name('admin.nilai.update');
Route::delete('/admin/nilai/{id}', [AdminNilaiController::class, 'destroy'])->name('admin.nilai.destroy');

// ====================================================
// MODUL EXCEL & CETAK NILAI
// ====================================================
Route::get('/guru/nilai/template', [GuruDashboardController::class, 'downloadTemplateNilai'])->name('guru.nilai.template');
Route::post('/guru/nilai/import', [GuruDashboardController::class, 'importNilai'])->name('guru.nilai.import');
Route::get('/siswa/nilai/export', [SiswaDashboardController::class, 'exportNilai'])->name('siswa.nilai.export');
Route::get('/siswa/nilai/cetak', [SiswaDashboardController::class, 'cetakNilai'])->name('siswa.nilai.cetak');