<?php
require_once "scripts/connect_to_db.php";
$sql = "SELECT * FROM user WHERE user_id =".$_SESSION['user']."";
$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

echo "<div id='profile-wrapper'>";
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            echo "<div id='user-nickname'>
				  ".$zeile['nickname']."
                 </div>
                 <div id='user-email'>".$zeile['email']."</div>";
                 
        }
echo "</div>";
mysqli_free_result( $db_erg );
?>