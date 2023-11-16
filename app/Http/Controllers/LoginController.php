<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('/login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi username
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            $error = 'Username tidak ditemukan.';
            return redirect()->back()->withErrors(['message' => $error]);
        }
// dd($credentials['password']);
        // Validasi password
        if ($credentials['password'] !== $user->password) {
            $error = 'Password salah.';
            return redirect()->back()->withErrors(['message' => $error]);
        }
        // Autentikasi berhasil
        Auth::login($user);
        toast('Login Berhasil', 'success');
        return redirect()->intended('/dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
