<?php
    include('../_stream/config.php');

    $alreadyAdded = '';
    $error = '';
    $added = '';
    
    if (isset($_POST["addstaff"])) {
        $name = $_POST['nameStaff'];
        $cnic = $_POST['cnicStaff'];
        $designation = $_POST['designationStaff'];
        $salaryStaff = $_POST['salaryStaff'];
        $dateofjoiningStaff = $_POST['dateofjoiningStaff'];
        $starttimeStaff = $_POST['starttimeStaff'];
        $endtimeStaff = $_POST['endtimeStaff'];
        $visitcharges = $_POST['visitchargesStaff'];
        
        if(empty($visitcharges)) {
            $visitcharges = 0;
        }
        $explodeDoctor = explode(":", $designation);
        $designationStaffId = $explodeDoctor[1];

        $checkMemberTable = mysqli_query($connect, "SELECT COUNT(*)AS countedStaff FROM `staff_members` WHERE cnic = '$cnic'");
        $fetch_checkMemberTable = mysqli_fetch_array($checkMemberTable);

        if ($fetch_checkMemberTable['countedStaff'] < 1) {
            $createMember = mysqli_query($connect, "INSERT INTO staff_members(name, cnic, category_id, salary, date_of_joining, start_time, end_time, visit_charges)VALUES('$name', '$cnic', '$designationStaffId', '$salaryStaff', '$dateofjoiningStaff', '$starttimeStaff', '$endtimeStaff', '$visitcharges')");

            if (!$createMember) {
                echo mysqli_error($connect);
                $error = "Member not added! Try Again.";
            }else{
                $added = '<div class="alert alert-primary" role="alert">
                                Staff Member Added!
                             </div>';
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                        Staff Member Already Added!
                                     </div>';
        }
    }


    include('../_partials/header.php'); 
?>
<!-- Top Bar End -->
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
                        <h4 class="mt-0 header-title">Payment Details</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="Amount" name="Amount" id="example-text-input">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Details</label>
                                <div class="col-sm-4">
                                   <textarea id="textarea" class="form-control" maxlength="225" rows="3" placeholder=""></textarea>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addstaff" class="btn btn-primary waves-effect waves-light">Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <span style="text-align: center">
                    <?php echo $error ?>
                </span>
                <span style="text-align: center">
                    <?php echo $added ?>
                </span>
                <span style="text-align: center">
                    <?php echo $alreadyAdded ?>
                </span>
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
<!-- App js -->
<?php include('../_partials/app.php') ?>
<?php include('../_partials/datetimepicker.php') ?>
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
function checkDoctor() {
    var option = document.getElementById('designation')
    var display = option.options[option.selectedIndex].text;

    if (display == 'Doctor' || display == 'doctor') {
        document.querySelector('#visitcharges').style.display = '';
    } else {
        document.querySelector('#visitcharges').style.display = 'none';
    }

}
</script>
</body>

</html>