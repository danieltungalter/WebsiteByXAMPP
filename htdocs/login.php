<?php
// Include config file
require_once 'connect.php';

// Define variables and initialize with empty values
$customer_name = $password = "";
$customer_name_err = $password_err = $error = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["customer_name"]))){
        $customer_name_err = 'Please enter your username.';
    } else{
        $customer_name = trim($_POST["customer_name"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    // Validate credentials
    if(empty($customer_name_err) && empty($password_err)){
        $customer_name = mysqli_real_escape_string($link,$_POST['customer_name']);
		$mypassword = mysqli_real_escape_string($link,$_POST['password']);

		$sql = "SELECT customer_name,customer_id FROM customer WHERE customer_name = '$customer_name' and password = '$mypassword'";
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
</head>

<style>
input[type=text], input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

.btn {
  width: 95%;
  font-size: 16px;
  background-color: #ff9900;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.btn:hover {
  background-color: #FF8033;
}

.help-block{
  color:red
}

.header {
  width: 25%;
  margin: 50px auto 0px;
  color: white;
  background: #ff9900;
  text-align: center;
  border: 1px solid #ff9900;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}

form, .content {
  width: 25%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.form-group {
  margin: 10px 0px 10px 0px;
}
.form-group label,span {
  display: block;
  text-align: left;
  margin: 3px;
}
.form-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
</style>

<body>
  <div id='cssmenu'>
  <ul>
  	<li class='active'>
  		<?php
  		if (isset($_SESSION["login_user"]) && !empty($_SESSION["login_user"])) {
  		echo "<a><H1>Welcome! ".$_SESSION["login_user"].".</H1></a>";
  	} else {
  		echo "<a><H1>Please login in the account!</H1></a>";
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

	<div class="header">
        <h1>Login</h1>

      </div>

      <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($customer_name_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="customer_name"class="form-control" value="<?php echo $customer_name; ?>">
                <span class="help-block"><?php echo $customer_name_err; ?></span>
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
                <button type="submit" class="btn btn-primary" name="Login"> Login</button>
            </div>
            <p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
        </form>
    </div>
</body>
</html>
