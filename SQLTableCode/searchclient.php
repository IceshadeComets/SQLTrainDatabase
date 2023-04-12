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
    <title>Registration Form</title>
</head>

<body bgcolor="FBB917">
<?php
// Retrieve the list of table names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>View Client Information</h1> 
<form action='searchclient.php' method="POST">
    <label for="name">Select Employee</label><br>
    <select name="name" id="name">
        <?php

            // Retrieve list of SSNs and names from employee table
            $sql = "SELECT ClientName AS Name FROM client";
            $result = $mysqli->query($sql);

            // Display SSNs and names as options in dropdown menu
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Name"] . "'>" . $row["Name"] . "</option>";
                }
            }
        ?>
    </select><br><br>
    <input type='submit' name='empsearch' id="empsearch" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empsearch"])) {

    // Retrieve the input data to display
$name = $_POST["name"];

// Query the client table for client with given name
$result = mysqli_query($mysqli,"SELECT * FROM client WHERE client.clientname = '$name'");

// Check if any results were returned
if($result->num_rows >= 1) {
    echo "<h2>Search Results:</h2>";
    echo "<table border='1'>
        <tr>
            <th>ClientName</th>
            <th>BranchID</th>
            <th>Type</th>
        </tr>";
    
    // Loop through each result
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ClientName'] . "</td>";
        echo "<td>" . $row['BranchID'] . "</td>";
        
        // Check if client is a government
        $gov_result = mysqli_query($mysqli, "SELECT * FROM government WHERE clientname = '".$row['ClientName']."'");
        if($gov_result->num_rows >= 1) {
            echo "<td>Government</td>";
        } else {
            // Check if client is a company
            $comp_result = mysqli_query($mysqli, "SELECT * FROM company WHERE cname = '".$row['ClientName']."'");
            if($comp_result->num_rows >= 1) {
                echo "<td>Company</td>";
            } else {
                // Otherwise, assume it's an individual
                echo "<td>Individual</td>";
            }
        }
        
        echo "</tr>";
    }
    echo "</table>";
} else {
    // No results were found
    echo "No clients found with name: $name";
}

// Close database connection
mysqli_close($mysqli);
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
