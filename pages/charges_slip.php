<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];
    $patCustomId = $_GET['pat_id'];

    $selectPatient = mysqli_query($connect, "SELECT discharge_patients.*, staff_members.name, staff_members.visit_charges, rooms.room_number, rooms.room_price  FROM `discharge_patients`
        INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
        INNER JOIN rooms ON rooms.id = discharge_patients.room_id
        WHERE discharge_patients.id = '$id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);

    $patIdFooter = $fetch_selectPatient['pat_id'];

    // $queryAdvice = mysqli_query($connect, "SELECT doctor_advice FROM `discharge_patients_charges` WHERE id= '$id'");
    // $fetch_queryAdvice = mysqli_fetch_assoc($queryAdvice);

    // $advice = $fetch_queryAdvice['doctor_advice'];

    // $explodeAdvice = explode(" , ", $advice);

    $retPatDetail = mysqli_query($connect, "SELECT * FROM pat_details WHERE pat_id = '$patIdFooter'");
    $fetch_retPatDetail = mysqli_fetch_assoc($retPatDetail);

    include '../_partials/header.php';
?>
<style type="text/css">
    body {
        color: black;
    }

    .custom {
        font-size: 13px;
    }

</style>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline" >Patient Discharge Slip</h5>
                <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <!-- end row -->
        <div class="row" id="printElement">
            <div class="col-12">
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h3 class="m-t-0 text-center">
                                            <img src="../assets/logo.png" alt="logo" height="60" />
                                            <h3 align="center" style="font-size: 120%">SHAH MEDICAL CENTER</h3>
                                            <h4 class="text-center font-16" style="font-size: 110%">Saidu Road, Opposite to Central Hospital, Saidu Sharif, Swat.</h4>
                                            <h4 class="text-center font-16" style="font-size: 110%">
                                                ( <?php
                                                    $dis = $fetch_selectPatient['organization'];
                                                    $card = "Sehat";
                                                    if (strpos($dis, $card) !== false) {
                                                        echo "Sehat Card";
                                                    }else {
                                                        echo $dis;        
                                                    }
                                                     
                                                ?> )
                                            </h4>
                                            <h4 class="float-right font-16" style="font-size: 80%"><strong>M.R No # <?php echo $fetch_selectPatient['patient_yearly_no'] ?></strong></h4>
                                            <br>
                                        </h3>
                                    </div>

                                    <hr>

                                    <div class="row custom" style="margin-bottom: -20px">
                                        <div class="col-6">
                                            <address>
                                                <strong><u>Patient Info</u></strong><br>
                                                <b>Patient Name: </b><?php echo $fetch_selectPatient['patient_name'] ?><br>
                                                <b>Room No. : </b><?php echo $fetch_selectPatient['room_number'] ?><br>
                                            </address>
                                        </div>
                                        <div class="col-6 text-right">
                                            <address><br>
                                                <b>Date Of Admission: </b>
                                                <?php
                                                
                                                $timezone = date_default_timezone_set('Asia/Karachi');
                                                $date = date('m/d/Y h:i:s a', time());


                                                $dateAdmisison = $fetch_selectPatient['patient_doa']; 
                                                echo $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                                
                                                $dod = $fetch_retPatDetail['dateandtime'];

                                                $dateOfDischarge = date('d/M/Y h:i:s A', strtotime($dod));
                                                ?>
                                                <br>
                                                <b>Date Of Discharge: </b><?php echo $dateOfDischarge ?><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <?php
                                    $queryDischargesId = mysqli_query($connect, "SELECT pat_id FROM `discharge_patients_charges` WHERE pat_id = '$patCustomId'");
                                    $fetch_queryDischargesId = mysqli_fetch_assoc($queryDischargesId);
                                    $dischargeID = $fetch_queryDischargesId['pat_id'];
                                

                                    // $dischargeID

                                    $queryDischargePatientAllData = mysqli_query($connect, "SELECT * FROM `discharge_patients_charges` WHERE pat_id = '$dischargeID'");
                                    $fetch_queryDischargePatientAllData = mysqli_fetch_assoc($queryDischargePatientAllData);
                                ?>

                                <div class="row custom">
                                    <?php
                                        if ($fetch_queryDischargePatientAllData['advance_payment'] !== '0') {
                                    ?>
                                    <div class="col-md-4" >
                                        <label> Advance Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['advance_payment'] ?></span>
                                    </div>
                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['med_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4" >
                                        <label> Medicines Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['med_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['room_charges'] !== '0') {
                                    ?>
                                    
                                    <div class="col-md-4">
                                        <label> Room Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['room_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['ot_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4" >
                                        <label> OT Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['ot_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['hospital_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4" >
                                        <label> Admission Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['hospital_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['lab_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4">
                                        <label> Lab Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['lab_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['dr_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4" >
                                        <label> Doctor Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['dr_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['anesthetic_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4" >
                                        <label> Anesthesia Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['anesthetic_charges'] ?></span>
                                    </div>

                                    <?php
                                        }

                                        if ($fetch_queryDischargePatientAllData['visit_charges'] !== '0') {
                                    ?>

                                    <div class="col-md-4">
                                        <label> Visit Charges:</label>
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['visit_charges'] ?></span>
                                    </div>

                                    <?php
                                        }
                                    ?>
                                </div>

                                <div class="row custom">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label> Total Charges:</label>
                                         <?php $totalPaidedAmount = $fetch_queryDischargePatientAllData['amount_paid'] - $fetch_queryDischargePatientAllData['advance_payment']; ?>
                                        <span><strong><?php echo "Rs. ".$totalPaidedAmount ?></strong></span>
                                    </div>
                                </div>

                                <div class="row custom">
                                    <div class="col-md-8">
                                        <label style="margin-bottom: 0rem !important">This is a computer generated report, therefore signatures are not required. </label><br>
                                        <label>Developed By: <i>Asif Ullah</i></label>
                                        <hr>
                                    </div>     
                                </div>
                            </form>    
                    <!-- </div> -->
                <!-- </div> -->
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
    function print() {
        printJS({
        printable: 'printElement',
        type: 'html',
        targetStyles: ['*']
     })
    }

    document.getElementById('printButton').addEventListener ("click", print);
</script>
</body>
</html>