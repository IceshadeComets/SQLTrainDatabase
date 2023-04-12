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
    <title>Search Results</title>
</head>

<body bgcolor="FBB917">
    <h1>Search Results</h1>

    <form action='select_pk.php' method="POST">
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
        <input type='submit' name='selectPK' id="selectPK" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectPK"])) {
        $primaryKeyValue = $_POST["primaryKeyValue"];
        // Fetch the row from the table using the primary key value
        $result = mysqli_query($mysqli, "SELECT * FROM $table WHERE $primaryKeyColumn = '$primaryKeyValue'");
        if($result->num_rows >= 1){
            //$result->num_rows;
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'>";
            
            // Print table headers
            $columnsResult = mysqli_query($mysqli, "SHOW COLUMNS FROM $table");
            $columns = mysqli_fetch_all($columnsResult, MYSQLI_ASSOC);
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>" . $column['Field'] . "</th>";
            }
            echo "</tr>";

            // Print table rows
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . $row[$column['Field']] . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h2>No results found.</h2>";
        }
    }
    ?>

    <h1>Return</h1>
    <form action='search.php' method="POST">
        <input type='submit' name='returnsearch' id="returnsearch" required/> <br> <br>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["returnsearch"])) {
        header("Location: search.php");
        exit;
    }
    ?>
</body>

</html>