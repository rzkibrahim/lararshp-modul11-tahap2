<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle login attempt
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        
        // Cari user di tabel custom 'user'
        $user = DB::table('user')
            ->where('email', $credentials['email'])
            ->first();

        if (!$user) {
            return false;
        }

        // Check password
        if (!Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        // Login user
        Auth::loginUsingId($user->iduser);
        
        // Set session data setelah login berhasil
        $this->setUserSession($user);
        
        return true;
    }

    /**
     * Set session data setelah login berhasil
     */
    protected function setUserSession($user)
    {
        // Ambil role user
        $roleUser = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.iduser', $user->iduser)
            ->where('role_user.status', 1)
            ->first();

        if ($roleUser) {
            session([
                'user_id' => $user->iduser,
                'user_name' => $user->nama,
                'user_email' => $user->email,
                'user_role' => $roleUser->idrole,
                'user_role_name' => $roleUser->nama_role,
            ]);
        }
    }

    /**
     * Redirect setelah login berhasil
     */
    protected function redirectTo()
    {
        $role = session('user_role');
        
        switch ($role) {
            case 1: return '/admin/dashboard';
            case 2: return '/dokter/dashboard';
            case 3: return '/perawat/dashboard';
            case 4: return '/resepsionis/dashboard';
            case 5: return '/pemilik/dashboard';
            default: return '/';
        }
    }

    public function username()
    {
        return 'email';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}