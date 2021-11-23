<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT patient_registration.room_id, rooms.* FROM `patient_registration`
    INNER JOIN rooms ON rooms.id = patient_registration.room_id
    WHERE patient_registration.id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    $error = '';

    if (isset($_POST['updateRoom'])) {
        $id = $_POST['id'];
        $roomUpdate = $_POST['roomUpdate'];
        $oldRoomId = $_POST['roomTypeUpdate'];

        

        $updateOldRoom = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$oldRoomId'");
        $updateNewRoom = mysqli_query($connect, "UPDATE patient_registration SET room_id = '$roomUpdate' WHERE id = '$id'");
        $updateNewRoomStatus = mysqli_query($connect, "UPDATE rooms SET status = '0' WHERE id = '$roomUpdate'");



        if (!$updateNewRoomStatus) {
            $error = 'Not Updated';
        }else {
            header("LOCATION: patients_list.php");
        }

    }

    include('../_partials/header.php');
?>
                <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                   
                                    <h5 class="page-title">Update Patient Room</h5>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">                                           
            								<form method="POST">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Room No.</label>
                                                    <div class="col-sm-4"> 

                                                    <?php
                                                        $select_option = mysqli_query($connect, "SELECT * FROM rooms WHERE status = '1'");
                                                            $options = '<select class="form-control select2" name="roomUpdate" required="" style="width:100%">';
                                                              while ($row = mysqli_fetch_assoc($select_option)) {
                                                                $options.= '<option value='.$row['id'].'>'.$row['room_number'].'</option>';
                                                              }
                                                            $options.= "</select>";
                                                        echo $options;
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
                                                  

                                             <button type="submit" name="updateRoom" class="btn btn-primary waves-effect waves-light">Update Room</button>
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

             $('.attendant').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
        </script>
       

    </body>
</html>