<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Jadwal Pertandingan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 11pt;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-surat h3 {
            margin: 2px 0;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-surat h4 {
            margin: 2px 0;
            font-size: 11pt;
            font-weight: normal;
        }
        .kop-surat p {
            margin: 2px 0;
            font-size: 9pt;
            color: #555;
        }
        
        .report-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
            color: #111;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table.data-table th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 10px 8px;
            font-weight: bold;
            font-size: 10pt;
            text-transform: uppercase;
            text-align: left;
        }
        table.data-table td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            font-size: 10pt;
            vertical-align: middle;
        }
        table.data-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-center {
            text-align: center;
        }
        
        /* Footer / Tanda Tangan */
        .signature-section {
            margin-top: 50px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
            border: none;
        }
        .signature-table td {
            border: none;
            width: 50%;
            text-align: center;
            font-size: 10.5pt;
        }
        .signature-space {
            height: 70px;
        }
        .meta-info {
            font-size: 9pt;
            color: #777;
            margin-top: 50px;
            text-align: left;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h3>YAYASAN SASMITA JAYA</h3>
        <h2>UNIVERSITAS PAMULANG</h2>
        <h3>FAKULTAS ILMU KOMPUTER</h3>
        <h4>PROGRAM STUDI SISTEM INFORMASI S-1</h4>
        <p>Jl. Puspitek Raya No. 10, Serpong - Tangerang Selatan Telp. (021) 742 7010</p>
    </div>

    <div class="report-title">
        LAPORAN DATA JADWAL PERTANDINGAN OLAHRAGA
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 15%;" class="text-center">ID Event</th>
                <th style="width: 30%;">Nama Event</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 20%;">Tempat</th>
                <th style="width: 15%;">Penanggung Jawab</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">#{{ sprintf('%04d', $item->id_event) }}</td>
                    <td style="font-weight: bold;">{{ $item->nama_event }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->tempat }}</td>
                    <td>{{ $item->penanggung_jawab }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px; color: #777;">Tidak ada data jadwal pertandingan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td>
                    <p>Mengetahui,</p>
                    <p><strong>Koordinator Pelaksana Ujian</strong></p>
                    <div class="signature-space"></div>
                    <p>__________________________</p>
                    <p>NIDN. 0418089103</p>
                </td>
                <td>
                    <p>Tangerang Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p><strong>Administrator Sistem</strong></p>
                    <div class="signature-space"></div>
                    <p><strong>Admin Rekayasa Web</strong></p>
                    <p>NIM. 241011750035</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="meta-info">
        * Laporan ini dibuat secara otomatis oleh sistem Rekayasa Web Universitas Pamulang.<br>
        Waktu Cetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>

</body>
</html>
