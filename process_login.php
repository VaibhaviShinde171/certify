<?php
// Database connection details
$host = "localhost";
$user = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is usually empty
$database = "PROJECT_DB"; // Name of your database

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to check if the username and password match
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Username and password match
        // Start session and store username
        session_start();
        $_SESSION['username'] = $username;
        
        // Redirect to data.html or any other page
        header("Location: data_cet.html");
        exit();
    } else {
        // Username and password do not match
        // Redirect back to login page with error message
        header("Location: login.html?error=1");
        exit();
    }
}

// Close connection
$conn->close();
?>
