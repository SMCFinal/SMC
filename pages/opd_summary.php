<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    


    $selectPatient = mysqli_query($connect, "SELECT opd_charges.*, opd_ptcl.* FROM `opd_charges`
    INNER JOIN opd_ptcl ON opd_ptcl.o_id = opd_charges.pat_id
    WHERE opd_charges.charges_status = '0' AND opd_charges.ref_no = '0'");
    

    if (isset($_POST['make_summary'])) {
        $maxQuery = mysqli_query($connect, "SELECT MAX(ref_no) AS MAXRef FROM `opd_charges`");
        $fetch_maxQuery = mysqli_fetch_assoc($maxQuery);

        // Reference Number
        $refNo = $fetch_maxQuery['MAXRef'] + 1;
        $charges_arr = $_POST['charges_arr'];

        for ($i=0; $i < sizeof($charges_arr) ; $i++) { 
            $charges_id = $charges_arr[$i];

            $updateChargesTable = mysqli_query($connect, "UPDATE opd_charges SET ref_no = '$refNo', charges_status = '1' WHERE opd_charges = '$charges_id'");
        }

        if ($updateChargesTable) {
            header("LOCATION: opd_summary_list.php");
        }
        
    }


    include '../_partials/header.php';

?>
<style type="text/css">
    /* body {
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
    } */


    /* th { */
        /* transform: rotate(300deg); */
        /* font-size: 80% !important; */
        /* transform-origin: 100% 150%; */
    /* } */

    /* .payment { */
        /* transform: rotate(300deg); */
        /* transform-origin: 0% 50%; */
    /* } */

    .customRollOPD {
        overflow-x: scroll !important
    }
</style>
<div class="page-content-wrapper " >
    <form method="POST">
        <div class="container-fluid"><br>
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="page-title d-inline">Make PTCL OPD Patients Summary</h5>
                    <!-- <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a> -->
                    <?php
                    $checkRow = mysqli_num_rows($selectPatient);
                    if ($checkRow > '0') {
                        echo '
                            <button type="submit" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3" name="make_summary">Make Summary!</button>
                        ';
                    }
                    ?>
                </div>
            </div>
            <br>
            <!-- end row -->
            <!-- <div class="row noPrint" id="printElement"> -->
            <div class="row noPrint" id="printElement">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12 customRollOPD">
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <?php
                                    $sumQuery = mysqli_query($connect, "SELECT 
                                        SUM(room_charges) AS Room,
                                        SUM(operation_charges) AS Surg,
                                        SUM(anesthesia_charges) AS ANA,
                                        SUM(ot_charges) AS OT,
                                        SUM(ota_charges) AS OTA,
                                        SUM(delivery_charges) AS Delivery,
                                        SUM(xray_charges) AS XRay,
                                        SUM(lab_charges) AS Lab,
                                        SUM(ultrasound_charges) AS US,
                                        SUM(otherinvestigation_charges) AS INV,
                                        SUM(consultant_charges) AS Cons,
                                        SUM(consultantvisit_charges) AS Viss,
                                        SUM(bloodtransfusions_charges) AS BT,
                                        SUM(medicines_charges) AS Med,
                                        SUM(mo_charges) AS MO,
                                        SUM(nursing_charges) AS Nurs,
                                        SUM(isochlorane_charges) AS ISLF,
                                        SUM(ctscan_charges) AS CT,
                                        SUM(mri_charges) AS MRI,
                                        SUM(otherone_charges) AS OtherOne,
                                        SUM(othertwo_charges) AS OtherTwo,
                                        SUM(otherthree_charges) AS OtherThree,
                                        SUM(otherfour_charges) AS OtherFour
                                        FROM `opd_charges`
                                        WHERE opd_charges.charges_status = '0' AND opd_charges.ref_no = '0'
                                    ");

                                    $fetch_sumQuery = mysqli_fetch_assoc($sumQuery);

                                    echo '
                                        <th>Bill</th>
                                        <th>Date</th>
                                        <th>P.Name</th>
                                        <th>E.Name</th>
                                        <th>Doctor</th>
                                    ';
                                    if ($fetch_sumQuery['Room'] != '0') {
                                        echo '<th>Room</th>';
                                    }

                                    if ($fetch_sumQuery['Surg'] != '0') {
                                        echo '<th>Surg</th>';
                                    }

                                    if ($fetch_sumQuery['ANA'] != '0') {
                                        echo '<th>ANA</th>';
                                    }

                                    if ($fetch_sumQuery['OT'] != '0') {
                                        echo '<th>OT</th>';
                                    }

                                    if ($fetch_sumQuery['OTA'] != '0') {
                                        echo '<th>OTA</th>';
                                    }

                                    if ($fetch_sumQuery['Delivery'] != '0') {
                                        echo '<th>Delivery</th>';
                                    }

                                    if ($fetch_sumQuery['XRay'] != '0') {
                                        echo '<th>XRay</th>';
                                    }

                                    if ($fetch_sumQuery['Lab'] != '0') {
                                        echo '<th>Lab</th>';
                                    }

                                    if ($fetch_sumQuery['US'] != '0') {
                                        echo '<th>U/S</th>';
                                    }

                                    if ($fetch_sumQuery['INV'] != '0') {
                                        echo '<th>Oth.INV</th>';
                                    }

                                    if ($fetch_sumQuery['Cons'] != '0') {
                                        echo '<th>Cons</th>';
                                    }

                                    if ($fetch_sumQuery['Viss'] != '0') {
                                        echo '<th>Viss</th>';
                                    }

                                    if ($fetch_sumQuery['BT'] != '0') {
                                        echo '<th>BT</th>';
                                    }

                                    if ($fetch_sumQuery['Med'] != '0') {
                                        echo '<th>Med</th>';
                                    }

                                    if ($fetch_sumQuery['MO'] != '0') {
                                        echo '<th>MO</th>';
                                    }

                                    if ($fetch_sumQuery['Nurs'] != '0') {
                                        echo '<th>Nurs</th>';
                                    }

                                    if ($fetch_sumQuery['ISLF'] != '0') {
                                        echo '<th>ISLF</th>';
                                    }

                                    if ($fetch_sumQuery['CT'] != '0') {
                                        echo '<th>CT</th>';
                                    }

                                    if ($fetch_sumQuery['MRI'] != '0') {
                                        echo '<th>MRI</th>';
                                    }

                                    if ($fetch_sumQuery['OtherOne'] != '0') {
                                        echo '<th>Oth.1</th>';
                                    }

                                    if ($fetch_sumQuery['OtherTwo'] != '0') {
                                        echo '<th>Oth.2</th>';
                                    }

                                    if ($fetch_sumQuery['OtherThree'] != '0') {
                                        echo '<th>Oth.3</th>';
                                    }

                                    if ($fetch_sumQuery['OtherFour'] != '0') {
                                        echo '<th>Oth.4</th>';
                                    }

                                    echo '
                                        <th>Total</th>
                                    ';
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                    $itr = 1;

                                    while ($row = mysqli_fetch_assoc($selectPatient)) {
                                        echo '
                                        <input type="hidden" value='.$row['opd_charges'].' name="charges_arr[]">
                                        <tr>
                                            <td>'.$row['bill_no'].'</td>
                                            <td>'.$row['emp_date'].'</td>
                                            <td>'.$row['emp_pat_name'].'</td>
                                            <td>'.$row['emp_name'].'</td>
                                            <td>'.$row['emp_doctor'].'</td>';

                                            if ($fetch_sumQuery['Room'] != '0') {
                                                if ($row['room_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['room_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';

                                                }
                                            }
                                            if ($fetch_sumQuery['Surg'] != '0') {
                                                if ($row['operation_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['operation_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';

                                                }
                                            }

                                            if ($fetch_sumQuery['ANA'] != '0') {
                                                if ($row['anesthesia_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['anesthesia_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';

                                                }
                                            }

                                            if ($fetch_sumQuery['OT'] != '0') {
                                                if ($row['ot_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['ot_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }
                                            
                                            if ($fetch_sumQuery['OTA'] != '0') {
                                                if ($row['ota_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['ota_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Delivery'] != '0') {
                                                if ($row['delivery_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['delivery_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['XRay'] != '0') {
                                                if ($row['xray_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['xray_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Lab'] != '0') {
                                                if ($row['lab_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['lab_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['US'] != '0') {
                                                if ($row['ultrasound_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['ultrasound_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['INV'] != '0') {
                                                if ($row['otherinvestigation_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['otherinvestigation_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Cons'] != '0') {
                                                if ($row['consultant_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['consultant_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Viss'] != '0') {
                                                if ($row['consultantvisit_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['consultantvisit_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['BT'] != '0') {
                                                if ($row['bloodtransfusions_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['bloodtransfusions_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Med'] != '0') {
                                                if ($row['medicines_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['medicines_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['MO'] != '0') {
                                                if ($row['mo_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['mo_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['Nurs'] != '0') {
                                                if ($row['nursing_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['nursing_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['ISLF'] != '0') {
                                                if ($row['isochlorane_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['isochlorane_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }
                                            
                                            if ($fetch_sumQuery['CT'] != '0') {
                                                if ($row['ctscan_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['ctscan_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['MRI'] != '0') {
                                                if ($row['mri_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['mri_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['OtherOne'] != '0') {
                                                if ($row['otherone_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['otherone_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['OtherTwo'] != '0') {
                                                if ($row['othertwo_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['othertwo_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['OtherThree'] != '0') {
                                                if ($row['otherthree_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['otherthree_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            if ($fetch_sumQuery['OtherFour'] != '0') {
                                                if ($row['otherfour_charges'] != '0') {
                                                    echo '<td class="payment">'.$row['otherfour_charges'].'</td>';
                                                }else {
                                                    echo '<td class="payment">0</td>';
                                                }
                                            }

                                            $totalAmount =  $row['room_charges'] + 
                                                            $row['operation_charges'] + 
                                                            $row['anesthesia_charges'] + 
                                                            $row['ot_charges'] + 
                                                            $row['ota_charges'] + 
                                                            $row['delivery_charges'] + 
                                                            $row['xray_charges'] + 
                                                            $row['lab_charges'] + 
                                                            $row['ultrasound_charges'] + 
                                                            $row['otherinvestigation_charges'] + 
                                                            $row['consultant_charges'] + 
                                                            $row['consultantvisit_charges'] + 
                                                            $row['bloodtransfusions_charges'] + 
                                                            $row['medicines_charges'] + 
                                                            $row['mo_charges'] + 
                                                            $row['nursing_charges'] + 
                                                            $row['isochlorane_charges'] + 
                                                            $row['ctscan_charges'] + 
                                                            $row['mri_charges'] + 
                                                            $row['otherone_charges'] + 
                                                            $row['othertwo_charges'] + 
                                                            $row['otherthree_charges'] + 
                                                            $row['otherfour_charges'];

                                            echo '<td class="payment">'.$totalAmount.'</td>';
                                        
                                        echo '
                                        </tr>
                                        ';
                                    }

                                    
                                ?>


                            </tbody>

                        </table>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div> <!-- Page content Wrapper -->
    </form>
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