<?php
// Erstelle connection
$con=mysqli_connect("mysqlsvr35.world4you.com","sql2130577","9gs6qsz","2130577db1");
// Überprüfe connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($con,"utf8");
?>