<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['d_id'];
    $ref = $_GET['refNo'];

    include '../_partials/header.php';

?>
<div class="page-content-wrapper " >
    <div class="container-fluid"><br>
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline" >Doctor Charges</h5>
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
                                            <!-- <br> -->
                                        </h3>
                                    </div>

                                    <!-- Data Table here -->
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- <div class="card m-b-30"> -->
                                                <form method="POST">
                                                <!-- <div class="card-body"> -->
                                                    <div class="table-responsive" >
                                                        <table class="table mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Patient</th>
                                                                    <th>Surgery</th>
                                                                    <th>Org</th>
                                                                    <th>Room</th>
                                                                    <th>Date/Time</th>
                                                                    <th>S. Charges</th>
                                                                    <th>V. Charges</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $itr = 1;

                                                                $sumSurgeryAmount = 0;
                                                                $sumVisitAmount = 0;
                                                                
                                                                $chargesQuery = mysqli_query($connect, "SELECT * FROM `charges_confirm_list` WHERE ref_no = '$ref' AND consult_id = '$id' ORDER BY op_vi_time DESC");

                                                                while ($chargesQueryFetch = mysqli_fetch_assoc($chargesQuery)) {
                                                                    echo '
                                                                    <tr>
                                                                        <td>'.$itr++.'</td>
                                                                        <td>'.$chargesQueryFetch['pat_name'].'</td>
                                                                        <td>'.$chargesQueryFetch['sur_name'].'</td>
                                                                        <td>'.$chargesQueryFetch['org_name'].'</td>
                                                                        <td>'.$chargesQueryFetch['room_name'].'</td>
                                                                        <td>'.$chargesQueryFetch['op_vi_time'].'</td>
                                                                        <td>'.$chargesQueryFetch['sur_charges'].'</td>
                                                                        <td>'.$chargesQueryFetch['vis_cahrges'].'</td>';
                                                                        $sumSurgeryAmount = $sumSurgeryAmount + $chargesQueryFetch['sur_charges'];

                                                                        $sumVisitAmount = $sumVisitAmount + $chargesQueryFetch['vis_cahrges'];
                                                                        echo '
                                                                    </tr>
                                                                    ';
                                                                }

                                                                    
                                                                echo '
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td align="right"><strong>Total: </strong></td>
                                                                        <td><strong>'.$sumSurgeryAmount.'</strong></td>
                                                                        <td><strong>'.$sumVisitAmount.'</strong></td>
                                                                    </tr>
                                                                ';
                                                                
                                                                $total = $sumSurgeryAmount + $sumVisitAmount;

                                                                echo '
                                                                    <tr>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none" align="right"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                        <td style="border-top:none; border-bottom:none"></td>
                                                                    </tr>
                                                                ';

                                                                echo '
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><strong></strong></td>
                                                                        <td align="right"><strong>Paid Amount Total: </strong></td>
                                                                        <td><strong>'.$total.'</strong></td>
                                                                    </tr>
                                                                ';
                                                                ?>

                                                        </tbody>
                                                    </table>
                                                    </div>                            
                                                <!-- </div> -->
                                            </form>
                                            <!-- </div> -->
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                </div>
                            </div>
                            <hr>
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
</html>12