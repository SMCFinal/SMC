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
                <h5 class="page-title">Doctor Visit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    
                        <!-- <h4 class="mt-0 header-title">Test Details</h4> -->
                       
                 
                        <div class="card-body" style="box-shadow: 30px 30px 30px #ccc">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td>Asif</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>' . "Dr. " . $rowPatientView['name'] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Floor/Room</th>
                                            <td>' . $rowPatientView['floor_name'] . " <b> | </b> " . $rowPatientView['room_number'] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Patient Case</th>
                                            <td>' . $rowPatientView['patient_disease'] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Village Name</th>
                                            <td>' . $rowPatientView['patient_address'] . '</td>
                                        </tr>
                                        <tr>
                                            <th>Visit Charges</th>
                                            <td>1200</td>

                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td> <div class="input-group">
                                        <input class="form-control form_datetime" name="dateOfpurchase" placeholder="dd/mm/yyyy-hh:mm">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div></td>
                                </tr>

                                 <tr>
                                            <th></th>
                                            <td><a href="" type="submit" name="addMedicine" class="btn btn-primary waves-effect waves-light">Submit</a></td>

                                        </tr>

                                    </tbody>
                                    
                                </table>
                                
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

  $(".form_datetime").datetimepicker({
    format: "yyyy-mm-dd"
});

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
  allowClear:true
  
});
</script>

</body>

</html>