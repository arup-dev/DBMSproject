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
	<h1>Products
	:
<table>
<tr>
<th>Product ID</th>
<th>Name</th>
<th>Category</th>
<th>Rating</th>
<th>Reviews(Decide average rating)</th>
</tr>
<?php
$conn = mysqli_connect("localhost:3306", "root", "", "entertainment_database");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM product ORDER BY category";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["pid"]. "</td><td>" . $row["pname"] . "</td><td>"
. $row["category"]."</td><td>" . $row["rating"]. "</td><td><form method='post' action='all_reviews.php'><input type='hidden' name='pid' value='".$row["pid"]."'><button type='submit'>Reviews</button></form></td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>