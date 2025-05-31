<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    // Menyimpan data pembayaran baru
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_layanan' => 'required|string',
            'lokasi_konter' => 'required|string',
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'jumlah_transfer' => 'required|string',
            'admin_transfer' => 'required|string',
        ]);

        // Simpan data ke database
        Payment::create($request->all());

        return redirect()->route('list');  // Setelah disimpan, redirect ke halaman daftar pembayaran
    }
    public function update(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required|exists:payments,id',
            'tanggal' => 'required|date',
            'jenis_layanan' => 'required|string',
            'lokasi_konter' => 'required|string',
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'jumlah_transfer' => 'required|string',
            'admin_transfer' => 'required|string',
        ]);

        $payment = Payment::findOrFail($request->id);

        $payment->update([
            'tanggal' => $validatedData['tanggal'],
            'jenis_layanan' => $validatedData['jenis_layanan'],
            'lokasi_konter' => $validatedData['lokasi_konter'],
            'nama_bank' => $validatedData['nama_bank'],
            'nomor_rekening' => $validatedData['nomor_rekening'],
            'atas_nama' => $validatedData['atas_nama'],
            'jumlah_transfer' => $validatedData['jumlah_transfer'],
            'admin_transfer' => $validatedData['admin_transfer'],
        ]);

        return redirect()->route('list');  // Setelah disimpan, redirect ke halaman daftar pembayaran
    }
    public function destroy($id) {
        $payment = Payment::findOrFail($id);

        // Jika diperlukan, cek apakah user yang sedang login adalah yang membuat transaksi
        // if (auth()->user()->cannot('delete', $transaction)) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Hapus transaksi
        $payment->delete();

        // Redirect kembali dengan pesan sukses
        // return redirect()->route('list')->with('success', 'Transaction deleted successfully!');
        return redirect()->route('list');
    }

    public function print($id){
        $payment = Payment::findOrFail($id);
        return view('print', compact('payment'));
    }

}
