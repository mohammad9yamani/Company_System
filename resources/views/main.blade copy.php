@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Transfer of Ownership</h2>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="steps">
            <span class="circle active">1</span>
            <span class="circle">2</span>
            <span class="circle">3</span>
            <span class="circle">4</span>
            <div class="progress-bar">
                <span class="indicator"></span>
            </div>
        </div>
    </div>

    <!-- Step 1: Input Form for Buyer, Seller, Vehicle, and Cost -->
    <div id="step1" class="step active-step">
        <form id="transferForm" class="registration-container card p-4 shadow-sm">
            @csrf
            <div class="form-group mb-3">
                <label for="buyer_national_id">Buyer National ID</label>
                <input type="text" id="buyer_national_id" name="buyer_national_id" class="form-control" placeholder="Enter Buyer National ID" required>
            </div>
            <div class="form-group mb-3">
                <label for="seller_national_id">Seller National ID</label>
                <input type="text" id="seller_national_id" name="seller_national_id" class="form-control" placeholder="Enter Seller National ID" required>
            </div>
            <div class="form-group mb-3">
                <label for="vehicles_num">Vehicle Number</label>
                <input type="text" id="vehicles_num" name="vehicles_num" class="form-control" placeholder="Enter Vehicle Number" required>
            </div>
            <div class="form-group mb-3">
                <label for="vehicle_cost">Cost of Vehicle</label>
                <input type="text" id="vehicle_cost" name="vehicle_cost" class="form-control" placeholder="Enter Vehicle Cost" required>
            </div>
            <button type="button" class="btn btn-primary btn-lg mt-3" onclick="fetchData()" id="confirmNextButton" disabled>Confirm and Next</button>
        </form>
    </div>

    <!-- Step 2: OTP Verification for Buyer and Seller -->
    <div id="step2" class="step" style="display: none;">
        <div class="card p-4 shadow-sm">
            <h3 class="text-center mb-4">OTP Verification</h3>
            <div class="row">
                <!-- Buyer Section -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Buyer Verification</h5>
                            <p id="buyerData" class="card-text"></p>
                            <div id="buyerOtpSection" class="otp-section">
                                <button class="btn btn-primary otp-button" onclick="sendOTP('buyer')">Send OTP</button>
                                <div id="buyerVerifySection" style="display: none;">
                                    <input type="text" id="buyerOtpInput" class="form-control otp-input mb-2" placeholder="Enter Buyer OTP">
                                    <button class="btn btn-secondary otp-button" onclick="verifyOTP('buyer')">Verify Buyer OTP</button>
                                </div>
                                <div id="buyerVerified" class="text-success" style="display:none;">
                                    <i class="bi bi-check-circle"></i> Buyer Verified
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Seller Section -->
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Seller Verification</h5>
                            <p id="sellerData" class="card-text"></p>
                            <div id="sellerOtpSection" class="otp-section">
                                <button class="btn btn-primary otp-button" onclick="sendOTP('seller')">Send OTP</button>
                                <div id="sellerVerifySection" style="display: none;">
                                    <input type="text" id="sellerOtpInput" class="form-control otp-input mb-2" placeholder="Enter Seller OTP">
                                    <button class="btn btn-secondary otp-button" onclick="verifyOTP('seller')">Verify Seller OTP</button>
                                </div>
                                <div id="sellerVerified" class="text-success" style="display:none;">
                                    <i class="bi bi-check-circle"></i> Seller Verified
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-secondary btn-lg mt-3 step-button" onclick="previousStep(1)">Previous</button>
                <button type="button" class="btn btn-success btn-lg mt-3 step-button" onclick="nextStep(3)" id="nextToContract">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 3: Contract Viewing and Printing -->
    <div id="step3" class="step" style="display: none;">
        <div class="card p-4 shadow-sm text-center">
            <h3 class="mb-4">Contract Document</h3>
            <button class="btn btn-warning btn-lg step-button" onclick="printContract()">View & Print Contract</button>
            <div class="button-group mt-4">
                <button type="button" class="btn btn-secondary btn-lg step-button" onclick="previousStep(2)">Previous</button>
                <button type="button" class="btn btn-success btn-lg step-button" onclick="nextStep(4)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 4: Document Upload -->
    <div id="step4" class="step" style="display: none;">
        <div class="card p-4 shadow-sm text-center">
            <h3 class="mb-4">Upload Contract Document</h3>
            <input type="file" id="contractFile" class="form-control-file mb-3">
            <div class="button-group">
                <button type="button" class="btn btn-secondary btn-lg step-button" onclick="previousStep(3)">Previous</button>
                <button class="btn btn-success btn-lg step-button" onclick="completeTransfer()">Done</button>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    .steps {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
        position: relative;
        max-width: 600px;
    }
    .circle {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        width: 40px;
        color: #999;
        font-size: 18px;
        font-weight: 500;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #e0e0e0;
    }
    .circle.active {
        border-color: #4070f4;
        color: #4070f4;
    }
    .progress-bar {
        position: absolute;
        height: 4px;
        width: 100%;
        background: #e0e0e0;
        z-index: -1;
    }
    .indicator {
        position: absolute;
        height: 100%;
        width: 0%;
        background: #4070f4;
        transition: all 300ms ease;
    }
    .otp-section {
        max-width: 300px;
        margin: auto;
    }
    .otp-input {
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }
    .otp-button {
        padding: 10px;
        font-size: 16px;
        width: 100%;
    }
    .btn-lg {
        padding: 10px 20px;
        font-size: 18px;
    }
    .button-group {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    .step-button {
        width: 150px;
    }


    #step3 .btn-warning {
        width: 200px;
        margin: 0 auto;
    }

    #step4 .btn-success, #step4 .btn-secondary {
        width: 150px;
        margin: 0 10px;
    }
