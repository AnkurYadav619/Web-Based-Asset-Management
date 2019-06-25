<?php
session_start();
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
?>