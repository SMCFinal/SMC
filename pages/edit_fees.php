<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $selectPatient = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name, staff_members.visit_charges, rooms.room_number, rooms.room_price  FROM `patient_registration`
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN rooms ON rooms.id = patient_registration.room_id

        WHERE patient_registration.id = '$id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);
    $surgeryId = $fetch_selectPatient['patient_operation'];

    $sur_details = mysqli_query($connect, "SELECT patient_registration.id, patient_registration.patient_operation, surgeries.surgery_name FROM `patient_registration`
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN surgeries ON surgeries.id = patient_registration.patient_operation

        WHERE patient_registration.id = '$id'");

    $fetch_surg_details = mysqli_fetch_assoc($sur_details);



    if (isset($_POST['makeSlip'])) {
        $id = $_POST['pat_id'];
        $pat_id = $_POST['pat_id'];
        $city_id = $_POST['city_id'];
        $room_id = $_POST['room_id'];
        $medCharges = $_POST['medCharges'];
        $roomCharges = $_POST['roomCharges'];
        $OTCharges = $_POST['OTCharges'];
        $hospitalCharges = $_POST['hospitalCharges'];
        $labCharges = $_POST['labCharges'];
        $drCharges = $_POST['drCharges'];
        $anestheticCharges = $_POST['anesthesiaCharges'];
        $actualCharges = $_POST['actualCharges'];
        $paidAmount = $_POST['paidAmount'];
        $doctorAdvice = $_POST['doctorAdvice'];
        $stitchesDays = $_POST['stitchesDays'];

        $patient_operation_discharge = $_POST['p_operation'];
        $pat_consultant = $_POST['p_consultant'];
        $visitCharges = $_POST['visitCharges'];

        $advance_payment = $_POST['advance_payment'];

        if (empty($visitCharges)) {
            $visitCharges = 0;
        }else {
            $visitCharges = $_POST['visitCharges'];
        }

        if (empty($advance_payment)) {
            $advance_payment = '0';
        }

        $queryDischargeCharges = mysqli_query($connect, "INSERT INTO `discharge_patients_charges`
            (`pat_id`, `city_id`, `room_id`, `med_charges`, `room_charges`, `ot_charges`, `hospital_charges`, `lab_charges`, `dr_charges`, `anesthetic_charges`, `actual_charges`, `amount_paid`, doctor_advice, days_stitches, pat_operation, pat_consultant, visit_charges, advance_payment) VALUES ('$pat_id', '$city_id', '$room_id', '$medCharges', '$roomCharges', '$OTCharges', '$hospitalCharges', '$labCharges', '$drCharges', '$anestheticCharges', '$actualCharges', '$paidAmount', '$doctorAdvice', '$stitchesDays', '$patient_operation_discharge', '$pat_consultant', '$visitCharges', '$advance_payment')");



        $p_name = $_POST['p_name'];
        $p_age = $_POST['p_age'];
        $p_gender = $_POST['p_gender'];
        $p_address = $_POST['p_address'];
        $p_cnic = $_POST['p_cnic'];
        $p_contact = $_POST['p_contact'];
        $p_city = $_POST['p_city'];
        $p_room = $_POST['p_room'];
        $p_doa = $_POST['p_doa'];
        $p_doop = $_POST['p_doop'];
        $p_disease= $_POST['p_disease'];
        $p_operation = $_POST['p_operation'];
        $p_consultant = $_POST['p_consultant'];
        $p_yearly = $_POST['p_yearly'];
        $p_attendent = $_POST['p_attendent'];
        $p_consultant_charges = $_POST['p_consultant_charges'];
        $p_anes = $_POST['p_anes'];
        $p_anes_charges = $_POST['p_anes_charges'];
        $p_organization = $_POST['p_organization'];

        $dateCustomForDischarge = date_default_timezone_set('Asia/Karachi');
        $autoDateForDischarge = date('Y-m-d');


        $p_advance = $_POST['p_advance'];
        if (empty($p_advance)) {
            $p_advance = '0';
        }
        $category = 'dischargePatient';
        
        $dischargePatientTable = mysqli_query($connect, "INSERT INTO `discharge_patients`
            (`patient_name`, `patient_age`, `patient_gender`, `patient_address`, `patient_cnic`, `patient_contact`, `city_id`, `room_id`, `patient_doa`, `patient_doop`, `patient_disease`, `patient_operation`, `patient_consultant`, `patient_yearly_no`, `attendent_name`, `consultant_charges`, `anasthetic_name`, `anesthesia_charges`, `category`, `pat_id`, `advance_payment`, `organization`, `auto_date`) VALUES 
            ('$p_name', '$p_age', '$p_gender', '$p_address', '$p_cnic', '$p_contact', '$p_city', '$p_room', '$p_doa', '$p_doop', '$p_disease', '$p_operation', '$p_consultant', '$p_yearly', '$p_attendent', '$p_consultant_charges', '$p_anes', '$p_anes_charges', '$category', '$id', '$p_advance', '$p_organization', '$autoDateForDischarge')");

        $updatePharmacyAmount = mysqli_query($connect, "UPDATE pharmacy_amount SET patient_payment_status = '0' WHERE patient_id = '$pat_id'");

        $updateRooms = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$room_id'");


        $updateLabTestReport = mysqli_query($connect, "UPDATE lab_test_report SET patient_payment_status = '0' WHERE pat_id = '$pat_id'");

        $deletePatient = mysqli_query($connect, "DELETE FROM `patient_registration` WHERE id='$id'");

        $dop = "0000-00-00 00:00:00";

        $queryDoctorChargesSurgery = mysqli_query($connect, "INSERT INTO doctor_surgery_charges(pat_id, room_id, surgery_charges, pat_operation, pat_consultant, date_of_payment)VALUES('$id', '$p_room', '$drCharges', '$p_operation', '$p_consultant', '$dop')");

        $stitchesDays = $_POST['stitchesDays'];
        $visitAfterDays = $_POST['visitAfterDays'];
        $catheterAfterDays = $_POST['catheterAfterDays'];
        $procedureCounter = $_POST['procedureCounter'];

        $queryAnestheticChargesSurgery = mysqli_query($connect, "INSERT INTO anesthetic_surgery_charges(
            anesthetic_id, 
             pat_id, 
              room_id,  
               surgery_anes_charges, 
                pat_operation, 
                 pat_consultant, 
                  date_of_payment
            )VALUES(
            '$p_anes', 
             '$id', 
              '$p_room', 
               '$anestheticCharges', 
                '$p_operation', 
                 '$p_consultant', 
                  '$dop')");


        $timezoneNew = date_default_timezone_set('Asia/Karachi');
        $dateNew = date('Y-m-d H:i:s', time());

        $detailPatQuery = mysqli_query($connect, "INSERT INTO pat_details(
            stitchesDays,
             visitAfterDays,
               catheterAfterDays,
                procedureCounter,
                 pat_id,
                  dateandtime
        )VALUES(
            '$stitchesDays',
             '$visitAfterDays',
               '$catheterAfterDays',
                '$procedureCounter',
                 '$id',
                  '$dateNew'
        )
        ");

        $visitChargesUpdateQuery = mysqli_query($connect, "UPDATE doctor_visit_charges SET visit_status = '0' WHERE pat_id = '$id'");

        if ($visitChargesUpdateQuery) {
            header("LOCATION:patients_discharge_list.php");
        }
    }


include '../_partials/header.php';
?>
<!-- Top Bar End -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Prepare Patient Discharge Slip</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL CENTER</h3>
                                        <h4 class="text-center font-16">Address: Near Center Hospital, Saidu Sharif Swat.</h4>
                                        <h4 class="float-right font-16"><strong>M.R No # <?php echo $fetch_selectPatient['patient_yearly_no'] ?></strong></h4>
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
                                            <b>Patient Gender: </b><?php if ($fetch_selectPatient['patient_gender'] == 1 ) {
                                                echo 'Male';
                                            }elseif ($fetch_selectPatient['patient_gender'] == 2) {
                                                echo 'Female';
                                            }else {
                                                echo 'Other';
                                            } 
                                            // $fetch_selectPatient['patient_name'] ?><br>
                                        </address>
                                    </div>
                                    <div class="col-6 text-right">
                                        <address>
                                            <b>Doctor Name: </b><?php echo $fetch_selectPatient['name'] ?><br>
                                            <b>Room No. : </b><?php echo $fetch_selectPatient['room_number'] ?><br>
                                            <b>Surgery: </b><?php echo $fetch_surg_details['surgery_name'] ?><br>
                                            <b>Date Of Admission: </b>
                                            <?php
                                            
                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                            $date = date('m/d/Y h:i:s a', time());


                                            $dateAdmisison = $fetch_selectPatient['patient_doa']; 
                                            echo $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                            
                                            // echo $fetch_selectPatient['patient_doa'] 

                                            ?>
                                            <br>
                                            <b>Date Of Discharge: </b><?php echo $dishcargeTime = date('d/M/Y h:i:s A') ?><br>
                                        </address>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <hr>
                        <?php

                        $roomEmbedPrice = $fetch_selectPatient['room_price'];

                        $timezone = date_default_timezone_set('Asia/Karachi');
                        $date = date('m/d/Y h:i:s a', time());

                        
                        $roomTotal = round((strtotime($date) - strtotime($fetch_selectPatient['patient_doa']))/3600);

                        $roomDays = floor($roomTotal / 24);

                        $roomHours =  $roomTotal % 24;
                        
                        if ($roomHours > 2) {
                            $roomInvoicePrice = ($roomDays + 1) * $roomEmbedPrice;
                        }else {
                            $roomInvoicePrice = $roomEmbedPrice * $roomDays;
                        }

                        ?>
                        <!-- <form method="POST"> -->
                            
                            <div class="row">
                                <div class="col text-right">
                                    <label> Advance Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="advance_payment" value="<?php echo $fetch_selectPatient['advance_payment']; ?>" class="form-control">
                                </div>
                                <div class="col-md-3 col-md-offset-2">
                                    <input type="number" id="advCharges" value="<?php echo $fetch_selectPatient['advance_payment'] ?>" class="form-control" required="" readonly >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Medicines Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php if($fetch_queryTotal['medTotal'] === 0 OR empty($fetch_queryTotal['medTotal'])){ echo "0"; }else{ echo $fetch_queryTotal['medTotal']; }  ?>" readonly id="actMedChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Medicines Price" >
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="medCharges" value="<?php if($fetch_queryTotal['medTotal'] === 0 OR empty($fetch_queryTotal['medTotal'])){ echo "0"; }else{ echo $fetch_queryTotal['medTotal']; }  ?>" class="form-control" id="totMedChar" required="" onkeyUp="totCharges()" placeholder="Medicines Price">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Room Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $roomInvoicePrice ?>" readonly id="actRoomChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Room Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="roomCharges" value="<?php echo $roomInvoicePrice ?>" id="totRoomChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Room Charges">
                                </div>
                            </div>
                            <br />

                            <?php
                            $surgeryChargesTable = mysqli_query($connect, "SELECT patient_registration.patient_operation, surgeries.*
                                FROM patient_registration
                                INNER JOIN surgeries ON surgeries.id = patient_registration.patient_operation
                                WHERE patient_registration.id = '$id'");
                            $fetch_surgeryChargesTable = mysqli_fetch_assoc($surgeryChargesTable);

                            $doctorCharges = $fetch_selectPatient['consultant_charges'] - $fetch_surgeryChargesTable['total_charges'];
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <label> OT Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_surgeryChargesTable['ot_charges'] ?>" id="actOtChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="OT Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="OTCharges" value="<?php echo $fetch_surgeryChargesTable['ot_charges'] ?>" id="totOtChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="OT Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Admission Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_surgeryChargesTable['admission_charges'] ?>" id="actHosChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Hospital Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="hospitalCharges" value="<?php echo $fetch_surgeryChargesTable['admission_charges'] ?>" id="totHosChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Hospital Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Lab Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php  if($fetch_queryTotalLab['totalPrice'] === 0 OR empty($fetch_queryTotalLab['totalPrice'])){ echo "0"; }else{ echo $fetch_queryTotalLab['totalPrice']; }  ?>" id="actLabChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Lab Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="labCharges" value="<?php  if($fetch_queryTotalLab['totalPrice'] === 0 OR empty($fetch_queryTotalLab['totalPrice'])){ echo "0"; }else{ echo $fetch_queryTotalLab['totalPrice']; }  ?>" id="totLabChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Lab Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Doctor Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo  $fetch_selectPatient['consultant_charges']  ?>" id="actDrChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Doctor Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="drCharges" value="<?php echo  $fetch_selectPatient['consultant_charges']  ?>" id="TotDrChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Doctor Charges">
                                </div>
                            </div>
                            <br />
                            <?php
                            $anestheticCharges = mysqli_query($connect, "SELECT patient_registration.*, staff_members.salary, staff_members.visit_charges FROM `patient_registration` 
                                INNER JOIN staff_members ON staff_members.id = patient_registration.anasthetic_name
                                WHERE patient_registration.id = '$id'");
                            $fetch_anestheticCharges = mysqli_fetch_assoc($anestheticCharges);
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <label> Anesthesia Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_surgeryChargesTable['anethesia_charges'] ?>" id="actAnesChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Anesthesia Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="anesthesiaCharges" value="<?php echo $fetch_selectPatient['anesthesia_charges'] ?>" id="totAnesChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Anesthesia Charges">
                                </div>
                            </div>
                            <br />
                            <?php
                            $queryVisitCharges = mysqli_query($connect, "SELECT SUM(visit_charges) AS sumVisitCharges, visit_charges, COUNT(*) AS countedVisit FROM `doctor_visit_charges` WHERE pat_id = '$id' AND visit_status = '1'");
                            $fetch_queryVisitCharges = mysqli_fetch_assoc($queryVisitCharges);
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <label> Visit Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php if(empty($fetch_queryVisitCharges['sumVisitCharges']) OR $fetch_queryVisitCharges['sumVisitCharges'] === 0){ echo "0"; }else{ echo $fetch_queryVisitCharges['sumVisitCharges']; }  ?>" id="actVisitCharges" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Visit Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="visitCharges" value="<?php if(empty($fetch_queryVisitCharges['sumVisitCharges']) OR $fetch_queryVisitCharges['sumVisitCharges'] === 0){ echo "0"; }else{ echo $fetch_queryVisitCharges['sumVisitCharges']; }  ?>" id="totVisitCharges" required="" onkeyUp="totCharges()" class="form-control" placeholder="Visit Charges">

                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Actual Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="actualCharges" value="" id="actualCharges" readonly class="form-control" placeholder="Actual Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="paidAmount" value="" id="totalCharges" class="form-control" readonly placeholder="Total Charges"> 
                                </div>
                            </div>
                            <br />
                            <hr>
                            <style type="text/css">
                                .customText { 
                                    text-align: center; 
                                }
                                input::-webkit-outer-spin-button,
                                input::-webkit-inner-spin-button {
                                  -webkit-appearance: none;
                                  margin: 0;
                                }

                                /* Firefox */
                                input[type=number] {
                                  -moz-appearance: textfield;
                                }
                            </style>
                            
                            
                            <input type="hidden" name="pat_id" value="<?php echo $fetch_selectPatient['id'] ?>">
                            <input type="hidden" name="city_id" value="<?php echo $fetch_selectPatient['city_id'] ?>">
                            <input type="hidden" name="room_id" value="<?php echo $fetch_selectPatient['room_id'] ?>">

                            <hr>

                            
                            <input type="hidden" name="p_name" value="<?php echo $fetch_selectPatient['patient_name'] ?>">
                            <input type="hidden" name="p_age" value="<?php echo $fetch_selectPatient['patient_age'] ?>">
                            <input type="hidden" name="p_gender" value="<?php echo $fetch_selectPatient['patient_gender'] ?>">
                            <input type="hidden" name="p_address" value="<?php echo $fetch_selectPatient['patient_address'] ?>">
                            <input type="hidden" name="p_cnic" value="<?php echo $fetch_selectPatient['patient_cnic'] ?>">
                            <input type="hidden" name="p_contact" value="<?php echo $fetch_selectPatient['patient_contact'] ?>">
                            <input type="hidden" name="p_city" value="<?php echo $fetch_selectPatient['city_id'] ?>">
                            <input type="hidden" name="p_room" value="<?php echo $fetch_selectPatient['room_id'] ?>">
                            <input type="hidden" name="p_doa" value="<?php echo $fetch_selectPatient['patient_doa'] ?>">
                            <input type="hidden" name="p_doop" value="<?php echo $fetch_selectPatient['patient_doop'] ?>">
                            <input type="hidden" name="p_disease" value="<?php echo $fetch_selectPatient['patient_disease'] ?>">
                            <input type="hidden" name="p_operation" value="<?php echo $fetch_selectPatient['patient_operation'] ?>">
                            <input type="hidden" name="p_consultant" value="<?php echo $fetch_selectPatient['patient_consultant'] ?>">
                            <input type="hidden" name="p_yearly" value="<?php echo $fetch_selectPatient['patient_yearly_no'] ?>">
                            <input type="hidden" name="p_attendent" value="<?php echo $fetch_selectPatient['attendent_name'] ?>">
                            <input type="hidden" name="p_consultant_charges" value="<?php echo $fetch_selectPatient['consultant_charges'] ?>">
                            <input type="hidden" name="p_anes" value="<?php echo $fetch_selectPatient['anasthetic_name'] ?>">
                            <input type="hidden" name="p_anes_charges" value="<?php echo $fetch_selectPatient['anesthesia_charges'] ?>">
                            <input type="hidden" name="p_advance" value="<?php echo $fetch_selectPatient['advance_payment'] ?>">
                            <input type="hidden" name="p_organization" value="<?php echo $fetch_selectPatient['organization'] ?>">

                        <!-- </form> -->
                            <div class="d-print-none mo-mt-2">
                                <div class="float-right">
                                    <!-- <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a> -->
                                    <button class="btn btn-primary waves-effect waves-light btn-lg" type="submit" name="makeSlip">Prepare Discharge Slip</button>
                                    <!-- <a href="#" class="btn btn-primary waves-effect waves-light">Send</a> -->
                                </div>
                            </div>
                        </form>
                          
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

<script type="text/javascript">
    window.onload = function() {
        actCharges();
        totCharges();
        console.log('executed')
    }
function actCharges() {
   let totalChargesVar = [];
    let totalCalcCharges = 0;

    totalChargesVar['actMedChar'] = parseInt(document.getElementById('actMedChar').value);
    totalChargesVar['actRoomChar'] = parseInt(document.getElementById('actRoomChar').value);
    totalChargesVar['actOtChar'] = parseInt(document.getElementById('actOtChar').value);
    totalChargesVar['actHosChar'] = parseInt(document.getElementById('actHosChar').value);
    totalChargesVar['actLabChar'] = parseInt(document.getElementById('actLabChar').value);
    totalChargesVar['actDrChar'] = parseInt(document.getElementById('actDrChar').value);
    totalChargesVar['actAnesChar'] = parseInt(document.getElementById('actAnesChar').value);
    totalChargesVar['actVisitCharges'] = parseInt(document.getElementById('actVisitCharges').value);
    // totalChargesVar['totVisitCharges'] = parseInt(document.getElementById('totVisitCharges').value);
    document.getElementById('actualCharges').value = '';

    for (let key in totalChargesVar) {
        if (totalChargesVar[key]) {
            totalCalcCharges += totalChargesVar[key];
            
            document.getElementById('actualCharges').value = totalCalcCharges;
        }
    }
}

function totCharges() {
    let totalChargesVar = [];
    let totalCalcCharges = 0;
    

    totalChargesVar['totMedChar'] = parseInt(document.getElementById('totMedChar').value);
    totalChargesVar['totRoomChar'] = parseInt(document.getElementById('totRoomChar').value);
    totalChargesVar['totOtChar'] = parseInt(document.getElementById('totOtChar').value);
    totalChargesVar['totHosChar'] = parseInt(document.getElementById('totHosChar').value);
    totalChargesVar['totLabChar'] = parseInt(document.getElementById('totLabChar').value);
    totalChargesVar['TotDrChar'] = parseInt(document.getElementById('TotDrChar').value);
    totalChargesVar['totAnesChar'] = parseInt(document.getElementById('totAnesChar').value);
    totalChargesVar['totVisitCharges'] = parseInt(document.getElementById('totVisitCharges').value);
    document.getElementById('totalCharges').value = '';

    for (let key in totalChargesVar) {
        if (totalChargesVar[key]) {
            totalCalcCharges += totalChargesVar[key];
            
            document.getElementById('totalCharges').value = totalCalcCharges;
        }
    }
}
</script>
</body>

</html>