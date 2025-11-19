<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
{
    if (auth()->check()) {
        return redirect()->route('admin.dashboard.index'); // Redirect to the 'home' route if already logged in
    }

    return view('auth.admin.login'); // Otherwise, show the login form
}


    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login dengan kredensial yang diberikan
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();

            // Setelah login berhasil, redirect ke dashboard admin
            return redirect()->route('admin.dashboard.index');
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login'); // Redirect to the 'home' route if already logged in
   
    }


}
