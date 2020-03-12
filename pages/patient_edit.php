<?php
    include('../_stream/config.php');
    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $user = $_SESSION["user"];

    $selectSystemUser = mysqli_query($connect, "SELECT id FROM login_user WHERE email = '$user'");
    $fetch_selectSystemUser  = mysqli_fetch_assoc($selectSystemUser);

    $userId = $fetch_selectSystemUser['id'];

    $id = $_GET['id'];

    $selectPatientData = mysqli_query($connect, "SELECT *  FROM patient_registration WHERE category = 'currentPatient' AND id = '$id'");
    $fetch_selectPatientData = mysqli_fetch_assoc($selectPatientData);

    $notUpdated = "";

    if (isset($_POST['patientUpdate'])) {
        $name = $_POST['patientName'];
        $RegNo = $_POST['patientRegNo'];
        $Age = $_POST['patientAge'];
        $Gender = $_POST['patientGender'];
        $Address = $_POST['patientAddress'];
        $DateOfAdmission = $_POST['patientDateOfAdmission'];
        $DateOfOperation = $_POST['patientDateOfOperation'];
        $disease = $_POST['patientDisease'];
        $operation = $_POST['patientOperation'];
        $consultant = $_POST['patientConsultant'];
        
        $id = $_POST['id'];
        $userId = $_POST['UserId'];

        $queryAddPatient = mysqli_query($connect, "UPDATE patient_registration SET
            patient_name = '$name',
            reg_no = '$RegNo',
            patient_age = '$Age', 
            patient_gender = '$Gender',
            patient_address = '$Address',
            patient_doa = '$DateOfAdmission', 
            patient_doop = '$DateOfOperation',
            patient_disease = '$disease',
            patient_operation = '$operation', 
            patient_consultant = '$consultant',
            updated_by = '$userId'
            
            WHERE id = '$id';
        ");

        if (!$queryAddPatient) {
            $notUpdated = "Not Updated!";
        }else {
            header("LOCATION: patients_list.php");
        }
    }


    include('../_partials/header.php') 
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active">Form Elements</li>
                    </ol>
                </div>
                <h5 class="page-title">Edit / Update Patient</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Heading</h4>
                        <p class="text-muted m-b-30 font-14">Example Text</p>
                        <form method="POST">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="patientName" type="text" value="<?php echo $fetch_selectPatientData['patient_name'] ?>" placeholder="Patient Name" id="example-text-input">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="UserId" value="<?php echo $userId ?>">

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Registration No.</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="patientRegNo" value="<?php echo $fetch_selectPatientData['reg_no'] ?>" type="text" value="" placeholder="Patient Registration No." id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="patientAge" type="number" value="<?php echo $fetch_selectPatientData['patient_age'] ?>" placeholder="Patient Age" value="" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <?php 
                                    if ($fetch_selectPatientData['patient_gender'] == 1) {
                                    echo '
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked="" value="1" name="patientGender">Male
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
                                    }elseif ($fetch_selectPatientData['patient_gender'] == 2) {
                                    echo '
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="1" name="patientGender">Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked="" value="2" name="patientGender">Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="3" name="patientGender">Other
                                        </label>
                                    </div>
                                    ';
                                    }elseif ($fetch_selectPatientData['patient_gender'] == 3) {
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
                                            <input type="radio" class="form-check-input" checked="" value="3" name="patientGender">Other
                                        </label>
                                    </div>
                                    ';
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="textarea" class="form-control" name="patientAddress" maxlength="225" rows="3" placeholder="Address"><?php echo $fetch_selectPatientData['patient_address'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Date of Admission</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="patientDateOfAdmission" placeholder="mm/dd/yyyy" id="datepicker-autoclose" value="<?php echo $fetch_selectPatientData['patient_doa'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Date of Operation</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="date" class="form-control" value="<?php echo $fetch_selectPatientData['patient_doop'] ?>" name="patientDateOfOperation" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Disease</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="<?php echo $fetch_selectPatientData['patient_disease'] ?>" name="patientDisease" placeholder="Disease Name" value="" id="example-text-input">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Operation</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="patientOperation">
                                        <?php
                                            if ($fetch_selectPatientData['patient_operation'] == 'Apendix') {
                                                echo '

                                        <option value="Apendix">Apendix</option>
                                                ';
                                            }else {
                                                echo '
                                        <option value="Hearast Bypass">Heart Bypass</option>

                                                ';
                                            }
                                        ?>
                                        <option value="Apendix">Apendix</option>
                                        <option value="Heart Bypass">Heart Bypass</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Consultant</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="patientConsultant">
                                        <option value="Dr. Habib">Dr. Habib</option>
                                        <option value="Dr. Taj Muhammad">Dr. Taj Muhammad</option>
                                        <option value="Dr. Aman Ullah">Dr. Aman Ullah</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="category" value="currentPatient">

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Yearly No.</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" value="<?php echo $newPatient ?>" placeholder="Yearly No." name="patientYearlyNumber" id="example-text-input" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="patientUpdate" class="btn btn-primary waves-effect waves-light">Update Patient</button>
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
 <?php    include('../_partials/jquery.php') ?> 
 <!-- App js -->
 <?php    include('../_partials/app.php') ?> 

</body>

</html>