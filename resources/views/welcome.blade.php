@extends('layouts.app')

@section('title', 'Jadwal Pertandingan')

@section('content')
<div class="row mb-5 justify-content-center text-center animate-fade-in">
    <div class="col-lg-8">
        <span class="badge bg-primary badge-premium mb-3 px-3 py-2 text-uppercase">Portal Informasi Olahraga</span>
        <h1 class="display-4 fw-extrabold text-white mb-3" style="letter-spacing: -1px;">
            Jadwal Pertandingan Terkini
        </h1>
        <p class="text-secondary lead fs-5">
            Dapatkan informasi lengkap mengenai jadwal event olahraga, tempat pelaksanaan, dan penanggung jawab event secara langsung dan akurat.
        </p>

        <div class="mt-4 glass-card p-3" style="max-width: 600px; margin: 0 auto;">
            <form action="{{ route('home') }}" method="GET" class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-accent border-0 text-secondary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="search" class="form-control form-control-premium" placeholder="Cari nama event, tempat, atau penanggung jawab..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-login-premium px-4">
                    Cari
                </button>
                @if($search)
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" style="border-radius: 10px;">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 animate-fade-in" style="animation-delay: 0.1s;">
    @forelse($jadwal as $item)
        <div class="col">
            <div class="glass-card h-100 p-0 overflow-hidden d-flex flex-column">
                <div style="height: 200px; width: 100%; overflow: hidden; position: relative; background-color: var(--bg-accent);">
                    @if($item->gambar && file_exists(public_path($item->gambar)))
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_event }}" style="width: 100%; height: 100%; object-fit: cover; transition: var(--transition-smooth);" class="card-img-hover">
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-secondary" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                            <i class="fa-solid fa-running fa-4x mb-2 text-primary" style="opacity: 0.5;"></i>
                            <span class="small text-uppercase tracking-wider fw-bold text-muted">Event Olahraga</span>
                        </div>
                    @endif
                    
                    <div style="position: absolute; bottom: 15px; left: 15px; background: rgba(11, 15, 25, 0.85); backdrop-filter: blur(5px); border-radius: 8px; padding: 6px 12px; border: 1px solid rgba(255, 255, 255, 0.1);" class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-calendar-days text-info"></i>
                        <span class="text-white fw-bold small">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                <div class="p-4 d-flex flex-column flex-grow-1">
                    <h3 class="h5 fw-bold text-white mb-3 text-truncate">{{ $item->nama_event }}</h3>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2 text-secondary small">
                            <div style="width: 28px;" class="text-center">
                                <i class="fa-solid fa-map-location-dot text-danger"></i>
                            </div>
                            <span class="text-truncate">{{ $item->tempat }}</span>
                        </div>
                        <div class="d-flex align-items-center text-secondary small">
                            <div style="width: 28px;" class="text-center">
                                <i class="fa-solid fa-user-tie text-success"></i>
                            </div>
                            <span class="text-truncate">PIC: <strong>{{ $item->penanggung_jawab }}</strong></span>
                        </div>
                    </div>

                    <div class="mt-auto pt-3 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">ID Event: #{{ sprintf('%04d', $item->id_event) }}</span>
                        <button class="btn btn-outline-info btn-sm px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id_event }}">
                            <i class="fa-solid fa-circle-info me-1"></i> Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detailModal{{ $item->id_event }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white" style="background-color: var(--bg-secondary); border: 1px solid var(--glass-border); border-radius: 18px;">
                    <div class="modal-header border-bottom border-secondary border-opacity-10 p-4">
                        <h5 class="modal-title fw-bold">Detail Jadwal Pertandingan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        @if($item->gambar && file_exists(public_path($item->gambar)))
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_event }}" class="w-100 rounded-3 mb-4" style="max-height: 250px; object-fit: cover;">
                        @endif
                        <table class="table table-borderless text-white mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-secondary ps-0" style="width: 130px;">ID Event</td>
                                    <td class="fw-bold text-info">#{{ sprintf('%04d', $item->id_event) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary ps-0">Nama Event</td>
                                    <td class="fw-bold">{{ $item->nama_event }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary ps-0">Tanggal</td>
                                    <td><i class="fa-regular fa-calendar me-2 text-warning"></i> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary ps-0">Tempat</td>
                                    <td><i class="fa-solid fa-location-dot me-2 text-danger"></i> {{ $item->tempat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-secondary ps-0">Penanggung Jawab</td>
                                    <td><i class="fa-solid fa-user me-2 text-success"></i> {{ $item->penanggung_jawab }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer border-top border-secondary border-opacity-10 p-4">
                        <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="glass-card py-5">
                <i class="fa-regular fa-calendar-times fa-4x text-muted mb-3" style="opacity: 0.5;"></i>
                <h4 class="text-white fw-bold">Belum Ada Jadwal Pertandingan</h4>
                <p class="text-secondary">Tidak ada jadwal pertandingan yang ditemukan atau sesuai dengan pencarian Anda.</p>
            </div>
        </div>
    @endforelse
</div>

<style>
    .card-img-hover:hover {
        transform: scale(1.05);
    }
</style>
@endsection
