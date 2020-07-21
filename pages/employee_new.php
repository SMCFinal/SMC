<?php
    include('../_stream/config.php');

    $alreadyAdded = '';
    $error = '';
    $added = '';
    
    if (isset($_POST["addEmp"])) {
        $name = $_POST['nameEmp'];
        $cnic = $_POST['cnicEmp'];
        $contact = $_POST['contactEmp'];
        $gender = $_POST['genderEmp'];
        $designation = $_POST['designationEmp'];
        $salaryStaff = $_POST['salaryEmp'];
        $dateofjoiningEmp = $_POST['dateofjoiningEmp'];
        $address = $_POST['addressEmp'];
        
        
        $checkMemberTable = mysqli_query($connect, "SELECT COUNT(*)AS countedEmp FROM `employee_registration` WHERE emp_cnic = '$cnic'");
        $fetch_checkMemberTable = mysqli_fetch_array($checkMemberTable);

        if ($fetch_checkMemberTable['countedEmp'] < 1) {
            $createMember = mysqli_query($connect, "INSERT INTO employee_registration(
                emp_name, emp_cnic, emp_contact, emp_gender, emp_designation, emp_salary, emp_doj, emp_address)VALUES(
                '$name', '$cnic', '$contact', '$gender', '$designation', '$salaryStaff', '$dateofjoiningEmp', '$address')");

            if (!$createMember) {
                echo mysqli_error($connect);
                $error = "Employee not added! Try Again.";
            }else{
                $added = '<div class="alert alert-primary" role="alert">
                                Employee Added!
                             </div>';
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                        Employee Already Added!
                                     </div>';
        }
    }


    include('../_partials/header.php'); 
?>
<!-- Top Bar End -->
<style type="text/css">
    
        .customClass {
            zoom: 1.5;
        }
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Employees Registration</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Employees Details</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Name" name="nameEmp" id="example-text-input">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="CNIC" name="cnicEmp" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Contact" name="contactEmp" id="example-text-input">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <label class="radio-inline">
                                        <input type="radio" name="genderEmp" class="customClass" checked="" value="1">&nbsp;&nbsp;Male
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="genderEmp" class="customClass" value="2">&nbsp;&nbsp;Female
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="genderEmp" class="customClass" value="3">&nbsp;&nbsp;Other
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                    <?php
                                    $select_option = mysqli_query($connect, "SELECT * FROM employee_designation");
                                        $options = '<select class="form-control designation" name="designationEmp" id="designation" style="width: 100%"  required="">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['id'].'>'.$row['designation_name'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                                </div>
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-4">
                                    <input type="number" id="pass2" name="salaryEmp" class="form-control" required placeholder="Salary" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control " type="date" name="dateofjoiningEmp" placeholder="dd/mm/yyyy" autoclear>
                                        <!-- <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div> -->
                                    </div>
                                </div>
                                 <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Address" name="addressEmp" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addEmp" class="btn btn-primary waves-effect waves-light">Add Employee</button>
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