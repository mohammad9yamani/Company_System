function showSection(sectionId) {
    document.getElementById("userDetailsSection").style.display = "none";
    document.getElementById("otpSection").style.display = "none";
    document.getElementById("passwordSection").style.display = "none";
    document.getElementById(sectionId).style.display = "block";
}

function sendOTP() {
    const phone = document.getElementById("phoneNumber").value;
    fetch('/api/send-otp', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ phone: phone })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            showSection('otpSection');
        } else {
            alert("Error sending OTP.");
        }
    });
}

function verifyOTP() {
    const phone = document.getElementById("phoneNumber").value;
    const otp = document.getElementById("otp").value;
    fetch('/api/verify-otp', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ phone: phone, otp: otp })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            showSection('passwordSection');
        } else {
            alert("Invalid OTP. Please try again.");
        }
    });
}

function registerUser() {
    const data = {
        company_national_id: document.getElementById("companyNationalId").value,
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        phone: document.getElementById("phoneNumber").value,
        password: document.getElementById("password").value,
        password_confirmation: document.getElementById("confirmPassword").value
    };

    fetch('/api/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            window.location.href = "/login";
        } else {
            alert("Error registering user. Please check your inputs.");
        }
    });
}
