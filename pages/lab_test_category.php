<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}

$alreadyAdded = '';
$added = '';
$error = '';

if (isset($_POST['addLabTest'])) {
	$test = $_POST['testName'];
    $price = $_POST['testPrice'];
    $testCategory = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($test))));


	$countQuery = mysqli_query($connect, "SELECT COUNT(*)AS testCategories FROM lab_test_category WHERE test_name = '$testCategory' AND test_price = '$price'");
	$fetch_countQuery = mysqli_fetch_assoc($countQuery);

	if ($fetch_countQuery['testCategories'] == 0) {
		$insertQuery = mysqli_query($connect, "INSERT INTO lab_test_category(test_name, test_price)VALUES('$testCategory', '$price')");
		if (!$insertQuery) {
			$error = 'Not Added! Try agian!';
		} else {
			$added = '
                <div class="alert alert-primary" role="alert">
                                Category Added!
                             </div>';
		}
	} else {
		$alreadyAdded = '<div class="alert alert-dark" role="alert">
                                Category Already Added!
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
                <h5 class="page-title">Laboratory Test's</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Test Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Lab Test Category" type="text" value="" id="example-text-input" name="testName" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Test Price</label>
                                <div class="col-sm-8">
                                    <input class="form-control" placeholder="Test Price" type="number" value="" id="example-text-input" name="testPrice" required="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <!-- <label for="example-password-input" class="col-sm-2 col-form-label"></label> -->
                                <div class="col-sm-12" align="right">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addLabTest">Add Test Category</button>
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
                        <h4 class="mt-0 header-title">Laboratory Test Catgeories</h4>

                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Test Name</th>
                                    <th>Test Price</th>
                                    <th class="text-center"><i class="fa fa-edit"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retTestCategory = mysqli_query($connect, "SELECT * FROM lab_test_category");
                                $iteration = 1;

                                while ($rowTestCategory = mysqli_fetch_assoc($retTestCategory)) {
                                	echo '
                                    <tr>
                                        <td>'.$iteration++ .'</td>
                                        <td>'.$rowTestCategory['test_name'].'</td>
                                        <td>'.$rowTestCategory['test_price'].'</td>
                                        <td class="text-center"><a href="lab_test_category_edit.php?id='.$rowTestCategory['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
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
</body>

</html>