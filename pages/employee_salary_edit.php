<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

        $id = $_GET['id'];

        $retQuery = mysqli_query($connect, "SELECT * FROM employee_salary WHERE id = '$id'");
        $fetch_retQuery = mysqli_fetch_assoc($retQuery);

        if (isset($_POST['salary'])) {
            $id = $_POST['id'];
            $employeeName = $_POST['employeeName'];
            $amount = $_POST['amount'];
            $dateofsalary = $_POST['dateofsalary'];

            $updateSalaryQuery = mysqli_query($connect, "UPDATE employee_salary SET emp_id = '$employeeName', salary_amount = '$amount', salaray_dop = '$dateofsalary' WHERE id = '$id'");

            // $salaryQuery = mysqli_query($connect, "INSERT INTO employee_salary(emp_id, salary_amount, salaray_dop)VALUES('$employeeName', '$amount', '$dateofsalary')");
            
            // $updateQuery = mysqli_query($connect, "UPDATE emp_advance_payment SET adv_status = '0'");
            if ($updateSalaryQuery) {
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
                <h5 class="page-title">Employee Salary Edit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                 <?php
                                $selectEmp = mysqli_query($connect, "SELECT * FROM `employee_registration`");
                                        $optionEmp = '<select class="form-control designation" name="employeeName" required="" style="width:100%" id="emp">';
                                          while ($rowEmp = mysqli_fetch_assoc($selectEmp)) {
                                            if ($fetch_retQuery['emp_id'] == $rowEmp['id']) {
                                                $optionEmp.= '<option value='.$rowEmp['id'].' selected>'.$rowEmp['emp_name'].' - 0'.$rowEmp['emp_contact'].'</option>';
                                            }else {
                                                $optionEmp.= '<option value='.$rowEmp['id'].'>'.$rowEmp['emp_name'].' - 0'.$rowEmp['emp_contact'].'</option>';
                                            }
                                          }
                                        $optionEmp.= "</select>";
                                echo $optionEmp;
                                ?>


                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-4">
                                    <input class="form-control" required="" id="salaryEmp" type="number" placeholder="Amount" name="amount" id="example-text-input" value="<?php echo $fetch_retQuery['salary_amount'] ?>">
                                </div>

                            </div>


                            <div class="form-group row">

                                


                                <label class="col-sm-2 col-form-label">Date of Salary</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control date dateonly" required="" name="dateofsalary" placeholder="dd/mm/yyyy" autoclear value="<?php echo $fetch_retQuery['salaray_dop'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                               
                            </div>



                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'; ?>
                                    
                                    <button type="submit" name="salary" class="btn btn-primary waves-effect waves-light">Update Salary</button>
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