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
                
                <h5 class="page-title">Employees</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Employees List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Date of Joining</th>
                                    <th>Address</th>
                                  
                                                                     
                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectQueryMembers = mysqli_query($connect, "SELECT employee_registration.*, employee_designation.designation_name FROM `employee_registration`
                                    INNER JOIN employee_designation ON employee_designation.id = employee_registration.emp_designation
                                    WHERE employee_registration.emp_status = '1'");
                                $iteration = 1;

                                while ($rowMembers = mysqli_fetch_assoc($selectQueryMembers)) {
                                    echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowMembers['emp_name'].'</td>';

                                            if ($rowMembers['emp_gender'] == '1') {
                                                echo '<td>Male</td>';
                                            }elseif ($rowMembers['emp_gender'] == '2') {
                                                echo '<td>Female</td>';
                                            }else {
                                                echo '<td>Other</td>';
                                            }

                                            echo '
                                            <td>'.$rowMembers['designation_name'].'</td>
                                            <td>'.$rowMembers['emp_salary'].'</td>
                                            <td>'.substr($rowMembers['emp_doj'], 0,10).'</td>
                                            <td>'.$rowMembers['emp_address'].'</td>
                                            <td class="text-center"><a href="HR_staff_view.php?id='.$rowMembers['emp_cnic'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>
                                             <td class="text-center"><a href="HR_staff_edit.php" class="btn btn-warning"  name="Deleteme" data-original-title="Deactivate User Access">Edit</a></td>';
                                            // <td class="text-center"><button class="btn btn-danger" onClick="deleteme('.$rowMembers['cnic'].')" name="Deleteme" data-original-title="Deactivate User Access">Discharge</button></td>
                                          
                                         
                                    
                                }
                                            // <td class="text-center"><a href="./user_edit.php" type="button" class="btn text-white btn-warning waves-effect 
                                            //waves-light">Edit</a></td>
                                ?>
                                
                                    
                            </tbody>
                        </table>
                        <script type="text/javascript">
        function deleteme(delid){
          if (confirm("Do you want to discharge patient?")) {
            window.location.href = 'temporary_disable.php?del_id=' + delid +'';
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