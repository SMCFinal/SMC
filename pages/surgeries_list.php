<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    if (isset($_POST['addSurgery'])) {
        $Name = $_POST['Name'];
        $adm_charges = $_POST['adm_charges'];
        $ot_charges = $_POST['ot_charges'];
        $anes_charges = $_POST['anes_charges'];
        $total_charges = $adm_charges + $ot_charges + $anes_charges;

        $checkQuery = mysqli_query($connect, "SELECT COUNT(*) AS countSurgeries FROM `surgeries` WHERE surgery_name = '$Name'");
        $fetch_checkQuery = mysqli_fetch_assoc($checkQuery);
        if ($fetch_checkQuery['countSurgeries'] < 1) {
            $insertQuery = mysqli_query($connect, "INSERT INTO surgeries(`surgery_name`, `admission_charges`, `ot_charges`, `anethesia_charges`, `total_charges`)VALUES('$Name', '$adm_charges', '$ot_charges', '$anes_charges', '$total_charges')");

        if (!$insertQuery) {
            $error ='<div align="center" class="alert alert-danger" role="alert">
                           Not Added! Try agian!
                         </div>';
        }else {
            $added = '
            <div align="center" class="alert alert-primary" role="alert">
                            Surgery Added!
                         </div>';
        }
        }else {
            $error = '<div align="center" class="alert alert-danger" role="alert">
                            Surgery details already added!
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
                                    <input class="form-control" placeholder="Name" type="text" id="example-text-input" name="Name" required="">
                                </div>


                                <label for="example-text-input" class="col-sm-2 col-form-label">Admission Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Admission Charges" type="number" id="example-text-input" name="adm_charges" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">OT Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="OT Charges" type="number" id="example-text-input" name="ot_charges" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Anethesia Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Anethesia Charges" type="number" id="example-text-input" name="anes_charges" required="">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addSurgery">Add Surgery</button>
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
                                    <th>Admission Charges</th>
                                    <th>OT Charges</th>
                                    <th>Anethesia Charges</th>
                                    <th>Total Charges</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retSurgeryData = mysqli_query($connect, "SELECT * FROM `surgeries` WHERE status = '1'");

                                $iteration = 1;

                                while ($rowSurgery = mysqli_fetch_assoc($retSurgeryData)) {
                                    echo '
                                    <tr>
                                        <td>'.$iteration++.'</td>
                                        <td>'.$rowSurgery['surgery_name'].'</td>
                                        <td>'.$rowSurgery['admission_charges'].'</td>
                                        <td>'.$rowSurgery['ot_charges'].'</td>
                                        <td>'.$rowSurgery['anethesia_charges'].'</td>
                                        <td>'.$rowSurgery['total_charges'].'</td>
                                        <td class="text-center"><a href="surgery_list_edit.php?id='.$rowSurgery['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                        <td class="text-center"><a type="button"  onClick="deleteme('.$rowSurgery['id'].')" class="btn text-white btn-danger waves-effect waves-light">Delete</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <script type="text/javascript">
                        function deleteme(delid){
                          if (confirm("Do you want to Delete Surgery?")) {
                            window.location.href = 'surgeryDelete.php?del_id='+delid+'';
                            return true;
                          }
                        }
                      </script>
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
        placeholder: 'Specialist Name',
  allowClear:true
    });
});
</script>
</body>

</html>