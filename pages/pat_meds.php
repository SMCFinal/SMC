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


    include '../_partials/header.php';

?>
<style type="text/css">
    body {
        color: black;
    }

    .custom {
        font-size: 13px;
    }

    .customP {
        margin-bottom: 0 !important;
    }

</style>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">In Patient Medication / Operative Order</h5>
                <a type="button" href="#" id="printButton"   class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
                <!-- <button onclick="window.print();" class="noPrint"> -->
            </div>
        </div>
        <!-- end row -->
        <!-- <div class="row noPrint" id="printElement"> -->
        <div class="row noPrint" id="printElement">
            <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <div class="invoice-title">
                            <h3 class="m-t-0 text-center">
                                <img src="../assets/logo.png" alt="logo" height="60" />
                            </h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="invoice-title">
                            <h3 class="m-t-0 text-center">
                                <h3 align="center" style="font-size: 130%">SHAH MEDICAL CENTER</h3>
                                <p class="text-center font-16" style="font-size: 80%">Saidu Road, Opposite to Central Hospital, Saidu Sharif, Swat.</p>
                                <br>
                            </h3>
                        </div>
                    </div>
                    <?php 
                        $dateOfAdmission = substr($fetch_selectPatient['patient_doa'], 11, 18);
                        $changeTime = $time_in_24_hour_format = date("h:i A", strtotime($dateOfAdmission));
                    ?>
                    <div class="col-3">
                        <div class="invoice-title">
                            <!-- <h3 class="m-t-0 text-center"> -->
                                <p class="text-left font-16 customP" style="font-size: 90%"><span style="font-weight:600">Weight:</span> _____________</p>
                                <p class="text-left font-16 customP" style="font-size: 90%"><span style="font-weight:600">NBM:</span> _______________</p>
                                <p class="text-left font-16 customP" style="font-size: 90%"><span style="font-weight:600">Time:</span> <?php echo $changeTime ?></p>
                                <br>
                            <!-- </h3> -->
                        </div>

                    </div>
                </div>

                <div class="row" style="margin-bottom: -5px !important; margin-top: -25px !important;">
                    <div class="col-md-12">
                        <table class="table table table-bordered">
                          <thead>
                            <tr>
                              <th style="font-size: 90%; border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important;">
                                    M.R No: <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_yearly_no'] ?></span>
                              </th>
                              <th style="font-size: 90%; border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important;">
                                    Consultant: <span style="font-weight: 100;"><?php echo $fetch_selectPatient['name'] ?></span>
                              </th>
                              <th style="font-size: 90%; border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important;">
                                    Room No: <span style="font-weight: 100;"><?php echo $fetch_selectPatient['room_number'] ?></span>
                              </th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>

                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 35% !important; border: 1px solid black;" scope="col">Name: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_name']; ?></span>
                                </th>
                              
                              <th style="font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 10% !important; border: 1px solid black;" scope="col">Age: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_age']; ?></span>
                              </th>
                              
                              <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 13% !important;" scope="col">Sex:
                                <span style="font-weight: 100;">
                                <?php
                                    if($fetch_selectPatient['patient_gender'] === '1'){
                                        echo "Male";
                                    }elseif ($fetch_selectPatient['patient_gender'] === '2') {
                                        echo "Female";
                                    }elseif ($fetch_selectPatient['patient_gender'] === '3') {
                                        echo "Other";
                                    }
                                ?>
                                </span>
                                </th>
                              
                                <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 42% !important;" scope="col">Address: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_address']; ?></span>
                                </th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>


                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 45% !important;" scope="col">Date: 
                                  <span style="font-weight: 100;"><?php echo substr($fetch_selectPatient['patient_doa'], 0,10); ?></span>
                                </th>

                                <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 55% !important;" scope="col">Contact No: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_contact']; ?></span>
                                </th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>

                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-9">
                        <h3 align="center" style="font-size: 100%">IN PATIENT MEDICATION / OPERATIVE ORDER</h3>
                    </div>

                    <div class="col-md-3">
                        <h3 align="center" style="font-size: 100%">INVESTIGATION</h3>
                    </div>
                </div>

                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-9" style="border-right: 1px solid black;">
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" scope="col">S#
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 24% !important;" scope="col">Medicine Name
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 10% !important;" scope="col">Dose
                                </th>

                                <th style="border: 1px solid black; font-size: 80%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 30% !important;" scope="col">Route Of Administration
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 15% !important;" scope="col">Time
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 15% !important;" scope="col">Dr Sign 
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                                $itr = 1;

                                while ($itr <= 20) {
                                    echo '
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">'.$itr++.' </td>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;"></td>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;"></td>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;"></td>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;"></td>
                                        <td style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;"></td>
                                    </tr>
                                    ';
                                }
                              ?>
                          </tbody>
                        </table>
                    </div>

                    <div class="col-md-3">
                        <div style="position: relative;">
                            <span>
                                <span>• Hbs</span><br>
                                <span>• Hcv</span><br>
                                <span>• Hiv</span><br>
                            </span>


                            <!-- <div style="position: absolute; padding-left: 50%; margin-top: 660%;"> -->
                            <div style="position: absolute; padding-left: 15%; margin-top: 250%;">
                                <p align="center" style="font-size: 150%;">
                                    <b><?php echo $fetch_selectPatient['organization'] ?></b>
                                </p>
                                <img src="../assets/triangle-removebg-preview.png" style="" width="100">
                                <h3 align="center" style="font-size: 90%">Diagnosis</h3>
                                <hr style="background-color: black">
                            </div>

                            <!-- <div style="position: absolute; margin-top: 920%;"> -->
                            <div style="position: absolute; margin-top: 375%;">
                                <p style="padding-left: 0 !important; font-size: 110%;">
                                    <img src="../assets/arrow.png" width="40">
                                    <?php echo $fetch_selectPatient['patient_disease'] ?></p>
                            </div>
                        </div>


                        <div style="margin-top: -43%;">
                            <img src="../assets/arrow.png" style="padding-left: 10%;" width="100" >
                        </div>
                    </div>
                </div>

                


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