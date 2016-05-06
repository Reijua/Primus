
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <link rel="stylesheet" type="text/css" href="resource/css/single-events.css"/>
<?php
$id = $_GET['id'];
$x = 0;
$y = 0;
require_once "scripts/connect_to_db.php";

$sql = "SELECT event_title, event_description, event_location_x, event_location_y FROM event 
       WHERE event_id=".$id."";
 
$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
echo "<div class='event-wrapper'>
        <img class='event-picture' src='/resource/pictures/bg-problem.jpg'/>
      </div>
      <div class='event-overlay'>
        <div class='event-content'>
          <div class='site-bar'>
            <a href='index.php'>
              <div class='pr-picture'></div>
            </a>
            <div class='icon-angle-right'></div>
            <div class='small-text'>
              <a href='events.php'>
                Events
              </a>
            </div>
        </div>
";
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            echo "<div id='post'>
                    <h1> ".$zeile['event_title']." </h1>
                    <div class='job-description'>
                            ".$zeile['event_description']." 
                    </div>
                 </div>";
            $x=$zeile['event_location_x'];
            $y=$zeile['event_location_y'];
        }
echo"
        <div id='map'></div>
        <script type='text/javascript'> 
          var myOptions = {
             zoom: 8,
             center: new google.maps.LatLng(".$x.",".$y."),
             mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById('map'), myOptions);
        </script> 
      </div>";
mysqli_free_result( $db_erg );
?>