<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPertandingan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pertandingans';

    protected $primaryKey = 'id_event';

    protected $fillable = [
        'gambar',
        'nama_event',
        'tanggal',
        'tempat',
        'penanggung_jawab',
    ];
}
