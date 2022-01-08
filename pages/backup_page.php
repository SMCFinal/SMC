<?php 
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    include('../_partials/header.php');
?>

    <div class="page-content-wrapper ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="page-title">Backup</h5>
                </div>
            </div>

            <br>
          <div class="row">
            <div class="col-md-12" align="center">
                <pre style="font-size:20px; font-family:Times; border: 1px solid #888; background-color:#c2c2c2"><marquee><b>To backup your database manually, click on the  [Database Backup] button.</b></marquee></pre>
            </div>
          </div><br><br><br><br><br><br><br><br>
          <div class="row" >
            <div class="col-md-12" style="display:flex; justify-content: center;">
                <a href="backup.php" data-toggle="tooltip" title="Download BackUp" data-placement="bottom" type="button" style="border-radius:.5rem; box-shadow:1px 1px 1px 1px #878787" class="btn btn-success btn-lg">Database Backup</a>
            </div>
          </div>
            <!-- end row -->
        </div><!-- container fluid -->

    </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    <footer class="footer">
        ©2020 <b>SMC</b> <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Team DCS.</span>
    </footer>

    </div>
    <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


    <!-- jQuery  -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/modernizr.min.js"></script>
    <script src="../assets/js/detect.js"></script>
    <script src="../assets/js/fastclick.js"></script>
    <script src="../assets/js/jquery.slimscroll.js"></script>
    <script src="../assets/js/jquery.blockUI.js"></script>
    <script src="../assets/js/waves.js"></script>
    <script src="../assets/js/jquery.nicescroll.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>

    <!-- skycons -->
    <script src="../assets/plugins/skycons/skycons.min.js"></script>

    <!-- skycons -->
    <script src="../assets/plugins/peity/jquery.peity.min.js"></script>

    <!--Morris Chart-->
    <script src="../assets/plugins/morris/morris.min.js"></script>
    <script src="../assets/plugins/raphael/raphael-min.js"></script>

    <!-- dashboard -->
    <script src="../assets/pages/dashboard.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>

    </body>
</html>

  