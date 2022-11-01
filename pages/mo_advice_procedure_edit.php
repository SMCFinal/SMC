<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];
    $doctor = $_GET['doctor'];

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


    $selectProcedureData = mysqli_query($connect, "SELECT * FROM doctor_prescription WHERE doctor_id = '$doctor' && pat_id = '$id'");
    $fetch_selectProcedureData = mysqli_fetch_assoc($selectProcedureData);


    if (isset($_POST['makeSlip'])) {
        $pat_id = $_POST['pat_id'];
        $doctor_id = $_POST['doctor_id'];
        $doctorAdvice = $_POST['doctorAdvice'];
        $procedureCounter = $_POST['procedureCounter'];
        $stitchesDays = $_POST['stitchesDays'];
        $visitAfterDays = $_POST['visitAfterDays'];
        $catheterAfterDays = $_POST['catheterAfterDays'];

        $updateQuery =  mysqli_query($connect, "UPDATE `doctor_prescription` 
        SET 
        `doctor_advice`='$doctorAdvice',
        `pat_procedure`='$procedureCounter',
        `stiches`='$stitchesDays',
        `visit`='$visitAfterDays',
        `cathetor`='$catheterAfterDays'
        WHERE pat_id = '$pat_id' AND doctor_id = '$doctor_id'");


        if ($updateQuery) {
            header("LOCATION: mo_patient_list.php");
        }
    }


include '../_partials/header.php';
?>
<!-- Top Bar End -->

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Doctor Advice + Procedure</h5>
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
                                        <h4 class="text-center font-16">Address: Near Central Hospital, Saidu Sharif Swat.</h4>
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
                                            <b>Patient Age: </b><?php echo $fetch_selectPatient['patient_age'] ?><br>
                                            <!-- <b>Patient CNIC: </b><?php echo $fetch_selectPatient['patient_cnic'] ?><br> -->
                                            <b>Patient Gender: </b><?php if ($fetch_selectPatient['patient_gender'] == 1 ) {
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
                                            <br>
                                            <b>Consultant: </b><?php echo $fetch_selectPatient['name'] ?><br>
                                            <b>Room No. : </b><?php echo $fetch_selectPatient['room_number'] ?><br>
                                            <b>Surgery: </b><?php echo $fetch_surg_details['surgery_name'] ?><br>
                                            <?php
                                            
                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                            $date = date('m/d/Y h:i:s a', time());


                                            $dateAdmisison = $fetch_selectPatient['patient_doa']; 
                                            $newAdmisison = date('d/M/Y h:i:s A', strtotime($dateAdmisison));

                                            ?>
                                            <br>
                                            <!-- <b>Date Of Discharge: </b><?php echo $dishcargeTime = date('d/M/Y h:i:s A') ?><br> -->
                                        </address>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 m-t-30">
                                        <address>
                                            <strong>Doctor Advice: (Tab1: Example 1 + 0 + 0, Tab2: Example 0 + 0 + 1, Tab3: Example 1 + 0 + 1, Tab4: Example 1 + 1 + 1)</strong><br>
                                        </address>
                                        <textarea class="form-control" name="doctorAdvice" rows="5" required=""  placeholder="Tab1: Example 1 + 0 + 0, Tab2: Example 0 + 0 + 1, Tab3: Example 1 + 0 + 1, Tab4: Example 1 + 1 + 1"><?php echo $fetch_selectProcedureData['doctor_advice'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- <form method="POST"> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Procedure</label>
                                    <textarea class="form-control" name="procedureCounter"  rows="5" placeholder="Procedure, Surgery here . . ." required><?php echo $fetch_selectProcedureData['pat_procedure'] ?></textarea>
                                </div>
                            </div>

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
                            <div class="row" align="center">                                
                                <div class="col-md-3" style="margin-top: 2%">
                                    <label style="color: green">.دن بعد ٹانکیں نکلوائیں</label>
                                    <input type="number" name="stitchesDays" required="" placeholder="براہ کرم خالی جگہ کو بھریں" value="<?php echo $fetch_selectProcedureData['stiches'] ?>" class="customText form-control" style="border: none; border-bottom: 1px solid green; color: green !important">
                                </div> 
                                <div class="col-md-1"></div>

                                <div class="col-md-3" style="margin-top: 2%">
                                    <label style="color: green">.دن بعد معائنہ کے لیے دوبارہ آئیں</label>
                                    <input type="number" name="visitAfterDays" required="" placeholder="براہ کرم خالی جگہ کو بھریں" value="<?php echo $fetch_selectProcedureData['visit'] ?>" class="customText form-control" style="border: none; border-bottom: 1px solid green; color: green !important">
                                </div>
                                <div class="col-md-1"></div>


                                <div class="col-md-3" style="margin-top: 2%">
                                    <label style="color: green">. دن کے بعد کیتھیٹر نکلوائیں</label>
                                    <input type="number" name="catheterAfterDays" required="" placeholder="براہ کرم خالی جگہ کو بھریں" value="<?php echo $fetch_selectProcedureData['cathetor'] ?>" class="customText form-control" style="border: none; border-bottom: 1px solid green; color: green !important">
                                </div>   
                            </div>
                            
                            <input type="hidden" name="pat_id" value="<?php echo $id ?>">
                            <input type="hidden" name="doctor_id" value="<?php echo $doctor ?>">
                            <hr>

                            
                           

                        <!-- </form> -->
                            <div class="d-print-none mo-mt-2">
                                <div class="float-right">
                                    <!-- <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a> -->
                                    <button class="btn btn-primary waves-effect waves-light btn-lg" type="submit" name="makeSlip">Update</button>
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

</body>

</html>