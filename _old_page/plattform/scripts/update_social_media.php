<?php

session_start();
require_once "connect_to_db.php";

$facebook = $_GET['facebook'];
$linkedin = $_GET['linkedin'];
$xing = $_GET['xing'];

$sql = "UPDATE user SET facebook='".$facebook."', linkedin='".$linkedin."', xing='".$xing."' WHERER user_id=".$_SESSION['user']." ";
$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

mysqli_free_result( $db_erg );
?>