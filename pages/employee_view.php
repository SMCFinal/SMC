<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT employee_registration.*, employee_designation.designation_name FROM `employee_registration`
                                    INNER JOIN employee_designation ON employee_designation.id = employee_registration.emp_designation
                                    WHERE employee_registration.id = '$id'");
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
                <h5 class="page-title">Employee Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title d-inline"><h3></h3></h4> -->
                        <a href="employee_list.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                       
                       
                   
                        
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['emp_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">CNIC</th>
                                        <td><?php echo $fetch_selectQuery['emp_cnic'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Designation</th>
                                        <td><?php echo $fetch_selectQuery['designation_name'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Gender</th>
                                        <?php
                                        if ($fetch_selectQuery['emp_designation'] == '1') {
                                            echo '<td>Male</td>';
                                        }elseif ($fetch_selectQuery['emp_designation'] == '2') {
                                            echo '<td>Female</td>';
                                        }elseif ($fetch_selectQuery['emp_designation'] == '3') {
                                            echo '<td>Other</td>';
                                        }
                                        ?>
                                    </tr>
                                    
                                     <tr>
                                        <th scope="row">Salary</th>
                                        <td><?php echo $fetch_selectQuery['emp_salary'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Joining</th>
                                        <td><?php echo substr($fetch_selectQuery['emp_doj'], 0,10) ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Contact</th>
                                        <td><?php echo "0".$fetch_selectQuery['emp_contact'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><?php echo $fetch_selectQuery['emp_address'] ?></td>
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