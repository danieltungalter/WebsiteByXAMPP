<?php
// initializing variables
$customer_name = "";
$phone_no = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'manufactor');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $customer_name = mysqli_real_escape_string($db, $_POST['customer_name']);
  $phone_no = mysqli_real_escape_string($db, $_POST['phone_no']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($customer_name)) { array_push($errors, "Username is required"); }
  if (empty($phone_no)) { array_push($errors, "Phone number id is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM customer WHERE customer_name='$customer_name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['customer_name'] === $customer_name) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  //	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO customer (customer_name, phone_no, email, password)
  			  VALUES('$customer_name','$phone_no', '$email', '$password_1')";
  	mysqli_query($db, $query);

    session_start();
  	$_SESSION['login_user'] = $customer_name;
  	header('location: home.php');
  }
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
input[type=text], input[type=password], input[type=email], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=text]:focus, input[type=password]:focus, input[type=email]:focus {
  background-color: #ddd;
  outline: none;
}

.btn {
  width: 95%;
  background-color: #ff9900;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn:hover {
  background-color: #FF8033;
}

.header {
  width: 25%;
  font-size: 16px;
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
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}

.error {
  width: 92%;
  margin: 0px auto;
  padding: 10px;
  border: 1px solid #a94442;
  color: #a94442;
  background: #f2dede;
  border-radius: 5px;
  text-align: left;
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
  <h2>Register</h2>
</div>

<div class="container">
<form method="post" action="register.php">
  <?php include('error.php'); ?>
  <div class="input-group">
    <label>Username</label>
    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
  </div>
  <div class="input-group">
    <label>Phone number</label>
    <input type="text" name="phone_no" value="<?php echo $phone_no; ?>">
  </div>
  <div class="input-group">
    <label>Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
  </div>
  <div class="input-group">
    <label>Password</label>
    <input type="password" name="password_1">
  </div>
  <div class="input-group">
    <label>Confirm password</label>
    <input type="password" name="password_2">
  </div>
  <div class="input-group">
    <button type="submit" class="btn" name="reg_user">Register</button>
  </div>
  <p>
    Already a member? <a href="login.php">Sign in</a>
  </p>
</form>

    </div>
</body>
</html>
