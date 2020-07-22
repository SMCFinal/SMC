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
    $query = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$id'");
    $fetchQuery = mysqli_fetch_assoc($query);

    if (isset($_POST["addstaff"])) {
        $id = $_POST['id'];
        $name = $_POST['nameStaff'];
        $cnic = $_POST['cnicStaff'];
        $designation = $_POST['designationStaff'];
        $salaryStaff = $_POST['salaryStaff'];
        $dateofjoiningStaff = $_POST['dateofjoiningStaff'];
        $starttimeStaff = $_POST['starttimeStaff'];
        $endtimeStaff = $_POST['endtimeStaff'];
        $visitcharges = $_POST['visitchargesStaff'];
        $contact = $_POST['contact'];

        $explodeDoctor = explode(":", $designation);
        $designationStaffId = $explodeDoctor[1];

        $checkMemberTable = mysqli_query($connect, "SELECT COUNT(*)AS countedStaff FROM `staff_members` WHERE cnic = '$cnic'");
        $fetch_checkMemberTable = mysqli_fetch_array($checkMemberTable);

        if ($fetch_checkMemberTable['countedStaff'] < 1) {
            $updateMember = mysqli_query($connect, "UPDATE staff_members SET name = '$name', cnic = '$cnic', category_id = '$designationStaffId', salary = '$salaryStaff', date_of_joining = '$dateofjoiningStaff', start_time = '$starttimeStaff', end_time = '$endtimeStaff', visit_charges = '$visitcharges', contact = '$contact' WHERE id = '$id'");
            
            // $createMember = mysqli_query($connect, "INSERT INTO staff_members(name, cnic, category_id, salary, date_of_joining, start_time, end_time, visit_charges)VALUES('$name', '$cnic', '$designationStaffId', '$salaryStaff', '$dateofjoiningStaff', '$starttimeStaff', '$endtimeStaff', '$visitcharges')");

            if (!$updateMember) {
                echo mysqli_error($connect);
                $error = "Member detail not updated! Try Again.";
            }else{
                $added = '<div class="alert alert-primary" role="alert">
                                Staff Member Updated!
                             </div>';
                             header("LOCATION: HR_staff_list.php");
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                        Staff Member Already in Database!
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
                <h5 class="page-title">Edit Staff Detail </h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Staff Details</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Name" name="nameStaff" id="example-text-input" value="<?php echo $fetchQuery['name'] ?>">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="CNIC" name="cnicStaff" id="example-text-input" value="<?php echo $fetchQuery['cnic'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                    <?php
                                    $select_option = mysqli_query($connect, "SELECT * FROM staff_category");
                                        $options = '<select class="form-control designation" name="designationStaff" id="designation" style="width: 100%" onchange=checkDoctor() required="">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            if ($row['id'] == $fetchQuery['category_id']) {
                                                $options.= '<option value='.$row['category_name'].':'.$row['id'].' selected>'.$row['category_name'].'</option>';
                                            }else {
                                                $options.= '<option value='.$row['category_name'].':'.$row['id'].'>'.$row['category_name'].'</option>';
                                            }
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-4">
                                    <input type="number" id="pass2" name="salaryStaff" class="form-control" required placeholder="Salary" value="<?php echo $fetchQuery['salary'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control date dateonly" name="dateofjoiningStaff" placeholder="dd/mm/yyyy" value="<?php echo $fetchQuery['date_of_joining'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>

                                <label class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input type="number" class="form-control" name="contact" placeholder="Contact No" value="<?php echo $fetchQuery['contact'] ?>" autoclear required="">
                                        <!-- <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Time</label>
                                <div class="col-sm-4">
                                    <div class="input-group ">
                                        <input class="form-control date  timeonly" name="starttimeStaff" placeholder="hh:mm" value="<?php echo $fetchQuery['start_time'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label">End Time</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control date  timeonly" name="endtimeStaff" placeholder="hh:mm" value="<?php echo $fetchQuery['end_time'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row " id="visitcharges" style="display: none">
                                <label for="visit" class="col-sm-2 col-form-label">Visit Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Visit Charges" name="visitchargesStaff" required="" value="<?php echo $fetchQuery['visit_charges'] ?>" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addstaff" class="btn btn-primary waves-effect waves-light">Update Staff</button>
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
    format: "HH:ii",
    showMeridian: true,
        autoclose: true,
        todayBtn: true
});

$(".dateonly").datetimepicker({
    format: "yyyy-mm-dd",
    autoclose:true,
    todayBtn: true
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
        }
        else {
            document.querySelector('#visitcharges').style.display = 'none';
        }

}

  


</script>
</body>

</html>