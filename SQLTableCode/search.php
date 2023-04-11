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
    <label for="pk">Enter primary key value:</label>
    <input type='text' name= 'pk' id="pk" required/> <br> <br>
    <input type='submit' name= 'clientsearch' id="clientsearch" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clientsearch"])) {
    // Retrieve the input data to display
    $name = $_POST["table"];
    $pkey = $_POST["pk"];

    $xKey = mysqli_query($mysqli, "SELECT COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = '$name' AND CONSTRAINT_NAME = 'PRIMARY'");
    if ($xKey) {
        $primaryKey = mysqli_fetch_assoc($xKey);
        $primaryKeyColumn = $primaryKey['COLUMN_NAME'];
        echo "The primary key column for $name is: $primaryKeyColumn";
        $result = mysqli_query($mysqli,"SELECT * FROM $name WHERE $name.$primaryKeyColumn = '$pkey'");
        if($result->num_rows >= 1){
            //$result->num_rows;
            echo "<h2>Search Results:</h2>";
            echo "<table border='1'>";
            
            // Print table headers
            $columnsResult = mysqli_query($mysqli, "SHOW COLUMNS FROM $name");
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
}
?>


<h1>Return</h1>
    <form action='search.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: home.php");
        exit;
    // Retrieve the input data to display

    }


         ?>
</body>
</html>
