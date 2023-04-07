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
    <h1> Search For Client Information</h1>
    <form action='home.php' method="POST">
        <label for="user">Client Name</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <input type='submit' name= 'clientsearch' id="clientsearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clientsearch"])) {
    // Retrieve the input data to display
    $name = $_POST["name"];
    $result = mysqli_query($mysqli,"SELECT * FROM client WHERE client.ClientName = '$name'");
    if($result->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
        <tr>
        <th>Client Name</th>
        <th>Branch ID</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['ClientName'] . "</td>";
            echo "<td>" . $row['BranchID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        //echo "<h2>No results found.</h2>";
    }
}
         ?>

<h1> Search For Employee Information</h1> 
    <form action='home.php' method="POST">
        <label for="user">Employee Name</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <input type='submit' name= 'empsearch' id="empsearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empsearch"])) {
    // Note for this crap, we will need to later sort this out by user type, etc User is Supervisor/CEo
    // Retrieve the input data to display
    $name = $_POST["name"];
    $result = mysqli_query($mysqli,"SELECT * FROM employee as E WHERE E.firstname = '$name'");
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
    else{
        //echo "<h2>No results found.</h2>";
    }
}
         ?>




</body>
</html>
