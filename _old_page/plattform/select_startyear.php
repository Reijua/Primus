<?php
require_once "scripts/connect_to_db.php";
$sql = "SELECT * FROM abs_start ORDER BY start_id";
	
	$db_erg = mysqli_query($con, $sql)
	            OR die(mysqli_error($con));
	if (!$db_erg) {
	    die('Ungültige Abfrage: ' . mysqli_error());
	}
echo "<select name='start-list'>
        <option value='0'>Jahrgang:</option>";
    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
    {
        echo "<option value='".$zeile['start_id']."'>".$zeile['start_year']."</option>";
    }

echo "</select>";
mysqli_free_result($db_erg);
?>