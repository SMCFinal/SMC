<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    if (isset($_POST['addFloor'])) {
        $floorName = $_POST['floorName'];

        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedFloors FROM floors WHERE floor_name = '$floorName'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);


        if ($fetch_countQuery['countedFloors'] == 0) {
            $insertQuery = mysqli_query($connect, "INSERT INTO floors(floor_name)VALUES('$floorName')");
            if (!$insertQuery) {
                $error = 'Not Added! Try agian!';
            }else {
                $added = 'Floor Added!';
            }
        }else {
            $alreadyAdded = 'Floor Already Added!';
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
                <h5 class="page-title">Surgeries</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Name" type="text" value="" id="example-text-input" name="Name" required="">
                                </div>

                                <label class="col-sm-2 col-form-label">Specialist</label>
                                <div class="col-sm-4">
                                   <select class="specialist" name="specilist[]" multiple="multiple" style="width: 100%">

                                        <option value="1">Johny Sins</option>
                                        <option value="2">Asif</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addFloor">Add Surgery</button>
                                </div>
                            </div>
                        </form>
                        <h5>
                            <?php echo $error ?>
                        </h5>
                        <h5>
                            <?php echo $added ?>
                        </h5>
                        <h5>
                            <?php echo $alreadyAdded ?>
                        </h5>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Surgery Details</h4>
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Specialist</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>XYZ</td>
                                    <td>Asif</td>
                                    <td class="text-center"><a href="surgery_list_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                    <td class="text-center"><a type="button" id="sa-warning" class="btn text-white btn-danger waves-effect waves-light">Delete</a></td>
                                </tr>
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
 <script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.specialist').select2({
        placeholder: 'Specilist Name',
  allowClear:true
    });
});
</script>
</body>

</html>