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
    $retData = mysqli_query($connect, "SELECT * FROM staff_category WHERE id = '$id'");
    $fetch_retData = mysqli_fetch_assoc($retData);
    $cat_Name = $fetch_retData['category_name'];

    if (isset($_POST['addCategory'])) {
        $id = $_POST['id'];
        $categoryName = $_POST['categoryName'];

        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedCategories FROM staff_category WHERE category_name = '$categoryName'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);


        if ($fetch_countQuery['countedCategories'] == 0) {
            $insertQuery = mysqli_query($connect, "UPDATE staff_category SET category_name = '$categoryName' WHERE id = '$id'");
            if (!$insertQuery) {
                $error = 'Not Added! Try agian!';
            }else {
                header("LOCATION:HR_staff_category.php");
            }
        }else {
            $alreadyAdded = '<div class="alert alert-dark" role="alert">
                                Category Already Added!
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
                <h5 class="page-title">HR Staff Categories</h5>
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
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $cat_Name ?>" placeholder="Name" type="text" value="" id="example-text-input" name="categoryName" required="">
                                </div>
                               
                            </div>
                            <div class="form-group row">
                                 <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addCategory">Update Category</button>
                                </div>
                            </div>
                        </form>
                        <span style="text-align: center">
                            <?php echo $error ?>
                        </span>
                        <span style="text-align: center">
                            <?php echo $added ?>
                        </span>
                        <span style="text-align: center">
                            <?php echo $alreadyAdded ?>
                        </span>
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
        allowClear: true
    });
});
</script>
</body>

</html>