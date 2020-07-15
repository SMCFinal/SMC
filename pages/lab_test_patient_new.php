<?php
include '../_stream/config.php';
    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    if (isset($_POST['addOrder'])) {
        header("LOCATION:Pharmacy_order.php");
    }

    $referenceNo_query = mysqli_query($connect, "SELECT MAX(reference_no) as dbRef FROM lab_order");

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
                <h5 class="page-title">Take Test</h5>
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
                                        <th>Test Name</th>
                                        <th>Price</th>
                                      
                                        <th>Confirm</th>
                                        <th class="text-center">
                                            <!-- <a href="pharmacy_order_medicine_pending.php" class="btn btn-primary waves-effect waves-light">Order Medicine</a> -->
                                            <button class="btn btn-primary waves-effect waves-light" type="submit" name="addOrder" id="getOrder" onclick="getValue();" onclick="javascript:change()">Submit</button>
                                            <!--  -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $itr = 1;

                                    $retMedicines = mysqli_query($connect, "SELECT * FROM `lab_test_category`");

                                    while ($rowMedicines = mysqli_fetch_assoc($retMedicines)) {
                                        echo '
                                                <div id="myDiv">
                                            <tr>
                                                <td>'.$itr++.'.'.'</td>
                                                <td>'.$rowMedicines['test_name'].'</td>
                                                <td>'.$rowMedicines['test_price'].'</td>

                                                <input  class="some'.$itr.'" type="hidden" name="medicine[]" value='.$rowMedicines['id'].'>

                                               
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
        "pageLength": 50,

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
                console.log(RowData)
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
                    // var qty = arrayPureData[pureData][2]

                    var patient = document.getElementById('userId').value;
                    var reference_number = document.getElementById('refNo').value;
                    // var status = arrayPureData[pureData][3]
                    
                    $.ajax({
                        url: "lab_test_order.php",
                        method: "GET",
                        data: {
                            medicineCategory,
                            Category,
                            // qty,
                            patient,
                            reference_number
                        },
                        dataType : 'html',
                        success: function(res) {
                            console.log(res)
                            window.location.href = 'order_placed_lab.php';
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