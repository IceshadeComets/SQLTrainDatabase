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
    <title>Registration Form</title>
</head>

<body bgcolor="FBB917">
<h1>Delete Table</h1>
<form action='delete.php' method="POST">
    <label for="table">Select a table to delete:</label>
    <select name="table" id="table" required>
        <?php
        // Retrieve the list of tables from the database
        $result = mysqli_query($mysqli, "SHOW TABLES");
        while ($row = mysqli_fetch_row($result)) {
            // Output each table as an option in the dropdown menu
            echo "<option value='$row[0]'>$row[0]</option>";
        }
        ?>
    </select>
    <br><br>
    <input type='submit' name='clientdelete' id="clientdelete" value="Submit" required/>
</form>

<h1>Return</h1>
<form action='delete.php' method="POST">
    <input type='submit' name= 'return' id="return" value="Return" required/>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clientdelete"])) {
    // Retrieve the input data to display
    session_start();
    $_SESSION['POST'] = $_POST["table"]; // store post variable which is table in the session
    header("Location: delete_pk.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
    header("Location: home.php");
    exit;
}
?>

</body>
</html>