<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT discharge_patients.*, staff_members.name, area.area_name FROM `discharge_patients`
                                INNER JOIN staff_members ON staff_members.id = discharge_patients.patient_consultant
                                INNER JOIN area ON area.id = discharge_patients.city_id
                                WHERE discharge_patients.id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    date_default_timezone_set('Asia/Karachi');
    $dateCustom = date('Y-m-d h:i:s A');

    include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title d-inline">Patient Slip Print</h5>
                 <a type="button" href="#" id="printButton" class="btn btn-success waves-effect waves-light float-right btn-lg mb-3"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>

        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <!-- <div class="card m-b-30" > -->
                    <!-- <div class="card-body"> -->
                        <div class="row" id="printElement">
                            <div class="col-6" style="border-right: 1px solid black;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="invoice-title" >
                                            <img  style="position: relative;" src="../assets/logo.png" alt="logo" height="100" />
                                        </div>
                                    </div> 

                                    <div class="col-md-10">
                                        <div class="invoice-title">
                                            <p style="color: black; font-size:17px;" align="right"><b>SHAH MEDICAL CENTER</b></p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Saidu Sharif, Swat.</p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Appoint Receipt</p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Patient Copy</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12" align="center">
                                        <h6 style="color: black; font-size: 12px; margin-bottom: 0;">MR No. <?php echo $fetch_selectQuery['patient_yearly_no'] ?></h6>
                                    </div>

                                    <div class="col-md-12" align="left">
                                        <div style="width: 100%; border: 1px solid black;">
                                            <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Patient Name: <?php echo $fetch_selectQuery['patient_name'] ?></p> 
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Age: <?php echo $fetch_selectQuery['patient_age'] ?> Y</p> 
                                            </div>

                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Contact: <?php echo $fetch_selectQuery['patient_contact'] ?></p> 
                                            </div>
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Doctor: <?php echo $fetch_selectQuery['name'] ?></p> 
                                            </div>

                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Address: <?php echo $fetch_selectQuery['area_name'] ?></p> 
                                            </div>
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Reg Fee: 50</p>
                                            </div>

                                            <?php
                                                $newAdmisison = $dateCustom;
                                            ?>
                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Date: <?php echo $newAdmisison ?></p> 
                                            </div>
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-top: none; border-bottom:none;" align="right">
                                            <p style="color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">اگر آپ نے معائنہ کیلے ڈاکٹر سے پہلے ٹائم لیا ہوا ہے تو برائے مہربانی مقررہ وقت پر متعلقہ کلینیک تشریف لے آئیں۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">اگر آپ کی طبعیت شدید خراب ہے تو فوری طور پر ایمرجنسی ڈیپارٹمنٹ سے رجوع کیجیے۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">ہر مرتبہ جب بھی آپ تشریف لائیں تو اپنا میڈیکل ریکارڈ نمبر نہ بھولیے۔ اگر آپ کو یاد نہیں ہے تو رجسٹریشن کا شعبہ آپ کے نام یا آپ کے فون نمبر وغیرہ سے ڈھونڈ نکال سکتا ہے۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">ہم آپ کے تعاون کیلے شکر گزار ہیں</p> 
                                        </div>


                                        <div style="width: 100%; border: 1px solid black; border-top:none;" align="right">
                                            <p style="margin-bottom: -7px !important; margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;"> انتظامیہ۔ شاہ میڈیکل سنٹر.</p> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6" style="border-left: 1px solid black;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="invoice-title" >
                                            <img  style="position: relative;" src="../assets/logo.png" alt="logo" height="100" />
                                        </div>
                                    </div> 

                                    <div class="col-md-10">
                                        <div class="invoice-title">
                                            <p style="color: black; font-size:17px;" align="right"><b>SHAH MEDICAL CENTER</b></p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Saidu Sharif, Swat.</p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Appoint Receipt</p>
                                            <p style="color: black; font-size:11px; margin-top: -12px; font-weight: bold;" align="right">Center Copy</p>
                                        </div>
                                    </div>

                                    <div class="col-md-12" align="center">
                                        <h6 style="color: black; font-size: 12px; margin-bottom: 0;">MR No. <?php echo $fetch_selectQuery['patient_yearly_no'] ?></h6>
                                    </div>

                                    <div class="col-md-12" align="left">
                                        <div style="width: 100%; border: 1px solid black;">
                                            <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Patient Name: <?php echo $fetch_selectQuery['patient_name'] ?></p> 
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Age: <?php echo $fetch_selectQuery['patient_age'] ?> Y</p> 
                                            </div>

                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Contact: <?php echo $fetch_selectQuery['patient_contact'] ?></p> 
                                            </div>
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Doctor: <?php echo $fetch_selectQuery['name'] ?></p> 
                                            </div>

                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Address: <?php echo $fetch_selectQuery['area_name'] ?></p> 
                                            </div>
                                        </div>

                                        <div style="display: flex;">
                                            <div style="width: 50%; border: 1px solid black; border-top: none; border-right: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Reg Fee: 50</p>
                                            </div>

                                            <?php
                                                $newAdmisison = $dateCustom;
                                            ?>
                                            <div style="width: 50%; border: 1px solid black; border-top: none;">
                                                <p style="margin-top: -5px !important; margin-bottom: -5px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">Date: <?php echo $newAdmisison ?></p> 
                                            </div>
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-top: none; border-bottom:none;" align="right">
                                            <p style="color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">اگر آپ نے معائنہ کیلے ڈاکٹر سے پہلے ٹائم لیا ہوا ہے تو برائے مہربانی مقررہ وقت پر متعلقہ کلینیک تشریف لے آئیں۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">اگر آپ کی طبعیت شدید خراب ہے تو فوری طور پر ایمرجنسی ڈیپارٹمنٹ سے رجوع کیجیے۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">ہر مرتبہ جب بھی آپ تشریف لائیں تو اپنا میڈیکل ریکارڈ نمبر نہ بھولیے۔ اگر آپ کو یاد نہیں ہے تو رجسٹریشن کا شعبہ آپ کے نام یا آپ کے فون نمبر وغیرہ سے ڈھونڈ نکال سکتا ہے۔</p> 
                                        </div>

                                        <div style="width: 100%; border: 1px solid black; border-bottom:none; border-top:none;" align="right">
                                            <p style="margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;">ہم آپ کے تعاون کیلے شکر گزار ہیں</p> 
                                        </div>


                                        <div style="width: 100%; border: 1px solid black; border-top:none;" align="right">
                                            <p style="margin-bottom: -7px !important; margin-top: -10px !important; color: black; font-weight: bold; font-size: 11px; margin: 0; padding: 5px;"> انتظامیہ۔ شاہ میڈیکل سنٹر.</p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                <!-- </div> -->
            </div>
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
<script type="text/javascript" src="../assets/print.js"></script>

<script type="text/javascript">

    function print() {
    printJS({
    printable: 'printElement',
    type: 'html',
    targetStyles: ['*']
 })
}

document.getElementById('printButton').addEventListener ("click", print)

//     function printDiv(divName) {
//      var printContents = document.getElementById(divName).innerHTML;
//      var originalContents = document.body.innerHTML;

//      document.body.innerHTML = printContents;

//      window.print();

//      document.body.innerHTML = originalContents;
// }

</script>
</body>

</html>