<?php
// Database connection details
$host = "localhost";
$user = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP is usually empty
$database = "PROJECT_DB"; // Update with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $university_name = $conn->real_escape_string($_POST['university_name']);
    $university_id = $conn->real_escape_string($_POST['university_id']);
    $student_name = $conn->real_escape_string($_POST['student_name']);
    $issue_date = $conn->real_escape_string($_POST['issue_date']);
    $course_name = $conn->real_escape_string($_POST['course_name']);

    // SQL query to insert data into a new table called "certificates"
    $sql = "INSERT INTO certificates (university_name, university_id, student_name, issue_date, course_name)
            VALUES ('$university_name', '$university_id', '$student_name', '$issue_date', '$course_name')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        // Redirect to certificate.html
        header("Location: certificate.html");
        exit(); // Make sure to exit after redirection
    } else {
        // Error inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
