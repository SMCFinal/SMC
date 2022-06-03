<?php
   include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }


    if (isset($_POST["selectSurgery"])) {   
        $surgeryId = $_POST['surgery'];
        header("LOCATION: add_meds.php?med_id=".$surgeryId."");
    }

    include('../_partials/header.php');
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Add Surgery Medicines</h5>
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
                                        $optionsSurgery = '<select class="form-control surgery_name" name="surgery" required="" id="surgery" style="width:100%">';
                                          while ($rowSurgery = mysqli_fetch_assoc($select_option_specialist)) {
                                            $optionsSurgery.= '<option value='.$rowSurgery['id'].'>'.$rowSurgery['surgery_name'].'</option>';
                                          }
                                        $optionsSurgery.= "</select>";
                                    echo $optionsSurgery;
                                    ?>
                                </div>
                            </div>
                            <hr>


                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="selectSurgery" class="btn btn-primary waves-effect waves-light">Select Surgery</button>
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