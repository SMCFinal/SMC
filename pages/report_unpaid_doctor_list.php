<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    if ($id == 'all') {
        
        $allPatientsQuery = mysqli_query($connect, "SELECT doctor_surgery_charges.*, rooms.room_number, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name, discharge_patients.organization, doctor_visit_charges.visit_charges  FROM `doctor_surgery_charges` 
        INNER JOIN rooms ON rooms.id = doctor_surgery_charges.room_id
        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_surgery_charges.pat_id
        INNER JOIN surgeries ON surgeries.id = doctor_surgery_charges.pat_operation
        INNER JOIN staff_members ON staff_members.id = doctor_surgery_charges.pat_consultant
        INNER JOIN doctor_visit_charges ON doctor_visit_charges.doctor_id = doctor_surgery_charges.pat_consultant
        WHERE doctor_surgery_charges.payment_status = '0' AND DATE(discharge_patients.patient_doop) BETWEEN '$fromDate' AND '$toDate' ORDER BY discharge_patients.patient_doop DESC");
    }else {
        $allPatientsQuery = mysqli_query($connect, "
            SELECT doctor_surgery_charges.*, rooms.room_number, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name, discharge_patients.organization, doctor_visit_charges.visit_charges  FROM `doctor_surgery_charges` 
        INNER JOIN rooms ON rooms.id = doctor_surgery_charges.room_id
        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_surgery_charges.pat_id
        INNER JOIN surgeries ON surgeries.id = doctor_surgery_charges.pat_operation
        INNER JOIN staff_members ON staff_members.id = doctor_surgery_charges.pat_consultant
        INNER JOIN doctor_visit_charges ON doctor_visit_charges.doctor_id = doctor_surgery_charges.pat_consultant
        WHERE doctor_surgery_charges.payment_status = '0' AND AND doctor_surgery_charges.pat_consultant = '$id' AND DATE(discharge_patients.patient_doop) BETWEEN '$fromDate' AND '$toDate' ORDER BY discharge_patients.patient_doop DESC");
    }

    include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Un-Paid Doctor Report</h5>
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
                                        <h3 align="center">SHAH MEDICAL AND SURGICAL CENTER</h3>
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
                                                        <th>Surgery</th>
                                                        <th>S. Charges</th>
                                                        <th>V. Amount</th>
                                                        <th>Date</th>
                                                        <th>Org</th>
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
                                                            <td>'.$row['patient_name'].'</td>
                                                            <td>'.$row['surgery_name'].'</td>
                                                            <td>'.$row['surgery_charges'].'</td>
                                                            <td>'.$row['visit_charges'].'</td>';
                                            
                                                            $Date_format = $row['patient_doop']; 
                                                            $Date = date('d/M h:i:s A', strtotime($Date_format));


                                                            $sumTotalSur = $sumTotalSur + $row['surgery_charges'];
                                                            $sumtotalVis = $sumtotalVis + $row['visit_charges'];

                                                            echo '
                                                            <td>'.$Date.'</td>
                                                            <td>'.$row['organization'].'</td>

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