<?php
include '../_stream/config.php';
    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['patientId'];

    if (isset($_POST['addOrder'])) {
        header("LOCATION:Pharmacy_order.php");
    }

    $referenceNo_query = mysqli_query($connect, "SELECT MAX(reference_no) as dbRef FROM medicine_order");

    $fetch_referenceNo = mysqli_fetch_assoc($referenceNo_query);

    if (empty($fetch_referenceNo['dbRef'])) {
      $reference_no = 1;
    } else {
      $reference_no = $fetch_referenceNo['dbRef'] + 1;
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
                        <form method="POST" onsubmit="e.preventDefault()">
                            <input type="hidden" id="refNo" name="ref_no" value="<?php echo $reference_no ?>">
                            <table id="datatablem" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Medicine Name</th>
                                        <th>Medicine Category</th>
                                        <th>Quantity</th>
                                        <th>Confirm</th>
                                        <th class="text-center">
                                            <!-- <a href="pharmacy_order_medicine_pending.php" class="btn btn-primary waves-effect waves-light">Order Medicine</a> -->
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="addOrder" id="getOrder" onclick="getValue();" onclick="javascript:change()">Order Medicine</button>
                                            <!--  -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $itr = 1;

                                    $retMedicines = mysqli_query($connect, "SELECT add_medicines.*, medicine_category.category_name FROM `add_medicines`
                                    INNER JOIN medicine_category ON medicine_category.id = add_medicines.medicine_category");

                                    while ($rowMedicines = mysqli_fetch_assoc($retMedicines)) {
                                        echo '
                                                <div id="myDiv">
                                            <tr>
                                                <td>'.$itr++.'.'.'</td>
                                                <td>'.$rowMedicines['medicine_name'].'</td>
                                                <td>'.$rowMedicines['category_name'].'</td>

                                                <input  class="some'.$itr.'" type="hidden" name="medicine[]" value='.$rowMedicines['id'].'>
                                                <input  class="some'.$itr.'" type="hidden" name="category[]" value='.$rowMedicines['medicine_category'].'>

                                                <td>
                                                    <input class="form-control some'.$itr.'" name="quantity[]" type="text" placeholder="Quantity" id="example-text-input">
                                                </td>
                                                <td class="zoom">
                                                    <div class="custom-control custom-checkbox"> 
                                                            <input type="checkbox" name="check[]" class="check some'.$itr.'" value='.$rowMedicines["id"].'> 
                                                    </div>
                                                </td>
                                                <input type="hidden" id="userId" class="check some'.$itr.'" value='.$id.'>
                                                <td></td>
                                            </tr>
                                                </div>
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
        // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "lengthMenu": [[-1], ["All"]],

         fixedHeader: {
        headerOffset: $('.topbar').outerHeight()
    }
    });


});
</script>

<script type="text/javascript">
    var arrayData = []
    
    var arrayPureData = []

    document.getElementById("getOrder").addEventListener("click", function(event){
      event.preventDefault();
    });
    function getValue() {
        var checks = document.getElementsByClassName('check');

        var str = '';

        var checkValues = [];

        for (var i = 0; i <= checks.length - 1; i++) {
            
            if (checks[i].checked === true) {
                str = checks[i].value + "";
                checkValues.push(str+"")

                var className = checks[i].className;
                var classNameSplit = className.split(" ");
                var classNameIndex = classNameSplit[1];

                var RowData = document.getElementsByClassName(classNameIndex);
                for (var TakeRowData = 0; TakeRowData <= RowData.length - 1; TakeRowData++) {
                    arrayData.push(RowData[TakeRowData].value)
                }
                arrayPureData.push(arrayData)
                arrayData = []

                $("#getOrder").click(function(e) {
                    e.preventDefault()
                })

                if (arrayPureData.length) {
                    var Category_id = arrayPureData;
                }


                console.log(arrayPureData)
                for( var pureData in arrayPureData){
                // if ((index = arrayPureData[pureData])) {}
                    // arrayPureData[pureData]

                }
                    var medicineCategory = arrayPureData[pureData][0]
                    var Category = arrayPureData[pureData][1]
                    var qty = arrayPureData[pureData][2]

                    var patient = document.getElementById('userId').value;
                    var reference_number = document.getElementById('refNo').value;
                    // var status = arrayPureData[pureData][3]
                    
                    $.ajax({
                        url: "Pharmacy_order.php",
                        method: "GET",
                        data: {
                            medicineCategory,
                            Category,
                            qty,
                            patient,
                            reference_number
                        },
                        dataType : 'html',
                        success: function(res) {
                            console.log(res)
                            window.location.href = 'order_placed.php';
                        },
                        error:function(e){
                            console.log(e)
                        }
                    })
                

                var medicineCategory = arrayPureData[0].value
                // console.log("HERE", medicineCategory)
                // var Category = arrayPureData[1].value
                // var quantity = arrayPureData[2].value
                // console.log(medicineCategory , Category, quantity)
            }
        }

    }

        // alert(medicineCategory)
        // alert("ASCBKASJC")

        // 


</script>
<style type="text/css">
    .zoom {
        border-right: none !important;
        text-align: right;

        zoom:2;
    }
</style>
</body>

</html>