<?php
include("config.php");
session_start();
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form 
$myusername=addslashes($_POST['username']); 
$mypassword=addslashes($_POST['password']); 
$sql="SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//$active=$row['Active'];
$count=mysql_num_rows($result);
//echo $count;
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
session_register("myusername");
$_SESSION['login_user']=$myusername;
     header("location: enquiry.php");
}
else 
{
$error="Your Login Name or Password is invalid";
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script>
  $(document).ready(function() {
    $("#dialog").dialog();
  });
  </script>
</head>
<body style="font-size:62.5%;">
<div id="dialog" title="LogIn Panel"><form action="login.php" method="post">
<table border="0" cellpadding="0" cellspacing="0">
<tr><th><b>User Name  :</b></th><td><input type="text" name="username" class="box"/></td>
<tr><th><b>Password  :</b></th><td><input type="password" name="password" class="box" /></td>
<tr><td colspan="2" align="center"><br/><input type="submit" value=" Submit "/></td>
<tr><td colspan="2" align="center"><br/><?php echo $error; ?></td>
</table>
</form>
</div>
</body>
</html>




<!DOCTYPE html>
<head>
	<title>Asset Management</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="header">
	<h2>Log In</h2>
</div>
	<?php
		$dbhost = "localhost";
 		$dbuser = "root";
 		$dbpass = "";
 		$db = "credentials";
 		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


	?>








	<form class="login" name="myForm" action="index.php" method="post">
		<br>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" placeholder="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password"  placeholder="password">
		</div>
		<input class="btn" id="btn1" type="submit" name="admin" value="AM-Login" formaction="adminAsset.php" formmethod="post"/>
		<input class="btn" id="btn2" type="submit" name="user" value="User-Login" formaction="userAsset.php" formmethod="post"/>
		<input class="btn"  type="reset" name="reset" value="Reset"/>
	
	</form>
	</body>
	</html>





//working copy of adminAsset.php
<!DOCTYPE html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="style.css">
	<SCRIPT language="javascript">
		function addRow(assetEntryTable) {

			var table = document.getElementById("assetEntryTable");

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "text";
			element1.name="srno[]";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "itemDescr[]";
			cell2.appendChild(element2);

			var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
			element3.type = "number";
			element3.name="qty[]";
			cell3.appendChild(element3);

			var cell4 = row.insertCell(3);
			var element4 = document.createElement("input");
			element4.type = "text";
			element4.name = "make[]";
			cell4.appendChild(element4);
		}
	</script>
</head>
<body>

	<div id="adminHeader">
		<h2>ASSET MANAGER</h2>
	</div>
	<b  style="margin-left:400px;">Assign Asset</b>
	<br>
		
 	<form id="assetEntry" name="hello" action="adminAsset.php" method="POST" style="margin-left:400px; ">
 		<div class="input-group">
			<label >Select User</label>
			<select name="userNum" id="userSelector" required">
				<option value="1">User 1</option>
				<option value="2">User 2</option>
				<option value="3">User 3</option>
				<option value="4">User 4</option>
				<option value="5">User 5</option>
				<option value="6">User 6</option>
				<option value="7">User 7</option>
				<option value="8">User 8</option>
				<option value="9">User 9</option>
				<option value="10">User 10</option>
			</select>
		</div>
		
		<table id="assetEntryTable" name="assetEntry" border="1" form="hello" style="width:715px;">
			<tr>
				<th>Sr.No.</th>
				<th>Item Description</th>
				<th>Qty.</th>
				<th>Make</th>
			</tr>
			<tr>
				<td><input type="text" name="srno[]"></td>
				<td><input type="text" name="itemDescr[]"></td>
				<td><input type="number" name="qty[]"></td>
				<td><input type="text" name="make[]"></td>
			</tr>
		<?php 
 		 $dbhost = "localhost";
		 $dbuser = "root";
		 $dbpass = "";
		 $db = "assetmanager";
		 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
		foreach ($_POST["srno"] as $key => $value) {
			$sno=$value;
			$descr=$_POST["itemDescr"][$key];
			$qty=$_POST["qty"][$key];
			$make=$_POST["qty"][$key];
			$q="INSERT INTO userassets ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
			$result=mysqli_query($conn,$q);
		}		
		if($result){?>
			<script>
				alert("Seccuessful!")
			</script>
		<?php    	
		mysqli_close($conn);
	}
?>
 			</table>
 			<input class="btn" id="btn4" type="submit" name="addInput" value="Submit" style="width:80px;margin-top:5px;"/>
 		</form> 
 		<input class="btn" id="btn3" type="button" name="addRow" value="Add Row" onclick="addRow('assetEntryTable')" style="margin-left: 400px; margin-top:5px;"/>	
 	</body>
</html>

//commnented switch for further use
		 /*switch($user)
		 {
		 	case 1: 
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user1 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 2:	
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user2 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 3:	
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user3 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 4:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user4 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 5:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user5 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 6:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user6 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 7:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user7 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 8:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user8 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 9:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user9 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			case 10:
					foreach ($_POST["srno"] as $key => $value) {
						$sno=$value;
						$descr=$_POST["itemDescr"][$key];
						$qty=$_POST["qty"][$key];
						$make=$_POST["make"][$key];
						$q="INSERT INTO user10 ( SerialNo,Description,Quantity,Make ) VALUES( '$sno','$descr','$qty','$make' )";
						$result=mysqli_query($conn,$q);
					}
					break;
			default: echo "Undefined User!";

		 }*/


//index.php actual copy
<!DOCTYPE html>
<head>
	<title>Asset Management</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="header">
	<h2>Log In</h2>
</div>
	<?php
		$dbhost = "localhost";
 		$dbuser = "root";
 		$dbpass = "";
 		$db = "assetmanager";
 		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	?>
	<form class="login" name="myForm" action="index.php" method="post">
		<br>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" placeholder="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password"  placeholder="password">
		</div>
		<input class="btn" id="btn1" type="submit" name="admin" value="AM-Login" formaction="adminAsset.php" formmethod="post"/>
		<input class="btn" id="btn2" type="submit" name="user" value="User-Login" formaction="userAsset.php" formmethod="post"/>
		<input class="btn"  type="reset" name="reset" value="Reset"/>
	
	</form>
	</body>
	</html>





	//userAsset

	if(isset($_POST['request']))
		{		
			//$q="INSERT INTO requeststatus (SerialNo,Description,Quantity,Make) SELECT SerialNo,Description,Quantity,Make FROM userassets";
			$result=mysqli_query($conn,$q);

			foreach ($_POST["transferToUserNo"] as $value) {		
				echo $value." ";
				$q="INSERT INTO requeststatus (userFrom,userTo,SerialNo,Description,Quantity,Make) VALUES ('$user','$value','SerialNo','Description','Quantity','Make')";

				/*"INSERT INTO requeststatus (userFrom,userTo,SerialNo,Description,Quantity,Make) VALUES ('$user','$value',SELECT SerialNo,Description,Quantity,Make FROM userassets)";*/
				//$result=mysqli_query($conn,$q);
		}

	}


	<input type="number" name="transferToUserNo[]"></td>




	 if(isset($_POST['assetSelector2'])){
	        	$q="SELECT userTo FROM requeststatus";
	        $result = mysqli_query($conn, $q);
	        $i=0;
	        if(mysqli_num_rows($result)>0)
	        {
	        	while($row = mysqli_fetch_assoc($result)){
	        		$data[$i]=$row["userTo"];
	        		//echo " ".$data[$i];
	        		$i++;

	        	}
	        }