<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    include('../_partials/header.php');
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <h5 class="page-title">Doctor <i class="fa fa-user-md"></i> </h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Doctors Login</h4>
                        <table id="datatable" class="table  dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th class="text-center"><i class="fa fa-sign-in"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $selectQueryMembers = mysqli_query($connect, "SELECT staff_members.*, staff_members.id AS staffId, staff_category.* FROM `staff_members`
                                    INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                    WHERE staff_members.status = '1'");
                                    $iteration = 1;

                                    while ($rowMembers = mysqli_fetch_assoc($selectQueryMembers)) {
                                        if ($rowMembers['category_id'] === '3') {   
                                            if ($rowMembers['login_credentials'] === '0') {
                                                echo '
                                                <tr>
                                                    <td>'.$iteration++.'</td>
                                                    <td>'.$rowMembers['name'].'</td>
                                                    <td>'.$rowMembers['category_name'].'</td>
                                                    <td class="text-center"><a href="generate_login_page.php?id='.$rowMembers['staffId'].'" type="button" class="btn text-white btn-secondary waves-effect waves-light btn-sm">Generate Credentials</a></td>
                                                </tr>';
                                            }
                                        }
                                    }
                                ?>


                            </tbody>
                        </table>
                        <script type="text/javascript">
                        function deleteme(delid) {
                            if (confirm("Do you want to discharge patient?")) {
                                window.location.href = 'temporary_disable.php?del_id=' + delid + '';
                                return true;
                            }
                        }
                        </script>
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