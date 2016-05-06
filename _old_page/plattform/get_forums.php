<?php
require_once('../scripts/connect_to_db.php');

$sql = "SELECT * FROM forum";

$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

echo "<div class='forum-wrapper'>
        <table class='flat-table'>
            <tr class='title-tr'>
                <td class='title-td' colspan='2'>Primus Romulus Forum </td>
            </tr>
            <tr class='heading-tr'>
                <td> Foren </td>
                <td> Eintr&auml;ge </td>
            </tr";

        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            //Anzahl Einträge
            $sql_entries = "SELECT * FROM forum_post
                            WHERE forum_id = ".$zeile['forum_id']."";
            $db_entries = mysqli_query($con, $sql_entries);
            if (!$db_entries) {
                die('Ungültige Abfrage: ' . mysqli_error());
            }
             $row_cnt = $db_entries->num_rows;
            
        echo " <tr>
                <td class='td-bold'><a href='forum.php?id=".$zeile['forum_id']."'/>".$zeile['forum_title']."</td>
                <td>".$row_cnt."</td>
               </tr>";
        }
echo "</table> </div>";
mysqli_free_result( $db_erg );
?>