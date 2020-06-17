<?php
include '../_stream/config.php';

session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

    $ref_id = $_GET['ref_no'];

    $retPatientData = mysqli_query($connect, "SELECT medicine_order.*, patient_registration.room_id FROM `medicine_order` 
                                            INNER JOIN patient_registration ON patient_registration.id = medicine_order.patient_id
                                            WHERE medicine_order.reference_no = '$ref_id'");
    $fetch_retPatientData = mysqli_fetch_assoc($retPatientData);

    $notAdded = '';
    $added = '';

    if (isset($_POST['confirmOrder'])) {
        $priceMedicine = $_POST['price'];
        $totalAmount = $_POST['totalAmount'];
        $refNo = $_POST['reference_no'];
        $patientId = $_POST['patientId'];
        $roomId = $_POST['roomId'];

        // for ($i=0; $i < sizeof($priceMedicine) ; $i++) { 
        //     $price = $priceMedicine[$i];

        //     $updateQuery = mysqli_query($connect, "UPDATE medicine_order SET ");
        // }

        $updateMedicineOrder = mysqli_query($connect, "UPDATE medicine_order SET med_status = '0' WHERE patient_id = '$patientId' AND reference_no = '$refNo'");

        $pharmacyAmountQuery = mysqli_query($connect, "INSERT INTO pharmacy_amount(patient_id, room_id, medicines_total, reference_no)VALUES('$patientId', '$roomId', '$totalAmount', '$refNo')");

        if (!$pharmacyAmountQuery) {
            $notAdded = 'Order Not Completed Please Try Again!';
        }else {
            // $added = 'Order Completed!';
            header("LOCATION:pharmacy_order_medicine_completed_list.php");
        }

    }

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
                            <input type="hidden" name="reference_no" value="<?php echo $fetch_retPatientData['reference_no'] ?>">
                            <input type="hidden" name="patientId" value="<?php echo $fetch_retPatientData['patient_id'] ?>">
                            <input type="hidden" name="roomId" value="<?php echo $fetch_retPatientData['room_id'] ?>">

                            <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Medicine Category</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $queryForRet = mysqli_query($connect, "SELECT medicine_order.*, add_medicines.medicine_name, medicine_category.category_name FROM `medicine_order`
                                        INNER JOIN add_medicines ON add_medicines.id = medicine_order.med_id
                                        INNER JOIN medicine_category ON medicine_category.id = medicine_order.cat_id
                                        WHERE medicine_order.reference_no = '$ref_id'");

                                    while ($rowQuery = mysqli_fetch_assoc($queryForRet)) {
                                        echo '
                                        <tr>
                                        <td>'.$rowQuery['medicine_name'].'</td>
                                        <td>'.$rowQuery['category_name'].'</td>                                        
                                        <td>'.$rowQuery['med_qty'].'</td>                                        
                                        <td style="">

                                            <input class="form-control calculateTotal" name="price[]" required="" type="number"  placeholder="Price"  id="example-text-input" >
                                        </td>
                                    </tr>
                                        ';
                                    }

                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="confirmOrder">Confirm Order</button>
                                            <!-- <a href="pharmacy_order_medicine_completed_list.php" ></a> -->
                                        </td>
                                        <td>
                                            <input class="form-control" name="totalAmount" type="text" placeholder="Total" id="total" readonly="true" required="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
                <h3><?php echo $notAdded ?></h3>
                <h3><?php echo $added ?></h3>
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


$(document).ready(function() {


    $( ".calculateTotal" ).keyup(function() {
        let total = 0;
        $.each($(".calculateTotal"),function(i,val) {
            if(val.value) {
            total += parseInt(val.value);
            }
             $("#total").val(total);


        })

});


});
</script>
<style type="text/css">
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
</body>

</html>