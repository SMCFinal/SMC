<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    include('../_partials/header.php');
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Current Patients List</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Current Patients List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Organization</th>
                                    <th>Date of Admission</th>
                                    <th>Disease</th>
                                    <th>Consultant</th>
                                    <th>Med List</th>
                                    <th>Patient Medication</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $selectQueryPatients = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name FROM `patient_registration`
                                    INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant AND category = 'currentPatient'
                                    ORDER BY patient_registration.patient_doa DESC");
                                    $iteration = 1;

                                    $timezone = date_default_timezone_set('Asia/Karachi');
                                    $date = date('m/d/Y h:i:s a', time());

                                    while ($rowPatients = mysqli_fetch_assoc($selectQueryPatients)) {
                                        // echo $rowPatients['patient_doa'];
                                    $hourdiff = round((strtotime($date) - strtotime($rowPatients['patient_doa']))/3600, 1);
                                        if ($rowPatients['room_id'] === '0') {
                                            
                                        }else {
                                        echo '
                                            <tr>
                                                <td>'.$iteration++.'</td>
                                                <td>
                                                    <a href="pat_meds.php?id='.$rowPatients['id'].'" type="button" style="background-color: #efefef; box-shadow: 3px 3px 3px 3px #ccc;" class="btn">
                                                    '.$rowPatients['patient_yearly_no'].'
                                                    </a>
                                                </td>
                                                <td>'.$rowPatients['patient_name'].'</td>
                                                <td>'.$rowPatients['organization'].'</td>';
                                                $dateAdmisison = $rowPatients['patient_doa']; 
                                                $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                                echo '
                                                <td>'.$newAdmisison.'</td>';
                                                
                                                echo '<td>'.$rowPatients['patient_disease'].'</td>';
                                                echo '
                                                <td>'.$rowPatients['name'].'</td>';

                                                if ($rowPatients['patient_operation'] === '0') {
                                                    echo '<td><span class="badge badge-secondary">No Surgery Assigned</span></td>';
                                                }else {
                                                    echo '
                                                    <td>
                                                        <a href="surg_meds_list.php?id='.$rowPatients['id'].'" class="btn btn-info">Print &nbsp; <i class="fa fa-print"></i></a>
                                                    </td>
                                                    ';
                                                }
                                            echo '
                                                <td>
                                                    <a href="pat_meds.php?id='.$rowPatients['id'].'" type="button" class="btn btn-success">
                                                        Medication
                                                    </a>
                                                </td>
                                            </tr>
                                        ';
                                        }
                                    }
                                ?>
                                
                                    
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            function deleteme(delid,room){
                              if (confirm("Do you want to PostPone Patient?")) {
                                window.location.href = 'temporary_disable.php?del_id='+delid+'&room_id='+room+'';
                                return true;
                              }
                            }
                      </script>
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
<!-- jQuery  -->
        <?php include('../_partials/jquery.php') ?>

<!-- Required datatable js -->
        <?php include('../_partials/datatable.php') ?>

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