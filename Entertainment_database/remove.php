<?php
 $pid = $_POST['pid'];
 $cid = $_POST['cid'];
 $host = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "entertainment_database";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     
     $DELETE = "Delete from product_owned where pid='$pid' and cid='$cid'";
     
      $stmt = $conn->prepare($DELETE);
      $stmt->execute();
      echo "Record deleted sucessfully";
       $stmt->close();
        $conn->close();
     } 
    
    
?>