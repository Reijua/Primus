<html>
<link rel="stylesheet" type="text/css" href="resource/css/jobs.css">
<link rel="stylesheet" type="text/css" href="resource/css/main.css">
<head>
        <link rel="stylesheet" type="text/css" href="resource/css/main.css"></link>
        <script src="resource/js/classie.js"></script>
        <script>
	        
	    function init() {
                window.addEventListener('scroll', function(e){
                    var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                        shrinkOn = 50,
                        header = document.querySelector("header");
                    if (distanceY > shrinkOn) {
                        classie.add(header,"smaller");
                    } else {
                        if (classie.has(header,"smaller")) {
                            classie.remove(header,"smaller");
                        }
                    }
                });
            }
            window.onload = init();
        </script>
    </head>
<body>
    <div id="page-wrapper">
    <?php include 'header.php'; ?>
    <?php include 'scripts/get_single_job.php'?>
    </div>    
    <?php include 'footer.php'; ?>
</body>
</html>