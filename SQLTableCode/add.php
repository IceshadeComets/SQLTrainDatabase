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
// If form is submitted, insert data into table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["table_name"]) && isset($_POST["submit"])) {
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
    $has_errors = false;
    foreach ($field_names as $field_name) {
        $field_value = mysqli_real_escape_string($mysqli, $_POST[$field_name]);
        if ($field_name == "email") {
            if (!filter_var($field_value, FILTER_VALIDATE_EMAIL)) {
                echo "Error: Invalid email format.<br>";
                $has_errors = true;
            }
        }
        if ($field_name == "age") {
            if (!is_numeric($field_value)) {
                echo "Error: Age must be a number.<br>";
                $has_errors = true;
            }
        }
        if (empty($field_value)) {
            echo "Error: Please fill in all fields.<br>";
            $has_errors = true;
        }
        $field_values[] = "'$field_value'";
    }
    $field_values_str = implode(", ", $field_values);

    // If there are errors, don't execute SQL query
    if ($has_errors) {
        return;
    }

    // Construct and execute SQL query
    $query = "INSERT INTO $table_name ($field_names_str) VALUES ($field_values_str)";
    $result = mysqli_query($mysqli, $query);

    // Check for errors
    if (!$result) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "Entry added successfully!";
        unset($_POST['submit']);
        unset($_POST['table_name']);
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
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='submit' name='submit' value='Add entry'>";
        echo "</form>";
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
