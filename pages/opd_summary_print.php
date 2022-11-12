<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$ref = $_GET['ref'];

include '../_partials/header.php';
?>
<style>
    body {
        background-color: white !important
    }
</style>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">OPD Summary</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <!-- <div class="card m-b-30"> -->
                    <!-- <div class="card-body"> -->
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
                                        WHERE opd_charges.charges_status = '1' AND opd_charges.ref_no = '$ref'
                                    ");

                                    $fetch_sumQuery = mysqli_fetch_assoc($sumQuery);

                                    echo '
                                        <th class="text-center">Bill</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">P.Name</th>
                                        <th class="text-center">E.Name</th>
                                        <th class="text-center">Doctor</th>
                                    ';
                                    if ($fetch_sumQuery['Room'] != '0') {
                                        echo '<th class="text-center">Room</th>';
                                    }

                                    if ($fetch_sumQuery['Surg'] != '0') {
                                        echo '<th class="text-center">Surg</th>';
                                    }

                                    if ($fetch_sumQuery['ANA'] != '0') {
                                        echo '<th class="text-center">ANA</th>';
                                    }

                                    if ($fetch_sumQuery['OT'] != '0') {
                                        echo '<th class="text-center">OT</th>';
                                    }

                                    if ($fetch_sumQuery['OTA'] != '0') {
                                        echo '<th class="text-center">OTA</th>';
                                    }

                                    if ($fetch_sumQuery['Delivery'] != '0') {
                                        echo '<th class="text-center">Delivery</th>';
                                    }

                                    if ($fetch_sumQuery['XRay'] != '0') {
                                        echo '<th class="text-center">XRay</th>';
                                    }

                                    if ($fetch_sumQuery['Lab'] != '0') {
                                        echo '<th class="text-center">Lab</th>';
                                    }

                                    if ($fetch_sumQuery['US'] != '0') {
                                        echo '<th class="text-center">U/S</th>';
                                    }

                                    if ($fetch_sumQuery['INV'] != '0') {
                                        echo '<th class="text-center">Oth.INV</th>';
                                    }

                                    if ($fetch_sumQuery['Cons'] != '0') {
                                        echo '<th class="text-center">Cons</th>';
                                    }

                                    if ($fetch_sumQuery['Viss'] != '0') {
                                        echo '<th class="text-center">Viss</th>';
                                    }

                                    if ($fetch_sumQuery['BT'] != '0') {
                                        echo '<th class="text-center">BT</th>';
                                    }

                                    if ($fetch_sumQuery['Med'] != '0') {
                                        echo '<th class="text-center">Med</th>';
                                    }

                                    if ($fetch_sumQuery['MO'] != '0') {
                                        echo '<th class="text-center">MO</th>';
                                    }

                                    if ($fetch_sumQuery['Nurs'] != '0') {
                                        echo '<th class="text-center">Nurs</th>';
                                    }

                                    if ($fetch_sumQuery['ISLF'] != '0') {
                                        echo '<th class="text-center">ISLF</th>';
                                    }

                                    if ($fetch_sumQuery['CT'] != '0') {
                                        echo '<th class="text-center">CT</th>';
                                    }

                                    if ($fetch_sumQuery['MRI'] != '0') {
                                        echo '<th class="text-center">MRI</th>';
                                    }

                                    if ($fetch_sumQuery['OtherOne'] != '0') {
                                        echo '<th class="text-center">Oth.1</th>';
                                    }

                                    if ($fetch_sumQuery['OtherTwo'] != '0') {
                                        echo '<th class="text-center">Oth.2</th>';
                                    }

                                    if ($fetch_sumQuery['OtherThree'] != '0') {
                                        echo '<th class="text-center">Oth.3</th>';
                                    }

                                    if ($fetch_sumQuery['OtherFour'] != '0') {
                                        echo '<th class="text-center">Oth.4</th>';
                                    }

                                    echo '
                                        <th class="text-center">Total</th>
                                    ';
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $ref = $_GET['ref'];

                                    $itr = 1;

                                    $selectPatient = mysqli_query($connect, "SELECT opd_charges.*, opd_ptcl.* FROM `opd_charges`
                                    INNER JOIN opd_ptcl ON opd_ptcl.o_id = opd_charges.pat_id
                                    WHERE opd_charges.charges_status = '1' AND opd_charges.ref_no = '$ref'");



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

                                    echo '
                                    <tr style="font-weight: 600 !important">
                                    <th style="color: white !important">Total</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>
                                    <th>-</th>';
                                    if ($fetch_sumQuery['Room'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Room'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Surg'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Surg'].'</th>';
                                    }

                                    if ($fetch_sumQuery['ANA'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['ANA'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OT'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OT'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OTA'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OTA'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Delivery'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Delivery'].'</th>';
                                    }

                                    if ($fetch_sumQuery['XRay'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['XRay'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Lab'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Lab'].'</th>';
                                    }

                                    if ($fetch_sumQuery['US'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['US'].'</th>';
                                    }

                                    if ($fetch_sumQuery['INV'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['INV'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Cons'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Cons'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Viss'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Viss'].'</th>';
                                    }

                                    if ($fetch_sumQuery['BT'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['BT'].'</th>';
                                    }

                                    if ($fetch_sumQuery['Med'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Med'].'</th>';
                                    }

                                    if ($fetch_sumQuery['MO'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['MO'].'</td>';
                                    }

                                    if ($fetch_sumQuery['Nurs'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['Nurs'].'</th>';
                                    }

                                    if ($fetch_sumQuery['ISLF'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['ISLF'].'</th>';
                                    }

                                    if ($fetch_sumQuery['CT'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['CT'].'</th>';
                                    }

                                    if ($fetch_sumQuery['MRI'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['MRI'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OtherOne'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OtherOne'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OtherTwo'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OtherTwo'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OtherThree'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OtherThree'].'</th>';
                                    }

                                    if ($fetch_sumQuery['OtherFour'] != '0') {
                                        echo '<th>'.$fetch_sumQuery['OtherFour'].'</th>';
                                    }


                                    $totalAmountSum =   $fetch_sumQuery['Room'] + 
                                                        $fetch_sumQuery['Surg'] + 
                                                        $fetch_sumQuery['ANA'] + 
                                                        $fetch_sumQuery['OT'] + 
                                                        $fetch_sumQuery['OTA'] + 
                                                        $fetch_sumQuery['Delivery'] + 
                                                        $fetch_sumQuery['XRay'] + 
                                                        $fetch_sumQuery['Lab'] + 
                                                        $fetch_sumQuery['US'] + 
                                                        $fetch_sumQuery['INV'] + 
                                                        $fetch_sumQuery['Cons'] + 
                                                        $fetch_sumQuery['Viss'] + 
                                                        $fetch_sumQuery['BT'] + 
                                                        $fetch_sumQuery['Med'] + 
                                                        $fetch_sumQuery['MO'] + 
                                                        $fetch_sumQuery['Nurs'] + 
                                                        $fetch_sumQuery['ISLF'] + 
                                                        $fetch_sumQuery['CT'] + 
                                                        $fetch_sumQuery['OtherOne'] + 
                                                        $fetch_sumQuery['OtherTwo'] + 
                                                        $fetch_sumQuery['OtherThree'] + 
                                                        $fetch_sumQuery['OtherFour'];
                                                        
                                echo '<th>'.$totalAmountSum.'</th>';
                                  

                            echo '
                                </tr>';
                                ?>


                            </tbody>

                        </table>
                    <!-- </div> -->
                <!-- </div> -->
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
<!-- jQuery  -->
<?php include '../_partials/jquery.php'?>
<!-- Required datatable js -->
<?php include '../_partials/datatable.php'?>
<!-- Buttons examples -->
<?php include '../_partials/buttons.php'?>
<!-- Responsive examples -->
<?php include '../_partials/responsive.php'?>
<!-- Datatable init js -->
<?php 
// include '../_partials/datatableInit.php'
?>
<!-- Sweet-Alert  -->
<?php include '../_partials/sweetalert.php'?>
<!-- App js -->
<?php include '../_partials/app.php'?>

<script src="../../assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>



<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pageLength": 100,
            dom: 'Bfrtip', 
            buttons: [
               'excel',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'A4'
            }
        ]

        });

    } );

    
</script>
</body>

</html>