<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    


    $selectPatient = mysqli_query($connect, "SELECT opd_charges.*, opd_ptcl.* FROM `opd_charges`
    INNER JOIN opd_ptcl ON opd_ptcl.o_id = opd_charges.pat_id
    WHERE opd_charges.charges_status = '0' AND opd_charges.ref_no = '0'");
    
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


    th {
        transform: rotate(300deg);
        font-size: 80% !important;
        /* transform-origin: 100% 150%; */
    }

    .payment {
        transform: rotate(300deg);
        /* transform-origin: 0% 50%; */
    }

    .customRollOPD {
        overflow-x: scroll !important
    }
</style>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Make PTCL OPD Patients Summary</h5>
                <!-- <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a> -->
                <button type="submit" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3" name="make_summary">Make Summary!</button>
            </div>
        </div>
        <br>
        <!-- end row -->
        <!-- <div class="row noPrint" id="printElement"> -->
        <div class="row noPrint" id="printElement">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12 customRollOPD">
                       <table class="table table-bordered">
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
                                    <th class="text-right">#</th>
                                    <th class="text-right">Bill</th>
                                    <th class="text-right">Date</th>
                                    <th class="text-right">Pat Name</th>
                                    <th class="text-right">Emp Name</th>
                                    <th class="text-right">Doctor</th>
                                ';
                                if ($fetch_sumQuery['Room'] != '0') {
                                    echo '<th class="text-right">Room</th>';
                                }

                                if ($fetch_sumQuery['Surg'] != '0') {
                                    echo '<th class="text-right">Surg</th>';
                                }

                                if ($fetch_sumQuery['ANA'] != '0') {
                                    echo '<th class="text-right">ANA</th>';
                                }

                                if ($fetch_sumQuery['OT'] != '0') {
                                    echo '<th class="text-right">OT</th>';
                                }

                                if ($fetch_sumQuery['OTA'] != '0') {
                                    echo '<th class="text-right">OTA</th>';
                                }

                                if ($fetch_sumQuery['Delivery'] != '0') {
                                    echo '<th class="text-right">Delivery</th>';
                                }

                                if ($fetch_sumQuery['XRay'] != '0') {
                                    echo '<th class="text-right">XRay</th>';
                                }

                                if ($fetch_sumQuery['Lab'] != '0') {
                                    echo '<th class="text-right">Lab</th>';
                                }

                                if ($fetch_sumQuery['US'] != '0') {
                                    echo '<th class="text-right">U/S</th>';
                                }

                                if ($fetch_sumQuery['INV'] != '0') {
                                    echo '<th class="text-right">Oth.INV</th>';
                                }

                                if ($fetch_sumQuery['Cons'] != '0') {
                                    echo '<th class="text-right">Cons</th>';
                                }

                                if ($fetch_sumQuery['Viss'] != '0') {
                                    echo '<th class="text-right">Viss</th>';
                                }

                                if ($fetch_sumQuery['BT'] != '0') {
                                    echo '<th class="text-right">BT</th>';
                                }

                                if ($fetch_sumQuery['Med'] != '0') {
                                    echo '<th class="text-right">Med</th>';
                                }

                                if ($fetch_sumQuery['MO'] != '0') {
                                    echo '<th class="text-right">MO</th>';
                                }

                                if ($fetch_sumQuery['Nurs'] != '0') {
                                    echo '<th class="text-right">Nurs</th>';
                                }

                                if ($fetch_sumQuery['ISLF'] != '0') {
                                    echo '<th class="text-right">ISLF</th>';
                                }

                                if ($fetch_sumQuery['CT'] != '0') {
                                    echo '<th class="text-right">CT</th>';
                                }

                                if ($fetch_sumQuery['MRI'] != '0') {
                                    echo '<th class="text-right">MRI</th>';
                                }

                                if ($fetch_sumQuery['OtherOne'] != '0') {
                                    echo '<th class="text-right">Other1</th>';
                                }

                                if ($fetch_sumQuery['OtherTwo'] != '0') {
                                    echo '<th class="text-right">Other2</th>';
                                }

                                if ($fetch_sumQuery['OtherThree'] != '0') {
                                    echo '<th class="text-right">Other3</th>';
                                }

                                if ($fetch_sumQuery['OtherFour'] != '0') {
                                    echo '<th class="text-right">Other4</th>';
                                }



                                ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $itr = 1;

                                while ($row = mysqli_fetch_assoc($selectPatient)) {
                                    echo '
                                    <tr>
                                        <td>'.$itr++.'</td>
                                        <td>'.$row['bill_no'].'</td>
                                        <td>'.$row['emp_date'].'</td>
                                        <td>'.$row['emp_pat_name'].'</td>
                                        <td>'.$row['emp_name'].'</td>
                                        <td>'.$row['emp_doctor'].'</td>';

                                        if ($row['room_charges'] != '0') {
                                            echo '<td class="payment">'.$row['room_charges'].'</td>';
                                        }

                                        if ($row['operation_charges'] != '0') {
                                            echo '<td class="payment">'.$row['operation_charges'].'</td>';
                                        }

                                        if ($row['anesthesia_charges'] != '0') {
                                            echo '<td class="payment">'.$row['anesthesia_charges'].'</td>';
                                        }

                                        if ($row['ot_charges'] != '0') {
                                            echo '<td class="payment">'.$row['ot_charges'].'</td>';
                                        }

                                        if ($row['ota_charges'] != '0') {
                                            echo '<td class="payment">'.$row['ota_charges'].'</td>';
                                        }

                                        if ($row['delivery_charges'] != '0') {
                                            echo '<td class="payment">'.$row['delivery_charges'].'</td>';
                                        }

                                        if ($row['xray_charges'] != '0') {
                                            echo '<td class="payment">'.$row['xray_charges'].'</td>';
                                        }

                                        if ($row['lab_charges'] != '0') {
                                            echo '<td class="payment">'.$row['lab_charges'].'</td>';
                                        }

                                        if ($row['ultrasound_charges'] != '0') {
                                            echo '<td class="payment">'.$row['ultrasound_charges'].'</td>';
                                        }

                                        if ($row['otherinvestigation_charges'] != '0') {
                                            echo '<td class="payment">'.$row['otherinvestigation_charges'].'</td>';
                                        }

                                        if ($row['consultant_charges'] != '0') {
                                            echo '<td class="payment">'.$row['consultant_charges'].'</td>';
                                        }

                                        if ($row['consultantvisit_charges'] != '0') {
                                            echo '<td class="payment">'.$row['consultantvisit_charges'].'</td>';
                                        }

                                        if ($row['bloodtransfusions_charges'] != '0') {
                                            echo '<td class="payment">'.$row['bloodtransfusions_charges'].'</td>';
                                        }

                                        if ($row['medicines_charges'] != '0') {
                                            echo '<td class="payment">'.$row['medicines_charges'].'</td>';
                                        }

                                        if ($row['mo_charges'] != '0') {
                                            echo '<td class="payment">'.$row['mo_charges'].'</td>';
                                        }

                                        if ($row['nursing_charges'] != '0') {
                                            echo '<td class="payment">'.$row['nursing_charges'].'</td>';
                                        }

                                        if ($row['isochlorane_charges'] != '0') {
                                            echo '<td class="payment">'.$row['isochlorane_charges'].'</td>';
                                        }
                                        
                                        if ($row['ctscan_charges'] != '0') {
                                            echo '<td class="payment">'.$row['ctscan_charges'].'</td>';
                                        }

                                        if ($row['mri_charges'] != '0') {
                                            echo '<td class="payment">'.$row['mri_charges'].'</td>';
                                        }

                                        if ($row['otherone_charges'] != '0') {
                                            echo '<td class="payment">'.$row['otherone_charges'].'</td>';
                                        }

                                        if ($row['othertwo_charges'] != '0') {
                                            echo '<td class="payment">'.$row['othertwo_charges'].'</td>';
                                        }

                                        if ($row['otherthree_charges'] != '0') {
                                            echo '<td class="payment">'.$row['otherthree_charges'].'</td>';
                                        }

                                        if ($row['otherfour_charges'] != '0') {
                                            echo '<td class="payment">'.$row['otherfour_charges'].'</td>';
                                        }
                                    
                                    echo '
                                    </tr>';    
                                }
                            ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
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