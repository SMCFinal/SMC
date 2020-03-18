<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    include('../_partials/header.php');
?>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                
                <h5 class="page-title">Rooms</h5>
            </div>
        </div>
        <!-- Collapse -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Rooms Satus</h4>
                      
                        <div id="accordion">
                            <div class="card">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="text-dark">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0 mt-0 font-16" align="right">
                                            <button class="btn btn-default waves-effect waves-light" style="border:1px solid #ccc">- Minimize</button>
                                        </h5>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $iteration = 1;
                                            $retDataRooms = mysqli_query($connect, "SELECT rooms.*, patient_registration.id, patient_registration.patient_name, patient_registration.city_id, patient_registration.patient_consultant, area.area_name, floors.floor_name, staff_members.name FROM `rooms`
                                                LEFT JOIN patient_registration ON patient_registration.room_id = rooms.id
                                                LEFT JOIN area ON area.id = patient_registration.city_id
                                                LEFT JOIN floors ON floors.id = rooms.floor_id
                                                LEFT JOIN staff_members ON staff_members.id = patient_registration.patient_consultant");

                                            while ($rowRooms = mysqli_fetch_assoc($retDataRooms)) {
                                                if ($rowRooms['status'] == 1) {
                                                echo '
                                                    <div class="col-lg-2 col-md-4 col-sm-12 roomSuccess m-3" style="border-radius:.2rem">
                                                        <a href="room_view.php">
                                                            <div>
                                                                <p class="badge badge-pill badge-light ">'.$rowRooms['floor_name'].'</p><br>
                                                                
                                                                <p class="badge badge-pill badge-light ">'.$rowRooms['room_number'].'</p><br>
                                                               
                                                                <span><i class="fa fa-wheelchair-alt text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                 N / A 
                                                                 </span><br>
                                                                <span ><i class="fa fa-user-md text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                N / A
                                                                </span><br>
                                                                <span ><i class="fa fa-address-card text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                N / A
                                                                </span><br>
                                                            </div>
                                                        </a>
                                                    </div>
                                                ';    
                                                }else {
                                                echo '
                                                    <div class="col-lg-2 col-md-4 col-sm-12 roomDanger m-3">
                                                        <a href="">
                                                            <div>
                                                            <p class="badge badge-pill badge-light ">'.$rowRooms['floor_name'].'</p><br>

                                                                <p class="badge badge-pill badge-light ">'.$rowRooms['room_number'].'</p><br>
                                                               
                                                                <span><i class="fa fa-wheelchair-alt text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                 '.$rowRooms['patient_name'].' 
                                                                 </span><br>
                                                                <span ><i class="fa fa-user-md text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                '."Dr. ".$rowRooms['name'].'
                                                                </span><br>
                                                                <span ><i class="fa fa-address-card text-dark" style="font-size: 20px;padding-right: 5px"></i>
                                                                '.$rowRooms['area_name'].'
                                                                </span><br>
                                                            </div>
                                                        </a>
                                                    </div>
                                                ';  
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
</div> <!-- content -->
<?php include('../_partials/footer.php') ?>

</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
        <?php include('../_partials/jquery.php') ?>

<!-- App js -->
        <?php include('../_partials/app.php') ?>

</body>

</html>