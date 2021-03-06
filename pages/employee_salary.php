<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

        if (isset($_POST['salary'])) {
            $employeeName = $_POST['employeeName'];
            $amount = $_POST['amount'];
            $dateofsalary = $_POST['dateofsalary'];


            $salaryQuery = mysqli_query($connect, "INSERT INTO employee_salary(emp_id, salary_amount, salaray_dop)VALUES('$employeeName', '$amount', '$dateofsalary')");
            
            $updateQuery = mysqli_query($connect, "UPDATE emp_advance_payment SET adv_status = '0'");
            if ($updateQuery) {
                header('LOCATION:employee_salary_list.php');
            }
        }

    include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Employee Salary</h5>
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
                                        $optionEmp = '<select class="form-control designation" name="employeeName" required="" style="width:100%" id="emp">';
                                          while ($rowEmp = mysqli_fetch_assoc($selectEmp)) {
                                            $optionEmp.= '<option value='.$rowEmp['id'].'>'.$rowEmp['emp_name'].' - 0'.$rowEmp['emp_contact'].'</option>';
                                          }
                                        $optionEmp.= "</select>";
                                echo $optionEmp;
                                ?>


                                </div>

                                 <label for="example-text-input" class="col-sm-3 col-form-label">Advanced Recieved Amount</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="recEmp" type="number" readonly placeholder="Amount" id="example-text-input">
                                </div>

                            </div>


                            <div class="form-group row">

                                <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-4">
                                    <input class="form-control" required="" id="salaryEmp" type="number" placeholder="Amount" name="amount" id="example-text-input">
                                </div>


                                <label class="col-sm-2 col-form-label">Date of Salary</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control " type="date" required="" name="dateofsalary" placeholder="dd/mm/yyyy" autoclear>
                                        <!-- <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div> -->
                                    </div>
                                </div>
                               
                            </div>



                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'; ?>
                                    
                                    <button type="submit" name="salary" class="btn btn-primary waves-effect waves-light">Salary</button>
                                    <!-- <a href="pharmacy_order_medicine_new_table.php" type="submit" name="patientMedicine" class=""></a> -->
                                </div>
                            </div>

                        </form>
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

<script type="text/javascript">
    $(document).ready(function(){
      $('#emp').change(function(){
        var emp = $(this).val();
        $.ajax({
          url:"getEmpRecAdvAmount.php",
          method:"POST",
          data:{
            empId:emp
          },
          dataType:"text",
          success:function(data){
            $('#recEmp').html(data);
            var allData = data;
            console.log(data);
            var splitArray = allData.split("|");


            document.getElementById('recEmp').value= splitArray[1];
            document.getElementById('salaryEmp').value= splitArray[0];
          }
        });
      });
    });
  </script>
</body>

</html>