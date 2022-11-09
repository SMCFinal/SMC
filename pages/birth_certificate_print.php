<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['pat_id'];
    $cert_id = $_GET['cert_id'];

    $selectPatient = mysqli_query($connect, "SELECT birth_certificate.*, discharge_patients.patient_name, discharge_patients.patient_doop FROM `birth_certificate`
                                INNER JOIN discharge_patients ON discharge_patients.id = birth_certificate.pat_id
                                WHERE birth_certificate.pat_id = '$id' AND birth_certificate.certificate_id = '$cert_id'");

    $fetch_selectPatient = mysqli_fetch_assoc($selectPatient);
    
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
                <h5 class="page-title d-inline" >Birth Certificate Print</h5>
                <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <!-- end row -->
        <div class="row" id="printElement">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h3 class="m-t-0 text-center">
                                <img src="../assets/logo.png" alt="logo" height="60" />
                                <h3 align="center" style="font-size: 150%; font-family: Georgia">SHAH MEDICAL CENTER</h3>
                                <h4 class="text-center font-16" style="font-size: 90%; font-family: Georgia">Saidu Road, Opposite to Central Hospital, Saidu Sharif, Swat.</h4>
                                <br>
                            </h3>
                            <hr>
                            <br>

                            <h3 class="m-t-0 text-center">
                                <h4 class="text-center font-16" style="font-size: 150%; font-family: Georgia">Birth Certificate</h4>
                                <br>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <p class="text-center" style="font-family: monospace; font-weight: 600; font-size: 18px">This document acknowledges that a</p>

                                <br />

                                <h2 class="text-center" style="font-family: brush script mt; font-weight: 300;">Baby
                                <?php
                                    if($fetch_selectPatient['baby_gender'] === '1') {
                                        echo 'Boy';
                                    }else {
                                        echo 'Girl';
                                    }
                                ?>
                                </h2>

                                <br />

                                <p class="text-center" style="font-family: monospace; font-size: 18px; font-weight: 600;">was born to </p>

                                <br />

                                <div class="row">
                                    <div class="col-4" style="border-bottom: 2px solid black">
                                        <h3 class="text-center" style="font-family: brush script mt; font-weight: 100; "> Ms. 
                                            <?php
                                            $smallCharactersMO = strtolower($fetch_selectPatient['patient_name']);
                                            echo  $stringMO = ucwords($smallCharactersMO);
                                            ?>
                                        </h3>
                                    </div>

                                    <div class="col-4">
                                        <h3 class="text-center" style="font-family: brush script mt; font-weight: 100">and</h3>
                                    </div>
                                    
                                    <div class="col-4"  style="border-bottom: 2px solid black">
                                        <h3 class="text-center" style="font-family: brush script mt; font-weight: 100"> Mr. 
                                            <?php
                                                $smallCharactersFather = strtolower($fetch_selectPatient['baby_father']);
                                                echo  $stringFather = ucwords($smallCharactersFather);
                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="text-center" style="font-family: Georgia; font-weight: 100; font-size: 16px !important;">Mother Name</h5>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <h5 class="text-center" style="font-family: Georgia; font-weight: 100; font-size: 16px !important;">Father Name</h5>
                                    </div>
                                </div>

                                <br />
                                <br />

                                <p class="text-center" style="font-family: monospace; font-weight: 600; font-size: 18px">at Shah Medical Center, Swat</p>

                                <br />
                                
                                <div class="row">
                                    <div class="col-4">
                                        <p class="text-right" style="font-family: monospace; font-size: 18px"><b>Weight: <?php echo $fetch_selectPatient['baby_weight']." KG" ?></b></p>
                                    </div>

                                    <div class="col-4"></div>
                                    
                                    <div class="col-4">
                                        <p class="text-left" style="font-family: monospace; font-size: 18px"><b>Date: <?php echo $fetch_selectPatient['certificate_date'] ?></b></p>
                                    </div>
                                </div>

                                <br />
                                <br />
                                <br />
                                <br />
                                <br />



                                <div class="row">
                                    <div class="col-4" style="border-bottom: 2px solid black">
                                       
                                    </div>

                                    <div class="col-4">
                                        
                                    </div>
                                    
                                    <div class="col-4"  style="border-bottom: 2px solid black">
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h5 class="text-center" style="font-family: Georgia; font-weight: 100; ">Gynaecologist</h5>
                                    </div>

                                    <div class="col-4"></div>
                                    
                                    <div class="col-4">
                                        <h5 class="text-center" style="font-family: Georgia; font-weight: 100">Administration</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            
                        </div>
                    </div>
                </div>

                <!-- <div class="row custom" style="font-family: Georgia; position: inherit; top: 0">
                    <div class="col-md-8">
                        <label style="margin-bottom: 0rem !important">This is a computer generated certificate.</label><br>
                        <label>Developed By: <i>Team Pixelium</i></label>
                        <hr>
                    </div>     
                </div> -->
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