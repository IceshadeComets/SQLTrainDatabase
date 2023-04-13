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

session_start();
$table = $_SESSION['POST'];

// Retrieve the Primary Key Column Name
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
        <label for="primaryKeyValue"><b>Select a primary key value:</b></label>
        <select name="primaryKeyValue" id="primaryKeyValue" required>
            <?php
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
        $result = mysqli_query($mysqli, "SELECT * FROM $table WHERE $primaryKeyColumn = '$primaryKeyValue'");
        if($result->num_rows >= 1){
            echo "<h2>Search Results:</h2>";
            echo "<table border='4'>";
            $columnsResult = mysqli_query($mysqli, "SHOW COLUMNS FROM $table");
            $columns = mysqli_fetch_all($columnsResult, MYSQLI_ASSOC);
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>" . $column['Field'] . "</th>";
            }
            echo "</tr>";
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