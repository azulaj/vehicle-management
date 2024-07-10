<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<?php
$query2 = "SELECT * FROM mechreg ORDER BY mech_id DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);
$row = mysqli_fetch_array($result2);
$last_id = $row['mech_id'];
if ($last_id == "") {
    $mechanic_ID = "MEC1";
} else {
    $mechanic_ID = substr($last_id, 3);
    $mechanic_ID = intval($mechanic_ID);
    $mechanic_ID = "MEC" . ($mechanic_ID + 1);
}
?>

<?php
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mech_id = $_POST["mech_id"];
    $mechname = $_POST["mechname"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $location = $_POST["location"];
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
    $sql = "INSERT INTO mechreg (mech_id, mechname, number, email, password, location) VALUES ('$mech_id', '$mechname', '$number', '$email', '$password', '$location')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("Location: mechaniclogin.html"); // Redirect to mechaniclogin.html
        exit; // Terminate the script immediately
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title> Registration or Sign Up form in HTML CSS | CodingLab </title>-->
    <link rel="stylesheet" href="assets/css/reg.css">
</head>
<body>
<div class="wrapper">
    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
        <div align="left">
            <h2 style="color: #349beb; font-family: Arial, sans-serif;"> REGISTRATION</h2><br>
        </div>
        <div align="left">
            <label>Mechanic ID</label><br>
            <input type="text" class="form-control" name="mech_id" id="id" style="color: red" value="<?php echo $mechanic_ID; ?>" readonly>
        </div>
        <div align="left">
            <label style"font-family: Arial, sans-serif;">Mechanic Name:</label><br>
            <input type="text" class="form-control" name="mechname" id="id" required>
        </div>
        <div align="left">
            <label>Number</label><br>
            <input type="text" class="form-control" name="number" id="id" required>
        </div>
        <div align="left">
            <label>Email</label><br>
            <input type="text" class="form-control" name="email" id="id" required>
        </div>
        <div align="left">
            <label>Password</label><br>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div align="left">
            <label>Confirm Password</label><br>
            <input type="password" class="form-control" id="confirm-password" required>
        </div>
        <div align="left">
            <label>Location</label><br>
            <input type="text" class="form-control" name="location" id="location" required>
        </div>
        <br>
        <div align="center">
            <button type="submit" class="btn" name="mechanic login" style="#faq-content-5">SIGN UP</button>
        </div>
        <br>
        <div class="text">
            <h3>Already have an account? <a href="loginmech.php">Login now</a></h3>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</div>
</body>
</html>
