<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT patient_registration.room_id, rooms.*, patient_registration.patient_consultant, patient_registration.patient_operation FROM `patient_registration`
    INNER JOIN rooms ON rooms.id = patient_registration.room_id
    WHERE patient_registration.id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    $error = '';

    if (isset($_POST['updateSur'])) {
        $id = $_POST['id'];
        $consultant = $_POST['patientConsultant'];
        $surgery = $_POST['surgery'];

        $updateNewSur = mysqli_query($connect, "UPDATE patient_registration 
            SET 
            patient_consultant = '$consultant', 
            patient_operation = '$surgery'
            WHERE id = '$id'");

        if (!$updateNewSur) {
            $error = 'Not Updated';
        }else {
            header("LOCATION: patients_list.php");
        }

    }

    include('../_partials/header.php');
?>
                    <div class="page-content-wrapper ">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="page-title">Update Patient Surgery Record</h5>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">                                           
            								<form method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Surgery Name</label>
                                                <div class="col-sm-4">
                                                    <?php
                                                    $select_option_specialist = mysqli_query($connect, "SELECT * FROM `surgeries`  where status='1' GROUP BY surgery_name");
                                                        $optionsSurgery = '<select class="form-control another" name="surgery" required="" id="surgery" style="width:100%">';
                                                          while ($rowSurgery = mysqli_fetch_assoc($select_option_specialist)) {
                                                            if ($fetch_selectQuery['patient_operation'] === $rowSurgery['id']) {
                                                                $optionsSurgery.= '<option value='.$rowSurgery['id'].' selected>'.$rowSurgery['surgery_name'].'</option>';
                                                            }else {
                                                                $optionsSurgery.= '<option value='.$rowSurgery['id'].'>'.$rowSurgery['surgery_name'].'</option>';
                                                            }
                                                          }
                                                        $optionsSurgery.= "</select>";
                                                    echo $optionsSurgery;
                                                    ?>
                                                </div>


                                                <label class="col-sm-2 col-form-label">Refered by / Consultant</label>
                                                <div class="col-sm-4">
                                                <?php
                                                $selectDoctor = mysqli_query($connect, "SELECT staff_members.id AS staffID, staff_members.*, staff_category.* FROM `staff_members`
                                                INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                                WHERE staff_members.status = '1' AND staff_category.category_name = 'Doctor'");
                                                    $optionsDoctor = '<select class="form-control select2" name="patientConsultant" required="" style="width:100%">';
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
                                                <div class="col-sm-10">
                                                    <input class="form-control" value="<?php echo $fetch_selectQuery['id'] ?>" type="hidden" name="roomTypeUpdate" id="example-text-input">
                                                </div>
                                            </div>

                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                            <div class="form-group row">
                                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                <?php include('../_partials/cancel.php') ?>
                                                  
                                                <button type="submit" name="updateSur" class="btn btn-primary waves-effect waves-light">
                                                    Update Record
                                                </button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                        <h3><?php echo $error ?></h3>
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

        <script type="text/javascript" src="../assets/js/select2.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});

             $('.attendent').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});

                          $('.another').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
        </script>
       

    </body>
</html>