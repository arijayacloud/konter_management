<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan plural dari nama model
    protected $table = 'payments';  // Menentukan nama tabel secara eksplisit

    // Tentukan kolom yang boleh diisi
    protected $fillable = [
        'tanggal',
        'jenis_layanan',
        'lokasi_konter',
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'jumlah_transfer',
        'admin_transfer',
    ];
}
