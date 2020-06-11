<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $notAdded = '';

    $id = $_GET['id'];
    $retInventoryData = mysqli_query($connect, "SELECT * FROM inventory_items WHERE id = '$id'");
    $fetch_retInventoryData = mysqli_fetch_assoc($retInventoryData);

    if (isset($_POST['updateInventory'])) {
        $item = $_POST['name'];
        $item_name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($item))));
        $item_qty = $_POST['quantity'];
        $item_price = $_POST['price'];
        $dateOfpurchase = $_POST['dateOfpurchase'];
        $floor_no = $_POST['floor_no'];
        $room_no = $_POST['room_no'];
        $id = $_POST['id'];

        $updateQuery = mysqli_query($connect, "UPDATE inventory_items SET item_name = '$item_name', item_qty = '$item_qty', item_price = '$item_price', item_purchase_date = '$dateOfpurchase', floor_id = '$floor_no', room_id = '$room_no' WHERE id = '$id'");

        if (!$updateQuery) {
            $notAdded = 'Item not Updated!';
        }else {
            header("LOCATION:inventory_list.php");
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
                                    <input class="form-control" name="name" type="text" placeholder="Item Name" id="example-text-input" value="<?php echo $fetch_retInventoryData['item_name'] ?>" required="">
                                </div>
                                <label class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="quantity" type="number" placeholder="Quantity" value="<?php echo $fetch_retInventoryData['item_qty'] ?>" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="price" type="text" placeholder="Item Price" id="example-text-input" value="<?php echo $fetch_retInventoryData['item_price'] ?>" required=""> 
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Purchase</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="dateOfpurchase" placeholder="dd/mm/yyyy-hh:mm" value="<?php echo $fetch_retInventoryData['item_purchase_date'] ?>" required="">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Floor No</label>
                               <div class="col-sm-4">
                                    <?php
                                        $select_option = mysqli_query($connect, "SELECT * FROM floors");
                                  
                                            $options = '<select class="form-control floor"  name="floor_no" required="" style="width:100%">';
                                              while ($row = mysqli_fetch_assoc($select_option)) {

                                                if ($row['id'] == $fetch_retInventoryData['floor_id']) {
                                                    $options.= '<option value='.$row['id'].' selected>'.$row['floor_name'].'</option>';
                                                }else {
                                                    $options.= '<option value='.$row['id'].'>'.$row['floor_name'].'</option>';
                                                }
                                              }
                                            $options.= "</select>";
                                      
                                        echo $options;
                                    ?>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id ?>">

                                <label class="col-sm-2 col-form-label">Room No</label>
                                <div class="col-sm-4"> 

                                <?php
                                    $select_optionRoom = mysqli_query($connect, "SELECT * FROM rooms");

                                        $optionsRoom = '<select class="form-control room" name="room_no" required="" style="width:100%">';
                                          while ($rowRoom = mysqli_fetch_assoc($select_optionRoom)) {

                                            if ($rowRoom['id'] == $fetch_retInventoryData['room_id']) {
                                                $optionsRoom.= '<option value='.$rowRoom['id'].' selected>'.$rowRoom['room_number'].'</option>';
                                            }else {
                                                $optionsRoom.= '<option value='.$rowRoom['id'].'>'.$rowRoom['room_number'].'</option>';
                                            }

                                          }
                                        $optionsRoom.= "</select>";
                                    echo $optionsRoom;
                                ?>
                          
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="updateInventory" class="btn btn-primary waves-effect waves-light">Update Item</button>
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