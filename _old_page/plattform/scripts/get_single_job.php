<?php
$id = $_GET['id'];
require_once "scripts/connect_to_db.php";

$sql = "SELECT * FROM job 
       WHERE job_id=" . $id . "";

$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}
echo "<div id='content-wrapper'>";
while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    echo "<div id='post'>
                    <div id='job-title'>
                            " . $zeile['job_title'] . " 
                    </div>
                    <div id='job-description'>
                            " . $zeile['job_content'] . " 
                    </div>
                 </div>";
}
echo "</div>";
mysqli_free_result($db_erg);
?>