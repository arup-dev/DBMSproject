<!-- author:Abhishek Gupta -->
<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
	<h1> Movies: 
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Rating</th>
<th>Add to wishlist</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "entertainment_database");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT pid,pname,rating FROM product WHERE category='Movie' ORDER BY rating DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["pid"]. "</td><td>" . $row["pname"] . "</td><td>"
. $row["rating"]."</td><td><form method='post' action='insert_productown.php'><input type='text' name='cid' placeholder='CID'><input type='hidden' name='pid' value='".$row["pid"]."'><button type='submit'>ADD</button></form></td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>