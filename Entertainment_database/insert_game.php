<!-- author:Abhishek Gupta -->
<?php
$gid = $_POST['gid'];
$gname = $_POST['gname'];
$genre = $_POST['genre'];
$developer = $_POST['developer'];
$platform =$_POST['platform'];

if (!empty($gid) || !empty($gname) || !empty($genre) || !empty($developer) || !empty($platform)) {
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
     $INSERT = "INSERT Into game (gid, gname, genre, developer, platform) values(?, ?, ?,?,?)";
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
      $stmt->bind_param("issss", $gid, $gname, $genre, $developer, $platform);
      $stmt->execute();
      echo "<script>alert('New record inserted sucessfully: $gid, $gname, $genre, $developer, $platform.')</script> Insertion Successful, You can go back!";
       $stmt->close();
     } 
    
     $conn->close();
    
} else {
 echo "Something's Wrong--> ALL FIELDS are required";
 die();
}
sleep(2);
echo "<script> location.href='form_game.html'; </script>";
?>
