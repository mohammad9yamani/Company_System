<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginDashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $inputs = $request->only('email', 'password');
        $admin = admin::where('email', $inputs['email'])->first();

        if ($admin && $admin->validatePassword($inputs['password'])) {
            Auth::guard('admin')->login($admin);
            return redirect()->intended('/admin/dashboard'); // Redirect after login
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return  response()->json(['success'=>'logout ']);
    }
}
