<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin Rekayasa Web',
                'password' => bcrypt('admin'),
            ]
        );

        if (\App\Models\JadwalPertandingan::count() === 0) {
            \App\Models\JadwalPertandingan::create([
                'nama_event' => 'Turnamen Futsal Rektor Cup 2026',
                'tanggal' => '2026-07-10',
                'tempat' => 'Stadion Gelora Pamulang',
                'penanggung_jawab' => 'Himpunan Mahasiswa Sistem Informasi',
            ]);

            \App\Models\JadwalPertandingan::create([
                'nama_event' => 'Kompetisi Bulutangkis Single Putra',
                'tanggal' => '2026-07-15',
                'tempat' => 'GOR Kampus Viktor',
                'penanggung_jawab' => 'UKM Olahraga Unpam',
            ]);

            \App\Models\JadwalPertandingan::create([
                'nama_event' => 'Kejuaraan Basket Antar Fakultas',
                'tanggal' => '2026-07-22',
                'tempat' => 'Lapangan Basket Kampus 2',
                'penanggung_jawab' => 'Senat Mahasiswa Fasilkom',
            ]);
        }
    }
}
