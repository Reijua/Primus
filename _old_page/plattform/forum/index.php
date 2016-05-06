<?php
    session_start();
    require_once('authenticate.php');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link type="text/css" rel="stylesheet" href="resource/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="../resource/css/main.css"></link>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../resource/js/classie.js"></script>
        <script type="text/javascript" src="../resource/js/functions.js"></script>
        <script>
         window.onload = init();
        </script>
    </head>
    <body>
        <div class='site-wrapper'>
            <?php include ('header.php'); ?>
            <div class='forum-image-wrapper'>                
                <img class='forum-picture' src='/resource/pictures/forum.png'/>
            </div>
            <div class='forum-content-wrapper'>
                <div class='forum-overlay'>
                    <div class='forum-overlay-content'>
                        <div class='site-bar'>
                          <a href='index.php'>
                            <div class='pr-picture'></div>
                          </a>
                          <div class='icon-angle-right'></div>
                          <div class='small-text'><strong>Forum</strong></div>
                        </div>
                        <?php include('get_forums.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>