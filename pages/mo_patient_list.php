<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $user = $_SESSION["user"];
    $loginUser = mysqli_query($connect, "SELECT * FROM `login_user` WHERE email = '$user'");
    $fetch_loginUser = mysqli_fetch_assoc($loginUser);

    $userName = $fetch_loginUser['name'];

    include('../_partials/header.php');
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title"> Patients List</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Current Patient List </h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Organization</th>
                                    <th>Date of Admission</th>
                                    <th>Disease</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"><i class="mdi mdi-pill"></i></th>
                                </tr>
                            </thead>
                            <!-- <td>
                                <a href="pat_meds.php?id='.$rowPatients['id'].'" type="button" style="background-color: #efefef; box-shadow: 3px 3px 3px 3px #ccc;" class="btn">
                                '.$rowPatients['patient_yearly_no'].'
                                </a>
                            </td> -->
                            <tbody>
                                <?php
                                    $selectQueryPatients = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name FROM `patient_registration`
                                    INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant AND category = 'currentPatient'
                                    
                                    ORDER BY patient_registration.patient_doa DESC");
                                    $iteration = 1;

                                    $timezone = date_default_timezone_set('Asia/Karachi');
                                    $date = date('m/d/Y h:i:s a', time());

                                    while ($rowPatients = mysqli_fetch_assoc($selectQueryPatients)) {
                                    $hourdiff = round((strtotime($date) - strtotime($rowPatients['patient_doa']))/3600, 1);
                                        if ($rowPatients['room_id'] === '0') {
                                            
                                        }else {
                                        if ($rowPatients['patient_doop'] === '0000-00-00 00:00:00') {
                                            
                                        }else {
                                            echo '
                                            <tr>
                                                <td>'.$iteration++.'</td>
                                                <td>'.$rowPatients['patient_yearly_no'].'</td>
                                                <td>'.$rowPatients['patient_name'].'</td>
                                                <td>'.$rowPatients['organization'].'</td>';
                                                $dateAdmisison = $rowPatients['patient_doa']; 
                                                $newAdmisison = date('d/M/Y', strtotime($dateAdmisison));
                                                echo '
                                                <td>'.$newAdmisison.'</td>';

                                                if ($rowPatients['patient_operation'] === '0') {
                                                    echo '<td>'.$rowPatients['patient_disease'].'</td>';
                                                }else {
                                                    echo '
                                                    <td>
                                                        <a href="surg_meds_list.php?id='.$rowPatients['id'].'" type="button" style="background-color: #878787; box-shadow: 3px 3px 3px 3px #ccc;" class="btn text-light">
                                                        '.$rowPatients['patient_disease'].'
                                                        </a>
                                                    </td>
                                                    ';
                                                }

                                                echo '
                                                
                                                <td class="text-center">
                                                    <a href="patient_view_doctor.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a>&nbsp;&nbsp;&nbsp;
                                                </td>';

                                                $pat_id = $rowPatients['id'];
                                                $checkPatProcedureQuery = mysqli_query($connect, "SELECT COUNT(*) AS CountedProcedures FROM doctor_prescription WHERE pat_id = '$pat_id'");
                                                $fetch_checkPatProcedureQuery = mysqli_fetch_assoc($checkPatProcedureQuery);

                                                if ($fetch_checkPatProcedureQuery['CountedProcedures'] > 0) {
                                                    echo '
                                                    <td class="text-center">
                                                        <a href="mo_advice_procedure_edit.php?id='.$rowPatients['id'].'&doctor='.$rowPatients['patient_consultant'].'" type="button" class="btn text-white btn-info waves-effect waves-light btn-sm">Edit Advice + Procedure</a>&nbsp;&nbsp;&nbsp;
                                                    </td>
                                                    ';
                                                }else {
                                                    echo '
                                                    <td class="text-center">
                                                        <a href="mo_advice_procedure.php?id='.$rowPatients['id'].'&doctor='.$rowPatients['patient_consultant'].'" type="button" class="btn text-white btn-success waves-effect waves-light btn-sm">Advice + Procedure</a>&nbsp;&nbsp;&nbsp;
                                                    </td>';
                                                }
                                            echo '   
                                            </tr>
                                            ';
                                            }
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