<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link type="text/css" rel="stylesheet" href="resource/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../resource/css/main.css"></link>
        <script src="../resource/js/classie.js"></script>
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
$post_site = $_GET['post_nr'];

if(isset($_GET['post_nr']))
{
    $post_site = $_GET['post_nr'];
}

$limit = $post_site-1;

require_once('../scripts/connect_to_db.php');


// Query für Posts
$sql = "SELECT * FROM forum_post INNER JOIN user USING (user_id)
       WHERE post_id=" . $id . "";

$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

echo "
    <div class='forum-margin-wrapper'>
      <div class='forum-wrapper'>
        <table class='flat-table'>
         
            <tr class='heading-tr'>
                <td> Autor </td>
                <td> Nachricht </td>
            </tr>";

 while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            echo "<tr class='tr-noborder'>
                 <td> </td>
                 <td class='td-bold'>".$zeile['post_title']."</td>
                 </tr>
                <tr >
                <td class='td-align-middle'>".$zeile['nickname']."</td>
                <td>".$zeile['post_description']."</td>
               </tr>";
        }

$sql_answers = "SELECT * FROM forum_answer INNER JOIN user USING(user_id) INNER JOIN forum_post USING(post_id)
       WHERE forum_answer.post_id=".$id." ORDER BY answer_id ASC LIMIT ".$limit."0,10";

$db_answers = mysqli_query($con, $sql_answers);
if (!$db_answers) {
    die('Ungültige Abfrage: ' . mysqli_error());
}

while ($zeile = mysqli_fetch_array( $db_answers, MYSQL_ASSOC))
        {
            echo "<tr class='tr-noborder'>
                 <td> </td>
                 <td class='td-bold'> Re: ".$zeile['post_title']."</td>
                 </tr>
                <tr>
                <td class='td-align-middle'>".$zeile['nickname']."</td>
                <td>".$zeile['answer_text']."</td>
               </tr>";
        }


echo "</table></div>";
include('check_cnt_answers.php');
echo "
      <div id='after-forum' >
      <form method='post' action='create_answer.php'>
      <textarea name='answer-text'></textarea>
      <input type='hidden' name='post-id' value='".$id."'></input>
      <input class='bt-answer' type='submit' value='Antworten'/>
      </form>
       </div></div>";

mysqli_free_result( $db_erg );

?>
    </body>
</html>