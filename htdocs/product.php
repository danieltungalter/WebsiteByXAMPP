<?php
session_start();
require_once 'connect.php';
//echo "<H1>Welcome! ".$_SESSION["login_user"].".</H1>";

if(!isset($_SESSION["quantity0"]))
		$_SESSION["quantity0"] = 0;
if(!isset($_SESSION["quantity1"]))
	$_SESSION["quantity1"] = 0;
if(!isset($_SESSION["quantity2"]))
	$_SESSION["quantity2"] = 0;
if(!isset($_SESSION["quantity3"]))
	$_SESSION["quantity3"] = 0;
if(!isset($_SESSION["quantity4"]))
	$_SESSION["quantity4"] = 0;
if(!isset($_SESSION["quantity5"]))
	$_SESSION["quantity5"] = 0;

$quantity = array($_SESSION["quantity0"],$_SESSION["quantity1"],$_SESSION["quantity2"],$_SESSION["quantity3"],$_SESSION["quantity4"],$_SESSION["quantity5"]);
?>
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <meta charset="iso-8859-1">
	<link rel="stylesheet" href="styles/layout.css" type="text/css">
<title>
	Online Manufacturing - Product
</title>
</head>
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
<hr>
<style>
	.product_list {
		font-family: "Arial Black", Gadget, sans-serif;
		border: 0px solid #1C6EA4;
		margin: auto;
		width: 100%;
		height: 250px;
	}
	.product_list th {
		border:0px solid #ffffff;
		padding:8px;
		background:#ff9900;
		margin: auto;
		color: #ffffff;
	}
	.product_list td {
		text-align: center;
		border:0px solid #ffffff;
		padding: 10px 4px;
		margin: auto;
		width: auto;
		color: #ffffff;
	}
	.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #ff9900;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
<form action = "#" method = "post">

<table class = 'product_list'>
<thead>
<tr>
	<th>ID</th>
	<th>Photo</th>
	<th>Description</th>
	<th>Stock</th>
	<th>HKD / Units</th>
	<th>Quantity</th>
</tr>
</thead>
<tbody>
<?php
	$sql = "SELECT * FROM product";
	$result = $link->query($sql);

	if ($result->num_rows > 0) {
		$x = 0;
		while($row = $result->fetch_row()) {
			$max_stock_sql = "SELECT stock from product WHERE product_id = 'P000000".($x+1)."'";
			$max_stock_result = $link->query($max_stock_sql);
			$max_stock_row = $max_stock_result->fetch_row();
			$image = $row[4];
			echo "<tr><td>".$row[0]."</td><td>"."<img src='$image' style=\'width:128px;height:128px;\'>"."</td><td>".$row[1]."</td><td>".($row[2]-$quantity[$x])."</td><td>$".$row[3]."</td><td><input type=\"number\" name=\"quantity".$x."\" id=\"quantity".$x."\" min=\"0\" max=\"".($max_stock_row[0]-$quantity[$x])."\" value=\"0\"></td></tr>";
			$x++;
		}
	} else {
    echo "There is no results";
}

?>
</tbody>
</table>
<hr>

<center><button class="button" style="vertical-align:middle" type="submit" name="submit"><span>Put it into cart </span></button></center>
</form>

<?php
if(isset($_POST['submit'])){
	$_SESSION["quantity0"] = $_SESSION["quantity0"]+$_POST['quantity0'];
	$_SESSION["quantity1"] = $_SESSION["quantity1"]+$_POST['quantity1'];
	$_SESSION["quantity2"] = $_SESSION["quantity2"]+$_POST['quantity2'];
	$_SESSION["quantity3"] = $_SESSION["quantity3"]+$_POST['quantity3'];
	$_SESSION["quantity4"] = $_SESSION["quantity4"]+$_POST['quantity4'];
	$_SESSION["quantity5"] = $_SESSION["quantity5"]+$_POST['quantity5'];

	header("location: please_confirm.php");
} 
?>

</body>
<html>
