<!-- author:Abhishek Gupta -->

<?php
$mid = $_POST['mid'];
$mname = $_POST['mname'];
$genre = $_POST['genre'];
$director = $_POST['director'];
$length = $_POST['length'];

if (!empty($mid) || !empty($mname) || !empty($genre) || !empty($director) || !empty($length) ) {
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
     $INSERT = "INSERT Into movie (mid, mname, genre, director, length) values(?, ?, ?, ?, ?)";
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
      $stmt->bind_param("issss", $mid, $mname, $genre, $director, $length);
      $stmt->execute();
      echo "<script>alert('New record inserted sucessfully: $mid, $mname, $genre, $director, $length.')</script> Insertion Successful, You can go back!";
       $stmt->close();
     } 
    
     $conn->close();
    
} else {
 echo "All field are required";
 die();
}
sleep(2);
echo "<script> location.href='form_movie.html'; </script>";
?>
