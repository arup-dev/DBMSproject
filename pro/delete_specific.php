<!-- author:Abhishek Gupta -->
<?php
 $pid = $_POST['pid'];
 $host = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "entertainment_database";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     
     $DELETE = "Delete from product where pid='$pid'";
     
      $stmt = $conn->prepare($DELETE);
      $stmt->execute();
      echo "Record deleted sucessfully";
       $stmt->close();
        $conn->close();
     } 
    
    
?>
