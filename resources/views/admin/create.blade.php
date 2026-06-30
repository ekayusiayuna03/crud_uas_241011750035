@extends('layouts.app')

@section('title', 'Tambah Jadwal Pertandingan')

@section('content')
<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-white mb-1">
                    <i class="fa-solid fa-circle-plus text-primary me-2"></i> Tambah Jadwal Pertandingan
                </h2>
                <p class="text-secondary small mb-0">Silakan isi formulir di bawah ini dengan lengkap untuk menambahkan jadwal baru.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 px-3 py-2" style="border-radius: 10px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="glass-card p-4 p-md-5">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="nama_event" class="form-label-premium">Nama Event / Pertandingan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_event" id="nama_event" class="form-control form-control-premium @error('nama_event') is-invalid @enderror" placeholder="Contoh: Turnamen Futsal Rektor Cup 2026" value="{{ old('nama_event') }}" required>
                        @error('nama_event')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tanggal" class="form-label-premium">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control form-control-premium @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tempat" class="form-label-premium">Tempat / Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="tempat" id="tempat" class="form-control form-control-premium @error('tempat') is-invalid @enderror" placeholder="Contoh: Gedung Serba Guna Viktor" value="{{ old('tempat') }}" required>
                        @error('tempat')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="penanggung_jawab" class="form-label-premium">Penanggung Jawab <span class="text-danger">*</span></label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control form-control-premium @error('penanggung_jawab') is-invalid @enderror" placeholder="Contoh: Himpunan Mahasiswa Sistem Informasi" value="{{ old('penanggung_jawab') }}" required>
                        @error('penanggung_jawab')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="gambar" class="form-label-premium">Gambar Poster / Banner <span class="text-secondary small">(Opsional)</span></label>
                        <input type="file" name="gambar" id="gambar" class="form-control form-control-premium @error('gambar') is-invalid @enderror" accept="image/*" style="padding-top: 10px;">
                        <div class="text-secondary small mt-2">Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</div>
                        @error('gambar')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                        
                        <div class="mt-3 d-none" id="previewContainer">
                            <label class="form-label-premium">Pratinjau Gambar:</label>
                            <div class="bg-accent rounded-3 overflow-hidden d-inline-block border border-secondary border-opacity-25" style="max-width: 300px;">
                                <img id="imagePreview" src="" alt="Pratinjau" style="width: 100%; height: auto; max-height: 200px; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-login-premium px-5 py-2">
                        Simpan Jadwal <i class="fa-solid fa-floppy-disk ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('d-none');
        }
    });
</script>
@endsection
