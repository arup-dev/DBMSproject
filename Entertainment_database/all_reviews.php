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
<table>
<tr>
<th>Name</th>
<th>Rating</th>
</tr>

<?php
$pid = $_POST['pid'];
$conn = mysqli_connect("localhost:3306", "root", "", "entertainment_database");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT cname,rating FROM critic where pid='$pid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["cname"]. "</td><td>" . $row["rating"] ."</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();

?>
</table>
</body>
</html>