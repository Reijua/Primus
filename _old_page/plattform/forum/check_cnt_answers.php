<?php
require_once('../scripts/connect_to_db.php');
$id = $_GET['id'];
$post_cnt = 0;
$post_nr = 1;

$sql = "SELECT * FROM forum_answer INNER JOIN forum_post USING(post_id)
       WHERE forum_answer.post_id=".$id."";

$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

$row_cnt = $db_erg->num_rows;
if($row_cnt >10)
{
    $post_cnt = floor($row_cnt / 10);
}

echo "<div class='post-wrapper'><div class='post-count'><a href='single_post.php?id=".$id."&post_nr=".$post_nr."'/>".$post_nr."</div>";
if ($post_cnt > 0)
{
    while($post_cnt > 0)
    {
        $post_cnt--;
        $post_nr++;
        echo "<div class='post-count'><a href='single_post.php?id=".$id."&post_nr=".$post_nr."'/>".$post_nr."</div>";
        
    }
}
echo"</div>";
?>