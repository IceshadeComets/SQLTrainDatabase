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
    <title>Train Database</title>
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
    $result = mysqli_query($mysqli, $sqlcost);
    $totalCostTrains = 0;
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostTrains += $row["cost"];
        }
    }

    // Display Total Cost of all Parts
    $sqlcostparts = "SELECT cost FROM parts";
    $result = mysqli_query($mysqli, $sqlcostparts);
    $totalCostParts = 0;
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostParts += $row["cost"];
        }
    }

    // Display Total Cost of Repairs
    $sqlcostrepair = "SELECT cost FROM repairservice";
    $result = mysqli_query($mysqli, $sqlcostrepair);
    $totalCostRepair = 0;
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $totalCostRepair += $row["cost"];
        }
    }

    echo "<h2>Receipt</h2>";

    echo "<b>Total cost of all trains: $</b>" . $totalCostTrains . "<br>";
    echo "<b>Total cost of all parts: $</b>" . $totalCostParts . "<br>";
    echo "<b>Total cost of all repairs: $</b>" . $totalCostRepair . "<br>";
    $netprofits = $totalCostTrains - ($totalCostRepair + $totalCostParts);
    echo "<b>Net Profits: $</b>" . $netprofits . "<br>";
}
?>


<h1>Return</h1>
    <form action='search.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: home.php");
        exit;
    }
         ?>
</body>
</html>
