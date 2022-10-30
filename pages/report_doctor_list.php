<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $org = $_GET['org'];
    $id = $_GET['id'];
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    if ($id == 'all') {
        
        $allPatientsQuery = mysqli_query($connect, "SELECT charges_confirm_list.*, staff_members.name FROM `charges_confirm_list`
            INNER JOIN staff_members ON staff_members.id = charges_confirm_list.consult_id
            WHERE charges_confirm_list.org_name LIKE '%$org%' AND DATE(charges_confirm_list.op_vi_time) BETWEEN '$fromDate' AND '$toDate' ORDER BY charges_confirm_list.op_vi_time DESC");
    }else {
        $allPatientsQuery = mysqli_query($connect, "SELECT charges_confirm_list.*, staff_members.name FROM `charges_confirm_list`
            INNER JOIN staff_members ON staff_members.id = charges_confirm_list.consult_id
            WHERE charges_confirm_list.org_name LIKE '%$org%' AND charges_confirm_list.consult_id = '$id' AND DATE(charges_confirm_list.op_vi_time) BETWEEN '$fromDate' AND '$toDate' ORDER BY charges_confirm_list.op_vi_time DESC");
    }

    include '../_partials/header.php';
?>
<style type="text/css">
    body {
        font-size: 13px !important;
    }
</style>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Doctor Report</h5>
                 <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
                
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <!-- <div class="card m-b-30" > -->
                    <!-- <div class="card-body"> -->
                        <div class="row" id="printElement">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL CENTER</h3>
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Doctor Name</th>
                                                        <th>Patient Name</th>
                                                        <th>Org</th>
                                                        <th>Surgery</th>
                                                        <th>S. Charges</th>
                                                        <th>V. Amount</th>
                                                        <th>Date</th>
                                                        <th>Pay Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $itr = 1;
                                                    $sumTotalSur = 0;
                                                    $sumtotalVis = 0;

                                                    while ($row = mysqli_fetch_assoc($allPatientsQuery)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itr++.'</td>
                                                            <td>'.$row['name'].'</td>
                                                            <td>'.$row['pat_name'].'</td>
                                                            <td>'.$row['org_name'].'</td>
                                                            <td>'.$row['sur_name'].'</td>
                                                            <td>'.$row['sur_charges'].'</td>
                                                            <td>'.$row['vis_cahrges'].'</td>';
                                            
                                                            $Date_format = $row['op_vi_time']; 
                                                            $Date = date('d/M h:i:s A', strtotime($Date_format));

                                                            $Date_formatPay = $row['pay_date']; 
                                                            $PayDate = date('d/M h:i:s A', strtotime($Date_formatPay));

                                                            $sumTotalSur = $sumTotalSur + $row['sur_charges'];
                                                            $sumtotalVis = $sumtotalVis + $row['vis_cahrges'];

                                                            echo '
                                                            <td>'.$Date.'</td>
                                                            <td>'.$PayDate.'</td>

                                                        </tr>
                                                        ';
                                                    }

                                                    echo '
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b>Total:</b></td>
                                                            <td><b>Pkr. '.$sumTotalSur.' /.</b></td>
                                                            <td><b>Pkr. '.$sumtotalVis.' /.</b></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Paid</b></td>
                                                            <td><b>Pkr. '.($sumTotalSur + $sumtotalVis).' /.</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></b></td>
                                                        </tr>
                                                    '
                                                    ?>  
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                <!-- </div> -->
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