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
                <h5 class="page-title">Operation Theater</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"> Items List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date of Purchase</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retOTitems = mysqli_query($connect, "SELECT * FROM ot_items WHERE ot_item_status = '1'");
                                    $iteration = 1;

                                    while ($rowOTitems = mysqli_fetch_assoc($retOTitems)) {
                                        echo '
                                        <tr>
                                            <td>' . $iteration++ . '</td>
                                            <td>' . $rowOTitems['ot_item_name'] . '</td>
                                            <td>' . $rowOTitems['ot_item_qty'] . '</td>
                                            <td>' . $rowOTitems['ot_item_price'] . '</td>
                                            <td>' . substr($rowOTitems['ot_item_dop'], 0,10) . '</td>

                                            <td class="text-center"><a href="ot_items_view.php?id=' . $rowOTitems['id'] . '" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>
                                            

                                            <td class="text-center"><a href="ot_items_edit.php?id=' . $rowOTitems['id'] . '" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>



                                            <td class="text-center"><button class="btn btn-danger" onClick="deleteme(' . $rowOTitems['id'] . ')" name="Deleteme" data-original-title="Deactivate User Access">Delete</button></td>


                                        </tr>
                                    ';
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                        function deleteme(delid) {
                            if (confirm("Do you want to delete an OT Item?")) {
                                window.location.href = 'disableOtItem.php?del_id=' + delid + '';
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