<!-- author:Abhishek Gupta -->
<?php
$cname = $_POST['cname'];
$pid = $_POST['pid'];
$rating = $_POST['rating'];

if (!empty($cname) || !empty($pid) || !empty($rating)) {
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
     $INSERT = "INSERT Into critic (cname, pid, rating) values(?, ?, ?)";
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
      $stmt->bind_param("sis", $cname, $pid, $rating);
      $stmt->execute();
     echo "<script>alert('New record inserted sucessfully: $cname, $pid, $rating')</script> Insertion Successful, You can go back!";
       $stmt->close();
     } 
    
     $conn->close();
    
} else {
 echo "All field are required";
 die();
}
sleep(2);
echo "<script> location.href='form_critic.html'; </script>";
?>