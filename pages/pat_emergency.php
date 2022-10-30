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
                <h5 class="page-title">Current Patient List (Emergency)</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Emergency Patient List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Organization</th>
                                    <th>Date of Admission</th>
                                    <th>Disease</th>
                                    <th>Consultant</th>
                                    <th>Change Room</th>
                                    <th>Edit Surgery</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
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
                                    
                                        if ($rowPatients['pat_category'] === '2') {
                                            echo '
                                            <tr>
                                                <td>'.$iteration++.'</td>
                                                <td>
                                                    <a href="pat_meds.php?id='.$rowPatients['id'].'" type="button" style="background-color: #efefef; box-shadow: 3px 3px 3px 3px #ccc;" class="btn">
                                                    '.$rowPatients['patient_yearly_no'].'
                                                    </a>
                                                </td>
                                                <td>'.$rowPatients['patient_name'].'</td>
                                                ';
                                                if ($rowPatients['organization'] === 'Sehat') {
                                                    echo '<td>Sehat Card</td>';
                                                }else {
                                                    echo '<td>'.$rowPatients['organization'].'</td>';
                                                }
                                                $dateAdmisison = $rowPatients['patient_doa']; 
                                                $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
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
                                                <td>'.$rowPatients['name'].'</td>
                                                <td class="text-center">
                                                <a href="changeRoom.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm"> <i class="fa fa-pencil"></i>&nbsp;Room</a>&nbsp;&nbsp;&nbsp;
                                                </td>
    
                                                <td class="text-center">
                                                <a href="change_consultant.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-success waves-effect waves-light btn-sm"><i class="fa fa-pencil"></i>&nbsp; Surgery</a>&nbsp;&nbsp;&nbsp;
                                                </td>
    
    
                                                <td class="text-center">
                                                <a href="emerygency_pat_view.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a>&nbsp;&nbsp;&nbsp;
                                                </td>
    
                                                <td class="text-center">
                                                    <a href="patient_postpone.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-secondary waves-effect waves-light btn-sm">PostPone</a>&nbsp;&nbsp;&nbsp;';
                                                
                                                if ($rowPatients['patient_doop'] === '0000-00-00 00:00:00') { }else {
                                                    echo '
                                                        <a href="discharge_patient_file.php?id='.$rowPatients['id'].'" type="button" class="btn text-white btn-danger waves-effect waves-light btn-sm">Discharge</a>&nbsp;&nbsp;&nbsp;
                                                    ';
                                                }
                                                echo '
                                                </td>
                                            </tr>
                                        ';
                                        }
                                    
                                    }
                                }
                                            // <td class="text-center"><a href="./user_edit.php" type="button" class="btn text-white btn-warning waves-effect 
                                            //waves-light">Edit</a></td>

                                ?>


                            </tbody>
                        </table>
                        <script type="text/javascript">
                        function deleteme(delid, room) {
                            if (confirm("Do you want to PostPone Patient?")) {
                                window.location.href = 'temporary_disable.php?del_id=' + delid + '&room_id=' + room +
                                    '';
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