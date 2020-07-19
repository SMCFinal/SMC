<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    $query = mysqli_query($connect, "SELECT lab_test_report.*, discharge_patients.patient_name, rooms.room_number FROM `lab_test_report`
INNER JOIN discharge_patients ON discharge_patients.pat_id = lab_test_report.pat_id
INNER JOIN rooms ON rooms.id = discharge_patients.room_id
WHERE lab_test_report.patient_payment_status = '0' AND DATE(lab_test_report.auto_date) BETWEEN '$fromDate' AND '$toDate'");



include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Lab Report</h5>
                 <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
                
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30" id="printElement">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL AND SERGICAL CENTER</h3>
                                        <h4 class="text-center font-16">Address: Near Center Hospital, Saidu Sharif Swat.</h4>
                                        <div class="d-print-none mo-mt-2">
                                           
                                        </div>
                                        <br>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Room Number</th>
                                                        <th>Tests Amount</th>
                                                        <th>Test Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $itr = 1;
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itr++.'</td>
                                                            <td>'.$row['patient_name'].'</td>
                                                            <td>'.$row['room_number'].'</td>
                                                            <td>'.$row['total_price'].'</td>';
                                            
                                                            $Date_format = $row['patient_payment_status']; 
                                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                                            echo '
                                                            <td>'.$Date.'</td>
                                                        </tr>
                                                        ';
                                                    }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript" src="../assets/print.js"></script>

<script type="text/javascript">

    // function printReport() {
    //     console.log('print');

    //      var printContents = document.getElementsByClassName('card')[0].innerH‌​TML;
    //  var originalContents = document.body.innerHTML;

    //  document.body.innerHTML = printContents;

    //  window.print();

    //  document.body.innerHTML = originalContents;

        // w = window.open();
        // w.document.write(document.getElementsByClassName('card')[0].innerH‌​TML);
        // w.print();
        // w.close();

    // }
    function print() {
    printJS({
    printable: 'printElement',
    type: 'html',
    targetStyles: ['*']
 })
}

document.getElementById('printButton').addEventListener ("click", print)

//     function printDiv(divName) {
//      var printContents = document.getElementById(divName).innerHTML;
//      var originalContents = document.body.innerHTML;

//      document.body.innerHTML = printContents;

//      window.print();

//      document.body.innerHTML = originalContents;
// }

</script>
</body>

</html>