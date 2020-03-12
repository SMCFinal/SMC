<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $error = '';
    $alreadyExist = '';

    if (isset($_POST['addRoom'])) {
        $roomNo = $_POST['roomNo'];
        $floorNumber = $_POST['floorNo'];
        $roomPrice = $_POST['roomPrice'];
        $roomType = $_POST['roomType'];

        $selectQuery = mysqli_query($connect, "SELECT COUNT(*)AS CountedRooms FROM rooms WHERE room_number = '$roomNo'");
        $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

        if ($fetch_selectQuery['CountedRooms'] == 0) {
            $insertQuery = mysqli_query($connect, "INSERT INTO rooms(room_number, floor_id, room_price, room_type)VALUES('$roomNo', '$floorNumber', '$roomPrice', '$roomType')");

            if (!$insertQuery) {
                $error = 'Room Not Added!';
            }else {
                header("LOCATION:rooms_list.php");
            }
        }else {
            $alreadyExist = 'Room Already Exist';
        }

    }

    include('../_partials/header.php');
?>
                <!-- Top Bar End -->

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="page-title">Add New Room</h5>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title text-center ">Room Details</h4>
                                           
            								<form method="POST">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Room No.</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="roomNo" type="text" value="" id="example-text-input">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- <label class="col-sm-2 col-form-label">Floor No.</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="floorNo">
                                                        <option>Floor #1</option>
                                                        <option>Floor #2</option>
                                                    </select>
                                                </div> -->
                                                <!-- <label class="col-sm-2 col-form-label">Floor No.</label> -->
                                                <label class="col-sm-2 col-form-label">Floor No.</label>
                                                     <div class="col-sm-10">
                                                <?php
                                                    $select_option = mysqli_query($connect, "SELECT * FROM floors");
                                              
                                                        $options = '<select class="form-control select2"  name="floorNo" required="" style="width:100%">';
                                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                                            $options.= '<option value='.$row['id'].'>'.$row['floor_name'].'</option>';
                                                          }
                                                        $options.= "</select>";
                                                  
                                                    echo $options;
                                                ?>
                                            </div>
                                        </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Room Price</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="roomPrice" type="number" value="" id="example-text-input">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Room Type</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2" name="roomType">
                                                        <option value="1">Single Bedded</option>
                                                        <option value="2">Double Bedded</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                  <?php include('../_partials/cancel.php') ?>

                                             <button type="submit" name="addRoom" class="btn btn-primary waves-effect waves-light">Add Room</button>
                                                </div>
                                            </div>
                                        </form>
                                        <h4><?php echo $alreadyExist ?></h4>                                            
                                        <h4><?php echo $error ?></h4>                                            
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
        <script type="text/javascript" src="../assets/js/select2.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
        </script>
    

    </body>
</html>