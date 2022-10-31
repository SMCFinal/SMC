<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $selectPatient = mysqli_query($connect, "SELECT postpone_patient.*, staff_members.name, staff_members.visit_charges, rooms.room_number, rooms.room_price  FROM `postpone_patient`
        INNER JOIN staff_members ON staff_members.id = postpone_patient.patient_consultant
        INNER JOIN rooms ON rooms.id = postpone_patient.room_id
        WHERE postpone_patient.id = '$id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);
    // if (isset($_POST['makeSlip'])) {
        // $id = $_POST['pat_id'];
    //     $pat_id = $_POST['pat_id'];
    //     $city_id = $_POST['city_id'];
    //     $room_id = $_POST['room_id'];
    //     $medCharges = $_POST['medCharges'];
    //     $roomCharges = $_POST['roomCharges'];
    //     $OTCharges = $_POST['OTCharges'];
    //     $hospitalCharges = $_POST['hospitalCharges'];
    //     $labCharges = $_POST['labCharges'];
    //     $drCharges = $_POST['drCharges'];
    //     $anestheticCharges = $_POST['anesthesiaCharges'];
    //     $actualCharges = $_POST['actualCharges'];
    //     $paidAmount = $_POST['paidAmount'];
    //     $doctorAdvice = $_POST['doctorAdvice'];
    //     $stitchesDays = $_POST['stitchesDays'];

    //     $patient_operation_discharge = $_POST['p_operation'];
    //     $pat_consultant = $_POST['p_consultant'];
    //     $visitCharges = $_POST['visitCharges'];
    //     if (empty($visitCharges)) {
    //         $visitCharges = 0;
    //     }else {
    //         $visitCharges = $_POST['visitCharges'];
    //     }

    //     $queryDischargeCharges = mysqli_query($connect, "INSERT INTO `discharge_patients_charges`
    //         (`pat_id`, `city_id`, `room_id`, `med_charges`, `room_charges`, `ot_charges`, `hospital_charges`, `lab_charges`, `dr_charges`, `anesthetic_charges`, `actual_charges`, `amount_paid`, doctor_advice, days_stitches, pat_operation, pat_consultant, visit_charges) VALUES ('$pat_id', '$city_id', '$room_id', '$medCharges', '$roomCharges', '$OTCharges', '$hospitalCharges', '$labCharges', '$drCharges', '$anestheticCharges', '$actualCharges', '$paidAmount', '$doctorAdvice', '$stitchesDays', '$patient_operation_discharge', '$pat_consultant', '$visitCharges')");



    //     $p_name = $_POST['p_name'];
    //     $p_age = $_POST['p_age'];
    //     $p_gender = $_POST['p_gender'];
    //     $p_address = $_POST['p_address'];
    //     $p_cnic = $_POST['p_cnic'];
    //     $p_contact = $_POST['p_contact'];
    //     $p_city = $_POST['p_city'];
    //     $p_room = $_POST['p_room'];
    //     $p_doa = $_POST['p_doa'];
    //     $p_doop = $_POST['p_doop'];
    //     $p_disease= $_POST['p_disease'];
    //     $p_operation = $_POST['p_operation'];
    //     $p_consultant = $_POST['p_consultant'];
    //     $p_yearly = $_POST['p_yearly'];
    //     $p_attendent = $_POST['p_attendent'];
    //     $p_consultant_charges = $_POST['p_consultant_charges'];
    //     $p_anes = $_POST['p_anes'];
    //     $p_anes_charges = $_POST['p_anes_charges'];
    //     $category = 'dischargePatient';
        
    //     $dischargePatientTable = mysqli_query($connect, "INSERT INTO `discharge_patients`
    //         (`patient_name`, `patient_age`, `patient_gender`, `patient_address`, `patient_cnic`, `patient_contact`, `city_id`, `room_id`, `patient_doa`, `patient_doop`, `patient_disease`, `patient_operation`, `patient_consultant`, `patient_yearly_no`, `attendent_name`, `consultant_charges`, `anasthetic_name`, `anesthesia_charges`, `category`, pat_id) VALUES 
    //         ('$p_name', '$p_age', '$p_gender', '$p_address', '$p_cnic', '$p_contact', '$p_city', '$p_room', '$p_doa', '$p_doop', '$p_disease', '$p_operation', '$p_consultant', '$p_yearly', '$p_attendent', '$p_consultant_charges', '$p_anes', '$p_anes_charges', '$category', '$id')");

    //     $updatePharmacyAmount = mysqli_query($connect, "UPDATE pharmacy_amount SET patient_payment_status = '0' WHERE patient_id = '$pat_id'");

    //     $updateRooms = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$room_id'");


    //     $updateLabTestReport = mysqli_query($connect, "UPDATE lab_test_report SET patient_payment_status = '0' WHERE pat_id = '$pat_id'");

    //     $deletePatient = mysqli_query($connect, "DELETE FROM `patient_registration` WHERE id='$id'");

    //     $dop = "0000-00-00 00:00:00";
    //     $queryDoctorChargesSurgery = mysqli_query($connect, "INSERT INTO doctor_surgery_charges(pat_id, room_id, surgery_charges, pat_operation, pat_consultant, date_of_payment)VALUES('$id', '$p_room', '$drCharges', '$p_operation', '$p_consultant', '$dop')");

    //     $queryDoctorChargesSurgery = mysqli_query($connect, "INSERT INTO anesthetic_surgery_charges(pat_id, room_id, surgery_anes_charges, pat_operation, pat_consultant, date_of_payment)VALUES('$id', '$p_room', '$anestheticCharges', '$p_operation', '$p_consultant', '$dop')");
    // }

    $queryAdvice = mysqli_query($connect, "SELECT doctor_advice FROM `postpone_patient` WHERE id= '$id'");
    $fetch_queryAdvice = mysqli_fetch_assoc($queryAdvice);

    $advice = $fetch_queryAdvice['doctor_advice'];

    $explodeAdvice = explode(",", $advice);

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<style type="text/css">
    body {
        color: black !important;
    }

    .custom {
        font-size: 13px;
    }

</style>
<div class="page-content-wrapper " style="font-size: 80%">
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline" >Patient Discharge Slip (Postpone)</h5>
                <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <!-- end row -->
        <div class="row" id="printElement">
            <div class="col-12">
                <div class="card m-b-30" >
                    <div class="card-body" >




                        <form method="POST">
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center" style="font-size: 130%">SHAH MEDICAL CENTER</h3>
                                        <h4 class="text-center font-16" style="font-size: 110%">Saidu Road, Opposite to Central Hospital, Saidu Sharif, Swat.</h4>
                                        
                                        <h4 class="float-right font-16" style="font-size: 90%"><strong>M.R No # <?php echo $fetch_selectPatient['patient_yearly_no'] ?></strong></h4>
                                        <h4 class="float-left font-16" style="font-size: 90%"><strong>* 
                                            <?php
                                                if ($fetch_selectPatient['pat_category'] === '1') {
                                                    echo "<i>Ellective</i>";
                                                }elseif ($fetch_selectPatient['pat_category'] === '2') {
                                                    echo "<i>Emergency</i>";
                                                    
                                                }
                                            ?>
                                        </strong></h4>
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
                                            <b>Patient Case: </b><?php echo $fetch_selectPatient['patient_disease'] ?><br>
                                            <b>Date Of Admission: </b>
                                            <?php
                                            
                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                            $date = date('m/d/Y h:i:s a', time());


                                            $dateAdmisison = $fetch_selectPatient['patient_doa']; 
                                            echo $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));
                                            
                                            // echo $fetch_selectPatient['patient_doa'] 

                                            ?>
                                            <br>
                                            <b>Postpone Date: </b><?php echo $dishcargeTime = date('d/M/Y h:i:s A') ?><br>
                                            <b>Advance Payment: </b><?php echo "Rs. ".$fetch_selectPatient['advance_payment']  ?><br>
                                            
                                            <?php
                                                if (empty($fetch_selectPatient['visit_id'])) {
                                                    
                                                }else {
                                                    
                                                    echo "<b>Visit ID: </b>".$fetch_selectPatient['visit_id'];

                                                }
                                            ?>
                                            <br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-30">
                                        <address>
                                            <strong>Doctor Advice:</strong><br>
                                        </address>
                                            <?php 

                                        echo '<textarea style="border: none; background-color: #ffffff !important; color: black !important" readonly="" class="form-control" name="doctorAdvice" rows="12" required="" style="font-size: 90%">';
                                            // echo "<br>";
                                            for ($i=0; $i < sizeof($explodeAdvice) ; $i++) { 
                                                echo $explodeAdvice[$i];
                                            }

                                        echo '</textarea>';
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $queryDischargesId = mysqli_query($connect, "SELECT pat_id FROM `postpone_patient` WHERE id = '$id'");
                            $fetch_queryDischargesId = mysqli_fetch_assoc($queryDischargesId);
                            $dischargeID = $fetch_queryDischargesId['pat_id'];
                        ?>
                      
                        <!-- <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20" style="font-size: 120%"><strong>Pharmacy Medicine Details: </strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td><strong>S.No.</strong></td>
                                                        <td><strong>Category - Medicine Name</strong></td>
                                                        <td><strong>Quantity</strong></td>
                                                        <td><strong>Date</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $itrMed = 1;
                                                    $retMe0dicinesQuery = mysqli_query($connect, "SELECT add_medicines.*, medicine_category.*, medicine_order.* FROM add_medicines
                                                        INNER JOIN medicine_order ON medicine_order.med_id = add_medicines.id
                                                        INNER JOIN medicine_category ON medicine_category.id = add_medicines.medicine_category
                                                        WHERE medicine_order.patient_id = '$dischargeID'");

                                                    while ($rowMedicinesQuery = mysqli_fetch_assoc($retMedicinesQuery)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrMed++.'</td>
                                                            <td>'.$rowMedicinesQuery['category_name'].' - '.$rowMedicinesQuery['medicine_name'].'</td>
                                                            <td>'.$rowMedicinesQuery['med_qty'].'</td>';

                                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                                            $MedDate_format = $rowMedicinesQuery['order_date']; 
                                                            $MedDate = date('d/M h:i:s A', strtotime($MedDate_format));
                                                            echo '
                                                            <td>'.$MedDate.'</td>
                                                        </tr>
                                                        ';
                                                    }

                                                    $queryTotal = mysqli_query($connect, "SELECT SUM(medicines_total) AS medTotal FROM `pharmacy_amount` WHERE patient_id = '$dischargeID'");
                                                    $fetch_queryTotal = mysqli_fetch_assoc($queryTotal);
                                                    echo '
                                                        <td></td>
                                                        <td align="right"><strong>Total</strong></td>
                                                        <td><strong>Rs. '.$fetch_queryTotal['medTotal'].'</strong></td>
                                                        <td></td>

                                                    ';
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> 
                            </div> 


                            <div class="col-6">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20" style="font-size: 120%"><strong>Laboratory Test Details: </strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td><strong>S.No.</strong></td>
                                                        <td><strong>Test</strong></td>
                                                        <td><strong>Price</strong></td>
                                                        <td><strong>Date</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $itrLab = 1;
                                                    $retLabTestQuery = mysqli_query($connect, "SELECT lab_order.*, lab_test_category.* FROM `lab_order` 
                                                        INNER JOIN lab_test_category ON lab_test_category.id = lab_order.lab_test_id
                                                        WHERE lab_order.pat_id = '$dischargeID'");

                                                    while ($rowLabTestQuery = mysqli_fetch_assoc($retLabTestQuery)) {
                                                        echo '
                                                        <tr>
                                                            <td>'.$itrLab++.'</td>
                                                            <td>'.$rowLabTestQuery['test_name'].'</td>
                                                            <td>'.$rowLabTestQuery['test_price'].'</td>';
                                                            
                                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                                            $LabDate_format = $rowLabTestQuery['auto_date']; 
                                                            $LabDate = date('d/M h:i:s A', strtotime($LabDate_format));
                                                            echo '
                                                            <td>'.$LabDate.'</td>
                                                        </tr>
                                                        ';
                                                    }

                                                     $queryTotalLab = mysqli_query($connect, "SELECT SUM(total_price) AS totalPrice FROM `lab_test_report` WHERE pat_id = '$dischargeID'");
                                                        $fetch_queryTotalLab = mysqli_fetch_assoc($queryTotalLab);
                                                        echo '
                                                            <td></td>
                                                            <td align="right"><strong>Total</strong></td>
                                                            <td><strong>Rs. '.$fetch_queryTotalLab['totalPrice'].'</strong></td>
                                                            <td></td>';
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div> -->
                        <hr>
                        <?php
                        $queryDischargePatientAllData = mysqli_query($connect, "SELECT * FROM `discharge_patients_charges` WHERE id = '$id' AND pat_id = '$dischargeID'");
                        $fetch_queryDischargePatientAllData = mysqli_fetch_assoc($queryDischargePatientAllData);
                        
                        ?>
                        <!-- <form method="POST"> -->

                          
                            
                           
                           
                            <?php
                            // $doctorCharges = mysqli_query($connect, "SELECT patient_registration.*, staff_members.salary, staff_members.visit_charges FROM `patient_registration` 
                            //     INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                            //     WHERE patient_registration.id = '$id'");
                            // $fetch_doctorCharges = mysqli_fetch_assoc($doctorCharges);
                            ?>
                            
                            <?php
                            // $anestheticCharges = mysqli_query($connect, "SELECT patient_registration.*, staff_members.salary, staff_members.visit_charges FROM `patient_registration` 
                            //     INNER JOIN staff_members ON staff_members.id = patient_registration.anasthetic_name
                            //     WHERE patient_registration.id = '$id'");
                            // $fetch_anestheticCharges = mysqli_fetch_assoc($anestheticCharges);
                            ?>
                                                        <?php
                            // $queryVisitCharges = mysqli_query($connect, "SELECT SUM(visit_charges) AS sumVisitCharges, visit_charges, COUNT(*) AS countedVisit FROM `doctor_visit_charges` WHERE pat_id = '$id' AND visit_status = '1'");
                            // $fetch_queryVisitCharges = mysqli_fetch_assoc($queryVisitCharges);
                            ?>
                            
                           
                            <!-- <div class="col-3 col-md-offset-1" align="center" style="margin-top: 2%; "> -->
                                
                                <!-- <input type="text" name="stitchesDays" required="" placeholder="براہ کرم خالی جگہ کو بھریں" class="form-control" style="border: none; border-bottom: 1px solid black"> -->
                            <!-- </div> -->
                            <!-- <input type="hidden" name="pat_id" value="<?php echo $fetch_selectPatient['id'] ?>">
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
                            <input type="hidden" name="p_anes_charges" value="<?php echo $fetch_selectPatient['anesthesia_charges'] ?>"> -->

                        <!-- </form> -->
                            <!-- <div class="d-print-none mo-mt-2">
                                <div class="float-right">
                                    <button class="btn btn-primary waves-effect waves-light btn-lg" type="submit" name="makeSlip">Prepare Discharge Slip</button>
                                </div>
                            </div> -->   




                            <div class="row custom" style="font-family: 'Georgia'">
                                <div class="col-md-8">
                                    <label style="margin-bottom: 0rem !important">This is a computer generated report, therefore signatures are not required. </label><br>
                                    <label>Developed By: <i>Asif Ullah</i></label>
                                    <hr>
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

<script type="text/javascript" src="../assets/print.js"></script>

<script type="text/javascript">

 
    function print() {
    printJS({
    printable: 'printElement',
    type: 'html',
    targetStyles: ['*']
 })
}

document.getElementById('printButton').addEventListener ("click", print)



</script>

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