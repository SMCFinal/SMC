<?php 
    include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }
    include('../_partials/header.php');
?>
  <style type="text/css">  <link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css"></style>

<div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <h5 class="page-title">Floors</h5>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
                                            <h4 class="mt-0 header-title">Rooms</h4>   
                                            <a href="floor_new.php" type="button" class="btn btn-primary waves-effect waves-light text-white ml-auto" style="float: right;">Rooms Detials</a>

                                            <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Room No.</th>
                                                    <th>Floor No.</th>
                                                    <th>Room Price</th>
                                                    <th>Room Type</th>                                                   
                                                    <th class="text-center"> <i class="fa fa-eye"></i></th>
                                                    <th class="text-center"> <i class="fa fa-edit"></i></th>
                                                    <th  class="text-center"><i class="fa fa-trash"></i></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $retrieveRooms = mysqli_query($connect, "SELECT rooms.*, floors.floor_name FROM `rooms` INNER JOIN floors ON floors.id = rooms.floor_id");

                                                    $iteration = 1;

                                                    while ($rowRooms = mysqli_fetch_assoc($retrieveRooms)) {
                                                        
                                                        echo '
                                                        <tr>
                                                            <td>'.$iteration++.'</td>
                                                            <td>'.$rowRooms['room_number'].'</td>
                                                            <td>'.$rowRooms['floor_name'].'</td>
                                                            <td>'.$rowRooms['room_price'].'</td>';

                                                            if ($rowRooms['room_type'] == '1') {
                                                                echo '<td>'."Single Bedded".'</td>';    
                                                            }elseif ($rowRooms['room_type'] == '2') {
                                                                echo '<td>'."Double Bedded".'</td>';
                                                            }
                                                            
                                                            // <td></td>
                                                            
                                                             echo '<td class="text-center"><a href="room_view.php?id='.$rowRooms['id'].'" type="button" class="btn text-white btn-success waves-effect waves-light">View</a></td>
                                                            <td class="text-center"><a href="room_edit.php?id='.$rowRooms['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                                            <td class="text-center"><a type="button" id="sa-warning" class="btn text-white btn-danger waves-effect waves-light">Delete</a></td>
                                                        </tr>
                                                        ';
                                                    }
                                                    ?>
                                                
                                                </tbody>
                                            </table>
            
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

<!-- Required datatable js -->
        <?php include('../_partials/datatable.php') ?>
>

<!-- Buttons examples -->
        <?php include('../_partials/buttons.php') ?>

<!-- Responsive examples -->
        <?php include('../_partials/responsive.php') ?>

<!-- Datatable init js -->
        <?php include('../_partials/datatableInit.php') ?>

<!-- Sweet-Alert  -->
        <?php include('../_partials/sweetalert.php') ?>

<!-- App js -->
        <?php include('../_partials/app.php') ?>

    </body>
</html>