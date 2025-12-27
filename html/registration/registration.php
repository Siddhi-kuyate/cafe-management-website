<?php
// Enable error reporting (useful for debugging, disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection credentials
$host = 'localhost';
$username = 'users';
$password = '123456'; // Replace with your MySQL password if set
$database = 'demo';

// Create connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Fetch form data safely
    $name = trim(mysqli_real_escape_string($con, $_POST['name']));
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters!');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if email is already registered
        $check_query = "SELECT * FROM regi WHERE email = '$email'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Email is already registered! Please log in.');</script>";
        } else {
            // Securely hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into database
            $query = "INSERT INTO regi (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

            if (mysqli_query($con, $query)) {
                echo "<script>alert('Registration successful! Redirecting to login...');
                      window.location.href = 'login.php';</script>";
                exit();
            } else {
                echo "<script>alert('Database error: " . mysqli_error($con) . "');</script>";
            }
        }
    }
}

// Close the database connection
mysqli_close($con);
?>

<style>
    body {
        background: url('image/rl.jpg') no-repeat center center/cover;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .container-center {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .form-container h3 {
        text-align: center;
        color: #ffffff;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 16px;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .text-white {
        color: white !important;
    }

    a {
        color: #ffcc00;
        text-decoration: none;
    }

    a:hover {
        color: white;
        text-decoration: underline;
    }
</style>

<div class="container-center">
    <div class="form-container">
        <h3>Register</h3>
        <form action="" method="POST">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register" class="btn-primary">Register</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-white">Already have an account? <a href="login.php">Login</a></small>
        </div>
    </div>
</div>
