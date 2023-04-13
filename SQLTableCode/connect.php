<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php
//Variables to connect to the database
$host = "localhost";
$username ="root";
$password = "";
$database = "471project";

// Create a database instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Create Account
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {

    // Retrieve Input Data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $adminc = $_POST["acode"];
    // Codes for End User Types
    // 69 CEO
    // 420 Train Engineer
    // 500 Safety Inspector
    // 555 Supervisor
    // Else Employee

    // CEO Code
    if($adminc == 69){
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "CEO";
    $stmt->bind_param("ssss", $name, $email, $password, $user_type);
    $stmt->execute();
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }
    $stmt->close();
    $mysqli->close();
    // Train Engineer Code
    } else if($adminc == 420){
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "TrainEngineer"; 
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); 
    $stmt->execute();
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }
    $stmt->close();
    $mysqli->close();
    // Safety Inspector Code
    } else if($adminc == 500){
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "SafetyInspector";
    $stmt->bind_param("ssss", $name, $email, $password, $user_type);
    $stmt->execute();
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }
    $stmt->close();
    $mysqli->close();   
    // Supervisor Code
    } else if($adminc == 555){
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "Supervisor";
    $stmt->bind_param("ssss", $name, $email, $password, $user_type);
    $stmt->execute();
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }
    $stmt->close();
    $mysqli->close();
    // General Employee, Else
    } else {
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "Employee";
    $stmt->bind_param("ssss", $name, $email, $password, $user_type);
    $stmt->execute();
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }
    $stmt->close();
    $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login or Create Account</title>
    <style>
        h1, h2, form {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Create account form -->
    <h1>User Login</h1>
    <h2>Create Account</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name"><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br>

        <label>Admin Code</label><br>
        <input type="text" name="acode"><br>

        <input type="submit" name="create" value="Create Account">
    </form>

    <h1>Return</h1>
    <form action='connect.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: index.php");
        exit;
    }
         ?>