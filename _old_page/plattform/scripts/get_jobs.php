<?php
require_once "scripts/connect_to_db.php";

$category = 0;

if(isset($_POST['job_category']))
{
$category = $_POST['job_category'];
$sql = "SELECT * FROM job INNER JOIN company INNER JOIN jobtype WHERE job.type_id = jobtype.type_id AND job.company_id = company.company_id HAVING job.type_id =".$category."";
}

if($category==0 || !isset($category))
{
    $sql = "SELECT * FROM job INNER JOIN company WHERE job.company_id = company.company_id";
}
 
$db_erg = mysqli_query( $con, $sql );
if ( ! $db_erg )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}

        while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
        {
            echo '<a href="single_job.php?id='.$zeile["job_id"].'">
                    <div class="job-item">
                        <div class="job-content">
                            <div class="job-left" style="background-image:url('.$zeile["company_logo"].');">
                            </div>
                            <div class="job-center"><a href="single_job.php?id='.$zeile["job_id"].'">'.$zeile["job_title"].'</a></div>
                            <div class="job-right"></div>
                        </div>
                    </div>
               </a>';
        }
mysqli_free_result( $db_erg );
?>