<?php
require_once "connect_to_db.php";
session_start();
$user = $_POST['user'];
$password = $_POST['pass'];
$hash_password = md5($password);
$last_login =date("Y-m-d H:i:s");
if (!empty($user))
	{
	$sql = "SELECT * FROM user where nickname='" . $user . "' AND user_password='" . $hash_password . "'";
	$db_erg = mysqli_query($con, $sql);
	if ($db_erg->num_rows == 0)
		{
		header("Location:/login.php?login=false");
		}
	  else
		{
		$row = mysqli_fetch_array($db_erg) OR die(mysqli_error($con));
		if (!empty($row['nickname']) AND !empty($row['user_password']))
			{
			$_SESSION['nickname'] = $row['user_password'];
			$_SESSION['user'] = $row['user_id'];
			$_SESSION['logged_in'] = true;
            
            $sql_update = "UPDATE user SET last_login='".$last_login."' WHERE user_id = '".$row['user_id']."'";
            $db_update = mysqli_query($con, $sql_update);
            if (!$db_update)
            {
                die('Ungültiger Query: '.mysqli_error());
            }
            
			header("Location: /index.php");
			}
		}
	}
  else
	{
	header("Location:/login.php");
	}
mysqli_free_result($db_erg);
mysqli_free_result($db_update);

?>