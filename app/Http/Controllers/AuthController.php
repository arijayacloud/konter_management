<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Payment;

class AuthController extends Controller
{
     // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register'); // pastikan view ini ada
    }

    // Proses register
    public function register(Request $request)
    {
        $result = $request->validate([
            'nama_konter' => 'required|string|max:255',
            'lokasi' => 'required|string|unique:users,lokasi|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $data = [ 'nama_konter' => $request->nama_konter, 'lokasi' => $request->lokasi, 'email' => $request->email, 'password' => Hash::make($request->password) ];
        try {
            $user = User::create($data);
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'There was an issue creating your account. Please try again.']);
        }
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan view ini ada
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        // Simpan user id ke session
        $request->session()->put('user_id', $user->id);
        // $request->session()->put('user_name', $user->name);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('login.form');
    }

    // Dashboard protected
    public function dashboard(Request $request)
    {
        $userName = $request->session()->get('user_name');
        return view('dashboard', compact('userName'));
    }

    public function list(Request $request)
    {

         // Ambil query pencarian dari input search
        $keyword = $request->input('keyword');  // 'search' adalah nama parameter query dari input form

        $keyword = strtolower($keyword);

        $userId = session('user_id');
        // Jika ada query pencarian, cari di database
        if ($keyword) {
            // Misalnya kita mencari berdasarkan 'jenis_layanan', 'lokasi_konter', atau 'atas_nama'
            $payments = Payment::where('user_id', $userId)
                ->where(function ($query) use ($keyword) {
                    $keyword = strtolower($keyword); // konversi ke lowercase sekali aja

                    $query->whereRaw('LOWER(jenis_layanan) LIKE ?', ["%{$keyword}%"])
                          ->orWhereRaw('LOWER(nama_bank) LIKE ?', ["%{$keyword}%"])
                          ->orWhereRaw('LOWER(nomor_rekening) LIKE ?', ["%{$keyword}%"])
                          ->orWhereRaw('LOWER(atas_nama) LIKE ?', ["%{$keyword}%"])
                          ->orWhereRaw('LOWER(jumlah_transfer) LIKE ?', ["%{$keyword}%"])
                          ->orWhereRaw('LOWER(admin_transfer) LIKE ?', ["%{$keyword}%"]);
                })
                ->paginate(10);
        } else {
            // Jika tidak ada pencarian, ambil semua data
            $payments = Payment::where('user_id', $userId)->paginate(10);
        }
        // $payments = Payment::all();  // Ambil semua data pembayaran dari database
        // $payments = Payment::paginate(1);

        $user = User::find($userId);

        $nama_konter = $user->nama_konter;
        $paymentsCount = Payment::where('user_id', $userId)->count();

        $totalPayment = 0;
        foreach ($payments as $payment) {
            // Ambil nilai jumlah_transfer yang disimpan sebagai string (misalnya "Rp 1.000.000")
            $paymentString = $payment->jumlah_transfer;

            // Bersihkan simbol 'Rp' dan hapus koma (jika ada)
            $cleanedPayment = str_replace(['Rp', '.', ','], '', $paymentString);

            // Ubah menjadi integer (angka)
            $payment = (int) $cleanedPayment;

            // Tambahkan ke total pembayaran
            $totalPayment += $payment;
        }

        $uniqueNamesCount = Payment::where('user_id', $userId)
            ->distinct('atas_nama')
            ->count('atas_nama');


        return view('list', compact('nama_konter', 'payments', 'paymentsCount', 'totalPayment', 'uniqueNamesCount'));
    }
}
