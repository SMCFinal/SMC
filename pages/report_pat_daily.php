<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $date = date_default_timezone_set('Asia/Karachi');
    $currentDate = date('Y-m-d');
    
    
    $selectCurrentPatient = mysqli_query($connect, "SELECT area.area_name, patient_registration.patient_yearly_no, patient_registration.patient_name, patient_registration.room_id, patient_registration.patient_age, patient_registration.organization, patient_registration.patient_doa, patient_registration.patient_address, patient_registration.patient_consultant, patient_registration.patient_operation, surgeries.surgery_name, staff_members.name, rooms.room_number FROM patient_registration
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN area ON area.id = patient_registration.city_id
        INNER JOIN rooms ON rooms.id = patient_registration.room_id
        INNER JOIN surgeries ON surgeries.id = patient_registration.patient_operation
        WHERE DATE(patient_registration.patient_doa)  = '$currentDate'
        ");


     $selectDischargePatient = mysqli_query($connect, "SELECT area.area_name, discharge_patients.patient_yearly_no, discharge_patients.patient_name, discharge_patients.patient_age, discharge_patients.organization, discharge_patients.patient_doa, discharge_patients.patient_address, discharge_patients.patient_consultant, staff_members.name, discharge_patients.auto_date, surgeries.surgery_name, rooms.room_number FROM discharge_patients 
         INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
         INNER JOIN area ON area.id = discharge_patients.city_id
         INNER JOIN rooms ON rooms.id = discharge_patients.room_id
         INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
            WHERE DATE(discharge_patients.patient_doop) LIKE '%$currentDate%'
            ");

     $selectPostponePatient = mysqli_query($connect, "SELECT area.area_name, postpone_patient.patient_yearly_no, postpone_patient.patient_name, postpone_patient.patient_age, postpone_patient.patient_doa,  postpone_patient.auto_date, postpone_patient.patient_address, postpone_patient.patient_consultant, staff_members.name,surgeries.surgery_name, rooms.room_number FROM postpone_patient 
        INNER JOIN staff_members ON staff_members.id = postpone_patient.patient_consultant
        INNER JOIN area ON area.id = postpone_patient.city_id
        INNER JOIN rooms ON rooms.id = postpone_patient.room_id
        INNER JOIN surgeries ON surgeries.id = postpone_patient.patient_operation
            WHERE DATE(postpone_patient.patient_doa)  = '$currentDate'
            ");


include '../_partials/header.php';
?>
<style>

    body, td {
        color: black;
    }
    
    table {
        font-size: 12px !important;
    }

    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    
    .custom {
        font-size: 12px;
        color: black;
    }
</style>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Patient Report Daily</h5>
                 <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
                
            </div>
        </div>
        <!-- end row -->
        <div class="row custom">
            <div class="col-12">
                <!-- <div class="card m-b-30" > -->
                    <!-- <div class="card-body"> -->
                        <div class="row" id="printElement">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>Current Patients</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h5 align="center">SHAH MEDICAL CENTER</h5>
                                        <?php 
                                            $dateCustom = date_default_timezone_set('Asia/Karachi');
                                            $currentDateCustom = date('Y-m-d, "l"');
                                        ?>
                                        <p align="center">Daily Patient Report, Dated <?php echo $currentDateCustom ?></p>
                                    </h3>
                                </div>

                                <?php
                                    // echo $currentDate;
                                    $rowCountCurrent = mysqli_num_rows($selectCurrentPatient); 
                                    if ($rowCountCurrent > 0) {
                                ?>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Current Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>MR No</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Org</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                        <th>Room</th>
                                                        <th>Surgery</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrCurrent = 1;
                                                    while ($rowCurrent = mysqli_fetch_assoc($selectCurrentPatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'</td>
                                                            <td>'.$rowCurrent['patient_yearly_no'].'</td>
                                                            <td>'.$rowCurrent['patient_name'].'</td>
                                                            <td>'.$rowCurrent['patient_age'].'</td>
                                                            <td>'.$rowCurrent['organization'].'</td>
                                                            <td>'.$rowCurrent['patient_address'].'</td>
                                                            <td>'.$rowCurrent['name'].'</td>
                                                            <td>'.$rowCurrent['room_number'].'</td>
                                                            <td>'.$rowCurrent['surgery_name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
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

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Discharge Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>MR No</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Org</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                        <th>Room</th>
                                                        <th>Surgery</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrDischarge = 1;
                                                    while ($rowDischarge = mysqli_fetch_assoc($selectDischargePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrDischarge++.'</td>
                                                            <td>'.$rowDischarge['patient_yearly_no'].'</td>
                                                            <td>'.$rowDischarge['patient_name'].'</td>
                                                            <td>'.$rowDischarge['patient_age'].'</td>
                                                            <td>'.$rowDischarge['organization'].'</td>
                                                            <td>'.$rowDischarge['patient_address'].'</td>
                                                            <td>'.$rowDischarge['name'].'</td>
                                                            <td>'.$rowDischarge['room_number'].'</td>
                                                            <td>'.$rowDischarge['surgery_name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
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

                                    $rowCountPostPoned = mysqli_num_rows($selectPostponePatient); 
                                    if ($rowCountPostPoned > 0) {
                                ?>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Postpone Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>MR No</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                        <th>Room</th>
                                                        <th>Surgery</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrPostpone = 1;
                                                    while ($rowPostpone = mysqli_fetch_assoc($selectPostponePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrPostpone++.'</td>
                                                            <td>'.$rowPostpone['patient_yearly_no'].'</td>
                                                            <td>'.$rowPostpone['patient_name'].'</td>
                                                            <td>'.$rowPostpone['patient_age'].'</td>
                                                            <td>'.$rowPostpone['patient_address'].'</td>
                                                            <td>'.$rowPostpone['name'].'</td>
                                                            <td>'.$rowPostpone['room_number'].'</td>
                                                            <td>'.$rowPostpone['surgery_name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php    
                                    }else {
                                        echo '
                                        <div class="row" style="margin-top: 20px !important">
                                            <div class="col-12">
                                                <h6 align="center">No Postpone Patients</h6>
                                            </div>
                                        </div>
                                        ';
                                    } 
                                ?>
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