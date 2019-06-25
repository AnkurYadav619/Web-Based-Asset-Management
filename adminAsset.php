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
		<h2>ASSET MANAGER</h2>
	</div>
	<b  style="margin-left:400px;">Assign Asset</b>
	<br>
		
 	<form id="assetEntry" name="hello" action="adminAsset.php" method="POST" style="margin-left:400px; ">
 		<div class="input-group">
			<label >Select User</label>
			<select name="userNum" id="userSelector" required>
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
	session_destroy();
?>
 			</table>
 		</form> 
 		<input class="btn" id="btn3" type="button" name="addRow" value="Add Row" onclick="addRow('assetEntryTable')" style="margin-left: 400px; margin-top:5px;"/>	
 	</body>
</html>