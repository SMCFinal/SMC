<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $selectPatient = mysqli_query($connect, "SELECT opd_charges.*, opd_ptcl.* FROM `opd_charges`
    INNER JOIN opd_ptcl ON opd_ptcl.o_id = opd_charges.pat_id
    WHERE opd_charges.pat_id = '$id' AND opd_ptcl.o_id = '$id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);


    $getTotal = mysqli_query($connect, "SELECT * FROM opd_charges WHERE pat_id = '$id'");
    while ($a <= 10) {
        # code...
    }
    
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

    td {
        font-size: 90% !important;
        line-height: 1.5 !important
    }

</style>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Patient Medication List</h5>
                <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
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

                    <div class="col-3">
                        <div class="invoice-title">
                            <h3 class="m-t-0 text-right">
                                <p class="text-right font-16" style="font-size: 40%"><b>NO: <u>200</u></b></p>
                                <?php if($fetch_selectPatient['emp_date'] === '0000-00-00') {}else { ?>
                                <p class="text-right font-16" style="font-size: 40%"><b>Date: <u><?php echo $fetch_selectPatient['emp_date'] ?></u></b></p>
                                <?php  } ?>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: -25px !important;">
                <?php

                echo '
                <div class="col-md-4" style="margin-bottom: 2px !important; ">
                    <b>Employee Name: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_name'].'</span>
                </div>
                ';
                
                if(empty($fetch_selectPatient['emp_designation'])) {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>Designation: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_designation'].'</span>
                    </div>
                    ';
                }

                echo '
                <div class="col-md-4" style="margin-bottom: 2px !important; ">
                    <b> Patient Name: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_pat_name'].'</span>
                </div>
                ';

                if(empty($fetch_selectPatient['emp_diagnosis'])) {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>Diagnosis: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_diagnosis'].'</span>
                    </div>
                    ';
                }

                if(empty($fetch_selectPatient['emp_operation'])) {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>Operation: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_operation'].'</span>
                    </div>
                    ';
                }

                if(empty($fetch_selectPatient['emp_relation'])) {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>Relationship (Emp): </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_relation'].'</span>
                    </div>
                    ';
                }

               

                if($fetch_selectPatient['emp_date'] === '0000-00-00') {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>Designation: </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_date'].'</span>
                    </div>
                    ';
                }

                if(empty($fetch_selectPatient['emp_days'])) {

                }else {
                    echo '
                    <div class="col-md-4" style="margin-bottom: 2px !important; ">
                        <b>No of Days (Adm): </b><span style="font-weight: 100;">'.$fetch_selectPatient['emp_days'].'</span>
                    </div>
                    ';
                }




                ?>
                </div>
                
                <br>


                <div class="row" style="margin-bottom: -5px !important;">
                    <div class="col-md-12">
                       <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" scope="col"  class="text-center">S#
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 70% !important;" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Particulars
                                </th>

                                <th style="border: 1px solid black; font-size: 90%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 24% !important;" class="text-center" scope="col">Amount
                                </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                              
                                echo '
                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        1 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Ward / Private Room / VIP Room Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['room_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        2 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Operation Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['operation_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        3 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Anesthesia Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['anesthesia_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        4 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        OT Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['ot_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        5 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        OTA Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['ota_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        6 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Delivery Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['delivery_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        7 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        X-Ray Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['xray_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        8 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Laboratory Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['lab_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        9 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Ultrasound Examination Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['ultrasound_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        10 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Other Investigation Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['otherinvestigation_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        11 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Specialist Consultations (Physician) Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['consultant_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        12 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Specialist Visits Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['consultantvisit_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        13 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Blood Transfusions Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['bloodtransfusions_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        14 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Medicines Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['medicines_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        15 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        MO Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['mo_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        16 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Nursing Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['nursing_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        17 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Isochlorane Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['isochlorane_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        18 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        CT Scan Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['ctscan_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        19 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        MRI Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['mri_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        20 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Other 1 Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['otherone_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        21 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Other 2 Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['othertwo_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        22 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Other 3 Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['otherthree_charges'].'
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        23 .
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Other 4 Charges
                                    </td>
                                    <td style="border: 1px solid black; font-size: 100%; padding-bottom: 5px !important; padding-right: 0 !important; padding-top: 5px !important; width: 6% !important;" class="text-center">
                                        '.$fetch_selectPatient['otherfour_charges'].'
                                    </td>
                                </tr>
                                ';
                              ?>
                          </tbody>
                        </table>
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