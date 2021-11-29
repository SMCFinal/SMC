<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    $id = $_GET['id'];

    $QueryPatient = mysqli_query($connect, "SELECT patient_registration.*, staff_members.*, rooms.* FROM `patient_registration`
        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
        INNER JOIN rooms ON rooms.id = patient_registration.room_id
        WHERE patient_registration.id = '$id'");

    $fetch_QueryPatient = mysqli_fetch_assoc($QueryPatient);

    if (isset($_POST['addVisit'])) {
        $pat_id = $_POST['pat_id'];
        $pat_consultant = $_POST['pat_consultant'];
        $room_id = $_POST['room_id'];
        $pat_disease = $_POST['pat_disease'];
        $pat_address = $_POST['pat_address'];
        $pat_visit_charges = $_POST['pat_visit_charges'];
        $dateOfVisit = $_POST['dateOfVisit'];

        $queryInsert = mysqli_query($connect, "INSERT INTO doctor_visit_charges(pat_id, doctor_id, room_id, pat_case, pat_address, visit_charges, visit_date)VALUES('$pat_id', '$pat_consultant', '$room_id', '$pat_disease', '$pat_address', '$pat_visit_charges', '$dateOfVisit')");

        // echo "INSERT INTO doctor_visit_charges(pat_id, doctor_id, room_id, pat_case, pat_address, visit_charges, visit_date)VALUES('$pat_id', '$pat_consultant', '$room_id', '$pat_disease', '$pat_address', '$pat_visit_charges', '$dateOfVisit')";

        if (!$queryInsert) {
            
        }else {
            header("LOCATION:doctor_visit_charges_confirm_list.php");
        }
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
                       
                        <form method="POST">
                        <div class="card-body" style="box-shadow: 30px 30px 30px #ccc">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <td><?php echo  $fetch_QueryPatient['patient_name'] ?></td>
                                            <input type="hidden" name="pat_id" value="<?php echo $id ?>">
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>Dr. <?php echo  $fetch_QueryPatient['name'] ?></td>
                                            <input type="hidden" name="pat_consultant" value="<?php echo  $fetch_QueryPatient['patient_consultant'] ?>">
                                        </tr>
                                        <tr>
                                            <th>Floor/Room</th>
                                            <td><?php echo  $fetch_QueryPatient['room_number'] ?></td>
                                            <input type="hidden" name="room_id" value="<?php echo  $fetch_QueryPatient['room_id'] ?>">
                                        </tr>
                                        <tr>
                                            <th>Patient Case</th>
                                            <td><?php echo  $fetch_QueryPatient['patient_disease'] ?></td>
                                            <input type="hidden" name="pat_disease" value="<?php echo  $fetch_QueryPatient['patient_disease'] ?>">
                                        </tr>
                                        <tr>
                                            <th>Village Name</th>
                                            <td><?php echo  $fetch_QueryPatient['patient_address'] ?></td>
                                            <input type="hidden" name="pat_address" value="<?php echo  $fetch_QueryPatient['patient_address'] ?>">
                                        </tr>
                                        <tr>
                                            <th>Visit Charges</th>
                                            <td><?php echo  $fetch_QueryPatient['visit_charges'] ?></td>
                                            <input type="hidden" name="pat_visit_charges" value="<?php echo  $fetch_QueryPatient['visit_charges'] ?>">

                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td> <div class="input-group">
                                        <input class="form-control form_datetime" name="dateOfVisit" placeholder="dd/mm/yyyy-hh:mm" required="">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div></td>
                                </tr>

                                 <tr>
                                            <th></th>
                                            <td>
                                                <button type="submit" name="addVisit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                <!-- <a href="" ></a></td> -->

                                        </tr>

                                    </tbody>
                                    
                                </table>
                                
                            </div>
                        </div>
                        </form>
                  
                
                   
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
    format: "yyyy-mm-dd hh:ii"
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