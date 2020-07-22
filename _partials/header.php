<?php
    include('../_stream/config.php');
    $sesssionEmail = $_SESSION["user"];
    $query = mysqli_query($connect, "SELECT user_role FROM login_user WHERE email = '$sesssionEmail' ");
    $fetch_query = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SMC</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/logo.png">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">

    <link href="../assets/package/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/customStyles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker.min.css">
    
    

    <!-- <link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"> -->
</head>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>
            <div class="left-side-logo d-block d-lg-none">
                <div class="text-center">
                    <a class="logo">SMC</a>
                </div>
            </div>
            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <?php if ($fetch_query['user_role'] == '1' OR $fetch_query['user_role'] == '2') {?>
                        <li>
                            <a href="dashboard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                    <?php } ?>
                        <?php if ($fetch_query['user_role'] == '2' OR $fetch_query['user_role'] == '3' OR $fetch_query['user_role'] == '4' OR $fetch_query['user_role'] == '5') {
                            ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-flash"></i> <span> Quick Access </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="patients_list.php">View Patients</a></li>
                                <!-- <li><a href="patient_new.php">View Rooms</a></li> -->
                                <li><a target="_blank" href="patient_active_view.php">View Current Patients</a></li>

                                <li><a target="_blank" href="pharmacy_list.php">Pharmacy View</a></li>
                                <li><a target="_blank" href="lab_test_list_view.php">Laboratory View</a></li>
                            </ul>
                        </li>
                        <?php  } ?>

                        <?php if ($fetch_query['user_role'] == '2') {
                            ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-wheelchair-accessibility"></i> <span> Patients </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="patient_new.php">Patient Registration</a></li>
                                <li><a href="patients_list.php">Current Patients</a></li>
                                <li><a href="patients_postponed_list.php">Postponed Patients</a></li>
                                <li><a href="patients_observation.php">Patients Observation</a></li>
                                <li><a href="patients_discharge.php">Patient Discharge</a></li>
                                <li><a href="patients_discharge_list.php">Patient Discharge List</a></li>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php if ($fetch_query['user_role'] == '2') {?>
                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-glassdoor"></i> <span> Rooms</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="room_new.php">Add New Room</a></li>
                                <li><a href="rooms_list.php">Rooms List</a></li>
                                <li><a href="rooms_status.php">Rooms Status</a></li>
                                <li><a href="floors_list.php">Floors List</a></li>
                            </ul>
                        </li>
                        


                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-pulse"></i> <span> Surgeries</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="surgeries_list.php">Surgeries List</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i> <span> Areas</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="areas_list.php">Areas List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i> <span> HR Staff</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="HR_staff_new.php">Staff Registration</a></li>
                                <li><a href="HR_staff_list.php">Staff List</a></li>
                                <li><a href="HR_staff_category.php">Staff Category</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i> <span>Employees</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="employee_designations.php">Add Designations</a></li>

                                <li><a href="employee_new.php">Add Employee</a></li>
                                <li><a href="employee_list.php">Employees List</a></li>
                                <li><a href="employee_select.php">Advance Payments</a></li>
                                <li><a href="employee_advance_payments_list.php">Advance Payments List</a></li>
                                <li><a href="employee_salary.php">Employees Salary</a></li>
                                <li><a href="employee_salary_list.php">Employees Salary List</a></li>

                            </ul>
                        </li>
                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Pharmacy</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="pharmacy_medicine_category.php">Medicines Category</a></li>
                                <li><a href="pharmacy_medicine_new.php">Add New Medicines</a></li>

                                <li><a href="pharmacy_medicine_list.php">Medicines List</a></li>
                                <li><a href="pharmacy_order_medicine_new.php">Order Medicines</a></li>
                                <li><a href="pharmacy_order_medicine_pending.php">Pending Orders</a></li>
                                <li><a href="pharmacy_order_medicine_completed_list.php">Completed Orders</a></li>
                                <li><a href="pharmacy_list.php">Pharmacy List</a></li>



                            </ul>
                        </li>
                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-store"></i> <span> Inventory</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="inventory_new.php">Add Inventory Items</a></li>
                                <li><a href="inventory_list.php">Inventory Items List</a></li>

                            </ul>
                        </li>

                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-medical"></i> <span> Operation Theater</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="ot_items_new.php">Add Items</a></li>
                                <li><a href="ot_items_list.php">Items List</a></li>

                            </ul>
                        </li>

                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-experiment"></i> <span> Lab Tests</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="lab_test_category.php">Add Lab Test Category</a></li>
                                <li><a href="lab_test_new.php">Add New Lab Test</a></li>
                                <li><a href="lab_test_pending.php">Pending Lab Test</a></li>
                                <li><a href="lab_test_completed.php">Completed Lab Test</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i> <span> Expenses</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="expense_category_new.php">Expense Category</a></li>
                                <li><a href="expense_new.php">Add Expense</a></li>
                                <li><a href="expense_list.php">Expense List</a></li>

                            </ul>
                        </li>


                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-wallet"></i> <span>  Doctor Charges</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="doctor_payment_list.php">Doctor Payment List</a></li>
                                <li><a href="doctor_visit_charges.php">Doctor Visit Charges</a></li>
                                <li><a href="doctor_visit_charges_confirm_list.php">Doctor Charges List</a></li>
                                <li><a href="doctor_surgery_charges.php">Visit And Surgery Charges</a></li>

                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-wallet"></i> <span>  Anesthetic Charges</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="anesthetic_surgery_charges.php">Anesthetic Charges</a></li>
                                <li><a href="anesthetic_payment_list.php">Anesthetic Payment List</a></li>
                                <!-- <li><a href="doctor_visit_charges_confirm_list.php">Doctor Charges List</a></li> -->
                                <!-- <li><a href="doctor_surgery_charges.php">Doctor Visit /Charges List</a></li> -->
                                <!-- <li><a href="doctor_surgery_charges.php">Doctor Charges</a></li> -->
                                <!-- <li><a href="doctor_surgery_charges_list.php">Doctor Charges List</a></li> -->
<!--                                 <li><a href="doctor_visit_charges_list.php">Doctor Visit Charges List</a></li>
 -->                                <!-- <li><a href="doctor_visit_charges_confirm.php">Expense List</a></li> -->

                            </ul>
                        </li>
                        <?php } ?>

                        <?php if ($fetch_query['user_role'] == '1') {?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i> <span>  Reports</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <!-- <li><a href="doctor_visit_charges_confirm.php">Doctor Visit Charges</a></li> -->
                                <li><a href="report_areawise.php">Area wise Report</a></li>
                                <li><a href="report_doctor.php">Doctor Report</a></li>
                                <li><a href="report_pharmacy.php">Pharmacy Report</a></li>
                                <li><a href="report_lab.php">Lab Report</a></li>
                                <!-- <li><a href="report_surgeries.php">Surgery Report</a></li> -->
                                <li><a href="report_expenses.php">Expenses Report</a></li>
                                <li><a href="report_ot.php">OT Report</a></li>
                                

                            </ul>
                        </li>




                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i> <span> Users</span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="user_new.php">Add New User</a></li>
                                <li><a href="users_list.php">Users List</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                <div class="topbar">
                    <div class="topbar-left d-none d-lg-block">
                        <div class="text-center pt-2"  >
                            <a href="/smc/pages/dashboard.php" class="text-white "><h3>SMC</h3></a>
                        </div>
                    </div>
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="../assets/images/user.png" alt="user" class="rounded-circle" style="border:1px solid #54CC96; box-shadow: 1px 1px 3px 1px #ccc">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><span class="badge badge-success mt-1 float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                                    <a class="dropdown-item" href="signout.php"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-inline menu-left mb-0">
                            <li class="list-inline-item">
                                <button type="button" class="button-menu-mobile open-left waves-effect">
                                    <i class="ion-navicon"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </nav>
                </div>
                <!-- Top Bar End -->