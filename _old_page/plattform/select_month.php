<?php
require_once "scripts/connect_to_db.php";
$sql = "SELECT * FROM month ORDER BY month_id";
	
	$db_erg = mysqli_query($con, $sql)
	            OR die(mysqli_error($con));
	if (!$db_erg) {
	    die('Ungültige Abfrage: ' . mysqli_error());
	}
echo "<select name='month-list'>
        <option value='0'>Monat:</option>";
    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
    {
        echo "<option value='".$zeile['month_id']."'>".$zeile['month_name']."</option>";
    }

echo "</select>";
mysqli_free_result($db_erg);
?>