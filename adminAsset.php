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

		function assetEntry(){
			var x = document.getElementById("form1");
			var y = document.getElementById("form2");
			var z = document.getElementById("form3"); 
			
  			if (x.style.display === "none") {
   				 x.style.display = "block";
   				 y.style.display = "none";
   				 z.style.display = "none";
  			} else {
   				 x.style.display = "none";
  			}
		}

		function assetTransfer(){
			var x = document.getElementById("form1");
			var y = document.getElementById("form2");
			var z = document.getElementById("form3"); 
			
  			if (y.style.display === "none") {
   				 x.style.display = "none";
   				 y.style.display = "block";
   				 z.style.display = "none";

  			} else {
   				 y.style.display = "none";
  			}
		}

		function transferRequest(){
			var x = document.getElementById("form1");
			var y = document.getElementById("form2");
			var z = document.getElementById("form3"); 
			
  			if (z.style.display === "none") {
   				 x.style.display = "none";
   				 y.style.display = "none";
   				 z.style.display = "block";
  			} else {
   				 z.style.display = "none";
  			}
		}
	</script>
</head>
<body>
<div class="container">
	<div class="adminheader">
		<h2>ASSET MANAGER</h2>
	</div>
	<nav>
			<br>
			<button id="btn1" type="button" onclick="assetEntry()">Assign Asset</button>
			<button id="btn2" type="button" onclick="assetTransfer()">Transfer Asset</button>
			<button id="btn3" type="button" onclick="transferRequest()">Transfer Request</button>
			<a href="index.php">Back to Login</a>
			<a href="logout.php">Logout</a>
			
	</nav>
<article>

<div id="form1">		
 	<form id="assetEntry" name="assignAsset" action="" method="POST" >
 		<div class="input-group">
			<b>Assign Asset</b>
			<br>
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
		<input class="btn" id="btn4" type="submit" name="addInput" value="Submit" />
		<table id="assetEntryTable" name="assetEntry" border="1" >
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
  		<input class="btn" id="btn3" type="button" name="addRow" value="Add Row" onclick="addRow('assetEntryTable')" style="background-color: #ccaa66;"/>	
  		</div>
 		<div id="form2">
 		<form id="assetTransfer" name="assetViewer" action="" method="POST">
 		<b align="center">View/Transfer User Asset</b>
 		<br>
 		<br>
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
		<input class="btn" id="btn5" type="submit" name="viewUserAsset" value="View"/>
		<input class="btn" id="btn6" type="submit" name="transferUserAsset" value="Transfer"/>
		<table id="assetViewerTable" name="assetView" border="1" form="assetViewer">
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
 	</div>
 		<div id="form3">
 		<form id="transferRequest" name="processTransferRequest" action="" method="POST">
 		<b>Transfer Request</b>
 		<br>
 		<br>
		<table id="assetViewerTable" name="assetView" border="1" form="assetViewer">
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
				$q = "DELETE FROM requeststatus WHERE SerialNo='$del_id'";
				$result = mysqli_query($conn,$q);
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
 			<input class="btn" id="btn8" type="submit" name="approveRequest" value="Approve"/>
 			<input class="btn" id="btn9" type="submit" name="rejectRequest" value="Reject"/>
 		 </form>
 		</div>
 		</article>
 	    </div>
 	</body>
</html>