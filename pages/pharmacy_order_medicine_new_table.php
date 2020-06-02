<?php

include '../_partials/header.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css">
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Order Medicine</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title">Patient Name</h4> -->
                        <form method="POST">
                            <table id="datatablem" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Quantity</th>
                                        <th>Confirm</th>
                                        <th class="text-center"><a href="pharmacy_order_medicine_pending.php" class="btn btn-primary waves-effect waves-light">Order Medicine</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>
                                            <input class="form-control" name="quantity" type="text" placeholder="Quantity" id="example-text-input">
                                        </td>
                                        <td style="" class="zoom">
                                            <div class="custom-control custom-checkbox ">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>
                                            <input class="form-control" name="quantity" type="text" placeholder="Quantity" id="example-text-input">
                                        </td>
                                         <td style="" class="zoom">
                                            <div class="custom-control custom-checkbox ">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </form>
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
<!-- App js -->
<?php include '../_partials/app.php'?>
<?php include '../_partials/datetimepicker.php'?>
<?php include '../_partials/datatable.php'?>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<!-- <?php include '../_partials/datatableInit.php'?> -->
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$(document).ready(function() {
    $('#datatablem').DataTable({
        "pageLength": 50,

         fixedHeader: {
        headerOffset: $('.topbar').outerHeight()
    }

    //     fixedHeader: {
    //         fixedHeader: true,
    //      headerOffset: 500
    // }
    });


});

</script>
<style type="text/css">
    .zoom {
        border-right: none !important;
        text-align: right;

        zoom:1.5;
    }
</style>
</body>

</html>