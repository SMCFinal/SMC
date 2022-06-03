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
                <h5 class="page-title">Ground Floor Patients</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Ground Floor Patient List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Organization</th>
                                    <th>Contact</th>
                                    <th>Date of Admission</th>
                                    <th>Consultant</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i> / <i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectQueryPatients = mysqli_query($connect, "SELECT patient_registration.*, patient_registraion_date.pat_date, staff_members.name, area.area_name FROM `patient_registration`
                                INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant AND category = 'currentPatient'
                                INNER JOIN patient_registraion_date ON patient_registraion_date.pat_mr = patient_registration.patient_yearly_no
                                INNER JOIN area ON area.id = patient_registration.city_id
                                ORDER BY patient_registration.id DESC;");

                                $iteration = 1;

                                $timezone = date_default_timezone_set('Asia/Karachi');
                                $date = date('m/d/Y h:i:s a', time());

                                while ($rowPatients = mysqli_fetch_assoc($selectQueryPatients)) {
                                    // Put If condition on room
                                    if ($rowPatients['room_id'] === '0') {
                                    echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowPatients['patient_yearly_no'].'</td>
                                            <td>'.$rowPatients['patient_name'].'</td>
                                            <td>'.$rowPatients['patient_age'].'</td>
                                            <td>'.$rowPatients['area_name'].'</td>
                                            <td>'.$rowPatients['organization'].'</td>
                                            <td>'.$rowPatients['patient_contact'].'</td>
                                            ';

                                            $dateAdmisison = $rowPatients['pat_date']; 
                                            $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));

                                            echo '
                                            <td>'.$newAdmisison.'</td>
                                            <td>'.$rowPatients['name'].'</td>

                                            <td class="text-center">
                                            <a href="ground_patient_readmit.php?id='.$rowPatients['id'].'" type="button" class="btn btn-info waves-effect waves-light btn-lg">Admit Patient </a>
                                            </td>';

                                            echo '
                                            </td>
                                        </tr>
                                    ';
                                    }
                                }
                                ?>
                                
                                    
                            </tbody>
                        </table>
                        <script type="text/javascript">
                        function deleteme(delid, room){
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