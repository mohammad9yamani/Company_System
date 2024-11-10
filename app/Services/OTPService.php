<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class OTPService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('twilio.sid'), config('twilio.auth_token'));
    }

    public function generateOTP($identifier)
    {
        $otpCode = rand(1000, 9999);
        Cache::put('otp_' . $identifier, $otpCode, now()->addMinutes(5)); // Store OTP for 5 minutes

        return $otpCode;
    }

    public function sendOTP($phoneNumber, $identifier)
    {
        $otpCode = $this->generateOTP($identifier);
        Log::info($otpCode);


        $this->twilio->messages->create(
            $phoneNumber,
            [
                'from' => config('twilio.phone_number'),
                'body' => "Your OTP code is $otpCode"
            ]
        );

        return $otpCode;
    }

    public function verifyOTP($identifier, $userInputCode)
    {
        $cachedOTP = Cache::get('otp_' . $identifier);

        Log::info($cachedOTP);
        Log::info($userInputCode);

        if ($cachedOTP && $cachedOTP == $userInputCode) {
            Cache::forget('otp_' . $identifier);
            return true;
        }

        return false;
    }


       // Sends OTP to an email address
       public function sendOTPToEmail($email, $identifier)
       {
           $otpCode = $this->generateOTP($identifier);
           Log::info($otpCode);

   
           Mail::raw("Your OTP code is $otpCode", function ($message) use ($email) {
               $message->to($email)
                       ->subject('Email Verification Code');
           });
   
           return $otpCode;
       }
}
