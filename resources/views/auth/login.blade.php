@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="row justify-content-center align-items-center py-5 animate-fade-in">
    <div class="col-md-5">
        <div class="glass-card p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="d-inline-block bg-primary bg-opacity-10 p-3 rounded-circle mb-3" style="width: 70px; height: 70px;">
                    <i class="fa-solid fa-lock text-primary fs-2"></i>
                </div>
                <h2 class="h3 fw-bold text-white mb-1">Login Administrator</h2>
                <p class="text-secondary small">Masuk untuk mengelola Data Jadwal Pertandingan</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label-premium">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-accent border-0 text-secondary">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="username" id="username" class="form-control form-control-premium @error('username') is-invalid @enderror" placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                    </div>
                    @error('username')
                        <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label-premium">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-accent border-0 text-secondary">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control form-control-premium @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input bg-accent border-secondary" style="cursor: pointer;">
                        <label class="form-check-label text-secondary small" for="remember" style="cursor: pointer;">
                            Ingat Saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-login-premium w-100 py-3 fw-bold">
                    Masuk Sekarang <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                </button>
            </form>

            <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 text-center">
                <a href="{{ route('home') }}" class="text-secondary small text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
