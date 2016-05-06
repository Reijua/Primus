<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
session_start();
$post_text =$_POST['post-text'];
$post_title =$_POST['post-title'];
$user_id =$_SESSION['user'];
$forum_id =$_POST['forum-id'];
$sysdate=date('Y-m-d');

require_once('../scripts/connect_to_db.php');


$sql = "INSERT INTO forum_post( forum_id, user_id, post_date, post_title, post_description) VALUES ('".$forum_id."','".$user_id."','".$sysdate."','".$post_title."', '".$post_text."')";
    
$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

else {
    header('Location:forum.php?id='.$forum_id.'');
}


?>
    
</body>
</html>