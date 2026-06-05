@extends('layouts.admin_modern')

@section('judul', 'Profil Admin')

@section('konten')

@if(session('success_password'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:14px;">
    <i class="fas fa-check-circle mr-2"></i> {{ session('success_password') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

@if(session('error_password'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:14px;">
    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error_password') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

<div class="row">
    {{-- INFORMASI PROFIL --}}
    <div class="col-md-5">
        <x-card title="Informasi Profil">
            <div class="text-center mb-4 mt-3">
                <div style="width: 100px; height: 100px; border-radius: 50%; background: #003b70; color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 40px; font-weight: bold; margin-bottom: 15px;">
                    A
                </div>
                <h4 style="color: #072d54; font-weight: 700; margin-bottom: 5px;">Admin Mentari</h4>
                <p class="text-muted mb-0">Administrator Sistem</p>
            </div>

            <hr>

            <div class="px-3 pb-3">
                <div class="mb-3">
                    <label class="text-muted small font-weight-bold mb-1">Nomor WhatsApp (Login)</label>
                    <div class="d-flex align-items-center" style="gap: 10px;">
                        <i class="fab fa-whatsapp text-success" style="font-size: 20px;"></i>
                        <span style="font-size: 16px; font-weight: 600;">{{ auth()->user()->no_wa }}</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small font-weight-bold mb-1">Level Akses</label>
                    <div>
                        <span class="badge badge-primary px-3 py-2">Admin Utama</span>
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    {{-- GANTI PASSWORD --}}
    <div class="col-md-7">
        <x-card title="Ganti Password">
            
            <form action="/ubah-password" method="POST" class="form-crud" data-title="Simpan Password Baru?" data-text="Password Anda akan segera diubah.">
                @csrf
                
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Password Lama</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white" style="border-radius: 12px 0 0 12px; border-right: none;"><i class="fas fa-lock text-muted"></i></span>
                        </div>
                        <input type="password" name="password_lama" class="form-control" style="border-left: none;" placeholder="Masukkan password saat ini" required>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">Password Baru</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white" style="border-radius: 12px 0 0 12px; border-right: none;"><i class="fas fa-key text-primary"></i></span>
                        </div>
                        <input type="password" name="password_baru" class="form-control" style="border-left: none;" placeholder="Minimal 6 karakter" required minlength="6">
                    </div>
                    @error('password_baru')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white" style="border-radius: 12px 0 0 12px; border-right: none;"><i class="fas fa-check-circle text-primary"></i></span>
                        </div>
                        <input type="password" name="password_baru_confirmation" class="form-control" style="border-left: none;" placeholder="Ketik ulang password baru" required minlength="6">
                    </div>
                </div>

                <div class="text-right mt-4 pt-2 border-top">
                    <button type="submit" class="btn btn-success mt-3 px-4 py-2" style="font-size: 15px;">
                        <i class="fas fa-save mr-2"></i> Simpan Password
                    </button>
                </div>
            </form>

        </x-card>
    </div>
</div>

@endsection
