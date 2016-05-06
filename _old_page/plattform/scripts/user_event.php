<?php
require_once "connect_to_db.php";
session_start();
$user  = $_SESSION['user'];
$event = $_POST['event'];

$sql = "INSERT INTO userevent(event_id, user_id) VALUES (" . $event . "," . $user . ")";

$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
} else {
    header('Location: /single_event.php?id=' . $event . '');
}
mysqli_free_result($db_erg);
?>