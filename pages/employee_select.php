<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }
        $notAdded = '';

        if (isset($_POST['advPayment'])){ 
            $employeeName = $_POST['employeeName'];
            $amount = $_POST['amount'];
            $dateofpayment = $_POST['dateofpayment'];
            $description = $_POST['description'];

            $querypayment = mysqli_query($connect, "INSERT INTO emp_advance_payment(emp_id, adv_amount, adv_dop, adv_description)VALUES('$employeeName', '$amount', '$dateofpayment', '$description')");
            if (!$querypayment) {
                $notAdded = "Advance Payment not added!";
            }else{
               header('LOCATION:employee_advance_payments_list.php');
            }

        }

    include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Advance Payment</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                <?php
                                $selectEmp = mysqli_query($connect, "SELECT * FROM `employee_registration`");
                                        $optionEmp = '<select class="form-control designation" name="employeeName" required="" style="width:100%">';
                                          while ($rowEmp = mysqli_fetch_assoc($selectEmp)) {
                                            $optionEmp.= '<option value='.$rowEmp['id'].'>'.$rowEmp['emp_name'].' - 0'.$rowEmp['emp_contact'].'</option>';
                                          }
                                        $optionEmp.= "</select>";
                                echo $optionEmp;
                                ?>

                                </div>

                                 <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="Amount" name="amount" id="example-text-input">
                                </div>

                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Payment</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control " type="date" name="dateofpayment" placeholder="dd/mm/yyyy" autoclear>
                                        <!-- <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div> -->
                                    </div>
                                </div>
                               
                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="input-group ">
                                      <textarea id="textarea" name="description" class="form-control" maxlength="225" rows="3" placeholder=""></textarea>
                                       
                                    </div>
                                </div>
                               
                            </div>




                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'; ?>
                                    
                                    <button type="submit" name="advPayment" class="btn btn-primary waves-effect waves-light">Advance Payment</button>
                                    <!-- <a href="pharmacy_order_medicine_new_table.php" type="submit" name="patientMedicine" class=""></a> -->
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <h3><?php echo $notAdded ?></h3>

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
<!-- App js -->
<?php include '../_partials/app.php'?>
<?php include '../_partials/datetimepicker.php'?>


<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
<script type="text/javascript">
$(".timeonly").datetimepicker({
    format: "hh:ii",

    autoclose: true,
    todayBtn: true,
});

$(".dateonly").datetimepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayBtn: true,
});
</script>
</body>

</html>