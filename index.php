<!DOCTYPE html>
<head>
	<title>Asset Management</title>
	<link rel="stylesheet" href="style.css">
	<?php
session_start();
if(isset($_POST["login"])){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "assetmanager";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	    $result = mysqli_query($conn,"SELECT * FROM credentials WHERE (username = '" . mysqli_real_escape_string($conn,$_POST['username']) . "') and (password = '" . mysqli_real_escape_string($conn,$_POST['password']) . "')");

	    if (mysqli_num_rows($result) > 0) 
	    {
	        while($row = mysqli_fetch_assoc($result))
	        {

	            if ($row["accessLevel"] == '1') 
	            {
	                $_SESSION['username'] = $_POST['username'];
	                $_SESSION['UserNo'] = $row['UserNo'];
	                header('Location:adminAsset.php');

	            }
	            elseif ($row["accessLevel"] == '2') 
	            {
	                $_SESSION['username'] = $_POST['username'];
	                $_SESSION['UserNo'] = $row['UserNo'];
	                header('Location:userAsset.php');
	                
	            }
	            
	        }

	    }
	     else 
	            {?>  
	                <script>
	                    alert("Invalid User")
	                </script> 
	            <?php
	            }
  }

?>	
</head>
<body>
	<div class="header">
	<h2>Log In</h2>
</div>
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
		<input class="btn" id="btn1" type="submit" name="login" value="Login">
		<input class="btn"  type="reset" name="reset" value="Reset"/>
	
	</form>
	</body>
	</html>