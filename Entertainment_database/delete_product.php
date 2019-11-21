<!-- author:Abhishek Gupta -->
<!DOCTYPE html>
<html>
<body>

<h1>Deletion</h1>


<?php

 $host = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "entertainment_database";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     
     $DELETE = "Delete from product";
     
      $stmt = $conn->prepare($DELETE);
      $stmt->execute();
     echo "<h3><b>All records deleted sucessfully!</b></h3>";
       $stmt->close();
        $conn->close();
     } 
    
    
?>
