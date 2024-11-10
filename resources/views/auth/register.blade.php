@extends('layouts.main')

@section('content')
<div class="container">
    <div class="registration-container">
        <h3 class="text-center">Register</h3>

        <!-- User Details Section -->
        <div id="userDetailsSection">
            <div class="form-group">
                <label for="companyNationalId">Company National ID</label>
                <input type="text" class="form-control" id="companyNationalId" placeholder="Enter Company National ID" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Company Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Phone Number" required>
            </div>
            <button class="btn btn-primary" onclick="sendOTP()">Send OTP</button>
        </div>

        <!-- OTP Verification Section -->
        <div id="otpSection">
            <div class="form-group">
                <label for="otp">OTP</label>
                <input type="text" class="form-control" id="otp" placeholder="Enter OTP" required>
            </div>
            <button class="btn btn-primary" onclick="verifyOTP()">Verify OTP</button>
        </div>

        <!-- Password Section -->
        <div id="passwordSection">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <button class="btn btn-primary" onclick="registerUser()">Complete Registration</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/auth.js') }}"></script>
@endsection
