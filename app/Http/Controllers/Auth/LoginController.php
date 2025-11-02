<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Pakai 'roles' untuk login (lebih efisien)
        $user = User::with(['roles' => function ($query) {
            $query->where('role_user.status', 1);
        }])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput();
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        if ($user->roles->isEmpty()) {
            return redirect()->back()
                ->withErrors(['email' => 'Akun tidak memiliki akses aktif'])
                ->withInput();
        }

        $activeRole = $user->roles->first();
        $userRole = $activeRole->idrole;
        $namaRole = $activeRole->nama_role;

        Auth::login($user);

        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $userRole,
            'user_role_name' => $namaRole,
            'user_status' => $activeRole->pivot->status ?? 'active'
        ]);

        switch ($userRole) {
            case 1:
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case 4:
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case 5:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}