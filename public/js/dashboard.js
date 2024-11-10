function logoutUser() {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  fetch('/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    credentials: 'same-origin'
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
    localStorage.removeItem('auth_token'); // Clear token from storage if used
    window.location.href = "/login"; // Redirect to login page
  })
  .catch(error => {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  });
}
