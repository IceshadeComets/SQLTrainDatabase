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

// If the login form has been submitted, process the input data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    // Retrieve the input data from the login form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists in the database
    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If a matching row is found, verify the password and set the session variable and redirect the user to the home page
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

// If the create account form has been submitted, process the input data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {

    // Retrieve the input data from the create account form
    // Retrieve the input data from the create account form
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

    if($adminc == 69){
    // Insert the input data into the database table
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "CEO"; // Define the user type variable
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); // Bind the user type variable to the prepared statement
    $stmt->execute();

    // Check for insertion errors
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
    } else if($adminc == 420){
    // Insert the input data into the database table
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "TrainEngineer"; // Define the user type variable
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); // Bind the user type variable to the prepared statement
    $stmt->execute();

    // Check for insertion errors
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
    } else if($adminc == 500){
    // Insert the input data into the database table
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "SafetyInspector"; // Define the user type variable
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); // Bind the user type variable to the prepared statement
    $stmt->execute();

    // Check for insertion errors
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();   
    } else if($adminc == 555){
    // Insert the input data into the database table
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "Supervisor"; // Define the user type variable
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); // Bind the user type variable to the prepared statement
    $stmt->execute();

    // Check for insertion errors
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
    } else {
    // Insert the input data into the database table
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, UserType) VALUES (?, ?, ?, ?)");
    $user_type = "Employee"; // Define the user type variable
    $stmt->bind_param("ssss", $name, $email, $password, $user_type); // Bind the user type variable to the prepared statement
    $stmt->execute();

    // Check for insertion errors
    if ($stmt->errno) {
        echo "Failed to create account: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        echo "Account created successfully!";
    }

    // Close the database connection
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
    // Retrieve the input data to display

    }


         ?>