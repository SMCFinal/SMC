<?php
include '../_stream/config.php';

session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}



include '../_partials/header.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css">
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Completed Orders List</h5>
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
                                        <th>S No.</th>
                                        <th>Patient Name</th>
                                        <th>Room #</th>
                                        <th>Contact number</th>
                                        <th>Attendent Name</th>
                                        <th>Price</th>
                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $retQuery = mysqli_query($connect, "SELECT medicine_order.*, patient_registration.patient_name, patient_registration.patient_contact, patient_registration.attendent_name ,patient_registration.room_id, rooms.*, floors.*, pharmacy_amount.medicines_total FROM `medicine_order`
                                        INNER JOIN patient_registration ON patient_registration.id = medicine_order.patient_id
                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                        INNER JOIN floors ON floors.id = rooms.floor_id
                                        
                                        INNER JOIN pharmacy_amount ON pharmacy_amount.reference_no = medicine_order.reference_no
                                        WHERE medicine_order.med_status = '0'
                                        GROUP BY medicine_order.reference_no  ORDER BY medicine_order.reference_no ASC");

                                    $itr = 1;

                                    while ($rowQueryData = mysqli_fetch_assoc($retQuery)) {
                                        echo '
                                        <tr>
                                            <td>'.$itr++.'</td>
                                            <td>'.$rowQueryData['patient_name'].'</td>
                                            <td>'.$rowQueryData['room_number'].'</td>
                                            <td>'.$rowQueryData['patient_contact'].'</td>
                                            <td>'.$rowQueryData['attendent_name'].'</td>
                                            <td>'.$rowQueryData['medicines_total'].'</td>
                                            <td class="text-center"><a href="pharmacy_order_medicine_view.php?id='.$rowQueryData['reference_no'].'&patId='.$rowQueryData['patient_id'].'" class="btn btn-primary waves-effect waves-light">View</a></td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                   
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

</body>

</html>