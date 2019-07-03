<?php 
	session_start();
?>
<!DOCTYPE html>
<head>
	<title>User</title>
	<link rel="stylesheet" href="style.css">
	<script>
		function assetView(){
			var a = document.getElementById("assets");
			var b = document.getElementById("form4");

			if(a.style.display ==="none")
			{
				a.style.display = "block";
				b.style.display = "none";
			}
			else
			{
				a.style.display = "none";
			}
		}

		function assetTransfer(){
			var a = document.getElementById("assets");
			var b = document.getElementById("form4");
			
  			if (b.style.display === "none") {
   				 a.style.display = "none";
   				 b.style.display = "block";
  			} else {
   				 b.style.display = "none";
  			}
		}
	</script>
</head>
<body>
<div class="container">
	<div class="adminheader">
		<h2>Asset User: <?php echo $_SESSION['username'];?></h2>
	</div>
	<nav>
			<br>
			<button id="btn4" type="button" onclick="assetView()">View Asset</button>
			<button id="btn5" type="button" onclick="assetTransfer()">Request Transfer</button>
			<a href="index.php">Back to Login</a>
			<a href="logout.php">Logout</a>
			
	</nav>
<article>
<div id="assets">
	<b>Assets</b>
	<br>
	<br>
	<table id="assetViewerTable1" name="assetView" border="1" form="assetViewer">
			<thead>
			<tr>
			   	<th>Sr.No.</th>
				<th>Item Description</th>
				<th>Qty.</th>
				<th>Make</th>
			</tr>
		</thead>
<?php
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "assetmanager";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 		$user=$_SESSION['UserNo']; 
	        $q="Select * from userassets where UserNo=$user";
	        mysqli_query($conn, $q);
	        $result = mysqli_query($conn, $q);
	        $count=mysqli_num_rows($result);
	        if (mysqli_num_rows($result) > 0) 
	        {
			    while($row = mysqli_fetch_assoc($result)) 
			    {
			?>
			        <tr>
			        	<td>
			            <?php
			                echo " " . $row["SerialNo"]. " </td><td>" . $row["Description"]."</td><td> ".$row["Quantity"]."</td><td> ".$row["Make"]." ";
			            ?>
			        	</td>
			    	</tr><?php
				}
			 } else 
			 {}
 mysqli_close($conn);
?>
</table>
</div>
<div id="form4">
	 <form id="assetTransferRequest" name="userAssetViewer" action="userAsset.php" method="POST" >
 		<b>Transfer Asset</b>
 		<br>
 		<br>
			<label >Transfer To:</label>
			<select name="userNum3" id="userSelector3" required>
				<option value="">--Select--</option>
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
			<br>
			<br>
		<table id="assetViewerTable2" name="assetView" border="1" form="assetViewer">
			<tr>
				<th>Mark</th>	
				<th>Sr.No.</th>
				<th>Item Description</th>
				<th>Qty.</th>
				<th>Make</th>
			</tr>
<?php
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "assetmanager";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 		$user=$_SESSION['UserNo']; 
	        $q="Select * from userassets where UserNo=$user";
	        mysqli_query($conn, $q);
	        $result = mysqli_query($conn, $q);
	        $count=mysqli_num_rows($result);
	        if (mysqli_num_rows($result) > 0) 
	        {
			    while($row = mysqli_fetch_assoc($result)) 
			    {
			?>
			        <tr>
			        	<td>
			        		<input type="checkbox" name="assetSelector1[]" value="<?php echo $row["SerialNo"]; ?>"></td>
			        	<td>
			            <?php
			                echo " " . $row["SerialNo"]. " </td><td>" . $row["Description"]."</td><td> ".$row["Quantity"]."</td><td> ".$row["Make"]." ";
			            ?>
			        	</td>
			    	</tr><?php
				}
			 } else 
			 {}
		if(isset($_POST['request']))
		{		
			$checkbox=array();
			$textbox=array();
			$checkbox = $_POST['assetSelector1'];
			if(isset($_POST['userNum3'])){
				$value=$_POST['userNum3'];
			}
			for($i=0;$i<count($checkbox);$i++){
				$del_id = $checkbox[$i];
				$q="INSERT INTO requeststatus (SerialNo,Description,Quantity,Make,userFrom,userTo) SELECT SerialNo,Description,Quantity,Make,'$user' AS userFrom,'$value' AS userTo FROM userassets WHERE SerialNo='$del_id'";
				$result=mysqli_query($conn,$q);
			}
		}
    mysqli_close($conn);
?>
 		</table>
 		<input class="btn" id="btn7" type="submit" name="request" value="Request"/>
 	</form>
 </div>
 </article>
 	</div>
 	</body>
</HTML>