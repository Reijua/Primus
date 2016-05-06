<?php
    session_start();
    require_once('authenticate.php');
?>
<html>
<link rel="stylesheet" type="text/css" href="resource/css/jobs.css">
<link rel="stylesheet" type="text/css" href="resource/css/main.css">
<link rel="stylesheet" type="text/css" href="resource/css/filter-style.css">
<meta charset="utf-8">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="resource/css/main.css"></link>
        <script src="resource/js/classie.js"></script>
         <script type="text/javascript" src="resource/js/functions.js"></script>
        <script>
         window.onload = init();
        </script>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>
        <script>
            $(function() {

              var selectBox = $("select").selectBoxIt();
              $("select").selectBoxIt({

                // Hides the first select box option from appearing when the drop down is opened
                showFirstOption: false
            
              });

            });
        </script>
        <script type="text/javascript">
    
    var filterCounter = 0;
    function changeFilter() {
      if(filterCounter == 1)
        {
          document.getElementById("filter").style.height="auto";
          document.getElementById("filter").style.overflow="visible";
          filterCounter=0;
        }else
        {
          document.getElementById("filter").style.overflow="hidden";
          document.getElementById("filter").style.height="40px";
          filterCounter=1;
        }
    }
    </script>
    </head>
<body>
    <?php include 'header.php'; ?>
        <div id="job-wrapper">                
          <img class='job-picture' src='/resource/pictures/jobs.jpg'/>
        </div>
        <div id="job-content-wrapper">
            <div class='job-overlay'>
              <div class='job-overlay-content'>
                <div class='site-bar'>
                  <a href='index.php'>
                    <div class='pr-picture'></div>
                  </a>
                  <div class='icon-angle-right'></div>
                  <div class='small-text'><strong>Jobs</strong></div>
                </div>
                <div id="filter" class="filter-wrapper">
                  <div class="filter-bar"><a href="javascript:changeFilter()">
                    <img class="toggle-filter"src="resource/pictures/plus.png" /></a>
                  </div>
                  <div class="filter-column">
                    <div class="filter-head">
                      Datum
                    </div>
                    <div class="filter-center">
                      <input type="radio" name="First" value="Aufsteigend" checked> Hochladedatum<br>
                    </div>
                  </div>
                  <div class="filter-column">
                    <div class="filter-head">
                      Gehalt
                    </div>
                    <div class="filter-center">
                      <input type="radio" name="First" value="Aufsteigend" > Aufsteigend<br>
                      <input type="radio" name="First" value="Absteigend" > Absteigend
                    </div>
                  </div>
                  <div class="filter-column">
                    <div class="filter-head">
                      Branche
                    </div>
                    <div class="filter-center">
                      <?php include 'scripts/get_filter_jobs.php';?>
                    </div>
                  </div>
                  <div class="filter-end">

                    <img src="resource/pictures/arrow.png" />
                  </div>
                </div>
                <?php include 'scripts/get_jobs.php' ?>
             </div>
           </div>
        </div>
        <?php include 'footer.php'; ?>
    </div> 
    
</body>
</html>