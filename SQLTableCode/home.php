<style type = "text/css">
    body {
        /* background-color: #37FF8B; */
        background-image: url(bg4.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        margin: 100px;
        color: #457B9D; 

    }
    h1 {
        text-align: center;
        font-family: serif;
        margin: 50px;
    }
    form {
        text-align: center;
        font-family: tahoma;
    }
    div {
        text-align: center;
        font-family: tahoma;
    }
    input[type=text] {
        border: none;
    }
    input[type=button], input[type=submit] {
        border: none;
        border-radius: 2px;
        font-size: 18px;
        padding: 10px;
    } 
    input[type=submit]:hover {
        color: #E63946;
    }
</style>
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
    <h1>Information Lookup</h1>
    <form action='home.php' method="POST">
        <label for="user">Table Name</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <label for="user">Identifer</label><br>
        <input type='text' name= 'pk' id="pk" required/> <br> <br>
        <input type='submit' name= 'clientsearch' id="clientsearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clientsearch"])) {
    // Retrieve the input data to display
    $name = $_POST["name"];
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

<?php
// If form is submitted, insert data into table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table_name"])) {
    $table_name = $_POST["table_name"];

    // Get fields for specified table
    $fields_query = "SHOW COLUMNS FROM $table_name";
    $fields_result = mysqli_query($mysqli, $fields_query);

    // Construct list of field names for SQL query
    $field_names = [];
    while ($field_row = mysqli_fetch_assoc($fields_result)) {
        $field_names[] = $field_row['Field'];
    }
    $field_names_str = implode(", ", $field_names);

    // Construct list of escaped field values for SQL query
    $field_values = [];
    foreach ($field_names as $field_name) {
        $field_value = mysqli_real_escape_string($mysqli, $_POST[$field_name]);
        $field_values[] = "'$field_value'";
    }
    $field_values_str = implode(", ", $field_values);

    // Construct and execute SQL query
    $query = "INSERT INTO $table_name ($field_names_str) VALUES ($field_values_str)";
    $result = mysqli_query($mysqli, $query);

    // Check for errors
    if (!$result) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "Entry added successfully!";
    }
}

// If no table is specified, show dropdown to select table
if (!isset($_POST["table_name"])) {
    $tables_query = "SHOW TABLES";
    $tables_result = mysqli_query($mysqli, $tables_query);

    if (!$tables_result) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "<form method='POST'>";
        echo "<label for='table_name'>Table name:</label>";
        echo "<select name='table_name' id='table_name'>";
        while ($table_row = mysqli_fetch_row($tables_result)) {
            echo "<option value='$table_row[0]'>$table_row[0]</option>";
        }
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Select table'>";
        echo "</form>";
    }
} else { // If table is specified, show form with input fields for each table column
    $table_name = $_POST["table_name"];

    $fields_query = "SHOW COLUMNS FROM $table_name";
    $fields_result = mysqli_query($mysqli, $fields_query);

    if (!$fields_result) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "<form method='POST'>";
        while ($field_row = mysqli_fetch_assoc($fields_result)) {
            $field_name = $field_row['Field'];
            echo "<label for='$field_name'>$field_name:</label>";
            echo "<input type='text' name='$field_name' id='$field_name'><br><br>";
        }
        echo "<input type='submit' value='Add entry'>";
        echo "</form>";
    }
}
?>

</body>
</html>
