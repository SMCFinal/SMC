<?php
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT * FROM rooms WHERE id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    $error = '';

    if (isset($_POST['updateRoom'])) {
        $id = $_POST['id'];
        $roomUpdate = $_POST['roomUpdate'];
        $floorUpdate = $_POST['floorUpdate'];
        $room = $_POST['roomUpdate'];
        $priceUpdated = $_POST['priceUpdated'];
        $roomTypeUpdate = $_POST['roomTypeUpdate'];

        
        $updateRoomDetail = mysqli_query($connect, "UPDATE rooms SET room_number = '$roomUpdate', floor_id = '$floorUpdate', room_price = '$floorUpdate', room_type = '$roomTypeUpdate' WHERE id = '$id'");
        echo "UPDATE rooms SET room_number = '$roomUpdate', floor_id = '$floorUpdate', room_price = '$floorUpdate', room_type = '$roomTypeUpdate' WHERE id = '$id'";

        if (!$updateRoomDetail) {
            $error = 'Not Updated';
        }else {
            header("LOCATION: rooms_list.php");
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
            
                                            <h4 class="mt-0 header-title text-center">Room Details</h4>
                                           
            								<form method="POST">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Room No.</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" value="<?php echo $fetch_selectQuery['room_number'] ?>" type="text" name="roomUpdate" id="example-text-input">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                            <div class="row">
                                            <div class="col-md-10">
                                            <?php
                                                $select_option = mysqli_query($connect, "SELECT * FROM floors");
                                                    $options = '<select class="form-control" name="floorUpdate" required="">';
                                                      while ($row = mysqli_fetch_assoc($select_option)) {
                                                        if ($fetch_selectQuery['floor_id'] = $row['id']) {
                                                            $options.= '<option value='.$row['id'].'>'.$row['floor_name'].'</option>';
                                                        }else {
                                                        $options.= '<option value='.$row['id'].'>'.$row['floor_name'].'</option>';
                                                        }
                                                      }
                                                    $options.= "</select>";
                                                echo '<label class="col-sm-2 col-form-label">Floor No.</label>'.$options;
                                            ?>
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Room Price</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" name="priceUpdated" value="<?php echo $fetch_selectQuery['room_price'] ?>" id="example-text-input">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Room Type</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="roomTypeUpdate">
                                                        <?php
                                                        if ($fetch_selectQuery['room_type'] == 1) {
                                                            echo '
                                                                <option value="1">Single Bedded</option>
                                                                <option value="2">Double Bedded</option>
                                                            ';
                                                        }else {
                                                            echo '
                                                                <option value="2">Double Bedded</option>
                                                                <option value="1">Single Bedded</option>
                                                            ';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
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
       

    </body>
</html>