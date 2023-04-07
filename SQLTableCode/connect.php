<style type = "text/css">
    body {
        /* background-color: #37FF8B; */
        background-image: url(bg4.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        margin: 100px;
        color: #457B9D; 

    }
    h1 {
        text-align: center;
        font-family: serif;
        margin: 50px;
    }
    form {
        text-align: center;
        font-family: tahoma;
    }
    div {
        text-align: center;
        font-family: tahoma;
    }
    input[type=text] {
        border: none;
    }
    input[type=button], input[type=submit] {
        border: none;
        border-radius: 2px;
        font-size: 18px;
        padding: 10px;
    } 
    input[type=submit]:hover {
        color: #E63946;
    }
</style>
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
        <label for="user">Employee Name/SSN</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <input type='submit' name= 'empsearch' id="empsearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empsearch"])) {
    // Note for this crap, we will need to later sort this out by user type, etc User is Supervisor/CEo
    // Retrieve the input data to display
    $name = $_POST["name"];
    $result = mysqli_query($mysqli,"SELECT * FROM employee as E WHERE E.firstname = '$name'");
    $sresult = mysqli_query($mysqli,"SELECT * FROM employee as E WHERE E.ssn = '$name'");
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
    } else if($sresult->num_rows >= 1){
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
        while($row = mysqli_fetch_array($sresult))
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

<h1> Search For Train Specification</h1> 
    <form action='home.php' method="POST">
        <label for="user">TrainID</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <input type='submit' name= 'tsearch' id="tsearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tsearch"])) {
    // Note for this crap, we will need to later sort this out by user type, etc User is Supervisor/CEo
    // Retrieve the input data to display
    $name = $_POST["name"];
    $result = mysqli_query($mysqli,"SELECT * FROM train as T WHERE T.trainid = '$name'");
    if($result->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
        <tr>
        <th>TrainID</th>
        <th>InspectorSSN</th>
        <th>BranchID</th>
        <th>LocomotiveType</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['TrainID'] . "</td>";
            echo "<td>" . $row['InspectorSSN'] . "</td>";
            echo "<td>" . $row['BranchID'] . "</td>";
            echo "<td>" . $row['LocomotiveType'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    else{
        //echo "<h2>No results found.</h2>";
    }
}
?>

<h1> View Parts List</h1> 
    <form action='home.php' method="POST">
        <label for="user">PartNumber/TrainID</label><br>
        <input type='text' name= 'name' id="name" required/> <br> <br>
        <input type='submit' name= 'psearch' id="psearch" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["psearch"])) {
    // Note for this crap, we will need to later sort this out by user type, etc User is Supervisor/CEo
    // Retrieve the input data to display
    $name = $_POST["name"];
    $result = mysqli_query($mysqli,"SELECT * FROM parts as P WHERE P.PartNumber = '$name'");
    $sresult = mysqli_query($mysqli,"SELECT * FROM parts as P WHERE P.TrainID = '$name'");
    if($result->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
        <tr>
        <th>PartNumber</th>
        <th>SupplierName</th>
        <th>TrainID</th>
        <th>Cost</th>
        </tr>";
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['PartNumber'] . "</td>";
            echo "<td>" . $row['SupplierName'] . "</td>";
            echo "<td>" . $row['TrainID'] . "</td>";
            echo "<td>" . $row['Cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    else if($sresult->num_rows >= 1){
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>
        <tr>
        <th>PartNumber</th>
        <th>SupplierName</th>
        <th>TrainID</th>
        <th>Cost</th>
        </tr>";
        while($row = mysqli_fetch_array($sresult))
        {
            echo "<tr>";
            echo "<td>" . $row['PartNumber'] . "</td>";
            echo "<td>" . $row['SupplierName'] . "</td>";
            echo "<td>" . $row['TrainID'] . "</td>";
            echo "<td>" . $row['Cost'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        //echo "<h2>No results found.</h2>";
    } else {

    }
}

         ?>


</body>
</html>
