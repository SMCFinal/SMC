<?php
   include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $selectQuery = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name, staff_members.salary FROM `patient_registration` INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant WHERE patient_registration.id = '$id'");
    
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);


    $notAdded = '';

    if (isset($_POST["addsurgery"])) {
        $id = $_POST['id'];
        $patientDateOfsurgery = $_POST['patientDateOfsurgery'];
        
        $surgery = $_POST['surgery'];
        $name = $_POST['name'];
        
        $consCharges = $_POST['ConsultantPrice'];
        
        $anesthesiaSpecialist = $_POST['specialist'];
        $anesthesia_charges = $_POST['anesthesia_charges'];
        
        
        $patientConsultant = $_POST['patientConsultant'];

        $setDoctorMessage = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$patientConsultant'");
        $fetch_setDoctorMessage = mysqli_fetch_assoc($setDoctorMessage);
        $doctorContact = "0".$fetch_setDoctorMessage['contact'];

        $setAnesthesiaMessage = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$anesthesiaSpecialist'");
        $fetch_setAnesthesiaMessage = mysqli_fetch_assoc($setAnesthesiaMessage);
        $anesthesiaContact = "0".$fetch_setAnesthesiaMessage['contact'];

        $setSurgeries = mysqli_query($connect, "SELECT * FROM `surgeries` WHERE id = '$surgery'");
        $fetch_setSurgeries = mysqli_fetch_assoc($setSurgeries);
        $setSurgeryName = $fetch_setSurgeries['surgery_name'];

        $message = "Patient ".$name." has been admitted for ".$setSurgeryName." surgery. "." SMC";

        $zakriyaContact = '03464120026';
        $contact_one = '03466459796';
        // $contact_third = '03359967977';


        $insertMessageDoctor = mysqli_query($connect, "INSERT INTO message_tbl(from_device, to_device, message_body)VALUES('1', '$doctorContact', '$message')");

        $insertMessageAnesthesia = mysqli_query($connect, "INSERT INTO message_tbl(from_device, to_device, message_body)VALUES('1', '$anesthesiaContact', '$message')");


        $insertMessageZakriya = mysqli_query($connect, "INSERT INTO message_tbl(from_device, to_device, message_body)VALUES('1', '$zakriyaContact', '$message')");

        $insertMessageSec = mysqli_query($connect, "INSERT INTO message_tbl(from_device, to_device, message_body)VALUES('1', '$contact_one', '$message')");

        // $insertMessageThird = mysqli_query($connect, "INSERT INTO message_tbl(from_device, to_device, message_body)VALUES('1', '$contact_third', '$message')");
        
        $updateQuery = mysqli_query($connect, 
            "UPDATE patient_registration SET 
            patient_doop = '$patientDateOfsurgery', 
            patient_operation = '$surgery',  
            consultant_charges = '$consCharges', 
            anasthetic_name = '$anesthesiaSpecialist', 
            anesthesia_charges = '$anesthesia_charges',
            patient_consultant = '$patientConsultant'
            WHERE id = '$id'");

        if (!$updateQuery) {
            echo "<h1>".mysqli_error($connect)."</h1>";
            $notAdded = '<h1>Not Added! Try Again.</h1>';
        }else {
            header("LOCATION:patient_view.php?id=".$id."");
        }
        
    }


    include('../_partials/header.php');
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Assign Surgery</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"><u>Surgery Details</u></h4>
                        <form method="POST">
                            <div class="form-group row">
                                <label for="patient Name" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo $fetch_selectQuery['patient_name'] ?>" readonly placeholder=""  type="text" name="ptaient_name" id="">
                                    <input class="form-control"  value="<?php echo $fetch_selectQuery['patient_name'] ?>" type="hidden" name="name" id="">
                                </div>
                                <label class="col-sm-2 col-form-label">Date of Surgery</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="patientDateOfsurgery" placeholder="dd/mm/yyyy-hh:mm" required="" autoclear="">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Surgery Name</label>
                                <div class="col-sm-4">
                                    <?php
                                    $select_option_specialist = mysqli_query($connect, "SELECT * FROM `surgeries`  where status='1' GROUP BY surgery_name");
                                        $optionsSurgery = '<select class="form-control surgery_name" name="surgery" required="" id="surgery" style="width:100%">';
                                          while ($rowSurgery = mysqli_fetch_assoc($select_option_specialist)) {
                                            $optionsSurgery.= '<option value='.$rowSurgery['id'].'>'.$rowSurgery['surgery_name'].'</option>';
                                          }
                                        $optionsSurgery.= "</select>";
                                    echo $optionsSurgery;
                                    ?>
                                </div>

                                <!-- <label class="col-sm-2 col-form-label">Consultant</label> -->
                                <!-- <div class="col-sm-4"> -->
                                    <label for="patient Name" class="col-sm-2 col-form-label">Consultant</label>
                                <div class="col-sm-4">
                                
                                <?php
                                // print_r($fetch_selectQuery['patient_consultant']);
                                $selectDoctor = mysqli_query($connect, "SELECT staff_members.id AS staffID, staff_members.*, staff_category.* FROM `staff_members`
                                INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                WHERE staff_members.status = '1' AND staff_category.category_name = 'Doctor'");
                                    $optionsDoctor = '<select class="form-control surgery_name" name="patientConsultant" required="" style="width:100%">';
                                      while ($rowDoctor = mysqli_fetch_assoc($selectDoctor)) {

                                        if ($fetch_selectQuery['patient_consultant'] === $rowDoctor['staffID']) {
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
                                <label for="example-email-input" class="col-sm-2 col-form-label">Consultant Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" required  type="number" value="<?php echo $fetch_selectQuery['salary'] ?>" name="ConsultantPrice"  placeholder="Doctor Charges" id="example-email-input">
                                </div>
                            </div><hr>
                            <h4 class="mt-0 header-title"><u>Anasthesia</u></h4>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Anesthesia Name</label>
                                <div class="col-sm-4">
                                    <!-- <select class="form-control consultant" name="specialist" required="" id="specialist" style="width:100%"></select> -->
                                <?php
                                    $select_option_specialist = mysqli_query($connect, "SELECT staff_members.*, staff_category.category_name FROM `staff_members` 
                                        INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                        WHERE staff_category.category_name LIKE 'An%'");
                                        $optionsSurgery = '<select class="form-control consultant" name="specialist" required="" id="specialist" style="width:100%">';
                                          while ($rowSurgery = mysqli_fetch_assoc($select_option_specialist)) {
                                            $optionsSurgery.= '<option value='.$rowSurgery['id'].'>'.$rowSurgery['name'].'</option>';
                                          }
                                        $optionsSurgery.= "</select>";
                                    echo $optionsSurgery;
                                ?>
                                </div>
                                <label for="example-text-input" class="col-sm-2 col-form-label">Anesthesia Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Anesthesia Charges"  required type="number" name="anesthesia_charges" id="anesthesiaCharges">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="addsurgery" class="btn btn-primary waves-effect waves-light">Add Surgery</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 align="center">
                    <?php 
                    // echo $userAlreadyinDatabase;
                     ?>
                </h3>
                <h3 align="center">
                    <?php 
                    // echo $userAdded;
                     ?>
                </h3>
                <h3 align="center">
                    <?php 
                    // echo $userNotAdded;
                     ?>
                </h3>
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
$('.surgery_name').select2({
    placeholder: 'Select Option',
    allowClear: true

});
$('.consultant').select2({
    placeholder: 'Consultant Name',
    allowClear: true

});


</script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        var a = document.getElementById('surgery')
      $('#surgery').change(function(){
        var specialistData = $(this).val();
        console.log(specialistData)
        var selectedText = $("#surgery option:selected").html();
        $.ajax({
          url:"getConsultant.php",
          method:"POST",
          data:{
            surgeryData:selectedText
          },
          dataType:"text",
          success:function(data){
            $('#specialist').html(data);
            console.log(data);
          }
        });
      });
    });
  </script> -->

  <script type="text/javascript">
    $(document).ready(function(){
      $('#specialist').change(function(){
        var AnesthesiaData = $(this).val();
        console.log(AnesthesiaData)
        $.ajax({
          url:"getAnesthesiaCharges.php",
          method:"POST",
          data:{
            AnesData:AnesthesiaData
          },
          dataType:"text",
          success:function(data){
            $('#anesthesiaCharges').val(data);
          }
        });
      });
    });
  </script>


</body>

</html>