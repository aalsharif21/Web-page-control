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
        echo "Direction '$direction' inserted successfully";
    } else {
        echo "Error inserting direction '$direction': " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} 

// Close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Robot Control Panel</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 10px;
            text-align: center;
            
            border-radius: 2px;
        }

        button {
            width: 100%;
            height: 100%;
            font-size: 20px;
            background-color:aquamarine;
            border-radius: 20px;
                        
        }
       
        button:hover{
            background-color: royalblue;
        }
        #stop {
            grid-column: 2 / 3;
            grid-row: 2 / 3;
            
        }

        #forward {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
        }

        #left {
            grid-column: 1 / 2;
            grid-row: 2 / 3;
        }

        #right {
            grid-column: 3 / 4;
            grid-row: 2 / 3;
        }

        #backward {
            grid-column: 2 / 3;
            grid-row: 3 / 4;
        }

    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="control.php">
            <div class="controls">
                <button name="direction" value="L" id="left">Left</button>
                <button name="direction" value="F" id="forward">Forward</button>
                <button name="direction" value="R" id="right">Right</button>
                <button name="direction" value="S" id="stop">Stop</button>
                <button name="direction" value="B" id="backward">Backward</button>
            </div>
        </form>
    </div>
</body>
</html>
