<?php
    include('../_stream/config.php');
    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $alreadyAdded = '';
    $error = '';
    $added = '';

    $id = $_GET['id'];

        
        if (isset($_POST["updateEmp"])) {
        $id = $_POST['id'];
        $name = $_POST['nameEmp'];
        $cnic = $_POST['cnicEmp'];
        $contact = $_POST['contactEmp'];
        $gender = $_POST['genderEmp'];
        $designation = $_POST['designationEmp'];
        $salaryStaff = $_POST['salaryEmp'];
        $dateofjoiningEmp = $_POST['dateofjoiningEmp'];
        $address = $_POST['addressEmp'];
        

            $updateEmpQuery = mysqli_query($connect, "UPDATE employee_registration SET emp_name = '$name', 
                emp_cnic = '$cnic', 
                emp_contact = '$contact', 
                emp_gender = '$gender', 
                emp_designation = '$designation', 
                emp_salary = '$salaryStaff', 
                emp_doj = '$dateofjoiningEmp', 
                emp_address = '$address' 
                WHERE id = '$id'");


            if (!$updateEmpQuery) {
                echo mysqli_error($connect);
                $error = "Employee not added! Try Again.";
            }else{
                header("LOCATION:employee_list.php");
            }
    }


    include('../_partials/header.php'); 
?>
<!-- Top Bar End -->
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
                                <?php 
                                $query = mysqli_query($connect, "SELECT employee_registration.*, employee_designation.designation_name FROM `employee_registration`
                                    INNER JOIN employee_designation ON employee_designation.id = employee_registration.emp_designation
                                    WHERE employee_registration.id = '$id'");
                                $fetch_query = mysqli_fetch_assoc($query);
                                ?>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  type="text" placeholder="Name" name="nameEmp" id="example-text-input"  required="" value="<?php echo $fetch_query['emp_name'] ?>">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="CNIC" name="cnicEmp" id="example-text-input" value="<?php echo $fetch_query['emp_cnic'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Contact" name="contactEmp" id="example-text-input" value="<?php echo $fetch_query['emp_contact'] ?>" required="">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <?php
                                    if ($fetch_query['emp_gender'] == '1') {
                                        echo '
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" checked value="1">Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" value="2">Female
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" value="3">Other
                                            </label>
                                        ';
                                    }elseif ($fetch_query['emp_gender'] == '2') {
                                        echo '
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" value="1">Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" checked value="2">Fenale
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" value="3">Other
                                            </label>
                                        ';
                                    }elseif ($fetch_query['emp_gender'] == '3') {
                                        echo '
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" value="1">Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" checked value="2">Fenale
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="genderEmp" checked value="3">Other
                                            </label>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                   <?php
                                    $select_option = mysqli_query($connect, "SELECT * FROM employee_designation");
                                        $options = '<select class="form-control designation" name="designationEmp" id="designation" style="width: 100%"  required="">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            if ($row['id'] == $fetch_query['emp_designation']) {        
                                            $options.= '<option value='.$row['id'].' selected>'.$row['designation_name'].'</option>';
                                            }else{
                                            $options.= '<option value='.$row['id'].'>'.$row['designation_name'].'</option>';
                                            }
                                        }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                                </div>
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-4">
                                    <input type="number" id="pass2" name="salaryEmp" class="form-control" required value="<?php echo $fetch_query['emp_salary'] ?>" placeholder="Salary" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control date dateonly" name="dateofjoiningEmp" placeholder="dd/mm/yyyy" autoclear value="<?php echo $fetch_query['emp_doj'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                                 <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Address" name="addressEmp" id="example-text-input" value="<?php echo $fetch_query['emp_address'] ?>">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="updateEmp" class="btn btn-primary waves-effect waves-light">Update Employee</button>
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