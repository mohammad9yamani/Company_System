<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\OTPService;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);


        if (Auth::validate(['email' => $validated['email'], 'password' => $validated['password']])) {

            $user = Auth::getProvider()->retrieveByCredentials(['email' => $validated['email']]);


            $otp = $this->otpService->sendOTP($user->phone, $user->id);
            Session::put('otp', $otp);
            Session::put('otp_user_id', $user->id);

            return response()->json(['success' => true, 'otp_required' => true, 'message' => 'OTP sent to your phone.']);
        }


        return response()->json([
            'success' => false,
            'errors'  => ['email' => ['The provided credentials do not match our records.']],
        ], 422);
    }

    public function verifyOTP(Request $request)
    {

        $request->validate([
            'otp' => 'required|string',
        ]);

        $otp = $request->input('otp');
        $userId = Session::get('otp_user_id');


        if ($this->otpService->verifyOTP($userId, $otp)) {

            Auth::loginUsingId($userId);


            Session::forget('otp');
            Session::forget('otp_user_id');

            return response()->json(['success' => true, 'redirect' => '/main']);
        }


        return response()->json([
            'success' => false,
            'errors' => ['otp' => ['Invalid OTP provided.']],
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
