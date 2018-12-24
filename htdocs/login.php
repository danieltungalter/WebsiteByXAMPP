<?php
// Include config file
require_once 'connect.php';

// Define variables and initialize with empty values
$customer_id = $password = "";
$customer_id_err = $password_err = $error = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["customer_id"]))){
        $customer_id_err = 'Please enter customer id.';
    } else{
        $customer_id = trim($_POST["customer_id"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    // Validate credentials
    if(empty($customer_id_err) && empty($password_err)){
        $customer_id = mysqli_real_escape_string($link,$_POST['customer_id']);
		$mypassword = mysqli_real_escape_string($link,$_POST['password']);

		$sql = "SELECT customer_name,customer_id FROM customer WHERE customer_id = '$customer_id' and password = '$mypassword'";
		//echo $sql;
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row

		if($count == 1) {
			session_start();
			$_SESSION["login_user"] = $row["customer_name"];
			$_SESSION["user_id"]=$row["customer_id"];
			header("location: home.php");
		}else {
			$error = "Your Login Name or Password is invalid";
		}
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>
	Online Portal
	</title>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="styles/layout.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin: auto;}
    </style>
</head>
<body>
  <div id='cssmenu'>
  <ul>
  	<li class='active'>
  		<?php
  		if (isset($_SESSION["login_user"]) && !empty($_SESSION["login_user"])) {
  		echo "<a><H1>Welcome! ".$_SESSION["login_user"].".</H1></a>";
  	} else {
  		echo "<a>Please login in the account!</a>";
  	}
  		?>
     </li>
  </ul>
  </div>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="home.php">Best Manufacturer</a></h1>
      <h2>The Best Manufacturing</h2>
    </div>
    <nav>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li class="last"><a href="logout.php">Log out</a></li>
      </ul>
    </nav>
  </header>
</div>

	<div class="container">
        <h1>Login</h1>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($customer_id_err)) ? 'has-error' : ''; ?>">
                <label>Customer ID</label>
                <input type="text" name="customer_id"class="form-control" value="<?php echo $customer_id; ?>">
                <span class="help-block"><?php echo $customer_id_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($error)) ? 'has-error' : ''; ?>">
                <span class="help-block"><?php echo $error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
