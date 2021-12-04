<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];
    
    $selectCurrentPatient = mysqli_query($connect, "SELECT area.area_name, patient_registration.patient_name, patient_registration.patient_age, patient_registration.organization, patient_registration.patient_doa, patient_registration.patient_address, patient_registration.patient_consultant, staff_members.name  FROM patient_registration 
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN area ON area.id = patient_registration.city_id
        WHERE DATE(patient_registration.patient_doa) BETWEEN '$fromDate' AND '$toDate';
        ");


     $selectDischargePatient = mysqli_query($connect, "SELECT area.area_name, discharge_patients.patient_name, discharge_patients.patient_age, discharge_patients.organization, discharge_patients.patient_doa, discharge_patients.patient_address, discharge_patients.patient_consultant, staff_members.name, discharge_patients.auto_date FROM discharge_patients 
        INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
        INNER JOIN area ON area.id = discharge_patients.city_id
            WHERE DATE(discharge_patients.auto_date) BETWEEN '$fromDate' AND '$toDate';
            ");

     $selectPostponePatient = mysqli_query($connect, "SELECT area.area_name, postpone_patient.patient_name, postpone_patient.patient_age, postpone_patient.patient_doa,  postpone_patient.auto_date, postpone_patient.patient_address, postpone_patient.patient_consultant, staff_members.name  FROM postpone_patient 
        INNER JOIN staff_members ON staff_members.id = postpone_patient.patient_consultant
        INNER JOIN area ON area.id = postpone_patient.city_id
            WHERE DATE(postpone_patient.auto_date) BETWEEN '$fromDate' AND '$toDate';
            ");


include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Patient Report</h5>
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
                                        <h3 align="center">SHAH MEDICAL AND SERGICAL CENTER</h3>
                                        <p align="center">Patient Report: From Date <?php echo $fromDate ?> to Date <?php echo $toDate ?></p>
                                    </h3>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Current Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Area</th>
                                                        <th>Org</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrCurrent = 1;
                                                    while ($rowCurrent = mysqli_fetch_assoc($selectCurrentPatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'</td>
                                                            <td>'.$rowCurrent['patient_name'].'</td>
                                                            <td>'.$rowCurrent['patient_age'].'</td>
                                                            <td>'.$rowCurrent['area_name'].'</td>
                                                            <td>'.$rowCurrent['organization'].'</td>
                                                            <td>'.$rowCurrent['patient_address'].'</td>
                                                            <td>'.$rowCurrent['name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h6>Discharge Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Area</th>
                                                        <th>Org</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrDischarge = 1;
                                                    while ($rowDischarge = mysqli_fetch_assoc($selectDischargePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrDischarge++.'</td>
                                                            <td>'.$rowDischarge['patient_name'].'</td>
                                                            <td>'.$rowDischarge['patient_age'].'</td>
                                                            <td>'.$rowDischarge['area_name'].'</td>
                                                            <td>'.$rowDischarge['organization'].'</td>
                                                            <td>'.$rowDischarge['patient_address'].'</td>
                                                            <td>'.$rowDischarge['name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <h6>Postpone Patients</h6>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Area</th>
                                                        <th>Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrPostpone = 1;
                                                    while ($rowPostpone = mysqli_fetch_assoc($selectPostponePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrPostpone++.'</td>
                                                            <td>'.$rowPostpone['patient_name'].'</td>
                                                            <td>'.$rowPostpone['patient_age'].'</td>
                                                            <td>'.$rowPostpone['area_name'].'</td>
                                                            <td>'.$rowPostpone['patient_address'].'</td>
                                                            <td>'.$rowPostpone['name'].'</td>
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