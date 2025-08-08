<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use Mpdf\Mpdf;
use App\Exports\MutasiExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'jenis_layanan' => strtoupper($request->jenis_layanan),
            'nama_bank' => strtoupper($request->nama_bank),
            'nomor_rekening' => $request->nomor_rekening, // ini gak perlu dikapitalin
            'atas_nama' => strtoupper($request->atas_nama),
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
            'jenis_layanan' => strtoupper($validatedData['jenis_layanan']),
            'nama_bank' => strtoupper($validatedData['nama_bank']),
            'nomor_rekening' => $validatedData['nomor_rekening'],
            'atas_nama' => strtoupper($validatedData['atas_nama']),
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

        $pdfContent = $mpdf->Output('', 'S'); // << Simpan sekali aja

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="struk-transaction-' . $id . '.pdf"')
            ->header('Content-Length', strlen($pdfContent));
    }

    public function export(Request $request){

        $type = $request->input('type');
        $user = User::find(session('user_id'));

        if ($type === 'harian') {
            $request->validate([
                'tanggal' => 'required|date',
            ]);
            $tanggal = $request->input('tanggal');

            $mutasi = Payment::where('user_id', $user->id)
                ->whereDate('tanggal', $tanggal)
                ->get();
        } elseif ($type === 'bulanan') {
            $request->validate([
                'bulan' => 'required|integer|min:1|max:12',
                'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            ]);

            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');

            $mutasi = Payment::where('user_id', $user->id)
                ->whereMonth('tanggal', $bulan)   // pakai whereMonth biar lebih readable
                ->whereYear('tanggal', $tahun)    // filter tahun juga supaya tepat
                ->get();
        } else {
            //return redirect()->route("list")->with('error', 'Filter type tidak valid');
            $mutasi = Payment::where('user_id', $user->id)
                ->get();
        }

        $mutasi = $mutasi->map(function($item) use ($user) {
            return [
                'tanggal' => $item->tanggal,
                'jenis_layanan' => $item->jenis_layanan,
                'lokasi_konter' => $user->nama_konter,   // kolom tambahan dari user
                'nama_bank' => $item->nama_bank,
                'nomor_rekening' => $item->nomor_rekening,
                'atas_nama' => $item->atas_nama,
                'jumlah_transfer' => $item->jumlah_transfer,
                'admin_transfer' => $item->admin_transfer,
            ];
        });

        if ($mutasi->isEmpty()) {
            // Kalau datanya kosong, redirect balik dengan pesan error
            return redirect()->route("list")->with('error', 'Data mutasi tidak ditemukan untuk filter yang dipilih.');
        }

        return Excel::download(new MutasiExport($mutasi), 'mutasi.xlsx');
    }
    
    
    public function createFromPayment(Request $request, $id)
    {
        // Ambil serial number dari request atau buat baru
        $serial = $request->serial_number;
        if (!$serial) {
            do {
                $serial = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Payment::where('serial_number', $serial)->exists());
        }
    
        // Ambil data payment berdasarkan ID
        $payment = Payment::findOrFail($id);
    
        // Ambil semua atribut jadi array
        $data = $payment->toArray();
    
        // Hapus kolom id
        unset($data['id']);
    
        // Set kolom serial_number dengan yang baru
        $data['serial_number'] = $serial;
    
        // Duplikat data ke record baru
        Payment::create($data);
    
        return redirect()->back()->with('success', 'Data baru berhasil dibuat!');
    }

    
}
