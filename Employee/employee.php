<?php
$conn = mysqli_connect("db.com", "root", "", "employee");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT employeeID, firstName, middleName, lastName, position FROM employeeuser";
$result = mysqli_query($conn, $query);
?>

