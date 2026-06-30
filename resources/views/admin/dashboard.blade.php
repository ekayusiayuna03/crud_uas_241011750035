@extends('layouts.app')

@section('title', 'Dashboard Kelola Jadwal')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<style>
    .dataTables_wrapper {
        color: var(--text-secondary);
    }
    .dataTables_length label, .dataTables_filter label {
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.9rem;
    }
    .dataTables_filter input, .dataTables_length select {
        background-color: var(--bg-accent) !important;
        border: 1px solid var(--glass-border) !important;
        color: var(--text-primary) !important;
        border-radius: 6px;
        padding: 6px 12px;
        margin-left: 8px;
    }
    .dataTables_filter input:focus, .dataTables_length select:focus {
        outline: none;
        border-color: var(--primary-color) !important;
    }
    .table-premium {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100% !important;
    }
    .table-premium thead tr th {
        background-color: var(--bg-accent) !important;
        color: var(--text-primary) !important;
        border: none;
        padding: 15px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .table-premium tbody tr {
        background-color: rgba(22, 30, 49, 0.4);
        transition: var(--transition-smooth);
    }
    .table-premium tbody tr td {
        background-color: rgba(22, 30, 49, 0.4) !important;
        color: var(--text-secondary) !important;
        border-top: 1px solid var(--glass-border) !important;
        border-bottom: 1px solid var(--glass-border) !important;
        padding: 15px;
        vertical-align: middle;
    }
    .table-premium tbody tr td:first-child {
        border-left: 1px solid var(--glass-border) !important;
        border-radius: 8px 0 0 8px;
    }
    .table-premium tbody tr td:last-child {
        border-right: 1px solid var(--glass-border) !important;
        border-radius: 0 8px 8px 0;
    }
    .table-premium tbody tr:hover td {
        background-color: rgba(99, 102, 241, 0.08) !important;
        color: var(--text-primary) !important;
        border-color: rgba(99, 102, 241, 0.2) !important;
    }
    .dataTables_info {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    .pagination .page-link {
        background-color: var(--bg-accent) !important;
        border-color: var(--glass-border) !important;
        color: var(--text-secondary) !important;
        font-weight: 600;
        margin: 0 2px;
        border-radius: 6px;
    }
    .pagination .page-item.active .page-link {
        background: var(--primary-gradient) !important;
        border-color: transparent !important;
        color: white !important;
    }
    .pagination .page-item.disabled .page-link {
        background-color: rgba(11, 15, 25, 0.5) !important;
        opacity: 0.5;
    }
</style>
@endsection

@section('content')
<div class="row mb-4 align-items-center animate-fade-in">
    <div class="col-md-6 mb-3 mb-md-0">
        <h2 class="fw-bold text-white mb-1">
            <i class="fa-solid fa-folder-open text-primary me-2"></i> Pengelolaan Jadwal Pertandingan
        </h2>
        <p class="text-secondary small mb-0">Halaman khusus Administrator untuk mengelola entri data secara lengkap (CRUD).</p>
    </div>
    <div class="col-md-6 text-md-end d-flex gap-2 justify-content-md-end">
        <a href="{{ route('admin.export') }}" class="btn btn-outline-danger d-inline-flex align-items-center gap-2 px-3 py-2" style="border-radius: 10px;">
            <i class="fa-solid fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('admin.create') }}" class="btn btn-login-premium d-inline-flex align-items-center gap-2 px-4 py-2">
            <i class="fa-solid fa-circle-plus"></i> Tambah Jadwal
        </a>
    </div>
</div>

<div class="glass-card p-4 animate-fade-in" style="animation-delay: 0.1s;">
    <div class="table-responsive">
        <table id="jadwalTable" class="table table-premium align-middle">
            <thead>
                <tr>
                    <th style="width: 80px;" class="text-center">ID Event</th>
                    <th style="width: 100px;">Gambar</th>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Tempat</th>
                    <th>Penanggung Jawab</th>
                    <th style="width: 120px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $item)
                    <tr>
                        <td class="text-center fw-bold text-info">#{{ sprintf('%04d', $item->id_event) }}</td>
                        <td>
                            @if($item->gambar && file_exists(public_path($item->gambar)))
                                <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_event }}" class="rounded-2" style="width: 60px; height: 45px; object-fit: cover; border: 1px solid var(--glass-border);">
                            @else
                                <div class="rounded-2 bg-accent d-flex align-items-center justify-content-center" style="width: 60px; height: 45px; border: 1px solid var(--glass-border);">
                                    <i class="fa-solid fa-image text-muted small"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold text-white">{{ $item->nama_event }}</td>
                        <td>
                            <i class="fa-regular fa-calendar-days text-warning me-1"></i>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        </td>
                        <td>
                            <i class="fa-solid fa-map-pin text-danger me-1"></i>
                            {{ $item->tempat }}
                        </td>
                        <td class="fw-semibold">
                            <i class="fa-solid fa-user-gear text-success me-1"></i>
                            {{ $item->penanggung_jawab }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('admin.edit', $item->id_event) }}" class="btn btn-sm btn-outline-warning d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;" title="Ubah">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_event }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach($jadwal as $item)
    <div class="modal fade" id="deleteModal{{ $item->id_event }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-white" style="background-color: var(--bg-secondary); border: 1px solid var(--glass-border); border-radius: 18px;">
                <div class="modal-header border-bottom border-secondary border-opacity-10 p-4">
                    <h5 class="modal-title fw-bold text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus jadwal pertandingan <strong>"{{ $item->nama_event }}"</strong>?</p>
                    <p class="text-secondary small mt-2 mb-0">Tindakan ini bersifat permanen dan tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-top border-secondary border-opacity-10 p-4">
                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.destroy', $item->id_event) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 rounded-pill">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#jadwalTable').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Pencarian:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "<i class='fa-solid fa-chevron-right'></i>",
                    "previous": "<i class='fa-solid fa-chevron-left'></i>"
                }
            },
            "columnDefs": [
                { "orderable": false, "targets": [1, 6] }
            ],
            "order": [[3, "desc"]] 
        });
    });
</script>
@endsection