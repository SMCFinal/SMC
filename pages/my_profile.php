<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $user = $_SESSION["user"];
    $loginUser = mysqli_query($connect, "SELECT * FROM `login_user` WHERE email = '$user'");
    $fetch_loginUser = mysqli_fetch_assoc($loginUser);

    $userName = $fetch_loginUser['name'];

    $staffMembers = mysqli_query($connect, "SELECT * FROM staff_members WHERE name = '$userName'");
    $fetch_staffMembers = mysqli_fetch_assoc($staffMembers);

    include('../_partials/header.php'); 
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                </div>
                <h5 class="page-title">My Profile Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title d-inline"><?php echo $fetch_loginUser['name'] ?></h4>
                        <div class=" float-right">
                            <?php
                            echo '
                            <a href="my_profile_edit.php?id='.$fetch_loginUser['id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light">Edit</a>';
                            ?>
                        </div>
                       
                   
                        
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_loginUser['name'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Email</th>
                                        <td><?php echo $fetch_loginUser['email'] ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Password</th>
                                        <td><?php echo $fetch_loginUser['password'] ?></td>
                                    </tr>

                                     <tr>
                                        <th scope="row">Contact</th>
                                        <td>0<?php echo $fetch_staffMembers['contact'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Designation</th>
                                        <td><?php 
                                        if ($fetch_loginUser["user_role"] === '8') {
                                            echo "Doctor";
                                        }elseif ($fetch_loginUser["user_role"] === '9') {
                                            echo "Anesthetic";
                                        }
                                        ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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