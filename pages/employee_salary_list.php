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
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>Advance Amount</th>
                                    <th>Date of Salary</th>
                                  
                                                                     
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $salaryQuery = mysqli_query($connect, "SELECT employee_salary.*, employee_salary.id AS s_id, employee_registration.*, employee_designation.*, emp_advance_payment.adv_amount FROM `employee_salary`
                                    INNER JOIN employee_registration ON employee_registration.id = employee_salary.emp_id
                                    INNER JOIN employee_designation ON employee_designation.id = employee_registration.emp_designation
                                    LEFT JOIN emp_advance_payment ON emp_advance_payment.emp_id = employee_salary.emp_id");
                                $iteration = 1;

                                while ($rowSalary = mysqli_fetch_assoc($salaryQuery)) {
                                    echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowSalary['emp_name'].'</td>
                                            <td>'.$rowSalary['designation_name'].'</td>
                                            <td>'.$rowSalary['salary_amount'].'</td>';
                                            
                                            if (empty($rowSalary['adv_amount'])) {
                                                echo '<td>No Advance</td>';
                                            }else {
                                                echo '<td>Rs. '.$rowSalary['adv_amount'].'</td>';
                                            }
                                            
                                            echo '<td>'.$rowSalary['salaray_dop'].'</td>
                                            
                                            
                                            <td class="text-center"><a href="employee_salary_edit.php?id='.$rowSalary['s_id'].'" class="btn btn-warning"  name="Deleteme" data-original-title="Deactivate User Access">Edit</a></td>';
                                            // <td class="text-center"><button class="btn btn-danger" onClick="deleteme('.$rowSalary['cnic'].')" name="Deleteme" data-original-title="Deactivate User Access">Discharge</button></td>
                                          
                                         
                                    
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