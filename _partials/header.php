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
    <script src='../assets/kitFont.js' crossorigin='anonymous'></script>
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
                        <?php if ($fetch_query['user_role'] == '10') {?>
                        <li>
                            <a href="dashboard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="mo_patient_list.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> Patients List </span>
                            </a>
                        </li>



                        <?php } if ($fetch_query['user_role'] == '1' OR $fetch_query['user_role'] == '2') {?>
                        <li>
                            <a href="dashboard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <?php } if ($fetch_query['user_role'] == '2' OR $fetch_query['user_role'] == '3' OR $fetch_query['user_role'] == '4' OR $fetch_query['user_role'] == '5') {
                            ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-flash"></i> <span>
                                    Quick Access </span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="patients_list.php">View Patients</a></li>
                                <!-- <li><a href="patient_new.php">View Rooms</a></li> -->
                                <li><a target="_blank" href="patient_active_view.php">View Current Patients</a></li>

                                <li><a target="_blank" href="pharmacy_list.php">Pharmacy View</a></li>
                                <li><a target="_blank" href="lab_test_list_view.php">Laboratory View</a></li>
                            </ul>
                        </li>
                        

                        <?php } if ($fetch_query['user_role'] == '2') {
                            ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building"></i> <span>
                                    Organizations</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="select_organization.php">Organizations List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i
                                    class="mdi mdi-wheelchair-accessibility"></i> <span> Patients </span> <span
                                    class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="patient_new.php">Patient Registration</a></li>
                                <li><a href="patients_list.php">Current Patients</a></li>
                                <li><a href="patients_postponed_list.php">Postponed Patients</a></li>
                                <li><a href="patients_observation.php">Patients Observation</a></li>
                                <li><a href="patients_discharge.php">Patient Discharge</a></li>
                                <li><a href="patients_discharge_list.php">All Discharge Patients</a></li>
                                <li><a href="ptcl_patients_discharge_list.php">PTCL Patients List</a></li>
                                <li><a href="sehatcard_patients_discharge_list.php">Sehat Card Patients List</a></li>
                                <li><a href="general_patients_discharge_list.php">Private Patients List</a></li>
                                <li><a href="other_patients_discharge_list.php">Other Patients List</a></li>
                                <li><a href="ground_floor_admit.php">Ground Floor Patients</a></li>
                                
                                <li><a href="pat_emergency.php">Emergency Patients</a></li>
                                <li><a href="pat_emergency_discharged.php">Discharged Emergency Patients</a></li>


                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-medkit"></i> <span>
                                    Medications </span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="surgery_medicine_category.php">Add Med Category</a></li>
                                <li><a href="surgery_med_new.php">Add Medicines</a></li>
                                <li><a href="surgery_medicine_list.php">Medicines List</a></li>
                                <li><a href="select_surgery.php">Surgery Medicines</a></li>
                                <li><a href="meds_list.php">Surgery Med List</a></li>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php if ($fetch_query['user_role'] == '2') {?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-glassdoor"></i> <span>
                                    Rooms</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="room_new.php">Add New Room</a></li>
                                <li><a href="rooms_list.php">Rooms List</a></li>
                                <li><a href="rooms_status.php">Rooms Status</a></li>
                                <li><a href="floors_list.php">Floors List</a></li>
                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-pulse"></i> <span>
                                    Surgeries</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="surgeries_list.php">Surgeries List</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i> <span>
                                    Areas</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="areas_list.php">Areas List</a></li>
                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i>
                                <span> Pharmacy</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
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
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-store"></i> <span>
                                    Inventory</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="inventory_new.php">Add Inventory Items</a></li>
                                <li><a href="inventory_list.php">Inventory Items List</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-medical"></i> <span>
                                    Operation Theater</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="ot_items_new.php">Add Items</a></li>
                                <li><a href="ot_items_list.php">Items List</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-experiment"></i>
                                <span> Lab Tests</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="lab_test_category.php">Add Lab Test Category</a></li>
                                <li><a href="lab_test_new.php">Add New Lab Test</a></li>
                                <li><a href="lab_test_pending.php">Pending Lab Test</a></li>
                                <li><a href="lab_test_completed.php">Completed Lab Test</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i>
                                <span> Expenses</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="expense_category_new.php">Expense Category</a></li>
                                <li><a href="expense_new.php">Add Expense</a></li>
                                <li><a href="expense_list.php">Expense List</a></li>

                            </ul>
                        </li>



                        <?php } ?>

                        <?php if ($fetch_query['user_role'] == '1') {?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-md"></i> <span>
                                    Doctor Charges</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="doctor_payment_list.php">Doctor Payment List</a></li>
                                <li><a href="doctor_visit_charges.php">Doctor Visit Charges</a></li>
                                <li><a href="doctor_visit_charges_confirm_list.php">Doctor Charges List</a></li>
                                <li><a href="doctor_surgery_charges.php">Dr Charges Private</a></li>
                                <li><a href="doctor_sehatcard_charges.php">Dr Charges Sehat Card</a></li>
                                <li><a href="doctor_ptcl_charges.php">Dr Charges PTCL</a></li>
                                <li><a href="doctor_others_charges.php">Dr Charges Other</a></li>

                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bed"></i> <span> OT Daily
                                    Charges</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="ot_charges_list.php">OT Charges List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-wallet"></i> <span>
                                    Anesthesia Charges</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="anesthetic_surgery_charges.php">ANA Private Charges</a></li>
                                <li><a href="anesthetic_sehatcard_charges.php">ANA SehatCard Charges</a></li>
                                <li><a href="anesthetic_ptcl_charges.php">ANA PTCL Charges</a></li>
                                <li><a href="anesthetic_other_charges.php">ANA Other Charges</a></li>
                                <li><a href="anesthetic_payment_list.php">Anesthesia Payment List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fas">&#xf77c;</i> <span>
                                    Birth Certificate</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">

                                <li><a href="birth_certificate.php">Add Birth Certificate</a></li>
                                <li><a href="birth_certificate_list.php">Birth Certificate List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i>
                                <span> HR Staff</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="HR_staff_new.php">Staff Registration</a></li>
                                <li><a href="HR_staff_list.php">Staff List</a></li>
                                <li><a href="HR_staff_category.php">Staff Category</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i>
                                <span>Employees</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
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
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-md"></i>
                                <span>Doctor's Login</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="doctors_list_login.php">Dr Credentials</a></li>
                                <li><a href="doctors_list_login_resend.php">Dr Credentials List</a></li>
                                <li><a href="anesthesia_list_login.php">ANA Credentials</a></li>
                            </ul>
                        </li>


                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-document"></i> <span>
                                    Reports</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="report_areawise.php">Area wise Report</a></li>
                                <li><a href="report_doctor.php">Doctor Report</a></li>
                                <li><a href="report_doctor_unpaid.php">Un-Paid Doctor Report</a></li>
                                <li><a href="report_pharmacy.php">Pharmacy Report</a></li>
                                <li><a href="report_lab.php">Lab Report</a></li>
                                <li><a href="report_expenses.php">Expenses Report</a></li>
                                <li><a href="report_ot.php">OT Report</a></li>
                                <li><a href="report_pat.php">Patient Custom Report</a></li>
                                <li><a href="report_pat_daily.php">Patient Daily Report</a></li>
                                <li><a href="report_emergency.php">Emergency Patients Report</a></li>
                            </ul>
                        </li>


                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user-group"></i>
                                <span> Users</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="user_new.php">Add New User</a></li>
                                <li><a href="users_list.php">Users List</a></li>
                                <li><a href="doctors_credentials_list.php">Doctor Credentials</a></li>
                                <li><a href="ana_credentials_list.php">ANA Credentials</a></li>
                            </ul>
                        </li>


                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span>
                                    Approve Expense</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="expense_clear.php">Expense List</a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-upload"></i> <span>
                                    Backup</span> <span class="menu-arrow float-right"><i
                                        class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled">
                                <li><a href="backup_page.php">Website Backup</a></li>
                            </ul>
                        </li>
                        <?php } ?>


                        <?php if ($fetch_query['user_role'] == '2') {?>
                        <li>
                            <a href="../AndroidAppDownload/SMC.apk" class="waves-effect">
                                <i class="fa fa-android"></i>
                                <span> SMS Application </span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php if($fetch_query['user_role'] == '6'){ ?>

                        <li>
                            <a href="dashboardCustom.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="ground_floor_new_patient.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> Add Patient </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_today_list_ground.php" class="waves-effect">
                                <i class="dripicons-list"></i>
                                <span> Today's Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_list_ground.php" class="waves-effect">
                                <i class="fa fa-users"></i>
                                <span> All Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_discharge_ground.php" class="waves-effect">
                                <i class="fa fa-hospital-o"></i>
                                <span> Discharged Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_postpone_ground.php" class="waves-effect">
                                <i class="fa fa-times"></i>
                                <span> Postponed Patients </span>
                            </a>
                        </li>


                        <!-- <li>
                            <a href="patients_list_ground.php" class="waves-effect">
                                <i class="fa fa-id-card"></i>
                                <span> Current Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_postponed_list_ground.php" class="waves-effect">
                                <i class="fa fa-times"></i>
                                <span> Postponed Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="ptcl_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="fa fa-phone"></i>
                                <span> PTCL Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="sehatcard_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="fa fa-credit-card"></i>
                                <span> Sehat Card Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="general_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> General Patients List </span>
                            </a>
                        </li> -->

                        <?php  } ?>



                        <?php if($fetch_query['user_role'] == '7'){ ?>

                        <li>
                            <a href="groundFloorDBoard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="patient_new_ground.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> Add Patient </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_list_current_ground.php" class="waves-effect">
                                <i class="fa fa-bed"></i>
                                <span> Current Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="ground_floor_admit_new_patient.php" class="waves-effect">
                                <i class="fa fa-users"></i>
                                <span> Ground Floor Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_discharge_ground.php" class="waves-effect">
                                <i class="fa fa-hospital-o"></i>
                                <span> Discharged Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_postpone_ground.php" class="waves-effect">
                                <i class="fa fa-refresh"></i>
                                <span> Postponeded Patients </span>
                            </a>
                        </li>


                        <!-- <li>
                            <a href="patients_list_ground.php" class="waves-effect">
                                <i class="fa fa-id-card"></i>
                                <span> Current Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="patients_postponed_list_ground.php" class="waves-effect">
                                <i class="fa fa-times"></i>
                                <span> Postponed Patients </span>
                            </a>
                        </li>

                        <li>
                            <a href="ptcl_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="fa fa-phone"></i>
                                <span> PTCL Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="sehatcard_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="fa fa-credit-card"></i>
                                <span> Sehat Card Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="general_patients_discharge_list_ground.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> General Patients List </span>
                            </a>
                        </li> -->

                        <?php  } ?>

                        <?php if($fetch_query['user_role'] == '8'){ ?>

                            <li>
                            <a href="doctorDashboard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="doctor_surgery_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Private Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="doctor_sehatcard_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Sehat Card Charges </span>
                            </a>
                        </li>


                        <li>
                            <a href="doctor_ptcl_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> PTCL Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="doctor_other_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Other Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="doctor_payment_list_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Payment List </span>
                            </a>
                        </li>

                        <li>
                            <a href="doctor_patient_list.php" class="waves-effect">
                                <i class="mdi mdi-wheelchair-accessibility"></i>
                                <span> Patients List </span>
                            </a>
                        </li>

                        <li>
                            <a href="my_profile.php" class="waves-effect">
                                <i class="fa fa-user-md"></i>
                                <span> My Profile </span>
                            </a>
                        </li>



                        <?php } ?>



                        <?php if($fetch_query['user_role'] == '9'){ ?>
                        <li>
                            <a href="anestheticDashboard.php" class="waves-effect">
                                <i class="dripicons-meter"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="anesthetic_surgery_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Private Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="anesthetic_sehatcard_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Sehat Card Charges </span>
                            </a>
                        </li>


                        <li>
                            <a href="anesthetic_ptcl_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> PTCL Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="anesthetic_other_charges_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Other Charges </span>
                            </a>
                        </li>

                        <li>
                            <a href="anesthetic_payment_list_self.php" class="waves-effect">
                                <i class="dripicons-wallet"></i>
                                <span> Payment List </span>
                            </a>
                        </li>

                        <li>
                            <a href="my_profile.php" class="waves-effect">
                                <i class="fa fa-user-md"></i>
                                <span> My Profile </span>
                            </a>
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
                        <div class="text-center pt-2">
                            <a href="/smc/pages/dashboard.php" class="text-white ">
                                <h3>SMC</h3>
                            </a>
                        </div>
                    </div>
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="../assets/images/user.png" alt="user" class="rounded-circle"
                                        style="border:1px solid #54CC96; box-shadow: 1px 1px 3px 1px #ccc">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">

                                    <a class="dropdown-item" href="signout.php"><i
                                            class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
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