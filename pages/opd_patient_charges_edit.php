<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    $id = $_GET['id'];
    $getQuery = mysqli_query($connect, "SELECT * FROM opd_charges WHERE pat_id = '$id'");
    $fetch_getQuery = mysqli_fetch_assoc($getQuery);

    if (isset($_POST['addPatientCharges'])) {

        $room_charges               = $_POST['room_charges'];
        $operation_charges          = $_POST['operation_charges'];
        $anesthesia_charges         = $_POST['anesthesia_charges'];
        $ot_charges                 = $_POST['ot_charges'];
        $ota_charges                = $_POST['ota_charges'];
        $delivery_charges           = $_POST['delivery_charges'];
        $xray_charges               = $_POST['xray_charges'];
        $lab_charges                = $_POST['lab_charges'];
        $ultrasound_charges         = $_POST['ultrasound_charges'];
        $otherinvestigation_charges = $_POST['otherinvestigation_charges'];
        $consultant_charges         = $_POST['consultant_charges'];
        $consultantvisit_charges    = $_POST['consultantvisit_charges'];
        $bloodtransfusions_charges  = $_POST['bloodtransfusions_charges'];
        $medicines_charges          = $_POST['medicines_charges'];
        $mo_charges                 = $_POST['mo_charges'];
        $nursing_charges            = $_POST['nursing_charges'];
        $isochlorane_charges        = $_POST['isochlorane_charges'];
        $ctscan_charges             = $_POST['ctscan_charges'];
        $mri_charges                = $_POST['mri_charges'];
        $otherone_charges           = $_POST['otherone_charges'];
        $othertwo_charges           = $_POST['othertwo_charges'];
        $otherthree_charges         = $_POST['otherthree_charges'];
        $otherfour_charges          = $_POST['otherfour_charges'];
        $pat_id                     = $_POST['pat_id'];
        $charges_id                 = $_POST['charges_id'];

        $insertQuery = mysqli_query($connect, "UPDATE `opd_charges` SET 
             `room_charges` = '$room_charges',
              `operation_charges` = '$operation_charges',
               `anesthesia_charges` = '$anesthesia_charges',
                `ot_charges` = '$ot_charges',
                 `ota_charges` = '$ota_charges',
                  `delivery_charges` = '$delivery_charges',
                   `xray_charges` = '$xray_charges',
                    `lab_charges` = '$lab_charges',
                     `ultrasound_charges` = '$ultrasound_charges',
                      `otherinvestigation_charges` = '$otherinvestigation_charges',
                       `consultant_charges` = '$consultant_charges',
                        `consultantvisit_charges` = '$consultantvisit_charges',
                         `bloodtransfusions_charges` = '$bloodtransfusions_charges',
                          `medicines_charges` = '$medicines_charges',
                           `mo_charges` = '$mo_charges',
                            `nursing_charges` = '$nursing_charges',
                             `isochlorane_charges` = '$isochlorane_charges',
                              `ctscan_charges` = '$ctscan_charges',
                               `mri_charges` = '$mri_charges',
                                `otherone_charges` = '$otherone_charges',
                                 `othertwo_charges` = '$othertwo_charges',
                                  `otherthree_charges` = '$otherthree_charges',
                                   `otherfour_charges` = '$otherfour_charges'

                                     WHERE opd_charges = '$charges_id' AND pat_id = '$pat_id'");
        
        if (!$insertQuery) {
            $error = '
            <div align="center" class="alert alert-danger" role="alert">
                OPD Patient Charges Not Added! Try Again!
            </div>';
        }else {
                $changeStatus = mysqli_query($connect, "UPDATE opd_ptcl SET payment_status = '1' WHERE o_id = '$pat_id'");
                header("LOCATION: opd_patient_list.php");
        }
        
        
            
    }


    include('../_partials/header.php');
?>

<style>
    label {
        font-size: 18px !important;
    }
</style>

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Add OPD Patient Charges</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">

                        <input type="hidden" name="pat_id" value="<?php echo $id ?>">
                        <input type="hidden" name="charges_id" value="<?php echo $fetch_getQuery['opd_charges'] ?>">

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Ward / Private Room / VIP Room Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo  $fetch_getQuery['room_charges'] ?>" type="number" id="example-text-input" name="room_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Operation Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['operation_charges'] ?>"  type="number" id="example-text-input" name="operation_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Anesthesia Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['anesthesia_charges'] ?>"  type="number" id="example-text-input" name="anesthesia_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">OT Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['ot_charges'] ?>"  type="number" id="example-text-input" name="ot_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">OTA Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['ota_charges'] ?>"  type="number" id="example-text-input" name="ota_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Delivery Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['delivery_charges'] ?>"  type="number" id="example-text-input" name="delivery_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">X-Ray Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['xray_charges'] ?>"  type="number" id="example-text-input" name="xray_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Laboratory Investigation</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['lab_charges'] ?>"  type="number" id="example-text-input" name="lab_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Ultrasound Examination</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['ultrasound_charges'] ?>" type="number" id="example-text-input" name="ultrasound_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Other Investigations</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['otherinvestigation_charges'] ?>"  type="number" id="example-text-input" name="otherinvestigation_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Specialist Consultations (Physicians)</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['consultant_charges'] ?>"  type="number" id="example-text-input" name="consultant_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Specialist Visits</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['consultantvisit_charges'] ?>"  type="number" id="example-text-input" name="consultantvisit_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Blood Transfusions</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['bloodtransfusions_charges'] ?>"  type="number" id="example-text-input" name="bloodtransfusions_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Medicines</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['medicines_charges'] ?>"  type="number" id="example-text-input" name="medicines_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">MO Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['mo_charges'] ?>"  type="number" id="example-text-input" name="mo_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Nursing Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['nursing_charges'] ?>"  type="number" id="example-text-input" name="nursing_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Isochlorane Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['isochlorane_charges'] ?>"  type="number" id="example-text-input" name="isochlorane_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">CT Scan Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['ctscan_charges'] ?>"  type="number" id="example-text-input" name="ctscan_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">MRI Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['mri_charges'] ?>"  type="number" id="example-text-input" name="mri_charges" required="">
                                </div>
                            </div>

                            <hr />

                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Other Charges 1</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo  $fetch_getQuery['otherone_charges'] ?>"  type="number" id="example-text-input" name="otherone_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Other Charges 2</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php  echo $fetch_getQuery['othertwo_charges'] ?>"  type="number" id="example-text-input" name="othertwo_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Other Charges 3</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php  echo $fetch_getQuery['otherthree_charges'] ?>"  type="number" id="example-text-input" name="otherthree_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label text-right">Other Charges 4</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php  echo $fetch_getQuery['otherfour_charges'] ?>"  type="number" id="example-text-input" name="otherfour_charges" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-5 text-center">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addPatientCharges">OPD Patient Charges</button>
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
    $('.gender').select2({
        placeholder: 'Baby Gender',
        allowClear:true
    });
});
</script>
</body>

</html>