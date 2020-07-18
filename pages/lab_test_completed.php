<?php 
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }
    include('../_partials/header.php');
?>
  <style type="text/css">  <link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css"></style>

<div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <!-- <h5 class="page-title">Floors</h5> -->
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Completed lab test </h4>   
                                            <!-- <a href="floor_new.php" type="button" class="btn btn-primary waves-effect waves-light text-white ml-auto" style="float: right;">Rooms Detials</a> -->

                                            <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Reference No. </th>
                                                    <th>Patient</th>
                                                    <th>Attendant Name</th>
                                                    <th>Address</th>
                                                    <th class="text-center"> <i class="fa fa-edit"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $retrieveLabsTests = mysqli_query($connect, "SELECT lab_order.id AS labId, lab_order.*, patient_registration.patient_name, patient_registration.attendent_name, patient_registration.patient_address, rooms.room_number, lab_test_category.* FROM `lab_order` 
                                                        INNER JOIN patient_registration ON patient_registration.id = lab_order.pat_id
                                                        INNER JOIN lab_test_category ON lab_test_category.id = lab_order.lab_test_id
                                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                                        WHERE lab_order.lab_status = '0' GROUP BY lab_order.reference_no");

                                                    $iteration = 1;

                                                    while ($rowLabTests = mysqli_fetch_assoc($retrieveLabsTests)) {
                                                        
                                                        echo '
                                                        <tr>
                                                            <td>'.$iteration++.'</td>
                                                            <td>'.$rowLabTests['reference_no'].'</td>
                                                            <td>'.$rowLabTests['patient_name'].'</td>
                                                            <td>'.$rowLabTests['attendent_name'].'</td>
                                                            <td>'.$rowLabTests['room_number'].'</td>';
                                                            
                                                             echo '
                                                            <td class="text-center"><a href="lab_test_completed_patient_view.php?ref='.$rowLabTests['reference_no'].'" type="button" class="btn text-white btn-info waves-effect waves-light">View</a></td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
            
                          
            
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

<!-- Required datatable js -->
        <?php include('../_partials/datatable.php') ?>
>

<!-- Buttons examples -->
        <?php include('../_partials/buttons.php') ?>

<!-- Responsive examples -->
        <?php include('../_partials/responsive.php') ?>

<!-- Datatable init js -->
        <?php include('../_partials/datatableInit.php') ?>

<!-- Sweet-Alert  -->
        <?php include('../_partials/sweetalert.php') ?>

<!-- App js -->
        <?php include('../_partials/app.php') ?>

    </body>
</html>