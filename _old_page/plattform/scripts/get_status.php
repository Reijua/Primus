<?php
require_once "scripts/connect_to_db.php";

$sql = "SELECT text,picture,title FROM status";
 
$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
echo "<div id='content-wrapper'>
		<div class='status-border'>";
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
        echo " <div class='single-post'>
	        		
					<div class='status-text'>
	               	 	<h1> ".$zeile['title']."</h1>";
	               	 	if ( ! empty ($zeile['picture'] ))
						{
						echo"
							<div class='status-tex-left'>
	            				<img src='".$zeile['picture']."'/>
							</div>";
						  
						}
						echo"
							<div class='status-tex-right'>
	                			<p >".$zeile['text']."</p>
	                		</div>
					</div>
					<div class='status-date'>
						<p><strong>Details :</strong> Ver&oumlffentlicht: 25. Mai 2014</p>
					</div>
				 </div>";
        }
echo "	</div>";
mysqli_free_result( $db_erg );
?>