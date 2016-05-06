<?php
    session_start();
    require_once('authenticate.php');
?>
<html>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="resource/css/jobs.css">
<link rel="stylesheet" type="text/css" href="resource/css/main.css">
<link rel="stylesheet" type="text/css" href="resource/css/events.css">
<head>
        <link rel="stylesheet" type="text/css" href="resource/css/main.css"></link>
        <script src="resource/js/classie.js"></script>
		<script type="text/javascript" src="resource/js/functions.js"></script>
        <script>
         window.onload = init();
        </script>    </head>
<body>
    <?php include 'header.php'; ?>
            <?php include 'scripts/get_events.php'?>
        </div>
    </div>  
    <?php include 'footer.php'; ?>
</body>
</html>