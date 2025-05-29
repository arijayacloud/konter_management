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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $data = [ 'name' => $request->name, 'email' => $request->email, 'password' => $request->password ];
        try {
            $user = User::create($data);
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'There was an issue creating your account. Please try again.']);
        }

        // // Simpan user id ke session
        // $request->session()->put('user_id', $user->id);
        // $request->session()->put('user_name', $user->name);
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
        $request->session()->put('user_name', $user->name);

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

        // Jika ada query pencarian, cari di database
        if ($keyword) {
            // Misalnya kita mencari berdasarkan 'jenis_layanan', 'lokasi_konter', atau 'atas_nama'
             $payments = Payment::where('jenis_layanan', 'LIKE', "%{$keyword}%")
                ->orWhere('lokasi_konter', 'LIKE', "%{$keyword}%")
                ->orWhere('nama_bank', 'LIKE', "%{$keyword}%")
                ->orWhere('nomor_rekening', 'LIKE', "%{$keyword}%")
                ->orWhere('atas_nama', 'LIKE', "%{$keyword}%")
                ->orWhere('jumlah_transfer', 'LIKE', "%{$keyword}%")
                ->orWhere('admin_transfer', 'LIKE', "%{$keyword}%")
                ->paginate(10); // Pagination 10 results per page
        } else {
            // Jika tidak ada pencarian, ambil semua data
            $payments = Payment::paginate(10);
        }
        // $payments = Payment::all();  // Ambil semua data pembayaran dari database
        // $payments = Payment::paginate(1);

        $userName = $request->session()->get('user_name');
        $paymentsCount = Payment::count();

        $totalPayment = 0;
        foreach (Payment::all() as $payment) {
            // Ambil nilai jumlah_transfer yang disimpan sebagai string (misalnya "Rp 1.000.000")
            $paymentString = $payment->jumlah_transfer;

            // Bersihkan simbol 'Rp' dan hapus koma (jika ada)
            $cleanedPayment = str_replace(['Rp', '.', ','], '', $paymentString);

            // Ubah menjadi integer (angka)
            $payment = (int) $cleanedPayment;

            // Tambahkan ke total pembayaran
            $totalPayment += $payment;
        }

        $uniqueNamesCount = Payment::distinct('atas_nama')->count('atas_nama');

        return view('list', compact('userName', 'payments', 'paymentsCount', 'totalPayment', 'uniqueNamesCount'));
    }
}
