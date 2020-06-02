<?php

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Order Medicine</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title">Patient Name</h4> -->
                        <form method="POST">

                            <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-4">
                                <select class="form-control designation" name="Category" id="designation" style="width: 100%"  required="">
                                    <option value='abc'> abc</option>
                                    <option value='abc'> abc</option>

                                </select>

                                </div>

                            </div>

                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <a href="pharmacy_order_medicine_new_table.php" type="submit" name="addMedicine" class="btn btn-primary waves-effect waves-light">Order Medicine</a>
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

</body>

</html>