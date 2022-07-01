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

    $sur_details = mysqli_query($connect, "SELECT patient_registration.id, patient_registration.patient_operation, patient_registration.organization, surgeries.surgery_name FROM `patient_registration`
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
                <h5 class="page-title d-inline">Patient Medication List</h5>
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
                                <th style="font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; border: 1px solid black; width: 50% !important;" scope="col">Name: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_name']; ?></span>
                                </th>
                              
                                <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 50% !important;" scope="col">Address: 
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
                                <th style="font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; border: 1px solid black; width: 50% !important;" scope="col">Gender: 
                                  <span style="font-weight: 100;">
                                    <?php 
                                        if ($fetch_selectPatient['patient_gender'] === '1') {
                                            echo 'Male';
                                        }elseif ($fetch_selectPatient['patient_gender'] === '2') {
                                            echo 'Female';
                                        }elseif ($fetch_selectPatient['patient_gender'] === '3') {
                                            echo 'Other';
                                        }

                                    ?>
                                        
                                    </span>
                                </th>
                              
                                <th style="font-size: 90%; border: 1px solid black; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 50% !important;" scope="col">Age: 
                                  <span style="font-weight: 100;"><?php echo $fetch_selectPatient['patient_age']; ?></span>
                                </th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>

                <br>

                <div class="row" style="margin-bottom: -15px !important; margin-top: -15px !important;">
                    <div class="col-md-12">
                        <h3 align="center" style="font-size: 100%">PATIENT MEDICATION LIST (<?php echo $fetch_surg_details['surgery_name'] ?>)</h3>
                    </div>
                </div>
                
                <div class="row" style="border-bottom: 1px solid black; margin-bottom: 25px !important">
                    <div class="col-md-12">
                        <h3 align="center" style="font-size: 120%">(
                        <?php
                            if($fetch_surg_details['organization'] === 'Sehat') {
                                echo 'Sehat Card';
                            }else {
                                echo $fetch_surg_details['organization'];
                            }
                        ?>
                        )</h3>
                    </div>
                </div>
                


                <?php
                    $checkQuery = mysqli_query($connect, "SELECT COUNT(*) AS medsCount FROM `surgery_medicines` WHERE surgery_id = '$surgeryId'");
                    $fetch_checkQuery = mysqli_fetch_assoc($checkQuery);

                    if ($fetch_checkQuery['medsCount'] < 17) {
                ?>

                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-12">
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" scope="col"  class="text-center">S#
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 70% !important;" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Medicine Name
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 24% !important;" class="text-center" scope="col">Quantity
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php

                                $itr = 1;

                                $medicineQuery = mysqli_query($connect, "SELECT surgery_medicines.*, surgeries.surgery_name, medicine_category.category_name, add_medicines.medicine_name FROM surgery_medicines
                                                                        INNER JOIN surgeries ON surgeries.id = surgery_medicines.surgery_id
                                                                        INNER JOIN medicine_category ON medicine_category.id = surgery_medicines.cat_id
                                                                        INNER JOIN add_medicines ON add_medicines.id = surgery_medicines.med_id
                                                                        WHERE surgery_medicines.surgery_id =  '$surgeryId'
                                                                        ORDER BY add_medicines.medicine_name ASC");

                                while ($row = mysqli_fetch_assoc($medicineQuery)) {
                                    echo '
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">'.$itr++.'. </td>
                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['category_name'].'. '.$row['medicine_name'].'</td>

                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">'.$row['med_qty'].'</td>
                                    </tr>
                                    ';
                                }
                              ?>
                          </tbody>
                        </table>
                    </div>
                </div>

                <?php
                    }else {


                ?>



                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-6">
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" scope="col">S#
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 70% !important;" scope="col">Medicine Name
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 24% !important;" class="text-center" scope="col">Quantity
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php

                                $itr = 1;

                                $medicineQuery = mysqli_query($connect, "SELECT surgery_medicines.*, surgeries.surgery_name, medicine_category.category_name, add_medicines.medicine_name FROM surgery_medicines
                                INNER JOIN surgeries ON surgeries.id = surgery_medicines.surgery_id
                                INNER JOIN medicine_category ON medicine_category.id = surgery_medicines.cat_id
                                INNER JOIN add_medicines ON add_medicines.id = surgery_medicines.med_id
                                WHERE surgery_medicines.surgery_id =  '$surgeryId' ORDER BY add_medicines.medicine_name ASC");

                                while ($row = mysqli_fetch_assoc($medicineQuery)) {
                                    if ($itr <= 16) {
                                    echo '
                                    <tr>
                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">'.$itr++.'. </td>
                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">'.$row['category_name'].'. '.$row['medicine_name'].'</td>

                                        <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">'.$row['med_qty'].'</td>
                                    </tr>
                                    ';
                                    }
                                }
                              ?>
                          </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" scope="col">S#
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 70% !important;" scope="col">Medicine Name
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 24% !important;" class="text-center" scope="col">Quantity
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php

                                $iteration = 1;
                                $number = 17;

                                $medicineQuerySecond = mysqli_query($connect, "SELECT surgery_medicines.*, surgeries.surgery_name, medicine_category.category_name, add_medicines.medicine_name FROM surgery_medicines
                                INNER JOIN surgeries ON surgeries.id = surgery_medicines.surgery_id
                                INNER JOIN medicine_category ON medicine_category.id = surgery_medicines.cat_id
                                INNER JOIN add_medicines ON add_medicines.id = surgery_medicines.med_id
                                WHERE surgery_medicines.surgery_id =  '$surgeryId' ORDER BY add_medicines.medicine_name ASC");

                                while ($rowMeds = mysqli_fetch_assoc($medicineQuerySecond)) {
                                    if ($iteration <= 16) {
                                    // Nothing to show!
                                    }else {
                                        echo '
                                        <tr>
                                            <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">'.$number++.'. </td>
                                            
                                            <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">'.$rowMeds['category_name'].'. '.$rowMeds['medicine_name'].'</td>

                                            <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">'.$rowMeds['med_qty'].'</td>
                                        </tr>
                                        ';
                                    }
                                    $iteration++;
                                    
                                }
                              ?>
                          </tbody>
                        </table>
                    </div>
                </div>





                <?php } ?>

                


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