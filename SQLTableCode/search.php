<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php
// Variables to connect to the database
$host = "localhost";
$username = "root";
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
    <title>Train Database</title>
</head>

<body bgcolor="FBB917">
<?php
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);

?>
    <h1>Search</h1>
    <form action='search.php' method="POST">
        <label for="table"><b>Select a table:</b></label>
        <select name="table" id="table" required>
        <?php
            session_start();
            $result = mysqli_query($mysqli, "SHOW TABLES");
            while ($row = mysqli_fetch_row($result)) {
                $table_name = $row[0];
                // CEO Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'CEO'");
                if($resultx->num_rows >= 1){
                }
                // Supervisor Check
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'Supervisor'");
                if($resultx->num_rows >= 1){
                    if ($table_name == "builds" || $table_name == "ceo" || $table_name == "frieghtcars" ||
                    $table_name == "locomotives" || $table_name == "parts" || $table_name == "repairservice" ||
                    $table_name == "safetyinspector" || $table_name == "train" || $table_name == "transitcars" ||
                    $table_name == "users") {
                    continue;
                }
                }
                // Train Engineer Checkk
                $resultx = mysqli_query($mysqli, "SELECT UserType FROM users WHERE email = '{$_SESSION['email']}' AND UserType = 'TrainEngineer'");
                if($resultx->num_rows >= 1){
                if ($table_name == "ceo" || $table_name == "employee" || $table_name == "freightcarworker" ||
                    $table_name == "locomotiveworker" || $table_name == "safetyinspector" || $table_name == "trainengineer" ||
                    $table_name == "transitworker" || $table_name == "users") {
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
                    continue;
                }
                }
                echo "<option value='$table_name'>$table_name</option>";
            }
            session_abort();
            ?>
        </select>
        <br><br>
        <input type='submit' name= 'tableSelect' id="tableSelect" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tableSelect"])) {
        session_start();
        $_SESSION['POST'] = $_POST["table"];
        header("Location: select_pk.php");
        exit;
    }
    ?>
    <h1>Return</h1>
    <form action='search.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: home.php");
        exit;
    }
    ?>
</body>

</html>