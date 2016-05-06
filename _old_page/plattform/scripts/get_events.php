<?php
require_once "scripts/connect_to_db.php";


$sql = "SELECT * FROM event";


$db_erg = mysqli_query($con, $sql);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysqli_error());
}
echo " 
    <div class='event-wrapper'>
    <img class='event-picture' src='/resource/pictures/bg-problem.jpg'/>
    </div>
    <div class='event-overlay'>
      <div class='event-content'>
        <div class='site-bar'>
          <a href='index.php'>
            <div class='pr-picture'></div>
          </a>
          <div class='icon-angle-right'></div>
          <div class='small-text'><strong>Events</strong></div>
        </div>
        <div class='event-upper-content'>
          <h1>Events</h1>
        </div>
      ";

while ($zeile = mysqli_fetch_array($db_erg, MYSQL_ASSOC)) {
    echo "<div class='event-post'>
                    <div class='event-title'>
                      <div class='event-text'>
                        <div class='event-inner-left'>
                          <img class='event-picture' src='" . $zeile['event_picture'] . "'/>
                        </div>
                        <div class='event-inner-right'>
                          <strong>
                            <a href='single_event.php?id=" . $zeile['event_id'] . "'> 
                              " . $zeile['event_title'] . " 
                            </a>
                          </strong></br></br>
                          <p>
                            Read more ... 
                          </p>
                        </div>  
                      </div>
                    </div>
                    <div class='overlay'>
                      <a href='single_event.php?id=" . $zeile['event_id'] . "' class='expand'>+</a>
                      <a class='close-overlay hidden'>x</a>
                    </div>
                 </div>";
}
echo "
    </div>  
  </div>";
mysqli_free_result($db_erg);
?>