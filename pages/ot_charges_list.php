<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $date = date_default_timezone_set('Asia/Karachi');
    $currentDate = date('Y-m-d');
    
    
    $selectCurrentPatient = mysqli_query($connect, "SELECT patient_registration.patient_name, patient_registration.patient_address, patient_registration.patient_yearly_no, rooms.room_price, surgeries.admission_charges, surgeries.ot_charges, surgeries.surgery_name FROM `patient_registration`
        INNER JOIN rooms ON rooms.id = patient_registration.room_id
        INNER JOIN surgeries ON surgeries.id = patient_registration.patient_operation
        WHERE DATE(patient_registration.patient_doa) LIKE '%$currentDate%' AND patient_registration.organization LIKE '%Private%'
        ");


     $selectDischargePatient = mysqli_query($connect, "SELECT discharge_patients.patient_name, discharge_patients.patient_address, discharge_patients.patient_yearly_no, rooms.room_price, surgeries.admission_charges, surgeries.ot_charges, surgeries.surgery_name FROM `discharge_patients`
        INNER JOIN rooms ON rooms.id = discharge_patients.room_id
        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
        WHERE DATE(discharge_patients.patient_doa) LIKE '%$currentDate%' AND discharge_patients.organization LIKE '%Private%';
            ");

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">OT Charges Report Daily</h5>
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
                                    <!-- <h4 class="float-right font-16"><strong>Current Patients</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center"style="font-size: 20px;">SHAH MEDICAL CENTER</h3>
                                        <?php 
                                            $dateCustom = date_default_timezone_set('Asia/Karachi');
                                            $currentDateCustom = date('d M, Y , "l"');
                                        ?>
                                        <p align="center">OT Charges Report, Dated <b><?php echo $currentDateCustom ?></b></p>
                                    </h3>
                                </div>

                                <?php
                                    $rowCountCurrent = mysqli_num_rows($selectCurrentPatient); 
                                    if ($rowCountCurrent > 0) {
                                ?>

                                <div class="row">
                                    <div class="col-12">
                                        <h6 align="center">Current Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>MR No</th>
                                                        <th>Surgery</th>
                                                        <th>Room</th>
                                                        <th>Admission</th>
                                                        <th>OT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $currentSumPriceRoom = 0;
                                                    $currentSumPriceAdmission = 0;
                                                    $currentSumPriceOT = 0;

                                                    $itrCurrent = 1;
                                                    while ($rowCurrent = mysqli_fetch_assoc($selectCurrentPatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'. </td>
                                                            <td style="width: 15%">'.$rowCurrent['patient_name'].'</td>
                                                            <td>'.$rowCurrent['patient_yearly_no'].'</td>
                                                            <td>'.$rowCurrent['surgery_name'].'</td>
                                                            <td>'.$rowCurrent['room_price'].'</td>
                                                            <td>'.$rowCurrent['admission_charges'].'</td>
                                                            <td>'.$rowCurrent['ot_charges'].'</td>
                                                            ';

                                                            $currentSumPriceRoom = $currentSumPriceRoom + $rowCurrent['room_price'];
                                                            $currentSumPriceAdmission = $currentSumPriceAdmission + $rowCurrent['admission_charges'];
                                                            $currentSumPriceOT = $currentSumPriceOT + $rowCurrent['ot_charges'];
                                                        echo '
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                    <!-- <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Total: </th>
                                                        <th><?php echo $currentSumPriceRoom ?></th>
                                                        <th><?php echo $currentSumPriceAdmission ?></th>
                                                        <th><?php echo $currentSumPriceOT ?></th>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                    }else {
                                        echo '
                                        <div class="row" style="margin-top: 80px !important">
                                            <div class="col-12">
                                                <h6 align="center">No Current Patients</h6>
                                            </div>
                                        </div>
                                        ';
                                    } 

                                    $rowCountDischarge = mysqli_num_rows($selectDischargePatient); 
                                    if ($rowCountDischarge > 0) {
                                ?>

                                <div class="row mt-5">
                                    <div class="col-12">
                                        <h6 align="center">Discharged!</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">    
                                                <thead>
                                                   <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>MR No</th>
                                                        <th>Surgery</th>
                                                        <th>Room</th>
                                                        <th>Admission</th>
                                                        <th>OT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $dischargeSumPriceRoom = 0;
                                                    $dischargeSumPriceAdmission = 0;
                                                    $dischargeSumPriceOT = 0;
                                                    $itrDischarge = 1;
                                                    while ($rowDischarge = mysqli_fetch_assoc($selectDischargePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrDischarge++.'. </td>
                                                            <td style="width: 15%">'.$rowDischarge['patient_name'].'</td>
                                                            <td>'.$rowDischarge['patient_yearly_no'].'</td>
                                                            <td>'.$rowDischarge['surgery_name'].'</td>
                                                            <td>'.$rowDischarge['room_price'].'</td>
                                                            <td>'.$rowDischarge['admission_charges'].'</td>
                                                            <td>'.$rowDischarge['ot_charges'].'</td>';
                                                            $dischargeSumPriceRoom = $dischargeSumPriceRoom + $rowDischarge['room_price'];
                                                            $dischargeSumPriceAdmission = $dischargeSumPriceAdmission + $rowDischarge['admission_charges'];
                                                            $dischargeSumPriceOT = $dischargeSumPriceOT + $rowDischarge['ot_charges'];
                                                            echo '
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                                <!-- <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Total: </th>
                                                        <th><?php echo $dischargeSumPriceRoom ?></th>
                                                        <th><?php echo $dischargeSumPriceAdmission ?></th>
                                                        <th><?php echo $dischargeSumPriceOT ?></th>
                                                    </tr>
                                                </tfoot> -->
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                    }else {
                                        echo '
                                        <div class="row" style="margin-top: 30px !important">
                                            <div class="col-12">
                                                <h6 align="center">No Discharge Patients</h6>
                                            </div>
                                        </div>
                                        ';
                                    } 

                                ?>

                                <hr style="border-top: 10px solid cornflowerblue !important;">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <?php
                                                        $rowCountCurrent = mysqli_num_rows($selectCurrentPatient);
                                                        $rowCountDischarge = mysqli_num_rows($selectDischargePatient);
                                                        if ($rowCountDischarge > 0 && $rowCountCurrent > 0) {
                                                    ?>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Total: </th>
                                                        <th>Rooms: <?php echo $dischargeSumPriceRoom + $currentSumPriceRoom ?></th>
                                                        <th>Admission: <?php echo $dischargeSumPriceAdmission + $currentSumPriceAdmission ?></th>
                                                        <th>OT: <?php echo $dischargeSumPriceOT + $currentSumPriceOT ?></th>
                                                    </tr>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Sub Total: </th>
                                                        <th style="text-align:center;"><?php echo $dischargeSumPriceRoom + $dischargeSumPriceAdmission + $dischargeSumPriceOT + $currentSumPriceRoom + $currentSumPriceAdmission + $currentSumPriceOT ?></th>
                                                    </tr>
                                                    <?php 
                                                        }elseif ($rowCountDischarge > 0) {
                                                    ?>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Total: </th>
                                                        <th>Rooms: <?php echo $dischargeSumPriceRoom?></th>
                                                        <th>Admission: <?php echo $dischargeSumPriceAdmission?></th>
                                                        <th>OT: <?php echo $dischargeSumPriceOT?></th>
                                                    </tr>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Sub Total: </th>
                                                        <th><?php echo $dischargeSumPriceRoom + $dischargeSumPriceAdmission + $dischargeSumPriceOT?></th>
                                                    </tr>
                                                    <?php 
                                                        }elseif ($rowCountCurrent > 0) {
                                                    ?>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Total: </th>
                                                        <th style="text-align: center;">Rooms: <?php echo $currentSumPriceRoom ?></th>
                                                        <th style="text-align: center;">Admission: <?php echo $currentSumPriceAdmission ?></th>
                                                        <th style="text-align: center;">OT: <?php echo $currentSumPriceOT ?></th>
                                                    </tr>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th style="text-align: right;">Sub Total: </th>
                                                        <th><?php echo $currentSumPriceRoom + $currentSumPriceAdmission + $currentSumPriceOT ?></th>
                                                    </tr>
                                                    <?php      
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