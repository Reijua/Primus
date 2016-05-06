<html>
<head>
</head>
<body>
<?php
$nickname = $_POST['nickname'];
$birthdate_day = $_POST['birthdate-day'];
$birthdate_month = $_POST['month-list'];
$birthdate_year = $_POST['birthdate-year'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];
$forename = $_POST['forename'];
$place = $_POST['place'];
$plz = $_POST['plz'];
$address = $_POST['address'];
$name = $_POST['name'];
$abs_grad = $_POST['grad-list'];
$abs_class = $_POST['class-list'];
$start_year = $_POST['start-list'];
$user_password = $_POST['password'];
$hash_password = md5($user_password);
$sysdate=date("Y-m-d");

$string_birthdate = $birthdate_year."-".$birthdate_month."-".$birthdate_day;
$birthdate = $string_birthdate;


require_once "scripts/connect_to_db.php";

$sql_nickname_exists = "SELECT * FROM user WHERE nickname = '$nickname'";
$db_nickname_exists = mysqli_query($con, $sql_nickname_exists)
            OR die(mysqli_error($con));
if ($db_nickname_exists->num_rows != 0) {
    Header("Location: /registration.php?valid_nickname=false");
    mysqli_free_result($db_nickname_exists);
}

$sql_email_exists = "SELECT * FROM user WHERE email = '$email'";
$db_email_exists = mysqli_query($con, $sql_email_exists)
            OR die(mysqli_error($con));
if ($db_email_exists->num_rows != 0) {
    Header("Location: /registration.php?valid_email=false");
    mysqli_free_result($db_email_exists);
}

else{
	$sql = "INSERT INTO user (nickname, user_password, registrationDate, birthdate, phonenumber, email, forename, name, plz, address, class_id, grad_id, place, start_id) VALUES ('$nickname','$hash_password','$sysdate','$birthdate','$phonenumber','$email','$forename','$name','$plz','$address','$abs_class','$abs_grad','$place','$start_year')";
	
	$db_erg = mysqli_query($con, $sql)
	            OR die(mysqli_error($con));
	if (!$db_erg) {
	    die('Ungültige Abfrage: ' . mysqli_error());
	}
    
    include 'send_mail.php' ;
	Header("Location: login.php");
    
	}

mysqli_free_result($db_erg);

?>
    
</body>
</html>