<?php 
    include('../_stream/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SMC</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
    .table thead th {
        border-bottom:none;
       
    }
    .table thead td,.table thead th {
         border-bottom: 1px solid #dee2e6;
         border-top: none;

    }
</style>

<body onload="JavaScript:AutoRefresh(3000);">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="container-fluid p-0 fixed-top ">
        <div class="p-3" style="background-color: #60d09d">
            <!-- <a href="index.html" class="logo "><img src="../assets/images/logo.png" height="20" alt="logo"></a> -->
            <h3 class=" d-inline text-white">Patients | SHAH MEDICAL &amp; SURGICAL CENTER</h3>
            <span  class=" d-inline text-white" style="float: right;"><b>Developed By DCS PVT LTD.</b></span>
        </div>
    </div>
    <div class="container  p-5"></div>
    <div class="container-fluid mt-3">
        <div class="row">
            <?php
            $selectPat = mysqli_query($connect, "SELECT patient_registration.*,rooms.*, floors.*, staff_members.name FROM `patient_registration`
INNER JOIN rooms ON rooms.id = patient_registration.room_id
INNER JOIN floors ON floors.id = rooms.floor_id
INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant");

            $itr = 1;

            while ($rowPatientView = mysqli_fetch_assoc($selectPat)) {
                echo '
                <div class="col-xl-4 col-md-6 mb-2">
                    <div class="card ">
                        <div class="card-body" style="box-shadow: 30px 30px 30px #ccc">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td>'.$rowPatientView['patient_name'].'</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>'."Dr. ".$rowPatientView['name'].'</td>
                                        </tr>
                                        <tr>
                                            <th>Floor/Room</th>
                                            <td>'.$rowPatientView['floor_name']." <b> | </b> ".$rowPatientView['room_number'].'</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Case</th>
                                            <td>'.$rowPatientView['patient_disease'].'</td>
                                        </tr>
                                        <tr>
                                            <th>Village Name</th>
                                            <td>'.$rowPatientView['patient_address'].'</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                ';
            }
            ?>
        </div>
        <!-- end row -->
    </div>
   
    <!-- <footer class="footer mt-5 " style="position: relative;left: 0px;background-color: white">
        ©2020 <b>SMC</b> <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Team DCS.</span>
    </footer> -->
    <!-- END wrapper -->
    <!-- jQuery  -->
     <?php include('../_partials/jquery.php') ?>
     <?php include('../_partials/app.php') ?>
   
  
   

     <!-- <script type="text/javascript">
        $("html, body").animate({ scrollTop: $(document).height() }, 4000);
setTimeout(function() {
   $('html, body').animate({scrollTop:0}, 8000); 
},4000);
setInterval(function(){
     // 4000 - it will take 4 secound in total from the top of the page to the bottom
$("html, body").animate({ scrollTop: $(document).height() }, 4000);
setTimeout(function() {
   $('html, body').animate({scrollTop:0}, 8000); 
},4000);
    
},4000);
    </script> -->

    <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function(){
                  location.reload(true);
                }, 30000);       
            });
        </script>
</body>

</html>