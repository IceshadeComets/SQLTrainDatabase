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

<h1>Generate Repair/Service Report</h1>
<form action='generatereportteng.php' method="POST">
    <input type='submit' name= 'freport' id="freport" value="Generate Report" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {

    // Display Table of Train Engineers
    echo "List of Train Engineers";
    $sqltraubs = "SELECT * FROM Employee JOIN trainengineer ON trainengineer.essn = Employee.ssn";
    $result = mysqli_query($mysqli, $sqltraubs);
    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>EngineerSSN</th><th>CEOSSN</th><th>FirstName</th><th>MiddleName</th><th>LastName</th><th>Salary</th><th>Sex</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["SSN"] . "</td><td>" . $row["CEOSSN"] . "</td><td>" .  $row["FirstName"] . "</td><td>" . $row["MiddleName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Salary"] . "</td><td>" . $row["Sex"] . "</td></tr>";
    }
    // Close the table
    echo "</table>";
    } else {
        // If no rows returned, display a message
        echo "No results found.";
    }

    echo "List of Trains that need to be repaired";
    $sqltraubs = "SELECT * FROM Train WHERE inspection_status = 'Bad'";
    $result = mysqli_query($mysqli, $sqltraubs);

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>TrainID</th><th>InspectorSSN</th><th>BranchID</th><th>LocomotiveType</th><th>last_inspected</th><th>inspection_status</th><th>cost</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["TrainID"] . "</td><td>" . $row["InspectorSSN"] . "</td><td>" . $row["BranchID"] . "</td><td>" . $row["LocomotiveType"] . "</td><td>" . $row["last_inspected"] . "</td><td>" . $row["inspection_status"] . "</td><td>" . $row["cost"] . "</td></tr>";
    }
    // Close the table
    echo "</table>";
    } else {
        // If no rows returned, display a message
        echo "No results found.";
    }

    echo "List of Parts and Repair/Service Orders";
    // Prepare the SQL query to retrieve all columns and rows from "parts" table
    $sqlparts = "SELECT * FROM parts AS P JOIN repairservice AS R ON P.TrainID = R.TrainID";

    // Execute the SQL query and store the result in a variable
    $result = mysqli_query($mysqli, $sqlparts);

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
        // Display the table headers
        echo "<table><tr><th>Part Number</th><th>Supplier Name</th><th>Train ID</th><th>Repair ID</th><th>EngineerSSN</th><th</tr>";

        // Output the table rows
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["PartNumber"] . "</td><td>" . $row["SupplierName"] . "</td><td>" . $row["TrainID"] . "</td><td>" . $row["RepairID"] . "</td><td>" . $row["ESSN"] . "</td></tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        // If no rows returned, display a message
        echo "No results found.";
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
