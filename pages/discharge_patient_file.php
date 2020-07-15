<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Lab Tests</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <!-- <h4 class="float-right font-16"><strong>MR # 12345</strong></h4> -->
                                    <h3 class="m-t-0 text-center">
                                        <img src="../assets/logo.png" alt="logo" height="60" />
                                        <h3 align="center">SHAH MEDICAL AND SERGICAL CENTER</h3>
                                        <h4 class="text-center font-16">Address: Near Center Hospital, Saidu Sharif Swat.</h4>
                                        <h4 class="float-right font-16"><strong>MR # 12345</strong></h4>
                                        <br>
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <address>
                                            <strong>Patient Info:</strong><br>
                                            <b>Patient Name: </b>John Smith<br>
                                            <b>Patient Address: </b>John Smith<br>
                                            <b>Patient Contact: </b>John Smith<br>
                                            <b>Patient CNIC: </b>John Smith<br>
                                            <b>Patient Gender: </b>John Smith<br>
                                        </address>
                                    </div>
                                    <div class="col-6 text-right">
                                        <address>
                                            <b>Doctor Name: </b>John Smith<br>
                                            <b>Room No. : </b>John Smith<br>
                                            <b>Patient Case: </b>John Smith<br>
                                            <b>Date Of Admission: </b>John Smith<br>
                                            <b>Date Of Discharge: </b>John Smith<br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-t-30">
                                        <address>
                                            <strong>Doctor Advice:</strong><br>
                                        </address>
                                        <textarea class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20"><strong>Patient History</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Item</strong></td>
                                                        <td class="text-center"><strong>Price</strong></td>
                                                        <td class="text-center"><strong>Quantity</strong>
                                                        </td>
                                                        <td class="text-right"><strong>Totals</strong></total </tr> </thead> <tbody>
                                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <tr>
                                                        <td>BS-200</td>
                                                        <td class="text-center">$10.99</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-right">$10.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>BS-400</td>
                                                        <td class="text-center">$20.00</td>
                                                        <td class="text-center">3</td>
                                                        <td class="text-right">$60.00</td>
                                                    </tr>
                                                    </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="d-print-none mo-mt-2">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20"><strong>Medicine Details: </strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Item</strong></td>
                                                        <td class="text-center"><strong>Price</strong></td>
                                                        <td class="text-center"><strong>Quantity</strong>
                                                        </td>
                                                        <td class="text-right"><strong>Totals</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <tr>
                                                        <td>BS-200</td>
                                                        <td class="text-center">$10.99</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-right">$10.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>BS-400</td>
                                                        <td class="text-center">$20.00</td>
                                                        <td class="text-center">3</td>
                                                        <td class="text-right">$60.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="d-print-none mo-mt-2">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                </total </div> <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-20"><strong>Laboratory Details: </strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Quantity</strong>
                                                            </td>
                                                            <td class="text-right"><strong>Totals</strong></total>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        <tr>
                                                            <td>BS-200</td>
                                                            <td class="text-center">$10.99</td>
                                                            <td class="text-center">1</td>
                                                            <td class="text-right">$10.99</td>
                                                        </tr>
                                                        <tr>
                                                            <td>BS-400</td>
                                                            <td class="text-center">$20.00</td>
                                                            <td class="text-center">3</td>
                                                            <td class="text-right">$60.00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Medicines Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" readonly id="actMedChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Medicines Price">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" class="form-control" id="totMedChar" required="" onkeyUp="totCharges()" placeholder="Medicines Price">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Room Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" readonly id="actRoomChar" required="" onkeyUp="actCharges()" class="form-control" placeholder="Room Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totRoomChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Room Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> OT Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" id="actOtChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="OT Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totOtChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="OT Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Hospital Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" id="actHosChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Hospital Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totHosChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Hospital Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Lab Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" id="actLabChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Lab Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totLabChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Lab Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Doctor Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" id="actDrChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Doctor Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="TotDrChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Doctor Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Anesthesia Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="2" id="actAnesChar" required="" onkeyUp="actCharges()" readonly class="form-control" placeholder="Anesthesia Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totAnesChar" required="" onkeyUp="totCharges()" class="form-control" placeholder="Anesthesia Charges">
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <label> Actual Charges:</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" value="" id="actualCharges" readonly class="form-control" placeholder="Actual Charges">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" value="" id="totalCharges" class="form-control" readonly placeholder="Total Charges"> </div>
                                                </div>
                                                <br />
                                            </form>
                                            </form>
                                            <div class="d-print-none mo-mt-2">
                                                <div class="float-right">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="#" class="btn btn-primary waves-effect waves-light">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.select2').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
<script type="text/javascript">
    window.onload = function() {
        actCharges();
        totCharges();
        console.log('executed')
    }
function actCharges() {
   let totalChargesVar = [];
    let totalCalcCharges = 0;

    totalChargesVar['actMedChar'] = parseInt(document.getElementById('actMedChar').value);
    totalChargesVar['actRoomChar'] = parseInt(document.getElementById('actRoomChar').value);
    totalChargesVar['actOtChar'] = parseInt(document.getElementById('actOtChar').value);
    totalChargesVar['actHosChar'] = parseInt(document.getElementById('actHosChar').value);
    totalChargesVar['actLabChar'] = parseInt(document.getElementById('actLabChar').value);
    totalChargesVar['actDrChar'] = parseInt(document.getElementById('actDrChar').value);
    totalChargesVar['actAnesChar'] = parseInt(document.getElementById('actAnesChar').value);
    document.getElementById('actualCharges').value = '';

    for (let key in totalChargesVar) {
        if (totalChargesVar[key]) {
            totalCalcCharges += totalChargesVar[key];
            
            document.getElementById('actualCharges').value = totalCalcCharges;
        }
    }
}

function totCharges() {
    let totalChargesVar = [];
    let totalCalcCharges = 0;

    totalChargesVar['totMedChar'] = parseInt(document.getElementById('totMedChar').value);
    totalChargesVar['totRoomChar'] = parseInt(document.getElementById('totRoomChar').value);
    totalChargesVar['totOtChar'] = parseInt(document.getElementById('totOtChar').value);
    totalChargesVar['totHosChar'] = parseInt(document.getElementById('totHosChar').value);
    totalChargesVar['totLabChar'] = parseInt(document.getElementById('totLabChar').value);
    totalChargesVar['TotDrChar'] = parseInt(document.getElementById('TotDrChar').value);
    totalChargesVar['totAnesChar'] = parseInt(document.getElementById('totAnesChar').value);
    document.getElementById('totalCharges').value = '';

    for (let key in totalChargesVar) {
        if (totalChargesVar[key]) {
            totalCalcCharges += totalChargesVar[key];
            
            document.getElementById('totalCharges').value = totalCalcCharges;
        }
    }
}
</script>
</body>

</html>