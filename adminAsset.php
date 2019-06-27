<?php 
	session_start();
?>
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
		<h2 style="margin-left:150px;" >ASSET MANAGER</h2>
		<a style="text-decoration: none;float:right;margin-left:15px;" href="logout.php">Logout</a>
		<a style="text-decoration: none;float:right;" href="index.php">Back to Login</a>
		
	</div>
		
 	<form id="assetEntry" name="hello" action="adminAsset.php" method="POST" style="margin-left:400px;margin-right: 220px; ">
 		<div class="input-group">
			<b  style="margin-left:280px;">Assign Asset</b>
			<br>

			<label >Select User</label>
			<select name="userNum" id="userSelector1" required>
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

			
		</div>
		<input class="btn" id="btn4" type="submit" name="addInput" value="Submit" style="width:80px;margin-top:5px;"/>
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
		 if(isset($_POST["userNum"])){
		 	$user  =$_POST["userNum"];
		 }

		 if(isset($_POST["addInput"])){
		foreach ($_POST["srno"] as $key => $value) {
			$sno=$value;
			$descr=$_POST["itemDescr"][$key];
			$qty=$_POST["qty"][$key];
			$make=$_POST["make"][$key];
			$q="INSERT INTO userassets ( UserNo,SerialNo,Description,Quantity,Make ) VALUES( '$user','$sno','$descr','$qty','$make' )";
			$result=mysqli_query($conn,$q);
		}		
		if($result){?>
			<script>
				alert("Succuessful!")
			</script>
		<?php  }  	
		mysqli_close($conn);
	}
?>
 			</table>
 		</form> 
 		<input class="btn" id="btn3" type="button" name="addRow" value="Add Row" onclick="addRow('assetEntryTable')" style="margin-left: 400px; margin-top:5px;"/>	

 		<br>
 		<br>
 		<form id="assetTransfer" name="assetViewer" action="adminAsset.php" method="POST" style="margin-left:400px;margin-right: 220px; ">
 		<b  style="margin-left:280px;">View/Transfer User Asset</b>
 		<div class="input-group">
			<label >From User:</label>
			<select name="userNum" id="userSelector2" required>
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

			<label >To User:</label>
			<select name="userNum2" id="userSelector3">
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
		</div>
		<input class="btn" id="btn5" type="submit" name="viewUserAsset" value="View" style="width:80px;margin-top:5px;"/>
		<input class="btn" id="btn6" type="submit" name="transferUserAsset" value="Transfer" style="width:80px;margin-top:5px;"/>
		<table id="assetViewerTable" name="assetView" border="1" form="assetViewer" style="width:715px;">
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
 		if(isset($_POST["userNum"])){
		 	$user  =$_POST["userNum"];
		 }
		 if(isset($_POST["userNum2"])){
		 	$user2  =$_POST["userNum2"];
		 }
		 if(isset($_POST["viewUserAsset"])){ 
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
			        		<input type="checkbox" name="assetSelector[]" value="<?php echo $row["SerialNo"]; ?>"></td>
			        		<td>
			            <?php
			                echo " " . $row["SerialNo"]. " </td><td>" . $row["Description"]."</td><td> ".$row["Quantity"]."</td><td> ".$row["Make"]." ";
			        
			            ?>
			        	</td>
			    	</tr><?php
				}
			 } else 
			 {}
		}
		if(isset($_POST['transferUserAsset']))
		{	
			$checkbox=array();
			$checkbox = $_POST['assetSelector'];
			for($i=0;$i<count($checkbox);$i++)
			{
				$del_id = $checkbox[$i];
				$sql = "UPDATE userassets SET UserNo='$user2' WHERE SerialNo='$del_id'";
				$result = mysqli_query($conn,$sql);
			}	
		}
    mysqli_close($conn);
?>
 			</table>
 			
 		</form>

 		<br>
 		<br>
 		<form id="assetTransfer" name="assetViewer" action="adminAsset.php" method="POST" style="margin-left:400px;margin-right: 220px; ">
 		<b  style="margin-left:280px;">Transfer Request</b>
		<table id="assetViewerTable" name="assetView" border="1" form="assetViewer" style="width:715px;">
			<tr>
				<th>Mark</th>
				<th>Sr.No.</th>
				<th>Item Description</th>
				<th>Qty.</th>
				<th>Make</th>
				<th>From User</th>
				<th>To User</th>
			</tr>
<?php
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "assetmanager";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
		 if(isset($_POST["viewRequest"])){ 
	        $q="SELECT * FROM requeststatus WHERE Approved=0";
	        $result = mysqli_query($conn, $q);
	        if (mysqli_num_rows($result) > 0) 
	        {
			    while($row = mysqli_fetch_assoc($result)) 
			    {
			?>
			        <tr>
			        	<td>
			        		<input type="checkbox" name="assetSelector2[]" value="<?php echo $row["SerialNo"]; ?>"></td>
			        		<td>
			            <?php
			                echo " " . $row["SerialNo"]. " </td><td>" . $row["Description"]."</td><td> ".$row["Quantity"]."</td><td> ".$row["Make"]."</td><td>".$row["userFrom"]."</td><td>".$row["userTo"]." ";
			        
			            ?>
			        	</td>
			    	</tr><?php
				}
			 } else 
			 {}
		}
		//APPROVE BUTTON
		if(isset($_POST['approveRequest']))
		{	
			$checkbox=array();
			$checkbox = $_POST['assetSelector2'];
			for($i=0;$i<count($checkbox);$i++)
			{	
				
				$del_id = $checkbox[$i];
				$sql = "UPDATE userassets SET UserNo= (Select userTo from requeststatus WHERE SerialNo='$del_id') where SerialNo='$del_id' ";
				$result = mysqli_query($conn,$sql);
			}	
		
		}
		//REJECT BUTTON
		if(isset($_POST['rejectRequest']))
		{	
			$checkbox=array();
			$checkbox = $_POST['assetSelector2'];
			for($i=0;$i<count($checkbox);$i++)
			{	
				$del_id = $checkbox[$i];
				$sql = "DELETE FROM requeststatus WHERE SerialNo='$del_id'";
				$result = mysqli_query($conn,$sql);
			}	
		}
    mysqli_close($conn);
?>
 			</table>
 			<input class="btn" id="btn8" type="submit" name="viewRequest" value="View" style="width:80px;margin-top:5px;"/>
 			<input class="btn" id="btn9" type="submit" name="approveRequest" value="Approve" style="width:80px;margin-top:5px;"/>
 			<input class="btn" id="btn10" type="submit" name="rejectRequest" value="Reject" style="width:80px;margin-top:5px;"/>
 		</form>

 	</body>
</html>