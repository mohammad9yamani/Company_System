<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OTPService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OTPController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $phone = $request->input('phone');
        $identifier = $phone;

        $this->otpService->sendOTP($phone, $identifier);

        return response()->json(['message' => 'OTP sent successfully.']);
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $phone = $request->input('phone');
        $userInputOTP = $request->input('otp');

        if ($this->otpService->verifyOTP($phone, $userInputOTP)) {
            return response()->json(['message' => 'OTP verified successfully.']);
        }

        return response()->json(['error' => 'Invalid OTP'], 422);
    }
}
