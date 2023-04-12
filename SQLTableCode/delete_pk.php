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

// Retrieve the selected table name from the session
session_start();
$table = $_SESSION['POST']; // store post variable which is table

// Retrieve the primary key column name for the selected table
$result = mysqli_query($mysqli, "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $primaryKeyColumn = $row["Column_name"];
} else {
    echo "Error: Primary key column not found for table '$table'.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete primary key</title>
</head>

<body bgcolor="FBB917">
    <h1>Delete primary key</h1>

    <form action='delete_pk.php' method="POST">
        <label for="primaryKeyValue">Select a primary key value:</label>
        <select name="primaryKeyValue" id="primaryKeyValue" required>
            <?php
            // Fetch primary key values from the selected table
            $result = $mysqli->query("SELECT $primaryKeyColumn FROM $table");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row[$primaryKeyColumn] . "'>" . $row[$primaryKeyColumn] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No primary key values found</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <input type='submit' name='deletePK' id="deletePK" value="Delete" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletePK"])) {
        $primaryKeyValue = $_POST["primaryKeyValue"];
        $xKey = mysqli_query($mysqli, "SELECT COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$table' AND CONSTRAINT_NAME = 'PRIMARY'");
        if ($xKey) {
            $primaryKey = mysqli_fetch_assoc($xKey);
            $primaryKeyColumn = $primaryKey['COLUMN_NAME'];
            echo "The primary key column for $table is: $primaryKeyColumn";
            $result = mysqli_query($mysqli,"DELETE FROM $table WHERE $table.$primaryKeyColumn = '$primaryKeyValue'");
            if(mysqli_affected_rows($mysqli) > 0){
                echo "<h2>Row deleted successfully.</h2>";
            } else {
                echo "<h2>No rows found to delete.</h2>";
            }
        }
    }
    ?>

    <h1>Return</h1>
    <form action='delete.php' method="POST">
        <input type='submit' name='returndelete' id="returndelete" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["returndelete"])) {
        header("Location: delete.php");
        exit;
    }
    ?>
</body>

</html>