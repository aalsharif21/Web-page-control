<?php
// Define database connection details
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "robot"; // database name
// database table name is robot_retrev

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the direction value from the form
    $direction = $_POST["direction"];

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO robot_retrev (direction) VALUES (?)");
    $stmt->bind_param("s", $direction);
    $stmt->execute();

    // Check if row was inserted successfully
    if ($stmt->affected_rows > 0) {
        $last_id = mysqli_insert_id($conn); // Get the ID of the last inserted row
        echo "Direction '$direction' inserted successfully with ID '$last_id'";
    } else {
        echo "Error inserting direction '$direction': " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Form not submitted";
}

// Close database connection
mysqli_close($conn);
?>
