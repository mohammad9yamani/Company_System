

function editingName() 
{
    document.getElementById("editNameModal").style.display = "flex";  
}


function closeNameModal() {
    document.getElementById("editNameModal").style.display = "none";
}

//editing email 
function editingEmail() 
{
    document.getElementById("editEmailModal").style.display = "flex";  
}


function closeEmailModal() {
    document.getElementById("editEmailModal").style.display = "none";
}



function saveNameChange() {
    // Get the value of the new name from the input field
    const newName = document.getElementById("newName").value;

    // Ensure the new name is not empty
    if (!newName.trim()) {
        alert("Name cannot be empty.");
        return;
    }

    // Fetch the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
console.log(newName);
    fetch('/admin/profile/updateName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ newName: newName })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Name updated successfully.");
            window.location.href = '/admin/dashboard';

            
        } else {
            alert("Failed to update name.");

        }
    })
    .catch(error => {
        console.error("Error updating name:", error);
        alert("An error occurred while updating the name.");
    });
}


//save change Email
function saveEmailChange() {
    const newEmail = document.getElementById("newEmail").value;

    if (!newEmail.trim()) {
        alert("email cannot be empty.");
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
console.log(newName);
    fetch('/admin/profile/updateEmail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ newEmail: newEmail })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("email updated successfully.");
            window.location.href = '/admin/dashboard';

            
        } else {
            alert("Failed to update name.");

        }
    })
    .catch(error => {
        console.error("Error updating name:", error);
        alert("An error occurred while updating the name.");
    });
}

// change password 
function savePasswordBtn(){
    const old_password  = document.getElementById('old_password').value;
    const confirm_password  = document.getElementById('confirm_password').value;
    const new_password = document.getElementById('new_password').value;
    console.log(old_password);


    fetch('/admin/profile/change-password/updatepassword', {
        method: 'POST',
        headers: {
           
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json', 
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            old_password: old_password,
            new_password: new_password,
            confirm_password: confirm_password
        })
    })
    .then(response => {

        if (!response.ok) {
            return response.json().then(err => { throw err });
        }
        return response.json();
  
    })
    .then(data => {
        if (data.success) {
            alert('Password changed successfully');
            document.getElementById('change-password-model').style.display = 'none';
            document.getElementById('old_password').value='';
            document.getElementById('confirm_password').value='';
            document.getElementById('new_password').value='';

        } else {
            alert(data.error || 'Failed to change password');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
    });
    
}
function showChangePasswordModel(){
    document.getElementById('change-password-model').style.display = 'flex';
}

function closeChangePasswordModel(){
    document.getElementById('change-password-model').style.display = 'none';
}
function logout(){

   if (confirm('Are you sure you want to log out?')) {
        fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            window.location.href = '/login'; // Redirect to home or login page
        })
        .catch(error => console.error('Logout failed:', error));
    }
    
}



