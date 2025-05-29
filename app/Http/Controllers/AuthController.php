<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $userName = $request->session()->get('user_name');
        return view('list', compact('userName'));
    }
}
