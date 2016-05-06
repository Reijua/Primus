<?php
require_once "scripts/connect_to_db.php";
$sql = "SELECT * FROM abs_class ORDER BY class_id";
	
	$db_erg = mysqli_query($con, $sql)
	            OR die(mysqli_error($con));
	if (!$db_erg) {
	    die('Ungültige Abfrage: ' . mysqli_error());
	}
echo "<select name='class-list'>
        <option value='0'>Klasse:</option>";
    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
    {
        echo "<option value='".$zeile['class_id']."'>".$zeile['class_description']."</option>";
    }

echo "</select>";
mysqli_free_result($db_erg);
?>