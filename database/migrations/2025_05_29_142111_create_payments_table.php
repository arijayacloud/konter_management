<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();  // Kolom ID
            $table->date('tanggal');  // Kolom tanggal
            $table->string('jenis_layanan');  // Kolom jenis layanan
            $table->string('nama_bank');  // Kolom nama bank
            $table->string('nomor_rekening');  // Kolom nomor rekening
            $table->string('atas_nama');  // Kolom atas nama
            $table->string('jumlah_transfer');  // Kolom jumlah transfer
            $table->string('admin_transfer');  // Kolom admin transfer
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke users
            $table->string('serial_number', 8)->unique(); // 8 digit unik
            $table->timestamps();  // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
