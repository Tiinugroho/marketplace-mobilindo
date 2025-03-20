<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbstok;
use App\Models\tbpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        // $product = tbstok::all();
        // $id_user = Auth::id();
        // $products = tbpesanan::where('id_user', $id_user)
        // ->where('status', 'pending')
        //     ->with('tbstok')
        //     ->get();
        // $jumlah_pesanan = $products->count();
        // return view("login", compact('products', 'jumlah_pesanan'));
        return view('login');
    }

    public function register()
    {
        // $product = tbstok::all();
        // $id_user = Auth::id();
        // $products = tbpesanan::where('id_user', $id_user)
        // ->where('status', 'pending')
        //     ->with('tbstok')
        //     ->get();
        // $jumlah_pesanan = $products->count();
        // return view("register", compact('products', 'jumlah_pesanan'));
        return view('register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);
    
        // Cek apakah user dengan role yang sesuai ada
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => $credentials['role']
        ])) {
            $user = Auth::user();
    
            // Redirect berdasarkan role
            if ($user->role == 'admin') {
                return redirect('dashboard');
            } elseif ($user->role == 'seller') {
                return redirect('dashboard');
            } elseif ($user->role == 'client') {
                return redirect('/');
            }
        }
    
        return back()->with('error', 'Email, Password, atau Role tidak sesuai!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Session::flash('success', 'Logout berhasil! Sampai Jumpa Kembali.');
        return redirect('/login')->with('success', 'Logout berhasil! Sampai Jumpa Kembali.'); // Redirect to login page after logout
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'name' => 'required|unique:users|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'phone' => 'max:255',
            'address' => 'required',
        ]);

        // Hash the password before storing it
        $request['password'] = Hash::make($request->password);

        // Add default role_id
        // $request['role'] = 3;

        // Create the user with the provided data
        $user = User::create($request->all());

        // Flash success message to the session
        // Session::flash('status', 'success');
        // Session::flash('success', 'Register Berhasil.');

        // Redirect to the register page
        return redirect('login')->with('success', 'Register Berhasil.');
    }
}