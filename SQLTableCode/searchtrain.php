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
    <title>View Train Information</title>
</head>

<body bgcolor="FBB917">
<?php
// Retrieve the list of table names
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>View Train Information</h1> 
<form action='searchtrain.php' method="POST">
    <label for="TrainID">Select Train</label><br>
    <select name="TrainID" id="TrainID">
        <?php
            // Retrieve list of TrainIDs and LocomotiveTypes from train table
            $sql = "SELECT TrainID, LocomotiveType FROM train";
            $result = $mysqli->query($sql);

            // Display TrainIDs and LocomotiveTypes as options in dropdown menu
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["TrainID"] . "'>" . $row["TrainID"] . " - " . $row["LocomotiveType"] . "</option>";
                }
            }
        ?>
    </select><br><br>
    <input type='submit' name='trainsearch' id="trainsearch" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trainsearch"])) {
    // Retrieve the input data to display
    $trainid = $_POST["TrainID"];
    $result = mysqli_query($mysqli,"SELECT * FROM train WHERE train.trainid = '$trainid'");

    // rest of your code to display employee info goes here...
    if($result->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='4'>
        <tr>
        <th>TrainID</th>
        <th>InspectorSSN</th>
        <th>BranchID</th>
        <th>LocomotiveType</th>
        <th>Last Inspected</th>
        <th>Inspection Status</th>
        <th>Cost</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['TrainID'] . "</td>";
            echo "<td>" . $row['InspectorSSN'] . "</td>";
            echo "<td>" . $row['BranchID'] . "</td>";
            echo "<td>" . $row['LocomotiveType'] . "</td>";
            echo "<td>" . $row['last_inspected'] . "</td>";
            echo "<td>" . $row['inspection_status'] . "</td>";
            echo "<td>" . $row['cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
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
