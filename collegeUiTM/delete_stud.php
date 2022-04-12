<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "college";

if (isset($_GET['stud_id'])) {
$user = $_GET['stud_id'];
// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM student WHERE stud_id = '$user'";

if (mysqli_query($conn, $sql)) {
  echo "<script>alert('Rekod telah berjaya dipadam.')</script>";
  echo "<script> window.location.href = 'list.php'; </script>";
} else {
echo "Ralat: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>
