<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $getPatient = mysqli_query($connect, "SELECT * FROM patient_registration WHERE id = '$id'");
    $fetch_getPatient = mysqli_fetch_assoc($getPatient);

    if (empty($fetch_getPatient['patient_operation'])) {
        $selectQuery = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name FROM `patient_registration`
                                INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                WHERE patient_registration.id =  '$id'");
    }else {
        $selectQuery = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name, surgeries.surgery_name FROM `patient_registration`
                                INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                INNER JOIN surgeries ON surgeries.id = patient_registration.patient_operation
                                WHERE patient_registration.id  = '$id'");
    }
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    include('../_partials/header.php'); 
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <!--    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Datatable</li>
                    </ol> -->
                </div>
                <h5 class="page-title">Patient Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title d-inline"><?php echo $fetch_selectQuery['patient_name'] ?></h4>
                        <div class=" float-right">
                            <?php
                            if ($fetch_selectQuery['patient_doop'] == '0000-00-00 00:00:00') {
                            echo '
                            <a href="surgery_new.php?id='.$fetch_selectQuery['id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light">Add Surgery</a>';
                            }
                            echo '&nbsp;';
                            
                            echo '<a href="emergency_pat_edit.php?id='.$fetch_selectQuery['id'].'&org='.$fetch_selectQuery['organization'].'" type="button" class="btn text-white btn-success waves-effect waves-light">Edit Patient</a>';

                            
                            ?>
                        </div>



                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">M.R No.</th>
                                        <td><?php echo $fetch_selectQuery['patient_yearly_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['patient_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Age</th>
                                        <td><?php echo $fetch_selectQuery['patient_age'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender</th>
                                        <td><?php 
                                        if ($fetch_selectQuery['patient_gender'] == 1) {
                                            echo "Male";
                                        }elseif ($fetch_selectQuery['patient_gender'] == 2) {
                                            echo "Female";
                                        }elseif ($fetch_selectQuery['patient_gender'] == 3) {
                                            echo "Other";
                                        }
                                       ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><?php echo $fetch_selectQuery['patient_address'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Admission</th>
                                        <td><?php 
                                        $dateAdmisison = $fetch_selectQuery['patient_doa']; 
                                        $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                        echo $newAdmisison;

                                        ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Operation</th>
                                        <?php $fetch_selectQuery['patient_operation'];

                                        $date = $fetch_selectQuery['patient_doop']; 
                                        $newDate = date('d/M/Y h:i:s A', strtotime($date));
                                            if ($fetch_selectQuery['patient_doop'] == '0000-00-00 00:00:00') {
                                                echo '<td style="color:red"><b>No Surgery Assigned</b></td>';
                                             }else {
                                                echo '<td>'.$newDate.'</td>';
                                             } 
                                        ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Disease</th>
                                        <td><?php echo $fetch_selectQuery['patient_disease'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Operation</th>
                                        <?php $fetch_selectQuery['patient_operation'];
                                            if (empty($fetch_selectQuery['patient_operation'])) {
                                                echo '<td style="color:red"><b>No Surgery Assigned</b></td>';
                                             }else {
                                                echo '<td>'.$fetch_selectQuery['surgery_name'].'</td>';
                                             } 
                                             ?>
                                    </tr>

                                    <tr>
                                        <th scope="row">Refered by / Consultant</th>
                                        <td><?php echo $fetch_selectQuery['name'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Yearly No</th>
                                        <td><?php echo $fetch_selectQuery['patient_yearly_no'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Advance Payment</th>
                                        <td><?php echo "Rs. ".$fetch_selectQuery['advance_payment'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Advance Payment</th>
                                        <td>
                                            <?php 
                                                if ($fetch_selectQuery['pat_category'] === '1') {
                                                    echo "Ellective Patient";
                                                }else {
                                                    echo "Emergency Patient";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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