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

    session_start();

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    // Input Data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if Email Exists
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If Matching Row, then send to Home
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($username, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username; // set session variable
            $_SESSION['email'] = $email;
            header("Location: home.php");
            exit;
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}

// Send to Create Form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    header("Location: connect.php");
    exit;
    $stmt->close();
    $mysqli->close();
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

    <h1>User Login</h1>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Email:</label><br>
        <input type="email" name="email"><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br>

        <input type="submit" name="login" value="Login">
    </form>
    <h2>Create Account</h2>
    <form method="POST" action="">
        <input type="submit" name="create" value="Create Account">
    </
