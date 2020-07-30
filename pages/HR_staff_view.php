<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT staff_members.*, staff_category.* FROM `staff_members`
                                INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                WHERE staff_members.status = '1' AND staff_members.cnic = '$id'");
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
                <h5 class="page-title">Staff Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title d-inline"><h3><?php echo $fetch_selectQuery['name'] ?></h3></h4>
                       
                       
                   
                        
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">CNIC</th>
                                        <td><?php echo $fetch_selectQuery['cnic'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Designation</th>
                                        <td><?php echo $fetch_selectQuery['category_name'] ?></td>
                                    </tr>
                                    
                                     <tr>
                                        <th scope="row">Salary</th>
                                        <td><?php echo $fetch_selectQuery['salary'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Joining</th>
                                        <td><?php echo $fetch_selectQuery['date_of_joining'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Start Time</th>
                                        <td><?php echo $fetch_selectQuery['start_time'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">End Time</th>
                                        <td><?php echo $fetch_selectQuery['end_time'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Visit Charges</th>
                                        <td><?php echo $fetch_selectQuery['visit_charges'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Contact</th>
                                        <td><?php echo "0".$fetch_selectQuery['contact'] ?></td>
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