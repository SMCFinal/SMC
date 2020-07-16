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

                <h5 class="page-title">Doctor Visit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-3">
                    <div class="card-body">
                        
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Dr. Name</th>
                                    <th>Case</th>
                                    <th>Visit Charges</th>
                                   
                                    <th>Room No</th>
                                    <th class="text-center"> <i class="fa fa-eye"></i></th>
                                   
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
                                          
                                            <td>'.$rowInventory['item_price'].'</td>
                                            <td>'.substr($rowInventory['item_purchase_date'], 0,10).'</td>
                                            <td>'.$rowInventory['floor_name'].'</td>
                                            <td>'.$rowInventory['room_number'].'</td>
                                            <td class="text-center">
                                                <a href="doctor_visit_charges_list.php" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a>
                                            </td>
                                           

                                           


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
                              if (confirm("Do you want delete an item from inventory?")) {
                                window.location.href = 'delete_inventory.php?del_id=' + delid +'';
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