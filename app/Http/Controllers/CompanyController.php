<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OTPService;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use App\Models\TransferOfOwnershipDocs;


class CompanyController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }


    public function showDashboard()
    {
        $company = Auth::user();

        $transfers = TransferOfOwnershipDocs::where('company_id', $company->id)->get();

        return view('company_dashboard', compact('company', 'transfers'));
    }


    public function sendEmailVerificationOTP(Request $request)
    {
        $company = Auth::user();
        $this->otpService->sendOTPToEmail($company->email, $company->id);

        return response()->json(['success' => true, 'message' => 'OTP sent to your email.']);
    }


    public function verifyEmailOTP(Request $request)
    {
       // $request->validate(['otp' => 'required|string']);

        $otp = $request->input('otp_value');
        log::info('test:'. $otp);

        $company = Auth::user();

        if ($this->otpService->verifyOTP($company->id, $otp)) {
            $company->email_verified_at = now();
            $company->save();

            return response()->json(['success' => true, 'message' => 'Email verified successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP provided.'], 422);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        $company = Auth::user();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->address = $request->input('address');
        $company->save();

        return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
    }
}
