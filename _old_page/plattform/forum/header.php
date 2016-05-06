<head>
<meta charset="utf-8" />
<script type="text/javascript">
    
    var changeCounter = 0;
    function changeFooter() {
        if(changeCounter == 0)
        {
            document.getElementById("idfooter").style.height="120px";
            document.getElementById("idfootera").style.margin="70px 0px 0px 20px";
            changeCounter=1;
        }else
        {
            document.getElementById("idfooter").style.height="45px";
            document.getElementById("idfootera").style.margin="150px 0px 0px 20px";
            changeCounter=0;
        }
    }
    </script>
</head>
<body>
<header>
    <section><a href="../index.php">
        <img src="../resource/pictures/logo.png" /></a>
    </section>
    <nav class="mobile-bar">
        
    </nav>
    <nav class="desktop-bar">
        <ul>
            <li>
                <a href="../index.php">Startseite</a>
            </li>
            <li>
                <a href="../jobs.php">Jobs</a>
            </li>
            <li>
                <a href="../events.php">Events</a>
            </li>
            <li>
                <a href="..//forum/">Forum</a>
            </li>
            <li>
                <a href="../logout.php">Logout</a>
            </li>
        </ul>
    </nav>
</header>
<footer>
    <div id="idfooter" class="mobile-footer">
        <div class="mobile-button-space">
            <div class="mobile-column">
                <div class="mobile-set-center">
                    <a  href="../index.php"class="mobile-user-button" style="background-image:url(../resource/pictures/bt_home.png)" ></a>
                </div>
            </div>
            <div class="mobile-column">
                <div class="mobile-set-center">
                    <a  href="../events.php"class="mobile-user-button" style="background-image:url(../resource/pictures/bt_event.png)" ></a>
                </div>
            </div>
            <div class="mobile-column">
                <div class="mobile-set-center">
                    <a  href="../jobs.php"class="mobile-user-button" style="background-image:url(../resource/pictures/bt_jobs.png)" ></a>
                </div>
            </div>
            <div class="mobile-column">
                <div class="mobile-set-center">
                    <a  href="..//forum/"class="mobile-user-button" style="background-image:url(../resource/pictures/bt_forum.png)" ></a>
                </div>
            </div>                  
        </div>
        <a href="javascript:changeFooter()">
            <div class="mobile-settings">
                <div class="mobile-circle"></div>
                <div class="mobile-circle"></div>
                <div class="mobile-circle"></div>
            </div>
        </a>
        <div class="mobile-text-space">
            <div class="mobile-column">
                <label>Startseite</label>
            </div>
            <div class="mobile-column">
                <label>Events</label>
            </div>
            <div class="mobile-column">
                <label>Jobs</label>
            </div>
            <div class="mobile-column">
                <label>Forum</label>
            </div>          
        </div>
        <div id="idfootera" class="mobile-text">
            <a href="../logout.php" >Logout</a>
        </div>
    </div>
    </footer>
<script src="resource/js/classie.js"></script>
<script src="resource/js/nav.js"></script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34160351-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>

<!-- /header -->