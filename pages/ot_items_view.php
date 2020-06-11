<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}

$id = $_GET['id'];

$selectQuery = mysqli_query($connect, "SELECT * FROM ot_items WHERE id = '$id'");
$fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

include '../_partials/header.php';
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb"></div>
                <h5 class="page-title">Item Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title d-inline"><a href="ot_items_list.php" class="btn text-white btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i></a></h4>




                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['ot_item_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Quantity</th>
                                        <td><?php echo $fetch_selectQuery['ot_item_qty'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Price</th>
                                        <td><?php echo $fetch_selectQuery['ot_item_price'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Total Price</th>
                                        <td><?php echo "Rs. ".$fetch_selectQuery['ot_item_price']*$fetch_selectQuery['ot_item_qty'] ?></td>
                                    </tr>

                                     <tr>
                                        <th scope="row">Date of Purchase</th>
                                        <td><?php echo $fetch_selectQuery['ot_item_dop'] ?></td>
                                    </tr>







                                </tbody>
                            </table>
                        </div>
                    </div>
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

<!-- Buttons examples -->
        <?php include '../_partials/buttons.php'?>

<!-- Responsive examples -->
        <?php include '../_partials/responsive.php'?>

<!-- Datatable init js -->
        <?php include '../_partials/datatableInit.php'?>

<!-- Sweet-Alert  -->
        <?php include '../_partials/sweetalert.php'?>

<!-- App js -->
        <?php include '../_partials/app.php'?>

</body>

</html>