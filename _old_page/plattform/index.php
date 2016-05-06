<?php
    session_start();
    require_once('authenticate.php');
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/resource/css/main.css"></link>
        <link rel="stylesheet" type="text/css" href="/resource/css/framework.css"></link>
        <link rel="stylesheet" type="text/css" href="/resource/css/icon.css"></link>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
          <script type="text/javascript" src="/resource/js/system.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(this).initMobileMenu();
            });
        </script>
    </head>
<body bgcolor="#F7F7F7">
    
    <?php include 'header.php'; ?>
    <?php include 'scripts/get_status.php'; ?>
    <?php include 'footer.php'; ?>
</body>
</html>