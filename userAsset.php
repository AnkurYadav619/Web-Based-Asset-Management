<?php 
	session_start();
?>
<!DOCTYPE html>
<head>
	<title>User</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="adminHeader">
		<h2>Asset User: <?php echo $_SESSION['username'];?></h2>
	</div>
	<b style="margin-left:400px; ">Assigned Assets </b>
 	<table id="assetViewerTable" name="assetView" border="1" style="width:715px; margin-left:400px; ">
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
        session_destroy();
?>
 		</table>
 	</body>
</HTML>