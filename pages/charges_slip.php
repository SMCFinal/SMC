<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $selectPatient = mysqli_query($connect, "SELECT discharge_patients.*, staff_members.name, staff_members.visit_charges, rooms.room_number, rooms.room_price  FROM `discharge_patients`
        INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
        INNER JOIN rooms ON rooms.id = discharge_patients.room_id
        WHERE discharge_patients.id = '$id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);

    $patIdFooter = $fetch_selectPatient['pat_id'];

    $queryAdvice = mysqli_query($connect, "SELECT doctor_advice FROM `discharge_patients_charges` WHERE id= '$id'");
    $fetch_queryAdvice = mysqli_fetch_assoc($queryAdvice);

    $advice = $fetch_queryAdvice['doctor_advice'];

    $explodeAdvice = explode(" , ", $advice);

    $retPatDetail = mysqli_query($connect, "SELECT * FROM pat_details WHERE pat_id = '$patIdFooter'");
    $fetch_retPatDetail = mysqli_fetch_assoc($retPatDetail);

include '../_partials/header.php';
?>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline" >Patient Discharge Slip</h5>
                <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <!-- end row -->
        <div class="row" id="printElement">
            <div class="col-12">
                <!-- <div class="card m-b-30" > -->
                    <!-- <div class="card-body" > -->
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h3 class="m-t-0 text-center">
                                            <img src="../assets/logo.png" alt="logo" height="60" />
                                            <h3 align="center" style="font-size: 120%">SHAH MEDICAL CENTER</h3>
                                            <h4 class="text-center font-16" style="font-size: 110%">Address: Near Center Hospital, Saidu Sharif Swat.</h4>
                                            <h4 class="float-right font-16" style="font-size: 80%"><strong>M.R No # <?php echo $fetch_selectPatient['patient_yearly_no'] ?></strong></h4>
                                            <br>
                                        </h3>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong><u>Patient Info</u></strong><br>
                                                <b>Patient Name: </b><?php echo $fetch_selectPatient['patient_name'] ?><br>
                                                <b>Patient Address: </b><?php echo $fetch_selectPatient['patient_address'] ?><br>
                                                <b>Patient Contact: </b><?php echo $fetch_selectPatient['patient_contact'] ?><br>
                                                <b>Patient CNIC: </b><?php echo $fetch_selectPatient['patient_cnic'] ?><br>
                                                <b>Patient Gender: </b>
                                                <?php 
                                                    if ($fetch_selectPatient['patient_gender'] == 1 ) {
                                                        echo 'Male';
                                                    }elseif ($fetch_selectPatient['patient_gender'] == 2) {
                                                        echo 'Female';
                                                    }else {
                                                        echo 'Other';
                                                    } 
                                                ?><br>
                                            </address>
                                        </div>
                                        <div class="col-6 text-right">
                                            <address>
                                                <b>Doctor Name: </b><?php echo $fetch_selectPatient['name'] ?><br>
                                                <b>Room No. : </b><?php echo $fetch_selectPatient['room_number'] ?><br>
                                                <b>Patient Case: </b><?php echo $fetch_selectPatient['patient_disease'] ?><br>
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
                                                <!-- <b>Date Of Discharge: </b><?php echo $fetch_retPatDetail = date('d/M/Y h:i:s A') ?><br> -->
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <?php
                                    $queryDischargesId = mysqli_query($connect, "SELECT pat_id FROM `discharge_patients_charges` WHERE id = '$id'");
                                    $fetch_queryDischargesId = mysqli_fetch_assoc($queryDischargesId);
                                    $dischargeID = $fetch_queryDischargesId['pat_id'];
                                

                                    // $dischargeID

                                    $queryDischargePatientAllData = mysqli_query($connect, "SELECT * FROM `discharge_patients_charges` WHERE id = '$id' AND pat_id = '$dischargeID'");
                                    $fetch_queryDischargePatientAllData = mysqli_fetch_assoc($queryDischargePatientAllData);
                                ?>


                                <div class="row">
                                    <div class="col text-right">
                                        <label> Advance Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['advance_payment'] ?></span>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col text-right">
                                        <label> Medicines Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['med_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Room Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['room_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col text-right">
                                        <label> OT Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['ot_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Admission Charges:</label>
                                    </div>
                                   
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['hospital_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Lab Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['lab_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Doctor Charges:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['dr_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Anesthesia Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['anesthetic_charges'] ?></span>
                                    </div>
                                </div>
                                <br />
                                
                                <div class="row">
                                    <div class="col text-right">
                                        <label> Visit Charges:</label>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <span><?php echo "Rs. ".$fetch_queryDischargePatientAllData['visit_charges'] ?></span>

                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col text-right">
                                        <label style="font-size: 100%"> Total Charges:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <?php $totalPaidedAmount = $fetch_queryDischargePatientAllData['amount_paid'] - $fetch_queryDischargePatientAllData['advance_payment']; ?>
                                        <span style="font-size: 100%"><strong><?php echo "Rs. ".$totalPaidedAmount ?></strong></span>
                                    </div>
                                </div>
                                <br>
                                <div class="row">                                
                                    <div class="col-md-12">
                                        <label>Signature: </label><span>______________________</span>
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