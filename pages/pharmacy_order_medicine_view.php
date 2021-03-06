<?php
include '../_stream/config.php';

session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

    $id = $_GET['id'];
    $pat_id = $_GET['patId'];
    
    $retPatientData = mysqli_query($connect, "SELECT patient_registration.*, rooms.room_number FROM `patient_registration`
                                              INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                              WHERE patient_registration.id ='$pat_id'");
    $fetch_retPatientData = mysqli_fetch_assoc($retPatientData);

include '../_partials/header.php';
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
                <h5 class="page-title">Completed Orders List</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title d-inline"><h3>Abc Medicine </h3></h4> -->




                            <a href="pharmacy_order_medicine_completed_list.php" class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i></a>
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Patient Name</th>
                                        <td><?php echo $fetch_retPatientData['patient_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Room #</th>
                                        <td><?php echo $fetch_retPatientData['room_number'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact Number</th>
                                        <td><?php echo $fetch_retPatientData['patient_contact'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Attendant Name</th>
                                        <td><?php echo $fetch_retPatientData['attendent_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $queryTotalAmount = mysqli_query($connect, "SELECT * FROM pharmacy_amount WHERE reference_no = '$id'");
                                        $fetch_queryTotalAmount = mysqli_fetch_assoc($queryTotalAmount);
                                        ?>
                                        <th scope="row">Total Price</th>
                                        <td><i><b>Rs. <?php echo $fetch_queryTotalAmount['medicines_total'] ?></i></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title d-inline"><h3>Abc Medicine </h3></h4> -->



                        <h3>Medicines List</h3>
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <?php 
                                    $itr = 1;
                                        $queryListMedicines = mysqli_query($connect, "SELECT medicine_order.*, add_medicines.medicine_name, medicine_category.category_name FROM `medicine_order`
                                            INNER JOIN add_medicines ON add_medicines.id = medicine_order.med_id
                                            INNER JOIN medicine_category ON medicine_category.id = medicine_order.cat_id
                                            WHERE medicine_order.reference_no = '$id'");
                                        echo '
                                        <tr>
                                            <td><b><h4>S.No</h4></b></td>
                                            <td><b><h4>Medicine Name</h4></b></td>
                                            <td><b><h4>Medicine Category</h4></b></td>
                                            <td><b><h4>Quantity</h4></b></td>
                                        </tr>
                                        ';
                                        while ($rowList = mysqli_fetch_assoc($queryListMedicines)) {
                                            echo '
                                            <tr>
                                                <td>'.$itr++.'</td>
                                                <td>'.$rowList['medicine_name'].'</td>
                                                <td>'.$rowList['category_name'].'</td>
                                                <td>'.$rowList['med_qty'].'</td>
                                            </tr>
                                            ';

                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><i><b>Total: Rs. <?php echo $fetch_queryTotalAmount['medicines_total'] ?></i></b></td>
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
<?php include '../_partials/footer.php'?>

</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
        <?php include '../_partials/jquery.php'?>

<!-- Required datatable js -->
        <?php include '../_partials/datatable.php'?>

<!-- Buttons examples -->
        <?php include '../_partials/buttons.php'?>

<!-- Responsive examples -->
        <?php include '../_partials/responsive.php'?>

<!-- Datatable init js -->
        <?php include '../_partials/datatableInit.php'?>

<!-- Sweet-Alert  -->
        <?php include '../_partials/sweetalert.php'?>

<!-- App js -->
        <?php include '../_partials/app.php'?>

</body>

</html>