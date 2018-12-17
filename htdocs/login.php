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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; margin: auto;}
    </style>
</head>
<body>
	<div class="wrapper">
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