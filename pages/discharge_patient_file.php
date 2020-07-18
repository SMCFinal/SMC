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



include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Lab Tests</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL AND SERGICAL CENTER</h3>
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
                                            <b>Date Of Discharge: </b><?php echo $dishcargeTime = date('d/M/Y h:i:s A') ?><br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-30">
                                        <address>
                                            <strong>Doctor Advice:</strong><br>
                                        </address>
                                        <textarea class="form-control" name="doctorAdvice" rows="10" required=""></textarea>
                                    </div>
                                    <!-- <div align="right">    -->

                                        <div class="col-md-2" style="margin-top: 2%">
                                            <label>دن بعد ٹانکیں کھولنے کیلئے تشریف لائی</label>
                                        </div>
                                        <div class="col-2" align="right" style="margin-top: 2%; ">
                                            <input type="text" name="stitchesDays" class="form-control" style="border: none; border-bottom: 1px solid black">
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="panel-title font-20"><strong><u>Patient History</u></strong></h3>
                        <div class="row">
                            <div class="col-4" style="border-right: 1px solid #ccc;">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%">Blood Pressure</span>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>BP Low</strong></td>
                                                        <td class="text-center"><strong>BP High</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryBP = mysqli_query($connect, "SELECT * FROM `pat_observation_bp` WHERE pat_id = '$id'");
                                                    while ($rowBP = mysqli_fetch_assoc($queryBP)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowBP['bp_low'].'</td>
                                                            <td align="center">'.$rowBP['bp_high'].'</td>';
                                                            $BPDate_format = $rowBP['manual_date']; 
                                                            $BPDate = date('d/M h:i:s A', strtotime($BPDate_format));
                                                            echo '
                                                            <td align="right">'.$BPDate.'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <hr style="color: black">
                            </div>


                            <div class="col-4" style="border-right: 1px solid #ccc ">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <!-- <br><br> -->
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%;">Drain</span>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Drain</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryDrain = mysqli_query($connect, "SELECT * FROM `pat_observation_drain` WHERE pat_id = '$id'");
                                                    while ($rowDrain = mysqli_fetch_assoc($queryDrain)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowDrain['drain_measurement'].'</td>';
                                                            $DrainDate_format = $rowDrain['manual_date']; 
                                                            $DrainDate = date('d/M h:i:s A', strtotime($DrainDate_format));
                                                            echo '
                                                            <td align="right">'.$DrainDate.'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr style="color: black">
                            </div>

                            <div class="col-4">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <!-- <br><br> -->
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%;">N/G</span>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>N/G</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryNG = mysqli_query($connect, "SELECT * FROM `pat_observation_ng` WHERE pat_id = '$id'");
                                                    while ($rowNG = mysqli_fetch_assoc($queryNG)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowNG['ng_measurement'].'</td>';
                                                            $NGDate_format = $rowNG['manual_date']; 
                                                            $NGDate = date('d/M h:i:s A', strtotime($NGDate_format));
                                                            echo '
                                                            <td align="right">'.$NGDate.'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr style="color: black">
                            </div>

                            <div class="col-4" style="border-right: 1px solid #ccc ">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <br><br>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%;">Pulse</span>
                                            <table class="table" style="    margin-top: 1.5%;">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Pulse</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryPulse = mysqli_query($connect, "SELECT * FROM `pat_observation_pulse` WHERE pat_id = '$id'");
                                                    while ($rowPulse = mysqli_fetch_assoc($queryPulse)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowPulse['pulse_rate'].'</td>';
                                                            $PulseDate_format = $rowPulse['manual_date']; 
                                                            $PulseDate = date('d/M h:i:s A', strtotime($PulseDate_format));
                                                            echo '
                                                            <td align="right">'.$PulseDate.'</td>
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


                            <div class="col-4" style="border-right: 1px solid #ccc ">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <br><br>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%;">Respiratory</span>
                                            <table class="table" style="    margin-top: 1.5%;">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Respiratory</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryRespiratory = mysqli_query($connect, "SELECT * FROM `pat_observation_respiratory` WHERE pat_id = '$id'");
                                                    while ($rowRespiratory = mysqli_fetch_assoc($queryRespiratory)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowRespiratory['respiratory_measurement'].'</td>';
                                                            $RespiratoryDate_format = $rowRespiratory['manual_date']; 
                                                            $RespiratoryDate = date('d/M h:i:s A', strtotime($RespiratoryDate_format));
                                                            echo '
                                                            <td align="right">'.$RespiratoryDate.'</td>
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


                            <div class="col-4">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <br><br>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <span style="font-weight: bold; font-size: 100%;">Urine</span>
                                            <table class="table" style="    margin-top: 1.5%;">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Urine</strong></td>
                                                        <td class="text-center"><strong>Date</strong>
                                                        </td>
                                                    </tr> 
                                                </thead> 
                                                <tbody>
                                                    <?php
                                                    $queryUrine = mysqli_query($connect, "SELECT * FROM `pat_observation_urine` WHERE pat_id = '$id'");
                                                    while ($rowUrine = mysqli_fetch_assoc($queryUrine)) {
                                                        echo '
                                                        <tr>
                                                            <td align="center">'.$rowUrine['urine_measurement'].'</td>';
                                                            $UrineDate_format = $rowUrine['manual_date']; 
                                                            $UrineDate = date('d/M h:i:s A', strtotime($UrineDate_format));
                                                            echo '
                                                            <td align="right">'.$UrineDate.'</td>
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
                        </div> <!-- end row -->
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20"><strong>Pharmacy Medicine Details: </strong></h3>
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
                                                    $retMedicinesQuery = mysqli_query($connect, "SELECT add_medicines.*, medicine_category.*, medicine_order.* FROM add_medicines
                                                        INNER JOIN medicine_order ON medicine_order.med_id = add_medicines.id
                                                        INNER JOIN medicine_category ON medicine_category.id = add_medicines.medicine_category
                                                        WHERE medicine_order.patient_id = '$id'");

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

                                                    $queryTotal = mysqli_query($connect, "SELECT SUM(medicines_total) AS medTotal FROM `pharmacy_amount` WHERE patient_id = '$id'");
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
                                        <h3 class="panel-title font-20"><strong>Laboratory Test Details: </strong></h3>
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
                                                        WHERE lab_order.pat_id = '$id'");

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

                                                     $queryTotalLab = mysqli_query($connect, "SELECT SUM(total_price) AS totalPrice FROM `lab_test_report` WHERE pat_id = '10'");
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
                            $roomInvoicePrice = $roomEmbedPrice * $room;
                        }

                        ?>
                        <form method="POST">
                            <div class="row">
                                <div class="col text-right">
                                    <label> Medicines Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryTotal['medTotal'] ?>" readonly id="actMedChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Medicines Price">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="<?php echo $fetch_queryTotal['medTotal'] ?>" class="form-control" id="totMedChar" required="" onkeyUp="totCharges()" placeholder="Medicines Price">
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
                                    <input type="number" value="<?php echo $roomInvoicePrice ?>" id="totRoomChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Room Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> OT Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="200" id="actOtChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="OT Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="200" id="totOtChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="OT Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Hospital Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="2" id="actHosChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Hospital Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="" id="totHosChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Hospital Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Lab Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_queryTotalLab['totalPrice'] ?>" id="actLabChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Lab Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="<?php echo $fetch_queryTotalLab['totalPrice'] ?>" id="totLabChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Lab Charges">
                                </div>
                            </div>
                            <br />
                            <?php
                            $doctorCharges = mysqli_query($connect, "SELECT patient_registration.*, staff_members.salary, staff_members.visit_charges FROM `patient_registration` 
                                INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                WHERE patient_registration.id = '$id'");
                            $fetch_doctorCharges = mysqli_fetch_assoc($doctorCharges);
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <label> Doctor Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="<?php echo $fetch_doctorCharges['salary'] ?>" id="actDrChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Doctor Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="<?php echo $fetch_doctorCharges['salary'] ?>" id="TotDrChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Doctor Charges">
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
                                    <input type="number" value="<?php echo $fetch_anestheticCharges['salary'] ?>" id="actAnesChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Anesthesia Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="<?php echo $fetch_anestheticCharges['salary'] ?>" id="totAnesChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Anesthesia Charges">
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col text-right">
                                    <label> Actual Charges:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="" id="actualCharges" readonly class="form-control" placeholder="Actual Charges">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="" id="totalCharges" class="form-control" readonly placeholder="Total Charges"> </div>
                            </div>
                            <br />
                        </form>
        <div class="d-print-none mo-mt-2">
            <div class="float-right">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
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