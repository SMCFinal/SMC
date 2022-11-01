<?php 
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    
    $user = $_SESSION["user"];
    $loginUser = mysqli_query($connect, "SELECT * FROM `login_user` WHERE email = '$user'");
    $fetch_loginUser = mysqli_fetch_assoc($loginUser);
    
    include('../_partials/header.php');
?>

                <div class="page-content-wrapper">
                        <div class="container-fluid" >
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="page-title">Dashboard</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-6">
                                    <div class="card mini-stat m-b-30" style="background-color: #171717; color: #D4AF37">
                                        <div class="p-3  text-white">
                                            <div class="mini-stat-icon" align="center">
                                                <img src="../assets/logo.png" width="5%" height="20%">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="border-bottom pb-4 text-center text-white">
                                               <span style=" font-size: 70px; color: #D4AF37; font-family: Times">Welcome <br> <?php echo $fetch_loginUser['name'] ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">Welcome to SMC Admin Portal!</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END wrapper -->

                <?php include('../_partials/footer.php') ?>

            <!-- End Right content here -->



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

  