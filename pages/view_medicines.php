<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    include('../_partials/header.php');

    $id = $_GET['id'];

    $query = mysqli_query($connect, "SELECT surgeries.surgery_name FROM surgeries WHERE surgeries.id = $id");
    $fetch_query = mysqli_fetch_assoc($query);


?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Surgeries</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h2 class="mt-0 header-title">Surgery Medicines List for "<?php echo $fetch_query['surgery_name'] ?>"</h2>
                       
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine</th>
                                    <th>Quantity</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    <th class="text-center"> <i class="fa fa-eye"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $retSurgeries = mysqli_query($connect, "SELECT surgery_medicines.*, surgeries.surgery_name, medicine_category.category_name, add_medicines.medicine_name FROM surgery_medicines
                                                                        INNER JOIN surgeries ON surgeries.id = surgery_medicines.surgery_id
                                                                        INNER JOIN medicine_category ON medicine_category.id = surgery_medicines.cat_id
                                                                        INNER JOIN add_medicines ON add_medicines.id = surgery_medicines.med_id
                                                                        WHERE surgery_medicines.surgery_id = $id 
                                                                        ORDER BY add_medicines.medicine_name ASC");
                                $iteration = 1;

                                while ($rowretSurgeries = mysqli_fetch_assoc($retSurgeries)) {
                                    echo '
                                    <tr>
                                        <td>'.$iteration++.'</td>
                                        <td>'.$rowretSurgeries['category_name'].'. '.$rowretSurgeries['medicine_name'].'</td>
                                        <td>'.$rowretSurgeries['med_qty'].'</td>
                                        <td class="text-center">
                                            <a href="edit_meds.php?id='.$rowretSurgeries['surg_med_id'].'&surg_id='.$id.'" type="button" class="btn text-white btn-success waves-effect waves-light">Edit Medicine!</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="delete_meds.php?id='.$rowretSurgeries['surg_med_id'].'&surg_id='.$id.'" type="button" class="btn text-white btn-danger waves-effect waves-light">Delete Medicine!</a>
                                        </td>
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
<!-- Datatable init js -->
<?php include('../_partials/datatableInit.php') ?>
<!-- Buttons examples -->
<?php include('../_partials/buttons.php') ?>
<!-- App js -->
<?php include('../_partials/app.php') ?>
<!-- Responsive examples -->
<?php include('../_partials/responsive.php') ?>
<!-- Sweet-Alert  -->
<?php include('../_partials/sweetalert.php') ?>
</body>

</html>