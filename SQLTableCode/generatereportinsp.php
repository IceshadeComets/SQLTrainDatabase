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
    <title>Generate Inspection Report</title>
</head>

<body bgcolor="FBB917">
<?php
// Retrieve the list of table names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>Generate Report</h1>
<form action='generatereportinsp.php' method="POST">
    <label>Generate Inspection Report</label>
    <br></br>
    <label>Enter Report ID</label>
    <input type='text' name= 'reportid' id="reportid" required/> <br> <br>
    <input type='submit' name= 'freport' id="freport" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {

    // Display Table of Trains
    echo "List of Safety Inspectors";
    $sqltraubs = "SELECT * FROM Employee JOIN safetyinspector ON safetyinspector.essn = Employee.ssn";
    $result = mysqli_query($mysqli, $sqltraubs);
    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>InspectorSSN</th><th>CEOSSN</th><th>FirstName</th><th>MiddleName</th><th>LastName</th><th>Salary</th><th>Sex</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["SSN"] . "</td><td>" . $row["CEOSSN"] . "</td><td>" .  $row["FirstName"] . "</td><td>" . $row["MiddleName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Salary"] . "</td><td>" . $row["Sex"] . "</td></tr>";
    }
    // Close the table
    echo "</table>";
    } else {
        // If no rows returned, display a message
        echo "No results found.";
    }

    echo "List of the 5 most Recently Inspected Trains";

    $sqltraubs = "SELECT * FROM Train ORDER BY last_inspected DESC LIMIT 5";
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

    echo "List of the 5 Furthest Inspected Trains";
    $sqltraubs = "SELECT * FROM Train WHERE last_inspected IS NOT NULL ORDER BY DATEDIFF(NOW(), last_inspected) DESC LIMIT 5";
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

    // Prepare the SQL query to retrieve all columns and rows from "parts" table
    


    //SELECT cost FROM trains_table;




    /* Lets Generate a Report, This Report will need
    - Cost of Each Train bought for the Client
    - Cost to buy each Part to build the train
    - Cost To Repair/Service Train

    // Step 1, Retrieve the Costs of all trains
    $xCosts = mysqli_quert
    */
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
