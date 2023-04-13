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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Database</title>
</head>

<body bgcolor="FBB917">
<?php
// List of Table Names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>Generate End User Codes</h1>
<form action='endcodes.php' method="POST">
    <input type='submit' name= 'freport' id="freport" value="Generate Codes" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {
    echo "<h2>End User Codes</h2><br>";
    echo "<b>CEO: 69</b><br>";
    echo "<b>Train Engineer: 420</b><br>";
    echo "<b>Safety inspector: 500</b><br>";
    echo "<b>Supervisor: 555</b><br>";
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
