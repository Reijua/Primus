<html>
    <head>
        <body>
            <?php
            // Erstelle connection
            $con=mysqli_connect("mysqlsvr35.world4you.com","sql2130577","9gs6qsz","2130577db1");
            // Überprüfe connection
            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            
            $sql = "SELECT * FROM test_picture ";
            $db_erg = mysqli_query( $con, $sql );
            if ( ! $db_erg )
            {
              die('Ungültige Abfrage: ' . mysqli_error());
            }
            
                    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
                    {
                        echo " <img src='".$zeile["picture"]."'/>";
                    }
            mysqli_free_result( $db_erg );
            ?>
        </body>
    </head>
</html>