<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $patId = $_GET['id'];
    $retPatientData = mysqli_query($connect, "SELECT * FROM postpone_patient WHERE id = '$patId'");
    $fetch_retPatientData = mysqli_fetch_assoc($retPatientData);

    $notAdded = '';

    $date = date_default_timezone_set('Asia/Karachi');
    $currentYear = date('Y');
    $currentYearNewPatient = date('Y-');

    $pickYearly = mysqli_query($connect, "SELECT COUNT(*)AS yearlyCounted FROM `patient_registration` WHERE auto_date LIKE '%$currentYear%'");
    $fetch_pickYearly = mysqli_fetch_assoc($pickYearly);


    $pickYearlyPostpone = mysqli_query($connect, "SELECT COUNT(*)AS yearlyPostponeCounted FROM `postpone_patient` WHERE auto_date LIKE '%$currentYear%'");
    $fetch_pickYearlyPostpone = mysqli_fetch_assoc($pickYearlyPostpone);

    $pickYearlyDischarge = mysqli_query($connect, "SELECT COUNT(*)AS yearlyDischargeCounted FROM discharge_patients WHERE auto_date LIKE  '%$currentYear%'");
    $fetch_pickYearlyDischarge = mysqli_fetch_assoc($pickYearlyDischarge);
    
    $yearlyCountedPatients = $fetch_pickYearly['yearlyCounted'] + $fetch_pickYearlyPostpone['yearlyPostponeCounted'] + $fetch_pickYearlyDischarge['yearlyDischargeCounted'];

    $newPatient = $currentYearNewPatient."0".($yearlyCountedPatients + 1);

    if (isset($_POST['patientRegister'])) {
        $yearlyNumber = $_POST['patientYearlyNumber'];
        $name = $_POST['patientName'];
        $Age = $_POST['patientAge'];
        $Gender = $_POST['patientGender'];
        $disease = $_POST['patientDisease'];
        $Address = $_POST['patientAddress'];
        $address_city = $_POST['address_city'];
        $DateOfAdmission = $_POST['patientDateOfAdmission'];
        $consultant = $_POST['patientConsultant'];
        $patientRoom = $_POST['patientRoom'];
        $attendantName = $_POST['attendantName'];
        $patient_cnic = $_POST['patientCnic'];
        $patient_contact = $_POST['patientContact'];
        $advance_payment = $_POST['advance_payment'];
        $organization = $_POST['organization'];

        if (empty($advance_payment)) {
            $advance_payment = '0';
        }

        $currentPatient = 'currentPatient';

    
        //  Chnages Need to modify
        $patient_doop = '0000-00-00';
        $patient_operation = '0';
        $consultant_charges = '0';
        $anasthetic_name = '0';
        $anesthesia_charges = '0';
        $added_by = '0';
        $updated_by = '0';
        
        // Till here
        
        $queryAddPatient = mysqli_query($connect, 
            "INSERT INTO patient_registration(
            patient_name, 
            patient_age, 
            patient_gender, 
            patient_address, 
            city_id,
            room_id, 
            patient_doa, 
            patient_disease, 
            patient_consultant, 
            attendent_name, 
            category, 
            patient_yearly_no,
            patient_cnic,
            patient_contact,
            patient_doop,
            patient_operation,
            consultant_charges,
            anasthetic_name,
            anesthesia_charges,
            added_by,
            updated_by,
            advance_payment,
            organization
            )VALUES(
            '$name', 
            '$Age', 
            '$Gender', 
            '$Address', 
            '$address_city', 
            '$patientRoom', 
            '$DateOfAdmission', 
            '$disease', 
            '$consultant', 
            '$attendantName', 
            '$currentPatient',
            '$yearlyNumber', 
            '$patient_cnic', 
            '$patient_contact',
            '$patient_doop',
            '$patient_operation',
            '$consultant_charges',
            '$anasthetic_name',
            '$anesthesia_charges',
            '$added_by',
            '$updated_by',
            '$advance_payment',
            '$organization'
            )
           ");

        if (!$queryAddPatient) {
            $notAdded = 'Not added';
        }else {
            $description = "Dear ".$attendantName.", your patient has been admitted. Thank You! SMC";
                
                $insertMsg = mysqli_query($connect, "INSERT INTO message_tbl
                    (from_device, to_device, message_body, status)
                    VALUES
                    ('1', '$patient_contact', '$description', '1')");

            $updateRoom = mysqli_query($connect, "UPDATE rooms SET status = '0' WHERE id = '$patientRoom'");
            header("LOCATION: patients_list.php");
        }
    }


    include('../_partials/header.php') 
?>
<link rel="stylesheet" type="text/css" href="../assets/bootstrap-datetimepicker.css">
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Re-admit Postpone Patient</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 offset-sm-6 col-form-label">M.R No.</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="<?php echo $fetch_retPatientData['patient_yearly_no'] ?>" placeholder="Yearly No." name="patientYearlyNumber" id="example-text-input" readonly>
                                </div>
                            </div>
                            <h4 class="mb-4 page-title"><u>Patient Details</u></h4>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Organization</label>
                                <div class="col-sm-4">
                                    <?php
                                        $select_option_city = mysqli_query($connect, "SELECT * FROM select_organization");
                                            $optionsCity = '<select class="form-control Orgselect2" name="organization" required="" style="width:100%">';
                                            
                                              while ($rowCity = mysqli_fetch_assoc($select_option_city)) {
                                                $optionsCity.= '<option value='.$rowCity['org_name'].'>'.$rowCity['org_name'].'</option>';
                                              }
                                            $optionsCity.= "</select>";
                                        echo $optionsCity;
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientName" value="<?php echo $fetch_retPatientData['patient_name'] ?>" type="text" placeholder="Patient Name" id="example-text-input">
                                </div>

                                 <label class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientAge" value="<?php echo $fetch_retPatientData['patient_age'] ?>" type="number" placeholder="Patient Age" value="" id="example-text-input">
                                </div>
                              
                            </div>
                            <div class="form-group row">
                               
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
                                    <?php
                                        if ($fetch_retPatientData['patient_gender'] == '1') {
                                            echo '
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="1" name="patientGender" checked>Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="2" name="patientGender">Female
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="3" name="patientGender">Other
                                                </label>
                                            </div>
                                            ';    
                                        }elseif ($fetch_retPatientData['patient_gender'] == '2') {
                                            echo '
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="1" name="patientGender">Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="2" name="patientGender" checked>Female
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="3" name="patientGender">Other
                                                </label>
                                            </div>
                                            ';
                                        }elseif ($fetch_retPatientData['patient_gender'] == '3') {
                                            echo '
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="1" name="patientGender">Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="2" name="patientGender">Female
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="3" name="patientGender" checked>Other
                                                </label>
                                            </div>
                                            ';
                                        }
                                    ?>
                                </div>

                                <label class="col-sm-2 col-form-label">Case</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="<?php echo $fetch_retPatientData['patient_disease'] ?>" name="patientDisease" placeholder="Patient Case" value="" id="example-text-input">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input type="text" id="textarea" value="<?php echo $fetch_retPatientData['patient_address'] ?>" class="form-control" name="patientAddress" placeholder="Address">
                                </div>
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-4">
                                <?php
                                $select_option_city = mysqli_query($connect, "SELECT * FROM area");
                                    $optionsCity = '<select class="form-control select2" name="address_city" required="" style="width:100%">';
                                      while ($rowCity = mysqli_fetch_assoc($select_option_city)) {
                                        if ($rowCity['id'] == $fetch_retPatientData['city_id']) {
                                            $optionsCity.= '<option value='.$rowCity['id'].' selected>'.$rowCity['area_name'].'</option>';
                                        }else {
                                        $optionsCity.= '<option value='.$rowCity['id'].'>'.$rowCity['area_name'].'</option>';
                                        }
                                      }
                                    $optionsCity.= "</select>";
                                echo $optionsCity;
                                ?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" value="<?php echo $fetch_retPatientData['patient_cnic'] ?>" name="patientCnic" placeholder="CNIC">
                                </div>
                                <label class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <input type="number" value="<?php echo $fetch_retPatientData['patient_contact'] ?>" class="form-control" name="patientContact" placeholder="Patient Contact">
                                </div>
                            </div>
                            <hr>

                        <h4 class="mb-4 page-title"><u>Patient Admission Details</u></h4>
                        <?php
                        date_default_timezone_set('Asia/Karachi');
                        $date = date('Y-m-d H:i:s', time());
                        ?>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date of Admission</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input  class="form-control form_datetime" name="patientDateOfAdmission" value="<?php echo $date ?>" placeholder="dd/mm/yyyy-hh:mm" autoclear="">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>

                                 <label class="col-sm-2 col-form-label">Refered by / Consultant</label>
                                <div class="col-sm-4">
                                <?php
                                $selectDoctor = mysqli_query($connect, "SELECT staff_members.id AS staffID, staff_members.*, staff_category.* FROM `staff_members`
                                INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                WHERE staff_members.status = '1' AND staff_category.category_name = 'Doctor'");
                                    $optionsDoctor = '<select class="form-control select2" name="patientConsultant" required="" style="width:100%">';
                                      while ($rowDoctor = mysqli_fetch_assoc($selectDoctor)) {
                                            $optionsDoctor.= '<option value='.$rowDoctor['staffID'].'>'.$rowDoctor['name'].'</option>';
                                      }
                                    $optionsDoctor.= "</select>";
                                echo $optionsDoctor;
                                ?>
                                </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Room No.</label>
                                <div class="col-sm-4"> 

                                <?php
                                    $select_option = mysqli_query($connect, "SELECT * FROM rooms WHERE status = '1'");
                                        $options = '<select class="form-control select2" name="patientRoom" required="" style="width:100%">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['id'].'>'.$row['room_number'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                          
                                </div>




                               <label class="col-sm-2 col-form-label">Attendant Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_retPatientData['attendent_name'] ?>" name="attendantName" type="text" placeholder="Attendant Name" id="example-text-input">
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Advance Payment</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  name="advance_payment" type="number" placeholder="Advance Payment" id="example-text-input" required="">
                                </div>
                            </div><hr>
                           
                            <input type="hidden" name="category" value="currentPatient">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="patientRegister" class="btn btn-primary waves-effect waves-light">Add Patient</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <h3>
                        <?php echo $notAdded; ?>
                    </h3>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
</div> <!-- content -->
<?php include('../_partials/footer.php') ?>

</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
 <?php include('../_partials/jquery.php') ?>
<!-- App js -->
        <?php include('../_partials/app.php') ?>
        <?php include('../_partials/datetimepicker.php') ?>

<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
</script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});

             $('.attendant').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
        </script>
</body>

</html>