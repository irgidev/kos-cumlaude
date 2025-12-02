<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Staf;
use App\Models\Penghuni;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required|in:staf,penghuni'
        ]);

        if ($request->role == 'staf') {
            $user = Staf::where('nama_staf', $request->username)->first();
            if ($user && $user->no_telepon_staf == $request->password) {
                Auth::guard('web')->login($user);
                return redirect()->route('dashboard');
            }
        } else {
            $user = Penghuni::where('nama_penghuni', $request->username)->first();
            if ($user && $user->no_telepon_penghuni == $request->password) {
                Auth::guard('penghuni')->login($user);
                return redirect()->route('dashboard.penghuni');
            }
        }

        return back()->withErrors(['username' => 'Login gagal! Cek nama, password, atau peran Anda.']);
    }

    public function logout()
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        } elseif(Auth::guard('penghuni')->check()) {
            Auth::guard('penghuni')->logout();
        }
        return redirect()->route('login');
    }
}