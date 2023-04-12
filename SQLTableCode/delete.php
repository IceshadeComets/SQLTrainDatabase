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
            session_start();
            // Retrieve the list of tables from the database
            $result = mysqli_query($mysqli, "SHOW TABLES");
            while ($row = mysqli_fetch_row($result)) {
                $table_name = $row[0];
                // CEO Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'CEO'");
                if($resultx->num_rows >= 1){
                    if ($table_name == "users") {
                        continue;
                    }
                }
                // Supervisor Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'Supervisor'");
                if($resultx->num_rows >= 1){
                    if ($table_name == "builds" || $table_name == "ceo" || $table_name == "frieghtcars" ||
                    $table_name == "locomotives" || $table_name == "parts" || $table_name == "repairservice" ||
                    $table_name == "safetyinspector" || $table_name == "train" || $table_name == "transitcars" ||
                    $table_name == "users") {
                    // Skip the excluded table names
                    continue;
                }
                }
                // Train Engineer Checkk
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'TrainEngineer'");
                if($resultx->num_rows >= 1){
                if ($table_name == "ceo" || $table_name == "employee" || $table_name == "freightcarworker" ||
                    $table_name == "locomotiveworker" || $table_name == "safetyinspector" || $table_name == "trainengineer" ||
                    $table_name == "transitworker" || $table_name == "users") {
                    // Skip the excluded table names
                    continue;
                }
                }
                // Safety Inspector Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'SafetyInspector'");
                if($resultx->num_rows >= 1){
                if ($table_name == "builds" || $table_name == "ceo" || $table_name == "employee" || 
                    $table_name == "frieghtcars" || $table_name == "freightcarworker" || $table_name == "locomotives" || 
                    $table_name == "locomotiveworker" || $table_name == "parts" || $table_name == "repairservice" || 
                    $table_name == "safetyinspector" || $table_name == "trainengineer" || $table_name == "transitcars" || 
                    $table_name == "transitworker" || $table_name == "users") {
                    // Skip the excluded table names
                    continue;
                }
                }
                // Employee Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'Employee'");
                if($resultx->num_rows >= 1){
                    if ($table_name == "builds" || $table_name == "ceo" || $table_name == "employee" || 
                    $table_name == "frieghtcars" || $table_name == "freightcarworker" || $table_name == "locomotives" || 
                    $table_name == "locomotiveworker" || $table_name == "parts" || $table_name == "repairservice" || 
                    $table_name == "safetyinspector" || $table_name == "train" || $table_name == "trainengineer" || 
                    $table_name == "transitcars" || $table_name == "transitworker" || $table_name == "users") {
                    // Skip the excluded table names
                    continue;
                }
                }



                // Check if the current table is "users" and skip it if it is
                // Output each table as an option in the dropdown menu
                echo "<option value='$table_name'>$table_name</option>";
            }
            session_abort();
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