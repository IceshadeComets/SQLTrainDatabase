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
?>

<h1>Train Database</h1>

<?php
    // User Login and Check if they are logged in
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit;
    }
    echo "<h3>Session username: " . $_SESSION['username'] . "</h3>   ";
?>
<form action='home.php' method="POST">
        <input type='submit' name= 'return0' id="return0" value="logout" required/> 
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return0"])) {
        session_abort();
        header("Location: index.php");
        exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Database System</title>
</head>

<body bgcolor="FFFFFF">
<h2>Information Lookup</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: search.php");
        exit;
}

?>

<h2>Add Table</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return2' id="return2" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return2"])) {
        header("Location: add.php");
        exit;
}
?>

<h2>Delete Entry</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return4' id="return4" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return4"])) {
        header("Location: delete.php");
        exit;
}

?>
    <h2>View Client Information</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return13' id="return13" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return13"])) {
        header("Location: searchclient.php");
        exit;
}
?>

<?php
    // Check for Supervisor
    $result = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND (UserType = 'CEO' OR UserType = 'Supervisor')");
    if($result->num_rows >= 1){
?>
    <h2>View Employee Information</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return12' id="return12" required/> <br> <br>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return12"])) {
        header("Location: searchemp.php");
        exit;
}
?>
<?php
    }
?>

<?php
    // Check for Train Engineer
    $result = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'TrainEngineer'");
    if($result->num_rows >= 1){
?>
    <h2>View Train Information</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return14' id="return14" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return14"])) {
        header("Location: searchtrain.php");
        exit;
}
?>
<?php
    }
?>

<?php
    // Check for CEO
    $result = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'CEO'");
    if($result->num_rows >= 1){
?>
    <h2>View Train Information</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return14' id="return14" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return5"])) {
        header("Location: generatereportfin.php");
        exit;
}
?>
<?php
    }
?>

<?php
    // Check for CEO
    $result = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'CEO'");
    if($result->num_rows >= 1){
?>
    <h2>Generate Financial Report</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return5' id="return5" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return5"])) {
        header("Location: generatereportfin.php");
        exit;
}
?>
<?php
    }
?>

<?php
    // Check for CEO
    $result = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'CEO'");
    if($result->num_rows >= 1){
?>
    <h2>Generate End User Codes</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return99' id="return99" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return99"])) {
        header("Location: endcodes.php");
        exit;
}
?>
<?php
    }
?>

<?php
?>
    <h2>Generate Inspection Report</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return6' id="return6" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return6"])) {
        header("Location: generatereportinsp.php");
        exit;
}
?>
<?php
?>

<?php
?>
    <h2>Generate Repair/Service Report</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return7' id="return7" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return7"])) {
        header("Location: generatereportteng.php");
        exit;
    // Retrieve the input data to display
}
?>
<?php
?>

</body>
</html>
