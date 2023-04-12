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
    <title>Search Form</title>
</head>

<body bgcolor="FBB917">
<?php
// Retrieve the list of table names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);

?>
    <h1>Search</h1>
    <form action='search.php' method="POST">
        <label for="table">Select a table:</label>
        <select name="table" id="table" required>
            <?php foreach ($tables as $table) { ?>
                <option value="<?php echo $table['Tables_in_' . $database]; ?>"><?php echo $table['Tables_in_' . $database]; ?></option>
            <?php } ?>
        </select>
        <br><br>
        <input type='submit' name= 'tableSelect' id="tableSelect" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tableSelect"])) {
        // Retrieve the input data to display
        session_start();
        $_SESSION['POST'] = $_POST["table"]; // store post variable which is table in the session
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