<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    if (isset($_POST['prepare'])) {
        $patient_id = $_POST['patient'];

        header("LOCATION:birth_certificate_fields.php?id=".$patient_id."");
    }


include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Birth Certificate</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Prepare Birth Certificate</h4>
                        <form method="POST">
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select Patient</label>
                                <div class="col-sm-8"> 

                                <?php
                                    $select_option = mysqli_query($connect, "SELECT discharge_patients.id, discharge_patients.patient_name, discharge_patients.city_id, discharge_patients.patient_yearly_no, discharge_patients.patient_operation, surgeries.surgery_name, area.area_name, discharge_patients.auto_date  FROM `discharge_patients`
                                    INNER JOIN area ON area.id = discharge_patients.city_id
                                    INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
                                    WHERE surgeries.surgery_name LIKE '%INDUCTION%' OR surgeries.surgery_name LIKE '%Nvd%' OR surgeries.surgery_name LIKE '%Section%' AND discharge_patients.birth_certificate = '0' GROUP BY discharge_patients.patient_yearly_no ORDER BY discharge_patients.auto_date DESC");
                                        $options = '<select class="form-control select2" name="patient" required="" style="width:100%">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['id'].'>'.$row['patient_yearly_no'].' - '.$row['patient_name'].', R/O: '.$row['area_name'].', '.$row['surgery_name'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                          
                                </div>
                            </div>

                            <hr />

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <!-- <a href="discharge_patient_file.php" >Discharge  </a> -->

                                    <button type="submit" name="prepare" class="btn btn-primary waves-effect waves-light">Prepare</button>
                                    <!-- <a href="discharge_patient_file.php" type="submit" name="addMedicine" class="btn btn-primary waves-effect waves-light">Discharge  </a> -->
                                    <!-- <button ></button> -->
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div> <!-- end col -->
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

<script type="text/javascript" src="../assets/js/select2.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
</script>

</body>

</html>