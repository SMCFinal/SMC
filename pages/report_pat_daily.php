<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $date = date_default_timezone_set('Asia/Karachi');
    $currentDate = date('Y-m-d');
    
    $selectCurrentPatient = mysqli_query($connect, "SELECT area.area_name, patient_registration.patient_name, patient_registration.patient_age, patient_registration.patient_doa, patient_registration.patient_address, patient_registration.patient_consultant, staff_members.name  FROM patient_registration 
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN area ON area.id = patient_registration.city_id
        WHERE DATE(patient_registration.patient_doa) = '$currentDate'");


include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Patient Daily Report</h5>
                 <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
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
                                        <h3 align="center">SHAH MEDICAL AND SERGICAL CENTER</h3>
                                        <?php 
                                            $dateCustom = date_default_timezone_set('Asia/Karachi');
                                            $currentDateCustom = date('Y-m-d, "l"');
                                        ?>
                                        <p align="center">Daily Patient Report, Dated <?php echo $currentDateCustom ?></p>
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
                                                        <th>Area</th>
                                                        <th>Address</th>
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