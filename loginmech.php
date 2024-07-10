<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$errors = array(); // Array to store validation errors

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Check if the user is already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: mechhome.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mechname = $_POST["mechname"];
    $number = $_POST["number"];
    $password = $_POST["password"];

    // Validate form input
    if (empty($mechname)) {
        array_push($errors, "Name is required");
    }
    if (empty($number)) {
        array_push($errors, "Number is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $sql = "SELECT * FROM mechreg WHERE mechname='$mechname' AND number='$number' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        // Check if the username and password are correct
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['loggedin'] = true;
            header("Location: mechhome.php");
            exit;
        } else {
            $_SESSION['loggedin'] = false;
            echo "Invalid username, number, or password";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reg.css">
    <title>Registration or Sign Up form in HTML CSS | CodingLab</title>
</head>
<body>
    <div class="wrapper">
        <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
            <div align="left">
                <h2 style="color: #349beb; font-family: Arial, sans-serif;"> LOG IN</h2><br>
            </div>
            <div align="left">
                <label style="font-family: Arial, sans-serif;">Name:</label><br>
                <input type="text" class="form-control" name="mechname" id="id" required>
            </div>
            <div align="left">
                <label style="font-family: Arial, sans-serif;">Number:</label><br>
                <input type="text" class="form-control" name="number" id="number" required>
            </div>
            <div align="left">
                <label>Password</label><br>
                <input type="password" class="form-control" name="password" id="id" required><br>
            </div><br>
            <div align="center">
               
                <button type="submit" class="btn" name="mechlogin">Login</button>
            </div><br>
            <p>
                Not yet a member? <a href="mechreg.php">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>
