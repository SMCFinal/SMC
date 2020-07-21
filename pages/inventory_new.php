<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $notAdded = '';
    $added = '';
    $itemAlreadyAdded='';

    if (isset($_POST['addInventory'])) {
        $item = $_POST['name'];
        $item_name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($item))));
        $item_qty = $_POST['quantity'];
        $item_price = $_POST['price'];
        $dateOfpurchase = $_POST['dateOfpurchase'];
        $floor_no = $_POST['floor_no'];
        $room_no = $_POST['room_no'];

        $inventoryQuery = mysqli_query($connect, "INSERT INTO inventory_items(item_name, item_qty, item_price, item_purchase_date, floor_id, room_id)VALUES('$item_name', '$item_qty', '$item_price', '$dateOfpurchase', '$floor_no', '$room_no')");

        if (!$inventoryQuery) {
            $notAdded = '<div class="alert alert-danger text-center" role="alert">
                                Item not added to inventory!
                             </div>';
        }else {
            $added = '<div class="alert alert-success text-center" role="alert">
                                Item Added!
                             </div>';
        }
    }


    include('../_partials/header.php') 
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
                                    <input class="form-control" required="" name="name" type="text" placeholder="Item Name" id="example-text-input">
                                </div>
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input class="form-control" required="" name="quantity" type="number" placeholder="Qty" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-4">
                                    <input class="form-control" required="" name="price" type="text" placeholder="Item Price" id="example-text-input">
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Purchase</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control " type="date" required="" name="dateOfpurchase" placeholder="dd/mm/yyyy">
                                        <!-- <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label">Floor No</label>
                                <div class="col-sm-4">
                                    <?php
                                        $select_option = mysqli_query($connect, "SELECT * FROM floors");
                                  
                                            $options = '<select class="form-control floor" required  name="floor_no" required="" style="width:100%">';
                                              while ($row = mysqli_fetch_assoc($select_option)) {
                                                $options.= '<option value='.$row['id'].'>'.$row['floor_name'].'</option>';
                                              }
                                            $options.= "</select>";
                                      
                                        echo $options;
                                    ?>
                                </div>

                                <label class="col-sm-2 col-form-label">Room No</label>
                                <div class="col-sm-4"> 

                                <?php
                                    $select_option = mysqli_query($connect, "SELECT * FROM rooms");
                                        $options = '<select required class="form-control room" name="room_no" required="" style="width:100%">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['id'].'>'.$row['room_number'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                          
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addInventory" class="btn btn-primary waves-effect waves-light">Add Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h3>
                        <?php echo $notAdded; ?>
                        <?php echo $added; ?>
                        <?php echo $itemAlreadyAdded; ?>
                    </h3>
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
<!-- App js -->
<?php include('../_partials/app.php') ?>
<?php include('../_partials/datetimepicker.php') ?>
<script type="text/javascript">
$(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd"
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