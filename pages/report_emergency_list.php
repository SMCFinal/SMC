<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    


include '../_partials/header.php';
?>
<style type="text/css">
    body, td {
        color: black;
    }
    
    table {
        font-size: 13px;
    }

    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    
    /*.table-responsive {*/
    /*    line-height: 3px;*/
    /*}*/
</style>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Emergency Patients Report</h5>
                 <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
                
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class=" m-b-30" id="printElement">
                    <!-- <div class="card-body"> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL CENTER</h3>
                                        <h4 class="text-center font-16">Address: Near Center Hospital, Saidu Sharif, Swat.</h4>
                                        <hr>
                                        <h4 class="text-right font-14">Emergency Patients</h4>
                                        <h4 class="text-right font-14">
                                            <?php 
                                                date_default_timezone_set("Asia/Karachi");
                                                echo "Date: ".date('d M, Y h:i A'); 
                                            ?>
                                        </h4>
                                        <br>
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Address</th>
                                                        <th>Contact</th>
                                                        <th>DOA</th>
                                                        <th>Org</th>
                                                        <th>Surgery</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($connect, "SELECT discharge_patients.*, surgeries.surgery_name, staff_members.name FROM `discharge_patients`
                                                    INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
                                                    INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
                                                    WHERE discharge_patients.pat_category = '2' AND discharge_patients.auto_date BETWEEN '$fromDate' AND '$toDate'");

                                                    $itr = 1;

                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                        $doa = $row['patient_doa'];
                                                        echo '
                                                        <tr>
                                                            <td>'.$itr++.'</td>
                                                            <td>'.$row['patient_name'].'</td>
                                                            <td>'.$row['patient_age'].'</td>
                                                            <td>'.$row['patient_address'].'</td>
                                                            <td>'.$row['patient_contact'].'</td>
                                                            <td>'.substr($doa, 0, 10) .'</td>
                                                            <td>'.$row['organization'].'</td>
                                                            <td>'.$row['surgery_name'].'</td>
                                                            <td>'.$row['name'].'</td>
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
                    <!-- </div> -->
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