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
                
                <h5 class="page-title">Advance Payments</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Payments List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>CNIC</th>
                                    <th>Designation</th>
                                    <th>Contact</th>
                                    <th>Amount Paid</th>
                                    <th>Date</th>                                                                    
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectEmpAdvancePaymentData = mysqli_query($connect, "SELECT emp_advance_payment.*, emp_advance_payment.id AS AdvId, employee_registration.*, employee_designation.designation_name FROM `emp_advance_payment`
                                    INNER JOIN employee_registration ON employee_registration.id = emp_advance_payment.emp_id
                                    INNER JOIN employee_designation ON employee_designation.id = employee_registration.emp_designation");
                                $iteration = 1;

                                while ($rowEmpAdvancePaymentData = mysqli_fetch_assoc($selectEmpAdvancePaymentData)) {
                                    echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowEmpAdvancePaymentData['emp_name'].'</td>
                                            <td>'.$rowEmpAdvancePaymentData['emp_cnic'].'</td>
                                            <td>'.$rowEmpAdvancePaymentData['designation_name'].'</td>
                                            <td>'."0".$rowEmpAdvancePaymentData['emp_contact'].'</td>
                                            <td>'."Rs. ".$rowEmpAdvancePaymentData['adv_amount'].'</td>
                                            <td>'.$rowEmpAdvancePaymentData['adv_dop'].'</td>
                                            
                                             <td class="text-center"><a href="employee_select_edit.php?id='.$rowEmpAdvancePaymentData['AdvId'].'" class="btn btn-warning"  name="Deleteme" data-original-title="Deactivate User Access">Edit</a></td>';
                                            // <td class="text-center"><button class="btn btn-danger" onClick="deleteme('.$rowEmpAdvancePaymentData['cnic'].')" name="Deleteme" data-original-title="Deactivate User Access">Discharge</button></td>
                                          
                                         
                                    
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