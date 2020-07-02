<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}

$alreadyAdded = '';
$added = '';
$error = '';

$id = $_GET['id'];
$retTestCat = mysqli_query($connect, "SELECT * FROM lab_test_category WHERE id = '$id'");
$fetch_retData = mysqli_fetch_assoc($retTestCat);
$testCat = $fetch_retData['test_name'];
$testPrice = $fetch_retData['test_price'];

if (isset($_POST['updateTest'])) {
	$id = $_POST['id'];
	$name = $_POST['nameCategory'];
    $price = $_POST['testPrice'];
    $nameCategory = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($name))));

	$countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedTestCat FROM lab_test_category WHERE test_name = '$nameCategory' AND test_price = '$price'");
	$fetch_countQuery = mysqli_fetch_assoc($countQuery);

	if ($fetch_countQuery['countedTestCat'] == 0) {
		$updateQuery = mysqli_query($connect, "UPDATE lab_test_category SET test_name = '$nameCategory', test_price = '$price' WHERE id = '$id'");
		if (!$updateQuery) {
			$error = 'Not Added! Try agian!';
		} else {
			header("LOCATION:lab_test_category.php");
		}
	} else {
		$alreadyAdded = '<div class="alert alert-dark" role="alert">
                                Already Added!
                             </div>';
	}
}

include '../_partials/header.php';
?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Edit Laboratory Test Category</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $testCat ?>" placeholder="Lab Test Category" type="text" id="example-text-input"  name="nameCategory"  required="">
                                </div>

                                <!-- <div class="form-group row"> -->
                                <label for="example-text-input" class="col-sm-2 col-form-label">Test Price</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Test Price" type="number" value="<?php echo $testPrice ?>" id="example-text-input" name="testPrice" required="" >
                                </div>
                            <!-- </div> -->
                            </div>


                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="updateTest" id="submit-data">Update Category</button>
                                </div>
                            </div>
                        </form>
                        <h5><?php echo $error ?></h5>
                        <h5><?php echo $added ?></h5>
                        <h5><?php echo $alreadyAdded ?></h5>
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
<!-- Required datatable js -->
<?php include '../_partials/datatable.php'?>
<!-- Datatable init js -->
<?php include '../_partials/datatableInit.php'?>
<!-- Buttons examples -->
<?php include '../_partials/buttons.php'?>
<!-- App js -->
<?php include '../_partials/app.php'?>
<!-- Responsive examples -->
<?php include '../_partials/responsive.php'?>
<!-- Sweet-Alert  -->
<?php include '../_partials/sweetalert.php'?>

<script type="text/javascript">
    // Store original values
var orig = [];             
$("form :input").each(function () {
    var type = $(this).getType();
    var tmp = {'type': type, 'value': $(this).val()};
    if (type == 'radio') { tmp.checked = $(this).is(':checked'); }
    orig[$(this).attr('id')] = tmp;
});

// Check values on change
$('form').bind('change keyup', function () {
    var disable = true;
    $("form :input").each(function () {
        // var type = $(this).getType();
        var id = $(this).attr('id');    
        if (type == 'text' || type == 'select') {
            disable = (orig[id].value == $(this).val());
        } else if (type == 'radio') {
            disable = (orig[id].checked == $(this).is(':checked'));
        }    
        if (!disable) { return false; } // break out of loop
    });

    $('#submit-data').prop('disabled', disable); // update button
});

// Get form element type
$.fn.getType = function () { 
    if(this[0].tagName == "INPUT")
        return $(this[0]).attr("type").toLowerCase() 
    else
        return this[0].tagName.toLowerCase();        
}
</script>
</body>

</html>