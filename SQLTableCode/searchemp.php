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

<h1>View Employee Information</h1> 
<form action='searchemp.php' method="POST">
    <label for="ssn">Select Employee</label><br>
    <select name="ssn" id="ssn">
        <?php

            // Retrieve list of SSNs and names from employee table
            $sql = "SELECT SSN, CONCAT(FirstName, ' ', LastName) AS Name FROM employee";
            $result = $mysqli->query($sql);

            // Display SSNs and names as options in dropdown menu
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["SSN"] . "'>" . $row["SSN"] . " - " . $row["Name"] . "</option>";
                }
            }
        ?>
    </select><br><br>
    <input type='submit' name='empsearch' id="empsearch" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empsearch"])) {
    // Retrieve the input data to display
    $ssn = $_POST["ssn"];
    $result = mysqli_query($mysqli,"SELECT * FROM employee WHERE SSN = '$ssn'");
    // rest of your code to display employee info goes here...
    if($result->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
        <tr>
        <th>SSN</th>
        <th>CEOSSN</th>
        <th>Address</th>
        <th>FirstName</th>
        <th>MiddleName</th>
        <th>LastName</th>
        <th>Birthdate</th>
        <th>Salary</th>
        <th>Sex</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['SSN'] . "</td>";
            echo "<td>" . $row['CEOSSN'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['MiddleName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Birthdate'] . "</td>";
            echo "<td>" . $row['Salary'] . "</td>";
            echo "<td>" . $row['Sex'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    // Print out dependents if they exist
    $ssn = $_POST["ssn"];
    $result = mysqli_query($mysqli,"SELECT * FROM dependents as D WHERE ESSN = '$ssn'");
    if($result->num_rows >= 1){
        echo "<h2>List of Dependents:</h2>";
        echo "<table border='1'>
        <tr>
        <th>ESSN</th>
        <th>FirstName</th>
        <th>MiddleName</th>
        <th>LastName</th>
        <th>Relationship</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['ESSN'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['MiddleName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['Relationship'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        //echo "<h2>No results found.</h2>";
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
