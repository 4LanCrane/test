<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TESTING";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input from the user
    $usernameInput = $_POST['userName'];
    $passwordInput = $_POST['password'];
    $dobInput = $_POST['dob'];

    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $usernameInput, $passwordInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "welcome back! $usernameInput";
        exit();
    } else {
        echo "Invalid username or password";
        exit();
    }




}

// Close connection
$conn->close();
?>