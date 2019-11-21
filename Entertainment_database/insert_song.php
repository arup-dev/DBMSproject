<!-- author:Abhishek Gupta -->
<?php
$sid = $_POST['sid'];
$sname = $_POST['sname'];
$genre = $_POST['genre'];
$singer = $_POST['singer'];

if (!empty($sid) || !empty($sname) || !empty($genre) || !empty($singer)) {
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
     $INSERT = "INSERT Into song (sid, sname, genre, singer) values(?, ?, ?,?)";
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
      $stmt->bind_param("isss", $sid, $sname, $genre, $singer);
      $stmt->execute();
      echo "<script>alert('New record inserted sucessfully: $sid, $sname, $genre, $singer.')</script> Insertion Successful, You can go back!";
       $stmt->close();
     } 
    
     $conn->close();
    
} else {
 echo "Something's Wrong--> ALL FIELDS are required";
 die();
 
}
sleep(2);
echo "<script> location.href='form_song.html'; </script>";
?>
