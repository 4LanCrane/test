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



//get the input from the user
$username = $_POST['userName'];
$password = $_POST['password'];
$dob = $_POST['dob'];


//validate the input and make safe from sql injection
$usernameSafe = mysqli_real_escape_string($conn, $username);
$passwordSafe = mysqli_real_escape_string($conn, $password);
$dobSafe = mysqli_real_escape_string($conn, $dob);

//check if the user already exists and password is correct
$sql = "SELECT * FROM users WHERE username = '$usernameSafe' AND password = '$passwordSafe'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "User already exists";
    exit();
}
$sql = "INSERT INTO users (username, password, dob) VALUES ('$usernameSafe', '$passwordSafe', '$dobSafe')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "
";
echo "Username: $username";
echo "
";
echo "Password: $password";
echo "";
echo "Date of Birth: $dob";



?>