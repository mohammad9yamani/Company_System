document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const otpSection = document.getElementById("otpSection");
    const otpForm = document.getElementById("otpForm");
    const notificationMessage = document.getElementById("notificationMessage");
    const notificationModal = new bootstrap.Modal(document.getElementById("notificationModal"));

    function showNotification(message) {
        notificationMessage.innerHTML = message;
        notificationModal.show();
    }

    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(loginForm);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(loginForm.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData,
                credentials: 'same-origin',
            })
            .then(response => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then(data => {
                if (data.otp_required) {

                    showNotification(data.message);
                    loginForm.style.display = "none";
                    otpSection.style.display = "block";
                } else if (data.success) {

                    setTimeout(() => {
                        window.location.href = data.redirect || "/main";
                    }, 2000);
                }
            })
            .catch(error => {
                if (error instanceof Response) {
                    error.json().then(err => {
                        let errors = Object.values(err.errors || {}).flat();
                        showNotification("Login failed:<br>" + errors.join("<br>"));
                    }).catch(() => {
                        showNotification("An error occurred. Please try again.");
                    });
                } else {
                    console.error("Error:", error);
                    showNotification("A network error occurred. Please check your connection and try again.");
                }
            });
        });
    }

    if (otpForm) {
        otpForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const otpData = new FormData(otpForm);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/verify-otp-login', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: otpData,
                credentials: 'same-origin',
            })
            .then(response => {
                if (!response.ok) throw response;
                return response.json();
            })
            .then(data => {
                if (data.success) {

                    showNotification("OTP verified successfully.");
                    setTimeout(() => {
                        window.location.href = data.redirect || "/main";
                    }, 2000);
                }
            })
            .catch(error => {
                if (error instanceof Response) {
                    error.json().then(err => {
                        let errors = Object.values(err.errors || {}).flat();
                        showNotification("OTP verification failed:<br>" + errors.join("<br>"));
                    }).catch(() => {
                        showNotification("An error occurred. Please try again.");
                    });
                } else {
                    console.error("Error:", error);
                    showNotification("A network error occurred. Please check your connection and try again.");
                }
            });
        });
    }  
});
