<?php
require_once "scripts/connect_to_db.php";

$sql = "SELECT * FROM jobtype";

$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

echo "<form name='formFilter' action='jobs.php' method='post'>
        <select name='job_category'>
            <option value='0'> Alle </option>";
while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    echo "<option value='" . $zeile['type_id'] . "'>" . $zeile['type_description'] . "</option>";
}
echo "</select></form>";
mysqli_free_result($db_erg);
?>