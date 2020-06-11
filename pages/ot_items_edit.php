<?php
    include '../_stream/config.php';

        session_start();
        if (empty($_SESSION["user"])) {
        	header("LOCATION:../index.php");
        }

        $notAdded = '';
        $id = $_GET['id'];

        $ret_ot_data = mysqli_query($connect, "SELECT * FROM ot_items WHERE id = '$id'");
        $fetch_ret_ot_data = mysqli_fetch_assoc($ret_ot_data);


    $notAdded = '';

    if (isset($_POST['updateOTitem'])) {
        $item = $_POST['name'];
        $item_name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($item))));
        $item_qty = $_POST['quantity'];
        $item_price = $_POST['price'];
        $dateOfpurchase = $_POST['dateOfpurchase'];
        $id = $_POST['id'];


         $updateQuery = mysqli_query($connect, "UPDATE ot_items SET ot_item_name = '$item_name', ot_item_qty = '$item_qty', ot_item_price = '$item_price', ot_item_dop = '$dateOfpurchase' WHERE id = '$id'");

        if (!$updateQuery) {
            $notAdded = 'Item not added to inventory!';
        }else {
            header("LOCATION:ot_items_list.php");
        }
    }


    include '../_partials/header.php';
?>

<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Edit Item</h5>
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
                                    <input class="form-control" name="name" type="text" placeholder="Item Name" id="example-text-input" value="<?php echo $fetch_ret_ot_data['ot_item_name'] ?>">
                                </div>
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="quantity" type="number" placeholder="Quantity" value="<?php echo $fetch_ret_ot_data['ot_item_qty'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="price" type="number" placeholder="Item Price" id="example-text-input" value="<?php echo $fetch_ret_ot_data['ot_item_price'] ?>">
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Purchase</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="dateOfpurchase" placeholder="dd/mm/yyyy-hh:mm" value="<?php echo $fetch_ret_ot_data['ot_item_dop'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="updateOTitem" class="btn btn-primary waves-effect waves-light">Update Item</button>
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