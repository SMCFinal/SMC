<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}


include '../_partials/header.php';
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <h5 class="page-title">Inventory Items List</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-3">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Inventory List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date of Purchase</th>
                                    <th>Floor No</th>
                                    <th>Room No</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retInventoryItems = mysqli_query($connect, "SELECT inventory_items.*, floors.floor_name , rooms.room_number FROM `inventory_items`
                                        INNER JOIN floors ON floors.id = inventory_items.floor_id
                                        INNER JOIN rooms ON rooms.id = inventory_items.room_id");
                                    $iteration = 1;

                                    while ($rowInventory = mysqli_fetch_assoc($retInventoryItems)) {
                                    	echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowInventory['item_name'].'</td>
                                            <td>'.$rowInventory['item_qty'].'</td>
                                            <td>'.$rowInventory['item_price'].'</td>
                                            <td>'.substr($rowInventory['item_purchase_date'], 0,10).'</td>
                                            <td>'.$rowInventory['floor_name'].'</td>
                                            <td>'.$rowInventory['room_number'].'</td>
                                            <td class="text-center">
                                                <a href="inventory_edit.php?id='.$rowInventory['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a>
                                            </td>

                                            <td class="text-center"><button class="btn btn-danger" onClick="deleteme('.$rowInventory['id'].')" name="Deleteme" data-original-title="Deactivate User Access">Delete</button></td>


                                        </tr>
                                    ';
}

// <td class="text-center"><a href="./user_edit.php" type="button" class="btn text-white btn-warning waves-effect
//waves-light">Edit</a></td>
?>



                            </tbody>
                        </table>
                        <script type="text/javascript">
                            function deleteme(delid){
                              if (confirm("Do you want to discharge patient?")) {
                                window.location.href = 'temporary_disable.php?del_id=' + delid +'';
                                return true;
                              }
                            }
                        </script>
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