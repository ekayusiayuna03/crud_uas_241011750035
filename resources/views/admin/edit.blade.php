@extends('layouts.app')

@section('title', 'Ubah Jadwal Pertandingan')

@section('content')
<div class="row justify-content-center animate-fade-in">
    <div class="col-lg-8">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-white mb-1">
                    <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Ubah Jadwal Pertandingan
                </h2>
                <p class="text-secondary small mb-0">Perbarui informasi jadwal pertandingan #{{ sprintf('%04d', $item->id_event) }} di bawah ini.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 px-3 py-2" style="border-radius: 10px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="glass-card p-4 p-md-5">
            <form action="{{ route('admin.update', $item->id_event) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="nama_event" class="form-label-premium">Nama Event / Pertandingan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_event" id="nama_event" class="form-control form-control-premium @error('nama_event') is-invalid @enderror" placeholder="Contoh: Turnamen Futsal Rektor Cup 2026" value="{{ old('nama_event', $item->nama_event) }}" required>
                        @error('nama_event')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tanggal" class="form-label-premium">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control form-control-premium @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $item->tanggal) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="tempat" class="form-label-premium">Tempat / Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="tempat" id="tempat" class="form-control form-control-premium @error('tempat') is-invalid @enderror" placeholder="Contoh: Gedung Serba Guna Viktor" value="{{ old('tempat', $item->tempat) }}" required>
                        @error('tempat')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="penanggung_jawab" class="form-label-premium">Penanggung Jawab <span class="text-danger">*</span></label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control form-control-premium @error('penanggung_jawab') is-invalid @enderror" placeholder="Contoh: Himpunan Mahasiswa Sistem Informasi" value="{{ old('penanggung_jawab', $item->penanggung_jawab) }}" required>
                        @error('penanggung_jawab')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="gambar" class="form-label-premium">Gambar Poster / Banner <span class="text-secondary small">(Opsional)</span></label>
                        <input type="file" name="gambar" id="gambar" class="form-control form-control-premium @error('gambar') is-invalid @enderror" accept="image/*" style="padding-top: 10px;">
                        <div class="text-secondary small mt-2">Biarkan kosong jika tidak ingin mengubah gambar. Format didukung: JPG, JPEG, PNG, WEBP (maksimal 2MB).</div>
                        @error('gambar')
                            <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                        @enderror
                        
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label-premium">Gambar Saat Ini:</label>
                                <div class="bg-accent rounded-3 p-2 d-inline-block border border-secondary border-opacity-25" style="width: 100%; max-width: 250px;">
                                    @if($item->gambar && file_exists(public_path($item->gambar)))
                                        <img src="{{ asset($item->gambar) }}" alt="Gambar Saat Ini" style="width: 100%; height: auto; max-height: 150px; object-fit: contain;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-muted py-4 small">
                                            <i class="fa-solid fa-image-slash me-2"></i> Belum ada gambar
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6 d-none" id="previewContainer">
                                <label class="form-label-premium">Pratinjau Gambar Baru:</label>
                                <div class="bg-accent rounded-3 p-2 d-inline-block border border-success border-opacity-25" style="width: 100%; max-width: 250px;">
                                    <img id="imagePreview" src="" alt="Pratinjau Gambar Baru" style="width: 100%; height: auto; max-height: 150px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 10px;">Batal</a>
                    <button type="submit" class="btn btn-login-premium px-5 py-2">
                        Perbarui Jadwal <i class="fa-solid fa-floppy-disk ms-2"></i>
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
