<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    if (isset($_POST['addDesignation'])) {
        $designation = $_POST['designationName'];
        $designationName = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($designation))));


        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedDesignation FROM employee_designation WHERE designation_name = '$designationName'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);


        if ($fetch_countQuery['countedDesignation'] == 0) {
            $insertQuery = mysqli_query($connect, "INSERT INTO employee_designation(designation_name)VALUES('$designationName')");
            if (!$insertQuery) {
                $error = 'Not Added! Try agian!';
            }else {
                $added = '
                <div class="alert alert-primary" role="alert">
                                Designation Added!
                             </div>';
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                Designation Already Added!
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
                <h5 class="page-title">Designations</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Designation" type="text" value="" id="example-text-input" name="designationName" required="">
                                </div>
                            </div><hr>
                            <div class="form-group row">
                                <!-- <label for="example-password-input" class="col-sm-2 col-form-label"></label> -->
                                <div class="col-sm-12" align="right">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addDesignation">Add Designations</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                        <h5 align="center"><?php echo $error ?></h5>
                        <h5 align="center"><?php echo $added ?></h5>
                        <h5 align="center"><?php echo $alreadyAdded ?></h5>
            </div>
            <div class="col-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Designations List</h4>
                       
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
                                    $retDesignations = mysqli_query($connect, "SELECT * FROM `employee_designation`");
                                    $iteration = 1;

                                    while ($rowDesignation = mysqli_fetch_assoc($retDesignations)) {
                                        echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowDesignation['designation_name'].'</td>
                                            <td class="text-center"><a href="employee_designations_edit.php?id='.$rowDesignation['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                        </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
<!--                                          <td class="text-center"><button class="btn btn-danger btn-sm" onClick="deleteme('.$rowDesignation['id'].",".$rowDesignation['designation_name'].')" name="Deleteme" data-original-title="Deactivate User Access">PostPone</button></td> -->
                <!-- <script type="text/javascript">
                    function deleteme(delid,des_id){
                      if (confirm("Do you want to delete "+  +" designation?")) {
                        window.location.href = 'temporary_disable.php?del_id='+delid+'&room_id='+room+'';
                        return true;
                      }
                    }
                </script> -->
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