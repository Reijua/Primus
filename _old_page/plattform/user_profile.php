<html>
<head>
        <link rel="stylesheet" type="text/css" href="resource/css/main.css"></link>
        <script src="resource/js/classie.js"></script>
         <script type="text/javascript" src="resource/js/functions.js"></script>
        <script>
            window.onload = init();
        </script>
    </head>
<body>
    <?php
    session_start();
    require_once('authenticate.php');
    ?>
    <div id="page-wrapper">
    <?php include 'header.php'; ?>
        <div id="content-wrapper">
            <div class="profile-wrapper">
                <div class="profile-picture"></div>
                <div class="upload-picture-btn">Foto Hochladen</div>
                <div class="profile-information">
                    <form action="scripts/update_social_media.php">
                        <label>Facebook</label>
                        <input name="facebook" type="text">
                        <label>LinkedIn</label>
                        <input name="linkedin" type="text">
                        <label>Xing</label>
                        <input name="xing" type="text">
                </div>
            </div>
            <input type="submit" value="Aktualisieren" class="profile-update-btn">
                </form>
            <div class="profile-event-wrapper">
                <h2>Events an denen ich teilnehme:</h2>
                <?php
                    require_once 'scripts/connect_to_db.php';
                    $sql = "SELECT * FROM userevent INNER JOIN event USING(event_id) WHERE user_id=".$_SESSION['user']." AND event_date > sysdate() ";
                    $db_erg = mysqli_query($con, $sql)
                                OR die(mysqli_error($con));
                    if (!$db_erg) {
                        die('Ungültige Abfrage: ' . mysqli_error());
                    }

                    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
                    {
                        echo "<div class='profile-user-event'><img src='".$zeile['event_picture']."'><a href='/single_event.php?id=".$zeile['event_id']."'>".$zeile['event_title']."</a></div>";
                    }
                
                mysqli_free_result($db_erg);
                ?>
            </div>
            <div class="profile-event-wrapper">
                <h2>Jobs die mich interessieren:</h2>
                
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>    
</body>
</html>