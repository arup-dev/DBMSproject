<!-- author:Abhishek Gupta -->
<?php
$cid = $_POST['cid'];
$pid = $_POST['pid'];


if (!empty($cid) || !empty($pid)  ) {
 $host = "localhost:3306";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "entertainment_database";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     // $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into product_owned (cid, pid) values(?, ?)";
     //Prepare statement
     // $stmt = $conn->prepare($SELECT);
     // $stmt->bind_param("s", $email);
     // $stmt->execute();
     // $stmt->bind_result($email);
     // $stmt->store_result();
     // $rnum = $stmt->num_rows;
     // if ($rnum==0) {
      // $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ii", $cid, $pid);
      $stmt->execute();
      echo "New record inserted sucessfully";
       $stmt->close();
     } 
    
     $conn->close();
    
} else {
 echo "All field are required";
 die();
}
?>
