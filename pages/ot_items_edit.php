<?php
include '../_stream/config.php';

session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}

$notAdded = '';

$date = date_default_timezone_set('Asia/Karachi');
$currentYear = date('Y');
$currentYearNewPatient = date('Y-');

$pickYearly = mysqli_query($connect, "SELECT COUNT(*)AS yearlyCounted FROM `patient_registration` WHERE auto_date LIKE '%$currentYear%'");
$fetch_pickYearly = mysqli_fetch_assoc($pickYearly);
$yearlyCountedPatients = $fetch_pickYearly['yearlyCounted'];

$newPatient = $currentYearNewPatient . "0" . ($yearlyCountedPatients + 1);

if (isset($_POST['patientRegister'])) {
	$yearlyNumber = $_POST['patientYearlyNumber'];
	$name = $_POST['patientName'];
	$Age = $_POST['patientAge'];
	$Gender = $_POST['patientGender'];
	$disease = $_POST['patientDisease'];
	$Address = $_POST['patientAddress'];
	$address_city = $_POST['address_city'];
	$DateOfAdmission = $_POST['patientDateOfAdmission'];
	$consultant = $_POST['patientConsultant'];
	$patientRoom = $_POST['patientRoom'];
	$attendantName = $_POST['attendantName'];
	$patient_cnic = $_POST['patientCnic'];
	$patient_contact = $_POST['patientContact'];

	$currentPatient = 'observationPatient';

	$queryAddPatient = mysqli_query($connect,
		"INSERT INTO patient_registration(
            patient_name,
            patient_age,
            patient_gender,
            patient_address,
            city_id,
            room_id,
            patient_doa,
            patient_disease,
            patient_consultant,
            attendent_name,
            category,
            patient_yearly_no,
            patient_cnic,
            patient_contact
            )VALUES(
            '$name',
            '$Age',
            '$Gender',
            '$Address',
            '$address_city',
            '$patientRoom',
            '$DateOfAdmission',
            '$disease',
            '$consultant',
            '$attendantName',
            '$currentPatient',
            '$yearlyNumber',
            '$patient_cnic',
            '$patient_contact'
            )
           ");

	if (!$queryAddPatient) {
		echo mysqli_error($queryAddPatient);
		$notAdded = 'Not added';
	} else {
		header("LOCATION: observation_list.php");
	}
}

include '../_partials/header.php'
?>

<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Add New Item</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <h4 class="mb-4 page-title">Item Details</h4>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="name" type="text" placeholder="Item Name" id="example-text-input">
                                </div>
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="quantity" type="number" placeholder="Qty" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="price" type="text" placeholder="Item Price" id="example-text-input">
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Purchase</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="patientDateOfpurchase" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Floor No</label>
                               <div class="col-sm-4">
                                    <select class="form-control floor" name="floor_no">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div> -->
                              <!--   <label class="col-sm-2 col-form-label">Room No</label>
                                <div class="col-sm-4">
                                    <select class="form-control room" name="room_no">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div> -->
                            <!-- </div> -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="patientRegister" class="btn btn-primary waves-effect waves-light">Update Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h3>
                        <?php echo $notAdded; ?>
                    </h3>
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
<script type="text/javascript">
$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd hh:ii"
});
</script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.floor').select2({
    placeholder: 'Select floor',
    allowClear: true

});

$('.room').select2({
    placeholder: 'Select room',
    allowClear: true

});
</script>
</body>

</html>