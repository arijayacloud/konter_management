<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Mpdf\Mpdf;

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
            'nama_bank' => 'required|string',
            'nomor_rekening' => 'required|string',
            'atas_nama' => 'required|string',
            'jumlah_transfer' => 'required|string',
            'admin_transfer' => 'required|string',
        ]);

        $user = User::find(session('user_id'));

        $serial = $request->serial_number;
        if (!$serial) {
            do {
                $serial = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Payment::where('serial_number', $serial)->exists());
        }

        // Simpan data ke database
        $payment = Payment::create([
            'tanggal' => $request->tanggal,
            'jenis_layanan' => $request->jenis_layanan,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
            'jumlah_transfer' => $request->jumlah_transfer,
            'admin_transfer' => $request->admin_transfer,
            'user_id' => $user->id,
            'serial_number' => $serial,
        ]);

        return redirect()->route('list');  // Setelah disimpan, redirect ke halaman daftar pembayaran
    }
    public function update(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id' => 'required|exists:payments,id',
            'tanggal' => 'required|date',
            'jenis_layanan' => 'required|string',
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

        $user = User::find(session('user_id'));
        $nama_konter = $user->nama_konter;
        $lokasi = $user->lokasi;

        $html = view('print', compact('payment', 'nama_konter', 'lokasi'))->render();

        $mpdf = new Mpdf([
            'format' => [58, 100], // 58mm x 100mm
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 2,
            'margin_bottom' => 2,
        ]);
        $mpdf->WriteHTML($html);

        // return response($mpdf->Output('', 'I')) // 'I' = inline preview
        // ->header('Content-Type', 'application/pdf');

        // Return file as download
        return response($mpdf->Output('', 'S')) // Return as string
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="struk-transaction-' . $id . '.pdf"');
    }

}
