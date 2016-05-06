<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link type="text/css" rel="stylesheet" href="resource/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../resource/css/main.css"></link>
        <script type="text/javascript" src="../resource/js/functions.js"></script>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="resource/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
        });
        </script>
    </head>
    <body>
<?php include ('header.php'); ?>
<?php
$id = $_GET['id'];
require_once('../scripts/connect_to_db.php');

$sql = "SELECT * FROM forum_post INNER JOIN user USING (user_id)
       WHERE forum_id=" . $id . "";
    
$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

echo "
            <div class='forum-margin-wrapper'>
                <div class='forum-wrapper'>
                    <table class='flat-table'>
                        <tr class='heading-tr'>
                            <td> Posts </td>
                            <td> Von </td>
                            <td> Antworten </td>
                            <td> Datum </td>
                        </tr";

        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            //Anzahl Antworten
            $sql_answers = "SELECT * FROM forum_answer
                WHERE post_id = ".$zeile['post_id']."";
            $db_answers = mysqli_query($con, $sql_answers);
            if (!$db_answers) {
                die('Ungültige Abfrage: ' . mysqli_error());
            }
             $row_cnt = $db_answers->num_rows;

        echo " <tr>
                <td class='td-bold'><a href='single_post.php?id=".$zeile['post_id']."&post_nr=1'/>".$zeile['post_title']."</td>
                <td>".$zeile['nickname']."</td>
                <td> ".$row_cnt."</td>
                <td>".$zeile['post_date']."</td>
               </tr>";
        }
echo "</table>
      </div>";

echo "<div id='after-forum' >
      <form method='post' action='create_post.php'>
          <label class='post-schreiben'> Post schreiben </label>
          <input class='textbox-title' placeholder='Titel' name='post-title'></input>
          <textarea name='post-text'></textarea>
          <input type='hidden' name='forum-id' value='".$id."'></input>
          <input class='bt-answer' type='submit' value='Erstellen'/>
      </form></div></div>";

mysqli_free_result( $db_erg );

?>
    </body>
</html>