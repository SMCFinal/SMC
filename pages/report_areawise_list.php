<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    if ($id == 'all') {
        $selectCurrentPatient = mysqli_query($connect, "SELECT area.area_name, patient_registration.patient_name, patient_registration.patient_age, patient_registration.patient_address, patient_registration.patient_consultant, staff_members.name  FROM patient_registration 
    INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
    INNER JOIN area ON area.id = patient_registration.city_id");

    $selectDischargedPatient = mysqli_query($connect, "SELECT area.area_name, discharge_patients.patient_name, discharge_patients.patient_age, discharge_patients.patient_address, discharge_patients.patient_consultant, staff_members.name  FROM discharge_patients 
    INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
    INNER JOIN area ON area.id = discharge_patients.city_id");
        
$selectPostponePatient = mysqli_query($connect, "SELECT area.area_name, postpone_patient.patient_name, postpone_patient.patient_age, postpone_patient.patient_address, postpone_patient.patient_consultant, staff_members.name  FROM postpone_patient 
    INNER JOIN staff_members ON staff_members.id = postpone_patient.patient_consultant
    INNER JOIN area ON area.id = postpone_patient.city_id");

    }else {
    $selectCurrentPatient = mysqli_query($connect, "SELECT area.area_name, patient_registration.patient_name, patient_registration.patient_age, patient_registration.patient_address, patient_registration.patient_consultant, staff_members.name  FROM patient_registration 
    INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
    INNER JOIN area ON area.id = patient_registration.city_id
    WHERE patient_registration.city_id = '$id'");

    $selectDischargedPatient = mysqli_query($connect, "SELECT area.area_name, discharge_patients.patient_name, discharge_patients.patient_age, discharge_patients.patient_address, discharge_patients.patient_consultant, staff_members.name  FROM discharge_patients 
    INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
    INNER JOIN area ON area.id = discharge_patients.city_id
    WHERE discharge_patients.city_id = '$id'");


    $selectPostponePatient = mysqli_query($connect, "SELECT area.area_name, postpone_patient.patient_name, postpone_patient.patient_age, postpone_patient.patient_address, postpone_patient.patient_consultant, staff_members.name  FROM postpone_patient 
    INNER JOIN staff_members ON staff_members.id = postpone_patient.patient_consultant
    INNER JOIN area ON area.id = postpone_patient.city_id
    WHERE postpone_patient.city_id = '$id'");

    }



include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Area wise Report</h5>
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
                                        <h5 class="text-center font-16">Area Wise Report</h5>
                                        <div class="d-print-none mo-mt-2">
                                           
                                        </div>
                                        <br>
                                    </h3>
                                </div>
                                <hr>
                                 <h5 class="text-center font-16">Currently Admit Patients</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Patient Age</th>
                                                        <th>Area</th>
                                                        <th>Patient Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrCurrent = 1;
                                                    while ($rowDischarge = mysqli_fetch_assoc($selectCurrentPatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'</td>
                                                            <td>'.$rowDischarge['patient_name'].'</td>
                                                            <td>'.$rowDischarge['patient_age'].'</td>
                                                            <td>'.$rowDischarge['area_name'].'</td>
                                                            <td>'.$rowDischarge['patient_address'].'</td>
                                                            <td>Dr. '.$rowDischarge['name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                 <h5 class="text-center font-16">Dischared Patients</h5>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Patient Age</th>
                                                        <th>Area</th>
                                                        <th>Patient Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrCurrent = 1;
                                                    while ($rowCurrent = mysqli_fetch_assoc($selectDischargedPatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'</td>
                                                            <td>'.$rowCurrent['patient_name'].'</td>
                                                            <td>'.$rowCurrent['patient_age'].'</td>
                                                            <td>'.$rowCurrent['area_name'].'</td>
                                                            <td>'.$rowCurrent['patient_address'].'</td>
                                                            <td>Dr. '.$rowCurrent['name'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                                <br>
                                 <h5 class="text-center font-16">Postpone Patients</h5>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient Name</th>
                                                        <th>Patient Age</th>
                                                        <th>Area</th>
                                                        <th>Patient Address</th>
                                                        <th>Consultant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $itrCurrent = 1;
                                                    while ($rowCurrent = mysqli_fetch_assoc($selectPostponePatient)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrCurrent++.'</td>
                                                            <td>'.$rowCurrent['patient_name'].'</td>
                                                            <td>'.$rowCurrent['patient_age'].'</td>
                                                            <td>'.$rowCurrent['area_name'].'</td>
                                                            <td>'.$rowCurrent['patient_address'].'</td>
                                                            <td>Dr. '.$rowCurrent['name'].'</td>
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