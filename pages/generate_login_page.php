<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }
    include '../_partials/header.php';

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT * FROM staff_members WHERE id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    $dr_name_temp = strtolower($fetch_selectQuery['name']);
    $explodeDrName = explode(" ", $dr_name_temp);
    $sizeOfArray = sizeof($explodeDrName);
    
    if ($sizeOfArray > 2) {
        $dr_username = "dr_".$explodeDrName[1].$explodeDrName[2];
        $dr_email = $explodeDrName[1].$explodeDrName[2]."@smc.com"; 
    }else {
        $dr_username = "dr_".$explodeDrName[1];
        $dr_email = $explodeDrName[1]."@smc.com"; 
    }

    // Doctor Name 
    $dr_name = $fetch_selectQuery['name'];

    // Doctor Email
    $dr_email;

    // Doctor User name
    $dr_username;

    // Doctor Login Password
    $dr_password = random_int(100000, 999999);

    // Doctor Contact
    $dr_contact = "0".$fetch_selectQuery['contact'];

    // Doctor Role
    $dr_role = '8';


    $insertQuery = mysqli_query($connect, "INSERT INTO `login_user`
    (`name`, `username`, `email`, `password`, `contact`, `user_role`) 
    VALUES 
    ('$dr_name', '$dr_username', '$dr_email', '$dr_password', '$dr_contact', '$dr_role')");

    if ($insertQuery) {
        $updateStaffMembersTable = mysqli_query($connect, "UPDATE staff_members SET login_credentials = '1' WHERE id = '$id'");

        if ($updateStaffMembersTable) {
            $message = "Login via email: ".$dr_email." & password: ".$dr_password.". Access to login: http://babar-ali.com/SMC/";
            $messageTable = mysqli_query($connect, "INSERT INTO message_tbl
            (from_device, to_device, message_body, status)
            VALUES
            ('1', '$dr_contact', '$message', '1')");

            if ($messageTable) {
                $countDown = '12';
            }
        }
    }

?>
<!-- Top Bar End -->
<style type="text/css">
.lds-default {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-default div {
    position: absolute;
    width: 6px;
    height: 6px;
    background: #54CC96;
    border-radius: 50%;
    animation: lds-default 1.2s linear infinite;
}

.lds-default div:nth-child(1) {
    animation-delay: 0s;
    top: 37px;
    left: 66px;
}

.lds-default div:nth-child(2) {
    animation-delay: -0.1s;
    top: 22px;
    left: 62px;
}

.lds-default div:nth-child(3) {
    animation-delay: -0.2s;
    top: 11px;
    left: 52px;
}

.lds-default div:nth-child(4) {
    animation-delay: -0.3s;
    top: 7px;
    left: 37px;
}

.lds-default div:nth-child(5) {
    animation-delay: -0.4s;
    top: 11px;
    left: 22px;
}

.lds-default div:nth-child(6) {
    animation-delay: -0.5s;
    top: 22px;
    left: 11px;
}

.lds-default div:nth-child(7) {
    animation-delay: -0.6s;
    top: 37px;
    left: 7px;
}

.lds-default div:nth-child(8) {
    animation-delay: -0.7s;
    top: 52px;
    left: 11px;
}

.lds-default div:nth-child(9) {
    animation-delay: -0.8s;
    top: 62px;
    left: 22px;
}

.lds-default div:nth-child(10) {
    animation-delay: -0.9s;
    top: 66px;
    left: 37px;
}

.lds-default div:nth-child(11) {
    animation-delay: -1s;
    top: 62px;
    left: 52px;
}

.lds-default div:nth-child(12) {
    animation-delay: -1.1s;
    top: 52px;
    left: 62px;
}

@keyframes lds-default {

    0%,
    20%,
    80%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.5);
    }
}

#sidebar-menu,
.side-menu,
.topbar {
    display: none
}
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h5 class="page-title">Add Medicine</h5> -->
                <br><br><br><br><br>
                <br><br><br><br><br>
            </div>
        </div>
        <!-- end row -->
        <div class="row">    
            <div class="col-1"></div>
            <div class="col-8">
                <div class="card m-b-30">
                    <div class="card-body" align="center">
                        <div class="lds-default">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <h3>Generating Credentials, Please Wait <span id="countdown"><?php echo $countDown ?></span></h3>
                        <script type="text/javascript">
                        var seconds = document.getElementById("countdown").textContent;
                        var countdown = setInterval(function() {
                            seconds--;
                            document.getElementById("countdown").textContent = seconds;
                            if (seconds <= 0) {
                                window.location.href = 'doctors_list_login.php';
                            }
                        }, 1000);
                        </script>
                    </div>
                </div>

            </div> <!-- end col -->
            <div class="col-2"></div>
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
</body>

</html>