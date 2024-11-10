<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Log::info('start...');

        $validator = Validator::make($request->all(), [
            'company_national_id' => 'required|string|unique:companies',
            'name' => 'required|string|unique:companies',
            'email' => 'required|email|unique:companies',
            'phone' => 'required|string|unique:companies',
            'password' => 'required|string|min:8|confirmed',
        ]);


        


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('email: ');
        // Create a new company record
        $company = Company::create([
            'company_national_id' => $request->company_national_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'phone_code' => 0000,
            'address' => 'empty',
        ]);


        return response()->json(['message' => 'Registration successful. Please log in.'], 201);

    }
}
