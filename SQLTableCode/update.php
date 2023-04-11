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
// get list of tables
$tables = array();
$tables_query = "SHOW TABLES";
$tables_result = mysqli_query($mysqli, $tables_query);
while ($table_row = mysqli_fetch_array($tables_result)) {
    $tables[] = $table_row[0];
}

// If no table is specified, show dropdown to select table
if (!isset($_POST["table_name"])) {

    if (!$tables_result) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "<form method='POST'>";
        echo "<label for='table_name'>Table name:</label>";
        echo "<select name='table_name' id='table_name'>";
        foreach($tables as $table_name) {
            echo "<option value=' " . $table_name . " '>" . $table_name . "</option>";
        }
        echo "</select>";
        echo "<br><br>";
        echo "<input type='submit' value='Select table'>";
        echo "</form>";
    }
} else { // If table is specified, show form with input fields for each table column
    $table_name = $_POST["table_name"];

    $fields_query = "SELECT * FROM $table_name";
    $fields_result = mysqli_query($mysqli, $fields_query);

    if (mysqli_num_rows($fields_result) <= 0) {
        echo "Error: " . mysqli_error($mysqli);
    } else {
        echo "<form method='POST'>";
        echo "<table>";
        while ($table_row = mysqli_fetch_assoc($fields_result)) {
            echo "<tr>";
            foreach ($table_row as $key => $value) {
                echo "<td>" . $key . "</td>";
                echo "<td><input type='text' name='" . $key . "' value='" . $value . "'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='submit' name='submit' value='Update table'>";
        echo "</form>";

        // if form is submitted, update values with text in them
        if(isset($_POST['submit'])) {
            foreach($_POST as $key => $value) {
                if($key != '' && $value != '' && $key != 'submit') {
                    $fields_query = "UPDATE $table_name SET $key = '$value'";
                    mysqli_query($mysqli, $fields_query);
                }
            }
            echo "Records were updated successfully!";
        }
    }
}
?>

<h1>Return</h1>
    <form action='update.php' method="POST">
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