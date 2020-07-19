<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    if (isset($_POST['AddDoctor'])) {
        $id = $_POST['doctor'];
        header("LOCATION: doctor_surgery_charges_list.php?id=".$id."");
    }

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Doctor Surgery </h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title">Test Details</h4> -->
                        <form method="POST">
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select Doctor</label>
                                <div class="col-sm-4"> 

                                <?php
                                    $select_option = mysqli_query($connect, "SELECT staff_members.id AS dId, staff_members.*, staff_category.* FROM `staff_members`
                                        INNER JOIN staff_category ON staff_category.id = staff_members.category_id
                                        WHERE staff_category.category_name = 'Doctor' OR staff_category.category_name = 'Dr' OR staff_category.category_name = 'DR' OR staff_category.category_name = 'DOCTOR' OR staff_category.category_name = 'dr'");
                                        $options = '<select class="form-control select2" name="doctor" required="" style="width:100%">';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['dId'].'>Dr. '.$row['name'].' - 0'.$row['contact'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                          
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="AddDoctor" class="btn btn-primary waves-effect waves-light">Select Doctor</button>
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
<?php include '../_partials/footer.php'?>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<?php include '../_partials/jquery.php'?>
<!-- App js -->
<?php include '../_partials/app.php'?>
<?php include '../_partials/datetimepicker.php'?>


<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>

<script type="text/javascript" src="../assets/js/select2.min.js"></script>
        <script type="text/javascript">
            $('.select2').select2({
  placeholder: 'Select an option',
  allowClear:true
  
});
</script>

</body>

</html>