</style>


<script>
    let currentStep = 1;
    const circles = document.querySelectorAll(".circle");
    const progressBar = document.querySelector(".indicator");

    // Function to handle field validation
    function validateFields() {
        const buyerId = document.getElementById("buyer_national_id").value.trim();
        const sellerId = document.getElementById("seller_national_id").value.trim();
        const vehicleNum = document.getElementById("vehicles_num").value.trim();
        const vehicleCost = document.getElementById("vehicle_cost").value.trim();
        
        document.getElementById("confirmNextButton").disabled = !(buyerId && sellerId && vehicleNum && vehicleCost);
    }

    document.getElementById("buyer_national_id").addEventListener("input", validateFields);
    document.getElementById("seller_national_id").addEventListener("input", validateFields);
    document.getElementById("vehicles_num").addEventListener("input", validateFields);
    document.getElementById("vehicle_cost").addEventListener("input", validateFields);

    function nextStep(stepNumber) {
        document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
        document.getElementById(`step${stepNumber}`).style.display = 'block';
        updateProgressBar(stepNumber);
    }

    function previousStep(stepNumber) {
        document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
        document.getElementById(`step${stepNumber}`).style.display = 'block';
        updateProgressBar(stepNumber);
    }

    function updateProgressBar(step) {
        currentStep = step;
        circles.forEach((circle, index) => {
            circle.classList[index < step ? "add" : "remove"]("active");
        });
        progressBar.style.width = `${((step - 1) / (circles.length - 1)) * 100}%`;
    }

    function fetchData() {
        const formData = new FormData(document.getElementById('transferForm'));

        fetch('/fetch-data', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('buyerData').innerHTML = `Name: ${data.buyerData.name}, Phone: ${data.buyerData.phone}`;
            document.getElementById('sellerData').innerHTML = `Name: ${data.sellerData.name}, Phone: ${data.sellerData.phone}`;
            nextStep(2);
        })
        .catch(error => console.error(error));
    }

    function sendOTP(type) {
        fetch(`/send-otp?type=${type}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
        })
        .then(() => {
            document.getElementById(`${type}OtpSection`).querySelector('.otp-button').style.display = 'none';
            document.getElementById(`${type}VerifySection`).style.display = 'block';
        })
        .catch(error => console.error(error));
    }

    function verifyOTP(type) {
        const otpInput = document.getElementById(`${type}OtpInput`).value;
        fetch(`/verify-otp`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ type, otp: otpInput })
        })
        .then(response => response.json())
        .then(() => {
            document.getElementById(`${type}OtpInput`).disabled = true;
            document.getElementById(`${type}VerifySection`).style.display = 'none';
            document.getElementById(`${type}Verified`).style.display = 'block';
            checkVerificationCompletion();
        })
        .catch(error => console.error(error));
    }

    function checkVerificationCompletion() {
        if (document.getElementById('buyerVerified').style.display === 'block' && 
            document.getElementById('sellerVerified').style.display === 'block') {
            document.getElementById('nextToContract').disabled = false;
        }
    }

    function printContract() {
        window.open('/generate-contract-pdf', '_blank');
    }

    function completeTransfer() {
        const file = document.getElementById('contractFile').files[0];
        if (!file) {
            alert("Please upload a contract document.");
            return;
        }
        const formData = new FormData();
        formData.append('file', file);
        
        fetch('/complete-transfer', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            body: formData
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => console.error(error)); 
    }
</script>

@endsection
