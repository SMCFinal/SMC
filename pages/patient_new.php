<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $notAdded = '';
    $alreadyAddedPat = '';

    $date = date_default_timezone_set('Asia/Karachi');
    $currentYear = date('Y');
    $currentYearNewPatient = date('Y-');

    $pickYearly = mysqli_query($connect, "SELECT COUNT(*)AS yearlyCounted FROM `patient_registration` WHERE auto_date LIKE '%$currentYear%'");
    $fetch_pickYearly = mysqli_fetch_assoc($pickYearly);


    $pickYearlyPostpone = mysqli_query($connect, "SELECT COUNT(*)AS yearlyPostponeCounted FROM `postpone_patient` WHERE patient_doa LIKE '%$currentYear%'");
    $fetch_pickYearlyPostpone = mysqli_fetch_assoc($pickYearlyPostpone);



    $pickYearlyDischarge = mysqli_query($connect, "SELECT COUNT(*)AS yearlyDischargeCounted FROM discharge_patients WHERE patient_doa LIKE '%$currentYear%'");
    $fetch_pickYearlyDischarge = mysqli_fetch_assoc($pickYearlyDischarge);
    
    $yearlyCountedPatients = ($fetch_pickYearly['yearlyCounted'] + $fetch_pickYearlyPostpone['yearlyPostponeCounted']) + $fetch_pickYearlyDischarge['yearlyDischargeCounted'];

    $newPatient = $currentYearNewPatient."0".($yearlyCountedPatients + 1);


    $autoDate = date('Y-m-d');


    // O
    $fetch_pickYearlyPostpone['yearlyPostponeCounted'];

    // 1
    $fetch_pickYearly['yearlyCounted'];

    $fetch_pickYearlyDischarge['yearlyDischargeCounted'];





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
        $autoDate = $_POST['autoDate'];
        $organization = $_POST['organization'];

        $currentPatient = 'currentPatient';

    
        //  Chnages Need to modify
        $patient_doop = '0000-00-00';
        $patient_operation = '0';
        $consultant_charges = '0';
        $anasthetic_name = '0';
        $anesthesia_charges = '0';
        $added_by = '0';
        $updated_by = '0';

        if (empty($advance_payment)) {
            $advance_payment = '0';
        }
        
        // Till here

        $checkQueryPatient = mysqli_query($connect, "SELECT COUNT(*) AS countedContacts FROM patient_registration WHERE patient_contact = '$patient_contact'");

        $fetch_checkQueryPatient = mysqli_fetch_assoc($checkQueryPatient);
        $counted = $fetch_checkQueryPatient['countedContacts'];
        
        if ($counted > 0) {
            $alreadyAddedPat = '
                <div class="alert alert-danger text-center" style="color: red !important" role="alert">
                  Patient Contact Already added!
                </div>';
        }else {
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
            auto_date,
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
            '$autoDate',
            '$organization'
            )
           ");

        $description = "Dear ".$attendantName.", your patient has been admitted. Thank You! SMC";
                
        $insertMsg = mysqli_query($connect, "INSERT INTO message_tbl
            (from_device, to_device, message_body, status)
            VALUES
            ('1', '$patient_contact', '$description', '1')");

        $description_one = "New Patient ".$name.", (".$organization.") has been admitted! Thank You! FROM: SMC";

        $contact_one = '03466459796';
        $contact_sec = '03464120026';
        $contact_third = '03420478990';

        $insertMsgOne =  mysqli_query($connect, "INSERT INTO message_tbl
            (from_device, to_device, message_body, status)
            VALUES
            ('1', '$contact_one', '$description_one', '1')");

        $insertMsgSec =  mysqli_query($connect, "INSERT INTO message_tbl
            (from_device, to_device, message_body, status)
            VALUES
            ('1', '$contact_sec', '$description_one', '1')");

        $insertMsgThird =  mysqli_query($connect, "INSERT INTO message_tbl
            (from_device, to_device, message_body, status)
            VALUES
            ('1', '$contact_third', '$description_one', '1')");

        if (!$queryAddPatient) {
            $notAdded = '<div class="alert alert-danger text-center" style="color: red !important" role="alert">Not added</div>';
        }else {
            $updateRoom = mysqli_query($connect, "UPDATE rooms SET status = '0' WHERE id = '$patientRoom'");
            header("LOCATION: patients_list.php");
        }
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
                <h5 class="page-title">Add New Patient</h5>
            </div>
        </div>

        <h5>
            <?php echo $notAdded; ?>
            <?php echo $alreadyAddedPat; ?>
        </h5>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="autoDate" value="<?php echo $autoDate ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 offset-sm-6 col-form-label">M.R No.</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="<?php echo $newPatient ?>" placeholder="Yearly No." name="patientYearlyNumber" id="example-text-input" readonly>
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
                                    <input class="form-control" name="patientName" type="text" placeholder="Patient Name" id="example-text-input" required="">
                                </div>

                                 <label class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientAge" type="number" placeholder="Patient Age" value="" id="example-text-input" required="">
                                </div>
                              
                            </div>
                            <div class="form-group row">
                               
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">
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
                                            <input type="radio" class="form-check-input" value="3" name="patientGender">Other
                                        </label>
                                    </div>
                                </div>

                                <label class="col-sm-2 col-form-label">Case</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="patientDisease" placeholder="Patient Case" value="" id="example-text-input" required="">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input type="text" id="textarea" class="form-control" name="patientAddress" placeholder="Address" required="">
                                </div>
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-4">
                                <?php
                                $select_option_city = mysqli_query($connect, "SELECT * FROM area");
                                    $optionsCity = '<select class="form-control select2" name="address_city" required="" style="width:100%">';
                                      while ($rowCity = mysqli_fetch_assoc($select_option_city)) {
                                        $optionsCity.= '<option value='.$rowCity['id'].'>'.$rowCity['area_name'].'</option>';
                                      }
                                    $optionsCity.= "</select>";
                                echo $optionsCity;
                                ?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">CNIC</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="patientCnic" placeholder="CNIC" required="">
                                </div>
                                <label class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="patientContact" placeholder="Patient Contact" required="">
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
                                        <input  class="form-control form_datetime" name="patientDateOfAdmission" value="<?php echo $date ?>" placeholder="dd/mm/yyyy-hh:mm" autoclear="" required="">
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
                                    <input class="form-control" name="attendantName" type="text" placeholder="Attendant Name" id="example-text-input" required="">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Advance Payment</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="advance_payment" type="number" placeholder="Advance Payment" id="example-text-input" required="">
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
  allowClear: true
  
});

$('.attendant').select2({
  placeholder: 'Select an option',
  allowClear:true
});

$('.Orgselect2').select2({
  placeholder: 'Select an option',
  allowClear:true
});
</script>
</body>

</html>