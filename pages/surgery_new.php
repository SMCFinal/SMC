<?php
   
    include('../_partials/header.php') 
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Assign Surgery</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Surgery Details</h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="patient Name" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" readonly placeholder="" type="text" name="ptaient_name" id="">
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Surgery</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="patientDateOfsurgery" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Consultant</label>
                                <div class="col-sm-4">
                                    <select class="form-control consultant" name="consultant_name">
                                        <option>aaa</option>
                                        <option>bbb</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Surgery Name</label>
                                <div class="col-sm-4">
                                    <select class="form-control surgery_name" name="surgery_name">
                                        <option>aaa</option>
                                        <option>bbb</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-sm-2 col-form-label">Doctor Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="number" name="dr_charges" placeholder="Doctor Charges" id="example-email-input">
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Anesthesia Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Anesthesia Charges" type="number" name="anesthesia_charges" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addsurgery" class="btn btn-primary waves-effect waves-light">Add Surgery</button>
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
$('.surgery_name').select2({
    placeholder: 'Surgery Name',
    allowClear: true

});
$('.consultant').select2({
    placeholder: 'Consultant Name',
    allowClear: true

});
</script>
</body>

</html>