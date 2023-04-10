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
    // Retrieve the input data to display

}

?>

<h2>Add Table</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return2' id="return2" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return2"])) {
        header("Location: add.php");
        exit;
    // Retrieve the input data to display

}
?>
<h2>Update Table</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return3' id="return3" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return3"])) {
        header("Location: update.php");
        exit;
    // Retrieve the input data to display

}
?>
<h2>Delete Entry</h2>
    <form action='home.php' method="POST">
        <input type='submit' name= 'return4' id="return4" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return4"])) {
        header("Location: delete.php");
        exit;
    // Retrieve the input data to display

}

?>
</body>
</html>
