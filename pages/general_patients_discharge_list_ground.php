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
                <h5 class="page-title">General Discharged Patients </h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">General Discharged Patients List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Date of Admission</th>
                                    <th>Disease</th>
                                    <th>Consultant</th>
                                    <th>Organization</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i> / <i class="fa fa-sign-in"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectQueryPatients = mysqli_query($connect, "SELECT discharge_patients.*, staff_members.name FROM discharge_patients
                                INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant AND category = 'dischargePatient'
                                AND discharge_patients.organization LIKE '%General%'
                                ORDER BY discharge_patients.patient_doa DESC");
                                $iteration = 1;

                                $timezone = date_default_timezone_set('Asia/Karachi');
                                $date = date('m/d/Y h:i:s a', time());

                                while ($rowPatients = mysqli_fetch_assoc($selectQueryPatients)) {
                                    // echo $rowPatients['patient_doa'];
                                $hourdiff = round((strtotime($date) - strtotime($rowPatients['patient_doa']))/3600, 1);
                                    echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowPatients['patient_yearly_no'].'</td>
                                            <td>'.$rowPatients['patient_name'].'</td>';
                                            $dateAdmisison = $rowPatients['patient_doa']; 
                                            $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                            echo '
                                            <td>'.$newAdmisison.'</td>
                                            <td>'.$rowPatients['patient_disease'].'</td>
                                            <td>'."Dr. ".$rowPatients['name'].'</td>';
                                            if (empty($rowPatients['organization'])) {
                                                echo '<td><span class="badge badge-secondary">General</span></td>';
                                            }else {
                                                echo '<td><span class="badge badge-success">'.$rowPatients['organization'].'</span></td>';
                                            }

                                            echo '<td class="text-center">
                                            <a href="select_option.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-info waves-effect waves-light btn-sm">View</a>&nbsp;&nbsp;&nbsp;';

                                            // if ($hourdiff < 4) {
                                                echo '
                                                <a href="discharge_patient_readmit.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">Re-admit</a>

                                               ';
                                            // }
                                            echo '
                                            </td>
                                        </tr>
                                    ';
                                }
                                            // <td class="text-center"><a href="./user_edit.php" type="button" class="btn text-white btn-warning waves-effect 
                                            //waves-light">Edit</a></td>
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