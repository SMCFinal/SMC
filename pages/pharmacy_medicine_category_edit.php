<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

    $id = $_GET['id'];

    $retCategoryData = mysqli_query($connect, "SELECT * FROM medicine_category WHERE id = '$id'");
    $fetch_retCategoryData = mysqli_fetch_assoc($retCategoryData);

    $notUpdated = '';

    if (isset($_POST['updateCategory'])) {
        $id = $_POST['id'];
        $category = $_POST['categoryName'];
            $categoryName = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($category))));

        $updateCategory = mysqli_query($connect, "UPDATE medicine_category SET category_name = '$categoryName' WHERE id = '$id'");

        if (!$updateCategory) {
            $notUpdated = 'Category Not Updated!';
        }else {
            header("LOCATION:pharmacy_medicine_category.php");
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
                <h5 class="page-title">Medicines Categories</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $fetch_retCategoryData['id'] ?>">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Name" type="text" id="example-text-input" name="categoryName" value="<?php echo $fetch_retCategoryData['category_name'] ?>"  required="">
                                </div>

                            </div>
                            <div class="form-group row">
                                 <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="updateCategory">Update Category</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <h3><?php echo $notUpdated ?></h3>
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