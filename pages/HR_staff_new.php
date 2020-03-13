<?php
    include('../_stream/config.php');

    $userAlreadyinDatabase = '';
    $userNotAdded = '';
    $userAdded = '';
    
    if (isset($_POST["addUser"])) {
        $name = $_POST['addUser_Name'];
        $userName = $_POST['addUser_userName'];
        $email = $_POST['addUser_email'];
        $password = $_POST['addUser_password'];
        $role = $_POST['addUser_role'];

        $checkUserTable = mysqli_query($connect, "SELECT COUNT(*)AS countedUsers FROM `login_user` WHERE email = '$email'");
        $fetch_checkUserTable = mysqli_fetch_array($checkUserTable);

        if ($fetch_checkUserTable['countedUsers'] < 1) {
            $createUser = mysqli_query($connect, "INSERT INTO login_user(name, username, email, password, user_role)VALUES('$name', '$userName', '$email', '$password', '$role')");

            if (!$createUser) {
                echo mysqli_error($createUser);
                $userNotAdded = "User not added! Try Again.";
            }else{
                $userAdded = "User Added!";
            }
        }else {
            $userAlreadyinDatabase = "User Already Exist";
        }
    }

    include('../_partials/header.php') 
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Staff Registration</h5>
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
                                    <input class="form-control" type="text" placeholder="Name" name="name" id="example-text-input">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" placeholder="CNIC" name="cnic" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                    <select class="form-control designation" name="designation" id="designation" style="width: 100%" onchange=checkDoctor()>
                                        <option selected disabled=""  value="Doctor">Select Option</option>

                                        <option  value="Doctor">Doctor</option>
                                        <option value="Nurse">Nurse</option>
                                        <option value="3">aa</option>
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Salary</label>
                                <div class="col-sm-4">
                                    <input type="number" id="pass2" name="salary" class="form-control" required placeholder="Salary" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Joining</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="dateofjoining" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Termination</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="dateoftermination" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Time</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="starttime" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                                <label class="col-sm-2 col-form-label">End Time</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="endtime" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row " id="visitcharges" style="display: none">
                                <label for="visit" class="col-sm-2 col-form-label">Visit Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Visit Charges" name="visitcharges">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addstaff" class="btn btn-primary waves-effect waves-light">Add Staff</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 align="center">
                    <?php echo $userAlreadyinDatabase; ?>
                </h3>
                <h3 align="center">
                    <?php echo $userAdded; ?>
                </h3>
                <h3 align="center">
                    <?php echo $userNotAdded; ?>
                </h3>
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
$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii"
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
    let desg = document.querySelector('#designation');
    if (desg.value.toLowerCase() == 'doctor') {

        document.querySelector('#visitcharges').style.display = '';
    }
    else {
        document.querySelector('#visitcharges').style.display = 'none';


    }

}

  


</script>
</body>

</html>