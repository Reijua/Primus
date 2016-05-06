<?php
require_once "scripts/connect_to_db.php";
$sql = "SELECT * FROM abs_grad ORDER BY grad_id";
	
	$db_erg = mysqli_query($con, $sql)
	            OR die(mysqli_error($con));
	if (!$db_erg) {
	    die('Ungültige Abfrage: ' . mysqli_error());
	}
echo "<select name='grad-list'>
        <option value='0'>Abschlussjahr:</option>";
    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
    {
        echo "<option value='".$zeile['grad_id']."'>".$zeile['grad_year']."</option>";
    }

echo "</select>";
mysqli_free_result($db_erg);
?>