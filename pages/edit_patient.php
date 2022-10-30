<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $org = $_GET['org'];

    if ($org === 'Sehat') {
        $org = 'Sehat Card';
    }else {
        $org = $org;
    }


    $id = $_GET['id'];

    $selectQueryPatient = mysqli_query($connect, "SELECT * FROM patient_registration WHERE id = '$id'");

    $fetch_selectQueryPatient = mysqli_fetch_assoc($selectQueryPatient); 
    
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





    if (isset($_POST['patientEdit'])) {
        $yearlyNumber = $_POST['patientYearlyNumber'];

        $patient = $_POST['patientName'];
        $name = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($patient))));


        $Age = $_POST['patientAge'];
        $Gender = $_POST['patientGender'];

        $disease_small = $_POST['patientDisease'];
        $disease = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($disease_small))));

        $address_small = $_POST['patientAddress'];
        $Address = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($address_small))));

        $address_city = $_POST['address_city'];
        $DateOfAdmission = $_POST['patientDateOfAdmission'];
        $consultant = $_POST['patientConsultant'];
        $patientRoom = $_POST['patientRoom'];

        $attendant = $_POST['attendantName'];
        $attendantName = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($attendant))));

        $patient_cnic = $_POST['patientCnic'];
        $patient_contact = $_POST['patientContact'];
        $advance_payment = $_POST['advance_payment'];
        $autoDate = $_POST['autoDate'];
        $organization = $_POST['organization'];

        $patCategory = $_POST['patCategory'];
        $visitId = $_POST['visitId'];
        $id = $_POST['id'];

        $oldRoomId = $_POST['oldRoomId'];

        $currentPatient = 'currentPatient';

        if(empty($visitId)) {
            $visitId = '0';
        }

    
        //  Changes Need to modify
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

        
        $queryEditPatient = mysqli_query($connect,
            "UPDATE patient_registration SET 
            patient_name = '$name', 
            patient_age = '$Age', 
            patient_gender = '$Gender', 
            patient_address = '$Address', 
            city_id = '$address_city',
            room_id = '$patientRoom', 
            patient_doa = '$DateOfAdmission', 
            patient_disease = '$disease', 
            patient_consultant = '$consultant', 
            attendent_name = '$attendantName', 
            patient_cnic = '$patient_cnic',
            patient_contact = '$patient_contact',
            advance_payment = '$advance_payment',
            organization = '$organization',
            pat_category = '$patCategory',
            visit_id = '$visitId'
            WHERE id = '$id'
           ");

        

        if (!$queryEditPatient) {
            $notAdded = '<div class="alert alert-danger text-center" style="color: red !important" role="alert">Not Updated!</div>';
        }else {
            $updateOldRoom = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$oldRoomId'");
            $updateRoom = mysqli_query($connect, "UPDATE rooms SET status = '0' WHERE id = '$patientRoom'");
            header("LOCATION: patient_view.php?id=".$id."");
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
                <h5 class="page-title">Edit Patient</h5>
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
                            
                            <input type="hidden" name="oldRoomId" value="<?php echo $fetch_selectQueryPatient['room_id'] ?>">
                            <input type="hidden" name="autoDate" value="<?php echo $autoDate ?>">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 offset-sm-6 col-form-label">M.R No.</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text"
                                        value="<?php echo $fetch_selectQueryPatient['patient_yearly_no'] ?>" placeholder="Yearly No."
                                        name="patientYearlyNumber" id="example-text-input" readonly>
                                </div>
                            </div>
                            <h4 class="mb-4 page-title"><u>Patient Details</u></h4>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Organization</label>
                                <div class="col-sm-4">
                                    <?php
                                        $select_option_city = mysqli_query($connect, "SELECT * FROM select_organization");
                                            $optionsCity = '<select class="form-control Orgselect2" name="organization" id="organization" onchange=checkOrganization() required="" style="width:100%">';
                                            $sehatCard = 'Sehat';
                                              while ($rowCity = mysqli_fetch_assoc($select_option_city)) {
                                                if ($org === $rowCity['org_name']) {
                                                    $optionsCity.= '<option value='.$rowCity['org_name'].' selected>'.$rowCity['org_name'].'</option>';
                                                }else {
                                                    $optionsCity.= '<option value='.$rowCity['org_name'].'>'.$rowCity['org_name'].'</option>';
                                                }
                                              }
                                            $optionsCity.= "</select>";
                                        echo $optionsCity;
                                    ?>
                                </div>

                                <label class="col-sm-2 col-form-label">Select Category</label>
                                <div class="col-sm-4">
                                    <select name="patCategory" class="form-control Orgselect2">
                                        <?php
                                        if ($fetch_selectQueryPatient['pat_category'] === '1') {
                                            echo 
                                            '<option value="1" selected>Ellective Patient</option>
                                            <option value="2">Emergency Patient</option>';
                                        }else {
                                            echo 
                                            '<option value="1">Ellective Patient</option>
                                            <option value="2" selected>Emergency Patient</option>';
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>


                            <?php
                            if (empty($fetch_selectQueryPatient['visit_id']) OR $fetch_selectQueryPatient['visit_id'] === '0') {
                                
                            }else {
                                echo '
                                <div class="form-group row" id="visitId">
                                    <label class="col-sm-2 col-form-label">Visit ID / No</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" value="'.$fetch_selectQueryPatient['visit_id'].'" placeholder="Visit Id"
                                            name="visitId" required>
                                    </div>
                                </div>
                                ';
                            }
                            ?>

                            
                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientName" type="text"
                                        placeholder="Patient Name" value="<?php echo $fetch_selectQueryPatient['patient_name']  ?>" id="example-text-input" required="">
                                </div>

                                <label class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientAge" type="number"
                                        placeholder="Patient Age" value="<?php echo $fetch_selectQueryPatient['patient_age']  ?>" id="example-text-input" required="">
                                </div>

                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-4">

                                    <?php
                                    
                                    if ($fetch_selectQueryPatient['patient_gender'] === '1') {
                                        echo '
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" checked value="1"
                                                    name="patientGender">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="2"
                                                    name="patientGender">Female
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="3"
                                                    name="patientGender">Other
                                            </label>
                                        </div>
                                        ';
                                    }elseif ($fetch_selectQueryPatient['patient_gender'] === '2') {
                                        echo '
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"  value="1"
                                                    name="patientGender">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" checked value="2"
                                                    name="patientGender">Female
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="3"
                                                    name="patientGender">Other
                                            </label>
                                        </div>
                                        ';
                                    }elseif ($fetch_selectQueryPatient['patient_gender'] === '3') {
                                        echo '
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input"  value="1"
                                                    name="patientGender">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="2"
                                                    name="patientGender">Female
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" checked value="3"
                                                    name="patientGender">Other
                                            </label>
                                        </div>
                                        ';
                                    }
                                    
                                    ?>
                                </div>

                                <label class="col-sm-2 col-form-label">Case</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="patientDisease"
                                        placeholder="Patient Case" value="<?php echo $fetch_selectQueryPatient['patient_disease']  ?>" id="example-text-input" required="">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input type="text" id="textarea" value="<?php echo $fetch_selectQueryPatient['patient_address']  ?>" class="form-control" name="patientAddress"
                                        placeholder="Address" required="">
                                </div>
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-4">
                                    <?php
                                $select_option_city = mysqli_query($connect, "SELECT * FROM area");
                                    $optionsCity = '<select class="form-control select2" name="address_city" required="" style="width:100%">';
                                      while ($rowCity = mysqli_fetch_assoc($select_option_city)) {
                                        if ($fetch_selectQueryPatient['city_id'] === $rowCity['id']) {
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
                                    <input type="number" value="<?php echo $fetch_selectQueryPatient['patient_cnic']  ?>" class="form-control" name="patientCnic" placeholder="CNIC"
                                        required="">
                                </div>
                                <label class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-4">
                                    <input type="number" value="<?php echo $fetch_selectQueryPatient['patient_contact']  ?>" class="form-control" name="patientContact"
                                        placeholder="Patient Contact" required="">
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
                                        <input class="form-control form_datetime" name="patientDateOfAdmission"
                                            value="<?php echo $fetch_selectQueryPatient['patient_doa'] ?>" placeholder="dd/mm/yyyy-hh:mm" autoclear=""
                                            required="">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i
                                                    class="mdi mdi-calendar"></i></span></div>
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
                                        if ($rowDoctor['staffID'] === $fetch_selectQueryPatient['patient_consultant']) {
                                            $optionsDoctor.= '<option value='.$rowDoctor['staffID'].' selected>'.$rowDoctor['name'].'</option>';
                                        }else {
                                            $optionsDoctor.= '<option value='.$rowDoctor['staffID'].'>'.$rowDoctor['name'].'</option>';
                                        }
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
                                            if ($row['id'] === $fetch_selectQueryPatient['room_id']) {
                                                $options.= '<option value='.$row['id'].' selected>'.$row['room_number'].'</option>';                                                
                                            }else {
                                                $options.= '<option value='.$row['id'].'>'.$row['room_number'].'</option>';
                                            }
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>

                                </div>

                                <label class="col-sm-2 col-form-label">Attendant Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="attendantName" type="text"
                                        placeholder="Attendant Name" value="<?php echo $fetch_selectQueryPatient['attendent_name'] ?>" id="example-text-input" required="">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Advance Payment</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_selectQueryPatient['advance_payment'] ?>" name="advance_payment" type="number"
                                        placeholder="Advance Payment" id="example-text-input" required="">
                                </div>
                            </div>
                            <hr>

                            <input type="hidden" name="category" value="currentPatient">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="patientEdit"
                                        class="btn btn-primary waves-effect waves-light">Edit Patient</button>
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
    allowClear: true
});

$('.Orgselect2').select2({
    placeholder: 'Select an option',
    allowClear: true
});
</script>



<script type="text/javascript">
function checkOrganization() {
    var option = document.getElementById('organization')
    var display = option.options[option.selectedIndex].text;

    if (display == 'Sehat Card' || display == 'sehat card') {
        document.querySelector('#visitId').style.display = '';
    } else {
        document.querySelector('#visitId').style.display = 'none';
    }
}
</script>
</body>

</html>