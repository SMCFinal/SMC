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




    if (isset($_POST['makeSlip'])) {
        $advance_payment = $_POST['advance_payment'];
        $patIdForUpdate = $_POST['patIdForUpdate'];
        $customPatId = $_POST['customPatId'];

        $medCharges = $_POST['medCharges'];
        $roomCharges = $_POST['roomCharges'];
        $OTCharges = $_POST['OTCharges'];
        $hospitalCharges = $_POST['hospitalCharges'];
        $labCharges = $_POST['labCharges'];
        $drCharges = $_POST['drCharges'];
        $anestheticCharges = $_POST['anesthesiaCharges'];
        $actualCharges = $_POST['actualCharges'];
        $paidAmount = $_POST['paidAmount'];
        $visitCharges = $_POST['visitCharges'];



        if (empty($visitCharges)) {
            $visitCharges = 0;
        }else {
            $visitCharges = $_POST['visitCharges'];
        }

        if (empty($advance_payment)) {
            $advance_payment = '0';
        }

        $updatePatCharges = mysqli_query($connect, "UPDATE `discharge_patients_charges` SET 
        `med_charges` = '$medCharges', 
        `room_charges` = '$roomCharges', 
        `ot_charges` = '$OTCharges', 
        `hospital_charges` = '$hospitalCharges', 
        `lab_charges` = '$labCharges', 
        `dr_charges` = '$drCharges', 
        `anesthetic_charges` = '$anestheticCharges', 
        `actual_charges` = '$actualCharges', 
        `amount_paid` = '$paidAmount', 
        `visit_charges` = '$visitCharges' 
        WHERE pat_id = '$customPatId'");
        
       
        if ($updatePatCharges) {
            header("LOCATION:select_option.php?id=".$patIdForUpdate."&pat_id=".$customPatId."");
        }
    }


include '../_partials/header.php';
?>
<!-- Top Bar End -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Patients Fee Edit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                        <input type="hidden" value="<?php echo $id ?>" name="patIdForUpdate">
                        <input type="hidden" value="<?php echo $patCustomId ?>" name="customPatId">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL CENTER</h3>
                                        <h4 class="text-center font-16">Address: Near Centeral Hospital, Saidu Sharif Swat.</h4>
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
                            <?php
                                $queryDischargeCharges = mysqli_query($connect, "SELECT advance_payment, med_charges,room_charges, ot_charges, hospital_charges, lab_charges, dr_charges, anesthetic_charges, visit_charges, actual_charges  FROM  `discharge_patients_charges` WHERE pat_id = '$patCustomId'");
                                $fetch_queryDischargeCharges = mysqli_fetch_assoc($queryDischargeCharges);
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <label> Advance Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="advance_payment" value="<?php echo $fetch_queryDischargeCharges['advance_payment']; ?>" class="form-control">
                                </div>
                                <div class="col-md-3 col-md-offset-2">
                                    <input type="number" id="advCharges" value="<?php echo $fetch_queryDischargeCharges['advance_payment'] ?>" class="form-control" required="" readonly >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Medicines Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['med_charges'] ?>" readonly id="actMedChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Medicines Price" >
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="medCharges" value="<?php echo $fetch_queryDischargeCharges['med_charges'] ?>" readonly id="totMedChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Medicines Price" >
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Room Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['room_charges'] ?>" readonly id="actRoomChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Room Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="roomCharges" value="<?php echo $fetch_queryDischargeCharges['room_charges'] ?>" id="totRoomChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Room Charges">
                                </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col text-right">
                                    <label> OT Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['ot_charges'] ?>" id="actOtChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="OT Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="OTCharges" value="<?php echo $fetch_queryDischargeCharges['ot_charges'] ?>" id="totOtChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="OT Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Admission Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['hospital_charges'] ?>" id="actHosChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Hospital Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="hospitalCharges" value="<?php echo $fetch_queryDischargeCharges['hospital_charges'] ?>" id="totHosChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Hospital Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Lab Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['lab_charges'] ?>" id="actLabChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Lab Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="labCharges" value="<?php echo $fetch_queryDischargeCharges['lab_charges'] ?>" id="totLabChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Lab Charges">
                                </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col text-right">
                                    <label> Doctor Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo  $fetch_queryDischargeCharges['dr_charges']  ?>" id="actDrChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Doctor Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="drCharges" value="<?php echo  $fetch_queryDischargeCharges['dr_charges']  ?>" id="TotDrChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Doctor Charges">
                                </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col text-right">
                                    <label> Anesthesia Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['anesthetic_charges'] ?>" id="actAnesChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Anesthesia Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="anesthesiaCharges" value="<?php echo $fetch_queryDischargeCharges['anesthetic_charges'] ?>" id="totAnesChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Anesthesia Charges">
                                </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col text-right">
                                    <label> Visit Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryDischargeCharges['visit_charges'] ?>" id="actVisitCharges" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Visit Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="visitCharges" value="<?php echo $fetch_queryDischargeCharges['visit_charges'] ?>" id="totVisitCharges" required="" onkeyUp="totCharges()" class="form-control" placeholder="Visit Charges">

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
                                    <button class="btn btn-primary waves-effect waves-light btn-lg" type="submit" name="makeSlip">Edit Discharge Slip Fee</button>
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
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.select2').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>

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