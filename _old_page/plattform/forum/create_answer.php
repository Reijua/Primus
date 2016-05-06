<html>
<head>
</head>
<body>
<?php
session_start();
$answer =$_POST['answer-text'];
$user_id =$_SESSION['user'];
$post_id =$_POST['post-id'];
$sysdate=date('Y-m-d');

require_once('../scripts/connect_to_db.php');


$sql = "INSERT INTO forum_answer(post_id, user_id, answer_date, answer_text) VALUES ('".$post_id."','".$user_id."','".$sysdate."','".$answer."')";
    
$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

else {
    header('Location:single_post.php?id='.$post_id.'&post_nr=1');
}


?>
    
</body>
</html>