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

    $queryAdvice = mysqli_query($connect, "SELECT doctor_advice FROM `discharge_patients_charges` WHERE pat_id= '$patCustomId'");
    $fetch_queryAdvice = mysqli_fetch_assoc($queryAdvice);

    $advice = $fetch_queryAdvice['doctor_advice'];

    $explodeAdvice = explode(", ", $advice);

    $retPatDetail = mysqli_query($connect, "SELECT * FROM pat_details WHERE pat_id = '$patIdFooter'");
    $fetch_retPatDetail = mysqli_fetch_assoc($retPatDetail);


    $surgeryId = $fetch_selectPatient['patient_operation'];

    $sur_details = mysqli_query($connect, "SELECT discharge_patients.id, discharge_patients.patient_operation, surgeries.surgery_name FROM `discharge_patients`
        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation

        WHERE discharge_patients.id = '$id'");

    $fetch_surg_details = mysqli_fetch_assoc($sur_details);


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
                                            <h3 align="center" style="font-size: 130%">SHAH MEDICAL CENTER</h3>
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

                                            <h4 class="float-left font-16" style="font-size: 90%"><strong> 
                                                <?php 
                                                if ($fetch_selectPatient['pat_category'] === '1') {
                                                    echo "<i>* Ellective</i>";
                                                }elseif ($fetch_selectPatient['pat_category'] === '2') {
                                                    echo "<i>* Emergency</i>";
                                                }
                                                 ?>
                                            </strong></h4>
                                            <h4 class="float-right font-16" style="font-size: 90%"><strong>M.R No # <?php echo $fetch_selectPatient['patient_yearly_no'] ?></strong></h4>
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
                                                <b>Surgery: </b><?php echo $fetch_surg_details['surgery_name'] ?><br>
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
                                                
                                                <?php 
                                                if ($fetch_selectPatient['visit_id'] === '0' OR empty($fetch_selectPatient['visit_id'])) {

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
                                                
                                                echo '<p>';
                                                    for ($i=0; $i < sizeof($explodeAdvice) ; $i++) { 
                                                        echo $explodeAdvice[$i]."<br>";
                                                    }
                                                echo '</p>';
                                            ?>
                                        </div>
                                    </div>
                                    <!-- <hr> -->

                                    <div class="row">
                                        <div class="col-12 m-t-30">
                                            <address>
                                                <strong>Procedure:</strong><br>
                                            </address>

                                            <?php 
                                                $retPatDetailsData = mysqli_query($connect, "SELECT * FROM pat_details WHERE pat_id = '$patIdFooter'");
                                                $fetch_retPatDetailsData = mysqli_fetch_assoc($retPatDetailsData);
                                                echo '<p>';
                                                    echo $fetch_retPatDetailsData['procedureCounter'];
                                                echo '</p>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <div class="col-md-12" style="margin-top: 2%; margin-bottom: 2%;">
                                    <label>.دن بعد معائنہ کے لیے دوبارہ آئیں</label><span> "<?php echo $fetch_retPatDetailsData['visitAfterDays'] ?></span>"
                                </div>


                                <div class="col-md-12" style="margin-top: 2%; margin-bottom: 2%;">
                                    <label>.دن کے بعد کیتھیٹر نکلوائیں</label><span> "<?php echo $fetch_retPatDetailsData['catheterAfterDays'] ?></span>"
                                </div>  

                                <div class="col-md-12" style="margin-top: 2%; margin-bottom: 2%;">
                                    <label>.دن بعد ٹانکیں نکلوائیں</label><span> "<?php echo $fetch_retPatDetailsData['stitchesDays'] ?></span>"
                                </div>  
                            <hr>

                            <div class="row custom" style="font-family: Georgia">
                                <div class="col-md-8">
                                    <label style="margin-bottom: 0rem !important">This is a computer generated report, therefore signatures are not required. </label><br>
                                    <label>Developed By: <i>Asif Ullah</i></label>
                                    <hr>
                                </div>     
                            </div>
                            </form>
                    <!-- </div> -->
                <!-- </div>  -->
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