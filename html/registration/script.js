function validateForm() {
    // Clear previous error messages
    document.getElementById("errorMessages").innerHTML = "";
  
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let errorMessages = [];
  
    // Validate username
    if (username.trim() === "") {
      errorMessages.push("Username is required.");
    }
  
    // Validate email
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailRegex)) {
      errorMessages.push("Please enter a valid email address.");
    }
  
    // Validate password
    if (password.length < 6) {
      errorMessages.push("Password must be at least 6 characters long.");
    }
  
    // Validate confirm password
    if (password !== confirmPassword) {
      errorMessages.push("Passwords do not match.");
    }
  
    // Display error messages if any
    if (errorMessages.length > 0) {
      document.getElementById("errorMessages").innerHTML = errorMessages.join("<br>");
      return false; // Prevent form submission
    }
  
    return true; // Allow form submission
  }
  