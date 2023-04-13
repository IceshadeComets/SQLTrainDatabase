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
// List of Table Names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>Generate Financial Report</h1>
<form action='generatereportfin.php' method="POST">
    <input type='submit' name= 'freport' id="freport" value="Generate Report" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {

    // Display Table of Trains
    echo "<h2>List of Trains</h2>";
    $sqltraubs = "SELECT * FROM Train";
    $result = mysqli_query($mysqli, $sqltraubs);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>TrainID</th><th>InspectorSSN</th><th>BranchID</th><th>LocomotiveType</th><th>last_inspected</th><th>inspection_status</th><th>cost</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["TrainID"] . "</td><td>" . $row["InspectorSSN"] . "</td><td>" . $row["BranchID"] . "</td><td>" . $row["LocomotiveType"] . "</td><td>" . $row["last_inspected"] . "</td><td>" . $row["inspection_status"] . "</td><td>" . $row["cost"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    
    // Display Table of Parts
    echo "<h2>List of Parts</h2>";
    $sqlparts = "SELECT * FROM parts";
    $result = mysqli_query($mysqli, $sqlparts);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>Part Number</th><th>Part Name</th><th>Supplier Name</th><th>Train ID</th><th>Cost</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["PartNumber"] . "</td><td>" . $row["PartName"] . "</td><td>" . $row["SupplierName"] . "</td><td>" . $row["TrainID"] . "</td><td>" . $row["Cost"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    
    // Display List of Repair/Service
    echo "<h2>List of Repair/Service Orders</h2>";
    $sqlrepair = "SELECT * FROM repairservice";
    $result = mysqli_query($mysqli, $sqlrepair);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>RepairID</th><th>ESSN</th><th>TrainID</th><th>Cost</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["RepairID"] . "</td><td>" . $row["ESSN"] . "</td><td>" . $row["TrainID"] . "</td><td>" . $row["Cost"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }


    // Display Total Cost of all Trains
    $sqlcost = "SELECT cost FROM Train";
    //mysqli_query($mysqli, $sqlcost);
    $result = mysqli_query($mysqli, $sqlcost);
    // Initialize a variable to store the sum of all costs
    $totalCostTrains = 0;

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
        // Output the table rows and add up the cost
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostTrains += $row["cost"];
        }

        // Output the total cost

    }

    // Display Total Cost of all Parts
    $sqlcostparts = "SELECT cost FROM parts";
    //mysqli_query($mysqli, $sqlcost);
    $result = mysqli_query($mysqli, $sqlcostparts);
    // Initialize a variable to store the sum of all costs
    $totalCostParts = 0;

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
        // Output the table rows and add up the cost
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostParts += $row["cost"];
        }

        // Output the total cost
    }

    $sqlcostrepair = "SELECT cost FROM repairservice";
    //mysqli_query($mysqli, $sqlcost);
    $result = mysqli_query($mysqli, $sqlcostrepair);
    // Initialize a variable to store the sum of all costs
    $totalCostRepair = 0;

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result) > 0) {
        // Output the table rows and add up the cost
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostRepair += $row["cost"];
        }

        // Output the total cost
    }

    echo "Total cost of all trains: " . $totalCostTrains . PHP_EOL;
    echo "Total cost of all parts: " . $totalCostParts . PHP_EOL;
    echo "Total cost of all repairs: " . $totalCostRepair . PHP_EOL;
    $netprofits = $totalCostTrains - ($totalCostRepair + $totalCostParts);
    echo "Net Profits: " . $netprofits . PHP_EOL;


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
