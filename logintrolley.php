<?php 
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "database1";
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 ?>

  	<?php if(isset($_POST['trolleyname'])  && isset($_POST['number']) && isset($_POST['password'])) {
 $trolleyname = $_POST['trolleyname'];
 $number = $_POST['number'];
 $password = $_POST['password'];
 

  if (empty($name)) {
  	array_push($errors, "name is required");
  }
  if (empty($number)) {
    array_push($errors, "number is required");
}
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user exists in the database
$sql = "SELECT * FROM trolleyreg WHERE name='$trolleyname'  AND number='$number' AND password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 1) {
    // User is authenticated
    echo "Login successful!";
} else {
    // Invalid username or password
    echo "Invalid username or password.";
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
    <!--<title> Registration or Sign Up form in HTML CSS | CodingLab </title>-->
    <link rel="stylesheet" href="assets/css/reg.css">
</head>
<body>
<div class="wrapper">
        <form action="<?php echo ($_SERVER["PHP_SELF"]);?>" method="post">
		<div align="left">
              <h2 style="color: #349beb; font-family: Arial, sans-serif;"> LOG IN</h2><br>
            </div>
            <div align="left">
                <label style"font-family: Arial, sans-serif;">Name:</label><br>
                <input type="text" class="form-control" name="name" id="id" required>
            </div>
            <div align="left">
                <label style"font-family: Arial, sans-serif;">Number:</label><br>
                <input type="text" class="form-control" name="number" id="number" required>
            </div>
            <div align="left">
                <label>password</label><br>
                <input type="password" class="form-control" name="password" id="id" required><br>
            </div><br>
  	<div align="center">
  		<button type="submit" class="btn" name="trolley login" style="#faq-content-5"><a href="home1.html">Login</button>
  	</div><br>
  	<p>
  		Not yet a member? <a href="trolleyreg.php">Sign up</a>
  	</p>
  </form>
</body>
</html>