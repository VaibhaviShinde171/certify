<?php
// Database connection details
$host = "localhost"; // usually "localhost"
$user = "root";
$password = "";
$database = "PROJECT_DB";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $university_name = $conn->real_escape_string($_POST['university_name']);
    $university_id = $conn->real_escape_string($_POST['university_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to insert data into table
    $sql = "INSERT INTO users (university_name, university_id, username, password)
            VALUES ('$university_name', '$university_id', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
