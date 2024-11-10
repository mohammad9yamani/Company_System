
    function nextStep(stepNumber) {
        document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
        document.getElementById(`step${stepNumber}`).style.display = 'block';
    }

    function previousStep(stepNumber) {
        document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
        document.getElementById(`step${stepNumber}`).style.display = 'block';
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
        const phone = document.getElementById(`${type}Data`).getAttribute('data-phone');
        fetch('/send-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ phone })
        })
        .then(response => response.json())
        .then(() => alert('OTP sent successfully'))
        .catch(error => console.error(error));
    }

    function verifyOTP(type) {
        const otpInput = document.getElementById(`${type}OtpInput`).value;
        const phone = document.getElementById(`${type}Data`).getAttribute('data-phone');

        fetch('/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ phone, otp: otpInput })
        })
        .then(response => response.json())
        .then(() => {
            document.getElementById(`${type}OtpSection`).style.display = 'none';
            document.getElementById(`${type}Verified`).style.display = 'block';

            if (document.getElementById('buyerVerified').style.display === 'block' && 
                document.getElementById('sellerVerified').style.display === 'block') {
                document.getElementById('nextToContract').disabled = false;
            }
        })
        .catch(error => console.error(error));
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