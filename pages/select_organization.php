<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    if (isset($_POST['addOrganization'])) {
        $org_name = $_POST['org_name'];

        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedOrgs FROM select_organization WHERE org_name = '$org_name'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);


        if ($fetch_countQuery['countedOrgs'] == 0) {
            $insertQuery = mysqli_query($connect, "INSERT INTO select_organization(org_name)VALUES('$org_name')");
            if (!$insertQuery) {
                $error = 'Not Added! Try agian!';
            }else {
                $added = '
                <div class="alert alert-primary" role="alert">
                                Organization Added!
                             </div>';
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                Organization Already Added!
                             </div>';
        }
    }


    include('../_partials/header.php');
?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Organizations</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Organization Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="PTCL, General etc" type="text" value="" id="example-text-input" name="org_name" required="">
                                </div>
                            </div><hr>
                            <div class="form-group row">
                                <!-- <label for="example-password-input" class="col-sm-2 col-form-label"></label> -->
                                <div class="col-sm-12" align="right">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addOrganization">Add Organization</button>
                                </div>
                            </div>
                        </form>
                        <h5 align="center"><?php echo $error ?></h5>
                        <h5 align="center"><?php echo $added ?></h5>
                        <h5 align="center"><?php echo $alreadyAdded ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Organization List</h4>
                       
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $retOrganization = mysqli_query($connect, "SELECT * FROM select_organization");
                                $iteration = 1;

                                while ($rowOrganization = mysqli_fetch_assoc($retOrganization)) {
                                    echo '
                                    <tr>
                                        <td>'.$iteration++.'</td>
                                        <td>'.$rowOrganization['org_name'].'</td>
                                        <td class="text-center"><a href="org_edit.php?id='.$rowOrganization['org_id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
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
<!-- Datatable init js -->
<?php include('../_partials/datatableInit.php') ?>
<!-- Buttons examples -->
<?php include('../_partials/buttons.php') ?>
<!-- App js -->
<?php include('../_partials/app.php') ?>
<!-- Responsive examples -->
<?php include('../_partials/responsive.php') ?>
<!-- Sweet-Alert  -->
<?php include('../_partials/sweetalert.php') ?>
</body>

</html>