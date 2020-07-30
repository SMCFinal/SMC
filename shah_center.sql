-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 09:49 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shah_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_medicines`
--

CREATE TABLE `add_medicines` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(4000) NOT NULL,
  `medicine_category` varchar(250) NOT NULL,
  `doinsertion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_medicines`
--

INSERT INTO `add_medicines` (`id`, `medicine_name`, `medicine_category`, `doinsertion`) VALUES
(3, 'Panadol', '10', '2020-06-04 16:10:34'),
(4, 'Diclo', '8', '2020-06-04 16:10:45'),
(6, 'Medine', '8', '2020-06-05 15:27:50'),
(7, 'A', '9', '2020-06-09 01:09:10'),
(8, 'V', '10', '2020-06-09 01:09:17'),
(9, 'A', '8', '2020-06-09 01:09:24'),
(10, 'A', '10', '2020-06-09 01:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `anesthetic_surgery_charges`
--

CREATE TABLE `anesthetic_surgery_charges` (
  `id` int(11) NOT NULL,
  `anesthetic_id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `room_id` double NOT NULL,
  `surgery_anes_charges` double NOT NULL,
  `pat_operation` int(11) NOT NULL,
  `pat_consultant` int(11) NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 1,
  `date_of_payment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anesthetic_surgery_charges`
--

INSERT INTO `anesthetic_surgery_charges` (`id`, `anesthetic_id`, `pat_id`, `room_id`, `surgery_anes_charges`, `pat_operation`, `pat_consultant`, `payment_status`, `date_of_payment`) VALUES
(2, 2, 12, 2, 1500, 2, 1, 0, '2020-07-19 03:18:47'),
(3, 0, 13, 2, 1500, 2, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `anethetic_paid_amount`
--

CREATE TABLE `anethetic_paid_amount` (
  `id` int(11) NOT NULL,
  `aneshthetic_id` int(11) NOT NULL,
  `paid_amount` double NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anethetic_paid_amount`
--

INSERT INTO `anethetic_paid_amount` (`id`, `aneshthetic_id`, `paid_amount`, `auto_date`) VALUES
(1, 2, 1500, '2020-07-19 03:17:30'),
(2, 2, 1500, '2020-07-19 03:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area_name`) VALUES
(2, 'Kalam'),
(3, 'Malakand');

-- --------------------------------------------------------

--
-- Table structure for table `device_tbl`
--

CREATE TABLE `device_tbl` (
  `id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_tbl`
--

INSERT INTO `device_tbl` (`id`, `device_id`, `status`) VALUES
(1, '02:00:00:00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discharge_patients`
--

CREATE TABLE `discharge_patients` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(4000) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `patient_gender` int(11) NOT NULL,
  `patient_address` varchar(4000) NOT NULL,
  `patient_cnic` double NOT NULL,
  `patient_contact` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `patient_doa` datetime NOT NULL,
  `patient_doop` datetime NOT NULL,
  `patient_disease` varchar(4000) NOT NULL,
  `patient_operation` varchar(300) NOT NULL,
  `patient_consultant` varchar(300) NOT NULL,
  `patient_yearly_no` varchar(250) NOT NULL,
  `attendent_name` varchar(300) NOT NULL,
  `consultant_charges` double NOT NULL,
  `anasthetic_name` varchar(400) NOT NULL,
  `anesthesia_charges` double NOT NULL,
  `auto_date` date NOT NULL DEFAULT current_timestamp(),
  `category` varchar(240) NOT NULL,
  `pat_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discharge_patients`
--

INSERT INTO `discharge_patients` (`id`, `patient_name`, `patient_age`, `patient_gender`, `patient_address`, `patient_cnic`, `patient_contact`, `city_id`, `room_id`, `patient_doa`, `patient_doop`, `patient_disease`, `patient_operation`, `patient_consultant`, `patient_yearly_no`, `attendent_name`, `consultant_charges`, `anasthetic_name`, `anesthesia_charges`, `auto_date`, `category`, `pat_id`) VALUES
(4, 'Khan G', 26, 1, 'Utror', 1560284614213, '03460973906', 2, 2, '2020-07-17 23:03:00', '2020-07-18 23:00:00', 'Pregnancy', '2', '1', '2020-011', 'Khanz', 10000, '2', 1500, '2020-07-19', 'dischargePatient', 12),
(5, 'Saadat Khan', 26, 1, 'Mingora', 1560284614213, '03460973906', 3, 2, '2020-07-19 20:23:00', '2020-07-19 20:25:00', 'Heart', '2', '1', '2020-012', 'Asif', 10000, '5', 1500, '2020-07-19', 'dischargePatient', 13);

-- --------------------------------------------------------

--
-- Table structure for table `discharge_patients_charges`
--

CREATE TABLE `discharge_patients_charges` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `city_id` double NOT NULL,
  `room_id` double NOT NULL,
  `med_charges` double NOT NULL,
  `room_charges` double NOT NULL,
  `ot_charges` double NOT NULL,
  `hospital_charges` double NOT NULL,
  `lab_charges` double NOT NULL,
  `dr_charges` double NOT NULL,
  `anesthetic_charges` double NOT NULL,
  `actual_charges` double NOT NULL,
  `amount_paid` double NOT NULL,
  `days_stitches` int(11) NOT NULL,
  `doctor_advice` varchar(5000) NOT NULL,
  `doctor_payment_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:not Paid::0:paid',
  `pat_operation` double NOT NULL,
  `pat_consultant` double NOT NULL,
  `visit_charges` double NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discharge_patients_charges`
--

INSERT INTO `discharge_patients_charges` (`id`, `pat_id`, `city_id`, `room_id`, `med_charges`, `room_charges`, `ot_charges`, `hospital_charges`, `lab_charges`, `dr_charges`, `anesthetic_charges`, `actual_charges`, `amount_paid`, `days_stitches`, `doctor_advice`, `doctor_payment_status`, `pat_operation`, `pat_consultant`, `visit_charges`, `auto_date`) VALUES
(1, 10, 2, 2, 8050, 6000, 400, 400, 720, 11000, 1500, 26670, 28070, 2, 'Tabs:\r\nPandol 3 time a day.\r\nSyrup:\r\nSomething 3 time a day\r\n\r\nCheck up after 30 days', 0, 1, 1, 0, '2020-07-18 19:01:03'),
(4, 12, 2, 2, 1250, 1200, 400, 500, 1370, 12000, 1500, 17220, 19720, 2, '1. Hello,\r\n2. World,\r\n3. How are you,\r\n4. Good Now?,', 0, 2, 1, 1500, '2020-07-19 00:58:28'),
(5, 13, 3, 2, 2000, 1200, 200, 200, 460, 10000, 1500, 14860, 16060, 2, '1. Hello,\r\n2. Bye,', 1, 2, 1, 500, '2020-07-19 20:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_paid_amount`
--

CREATE TABLE `doctor_paid_amount` (
  `id` int(11) NOT NULL,
  `d_id` double NOT NULL,
  `total_surgery` double NOT NULL,
  `total_visit` double NOT NULL,
  `total_paid` double NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_paid_amount`
--

INSERT INTO `doctor_paid_amount` (`id`, `d_id`, `total_surgery`, `total_visit`, `total_paid`, `auto_date`) VALUES
(1, 1, 12000, 1500, 13500, '2020-07-19 03:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_surgery_charges`
--

CREATE TABLE `doctor_surgery_charges` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `room_id` double NOT NULL,
  `surgery_charges` double NOT NULL,
  `pat_operation` int(11) NOT NULL,
  `pat_consultant` int(11) NOT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT 1,
  `date_of_payment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_surgery_charges`
--

INSERT INTO `doctor_surgery_charges` (`id`, `pat_id`, `room_id`, `surgery_charges`, `pat_operation`, `pat_consultant`, `payment_status`, `date_of_payment`) VALUES
(2, 12, 2, 12000, 2, 1, 0, '2020-07-19 03:12:22'),
(3, 13, 2, 10000, 2, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_visit_charges`
--

CREATE TABLE `doctor_visit_charges` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `doctor_id` double NOT NULL,
  `room_id` int(11) NOT NULL,
  `pat_case` varchar(400) NOT NULL,
  `pat_address` varchar(500) NOT NULL,
  `visit_charges` double NOT NULL,
  `visit_date` datetime NOT NULL,
  `visit_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_visit_charges`
--

INSERT INTO `doctor_visit_charges` (`id`, `pat_id`, `doctor_id`, `room_id`, `pat_case`, `pat_address`, `visit_charges`, `visit_date`, `visit_status`) VALUES
(4, 12, 1, 2, 'Pregnancy', 'Utror', 500, '2020-07-18 09:15:00', 0),
(5, 12, 1, 2, 'Pregnancy', 'Utror', 500, '2020-07-18 12:00:00', 0),
(6, 12, 1, 2, 'Pregnancy', 'Utror', 500, '2020-07-18 11:20:00', 0),
(7, 13, 1, 2, 'Pain in dick', 'Mingora', 500, '2020-07-19 20:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_designation`
--

CREATE TABLE `employee_designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_designation`
--

INSERT INTO `employee_designation` (`id`, `designation_name`) VALUES
(1, 'Sweeper'),
(2, 'Testing Designation'),
(3, 'Sweepers'),
(4, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `employee_registration`
--

CREATE TABLE `employee_registration` (
  `id` int(11) NOT NULL,
  `emp_name` varchar(400) NOT NULL,
  `emp_cnic` double NOT NULL,
  `emp_contact` double NOT NULL,
  `emp_gender` int(11) NOT NULL,
  `emp_designation` int(11) NOT NULL,
  `emp_salary` double NOT NULL,
  `emp_doj` datetime NOT NULL COMMENT 'Date Of Joining',
  `emp_address` varchar(4000) NOT NULL,
  `emp_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_registration`
--

INSERT INTO `employee_registration` (`id`, `emp_name`, `emp_cnic`, `emp_contact`, `emp_gender`, `emp_designation`, `emp_salary`, `emp_doj`, `emp_address`, `emp_status`) VALUES
(3, 'Khan', 1560284614213, 3460973906, 1, 3, 150000, '2020-06-18 00:00:00', 'Saidu Sharif, Swat.', 1),
(4, 'Basit Khan', 1560284445215, 3461234567489, 1, 2, 1500, '2020-06-18 00:00:00', 'Mingora, Swat', 1),
(5, 'Name', 123123123, 6351651365, 3, 2, 3515, '2020-06-18 00:00:00', 'Saidu Sharif, Swat.', 1),
(6, 'Bilal Khan', 1560284614213, 3460973906, 1, 3, 5000, '2020-06-04 00:00:00', 'Amankot', 1),
(7, 'asdasd', 12312312322, 123321123, 2, 4, 123123, '2020-06-11 00:00:00', 'dasxdasxc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int(11) NOT NULL,
  `emp_id` double NOT NULL,
  `salary_amount` double NOT NULL,
  `salaray_dop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`id`, `emp_id`, `salary_amount`, `salaray_dop`) VALUES
(1, 6, 2000, '2020-07-14'),
(2, 4, 1500, '2020-07-14'),
(3, 7, 122923, '2020-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `emp_advance_payment`
--

CREATE TABLE `emp_advance_payment` (
  `id` int(11) NOT NULL,
  `emp_id` double NOT NULL,
  `adv_amount` double NOT NULL,
  `adv_dop` date NOT NULL,
  `adv_description` varchar(400) NOT NULL,
  `adv_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_advance_payment`
--

INSERT INTO `emp_advance_payment` (`id`, `emp_id`, `adv_amount`, `adv_dop`, `adv_description`, `adv_status`) VALUES
(1, 6, 2000, '2020-07-14', 'Employee advance payment for something something', 0),
(3, 7, 200, '2020-07-15', 'For personal Use', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `cat_id` double NOT NULL,
  `expense_amount` double NOT NULL,
  `expense_date` datetime NOT NULL,
  `expense_description` varchar(4000) NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expense_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `cat_id`, `expense_amount`, `expense_date`, `expense_description`, `auto_date`, `expense_status`) VALUES
(1, 1, 100, '2020-07-01 16:55:00', 'Tea for guests', '2020-07-01 16:57:35', 0),
(2, 2, 550, '2020-07-01 13:15:00', 'Lunch for employees', '2020-07-01 17:50:48', 0),
(3, 2, 1050, '2020-07-01 13:15:00', 'Lunch for employees', '2020-07-02 11:36:46', 1),
(4, 1, 120, '2020-07-18 06:10:00', 'Some', '2020-07-19 06:14:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(250) NOT NULL,
  `expense_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `expense_name`, `expense_status`) VALUES
(1, 'Tea', 1),
(2, 'Food', 1);

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `floor_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `floor_name`, `status`) VALUES
(1, 'Ground Floor', 1),
(2, 'Floor No.1', 1),
(3, 'Floor No.2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(4000) NOT NULL,
  `item_qty` double NOT NULL,
  `item_price` double NOT NULL,
  `item_purchase_date` datetime NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `item_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `item_name`, `item_qty`, `item_price`, `item_purchase_date`, `floor_id`, `room_id`, `item_status`) VALUES
(5, 'Test123', 10, 200, '2020-03-04 13:25:00', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_order`
--

CREATE TABLE `lab_order` (
  `id` int(11) NOT NULL,
  `lab_test_id` double NOT NULL,
  `pat_id` double NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reference_no` double NOT NULL,
  `lab_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_order`
--

INSERT INTO `lab_order` (`id`, `lab_test_id`, `pat_id`, `order_date`, `reference_no`, `lab_status`) VALUES
(1, 1, 7, '2020-07-15 13:12:04', 1, 0),
(2, 2, 7, '2020-07-15 13:12:04', 1, 0),
(3, 1, 8, '2020-07-15 13:12:59', 2, 0),
(4, 5, 8, '2020-07-15 13:12:59', 2, 0),
(5, 6, 8, '2020-07-15 13:12:59', 2, 0),
(6, 3, 7, '2020-07-15 17:30:08', 3, 1),
(7, 4, 7, '2020-07-15 17:30:08', 3, 1),
(8, 1, 10, '2020-07-16 16:21:54', 4, 0),
(9, 2, 10, '2020-07-16 16:21:54', 4, 0),
(10, 2, 10, '2020-07-17 12:05:51', 5, 0),
(11, 3, 10, '2020-07-17 12:05:51', 5, 0),
(12, 4, 10, '2020-07-17 12:05:52', 5, 0),
(13, 1, 10, '2020-07-17 12:09:57', 6, 0),
(14, 2, 10, '2020-07-17 12:09:57', 6, 0),
(15, 3, 10, '2020-07-17 12:09:57', 6, 0),
(16, 1, 12, '2020-07-18 23:09:03', 7, 0),
(17, 2, 12, '2020-07-18 23:09:03', 7, 0),
(18, 5, 12, '2020-07-18 23:09:35', 8, 0),
(19, 6, 12, '2020-07-18 23:09:35', 8, 0),
(20, 7, 12, '2020-07-18 23:09:35', 8, 0),
(21, 1, 13, '2020-07-19 20:26:54', 9, 0),
(22, 3, 13, '2020-07-19 20:26:54', 9, 0),
(23, 4, 13, '2020-07-19 20:26:54', 9, 0),
(24, 2, 13, '2020-07-19 20:26:54', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lab_test_category`
--

CREATE TABLE `lab_test_category` (
  `id` int(11) NOT NULL,
  `test_name` varchar(400) NOT NULL,
  `test_price` double NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_test_category`
--

INSERT INTO `lab_test_category` (`id`, `test_name`, `test_price`, `auto_date`) VALUES
(1, 'Urine', 50, '2020-07-02 12:09:32'),
(2, 'Sgpt', 100, '2020-07-02 12:27:12'),
(3, 'Test1', 10, '2020-07-02 12:27:36'),
(4, 'Test2', 300, '2020-07-02 12:27:42'),
(5, 'Test3', 500, '2020-07-02 12:27:45'),
(6, 'Test4', 320, '2020-07-02 12:27:51'),
(7, 'Test5', 400, '2020-07-02 12:27:58'),
(8, 'Urine', 200, '2020-07-02 14:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test_report`
--

CREATE TABLE `lab_test_report` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `reference_no` double NOT NULL,
  `total_price` double NOT NULL,
  `uploaded_file` varchar(500) NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp(),
  `patient_payment_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_test_report`
--

INSERT INTO `lab_test_report` (`id`, `pat_id`, `reference_no`, `total_price`, `uploaded_file`, `auto_date`, `patient_payment_status`) VALUES
(56, 8, 2, 870, '../_labFiles/Asif073820203826.pdf', '2020-07-16 12:38:26', 1),
(57, 7, 1, 150, '../_labFiles/Asif074820204829.pdf', '2020-07-16 14:48:29', 1),
(58, 10, 4, 150, '../_labFiles/Asif074620204621.pdf', '2020-07-16 17:46:21', 0),
(59, 0, 10, 0, '../_labFiles/AsifUllah070820200849.png', '2020-07-17 12:08:49', 1),
(60, 10, 5, 410, '../_labFiles/IMG_20200414_180431070920200939.jpg', '2020-07-17 12:09:39', 0),
(61, 10, 6, 160, '../_labFiles/Asif071020201030.docx', '2020-07-17 12:10:30', 0),
(62, 12, 7, 150, '../_labFiles/SMC071020201028.docx', '2020-07-18 23:10:28', 0),
(63, 12, 8, 1220, '../_labFiles/UberEats(1)071020201045.docx', '2020-07-18 23:10:45', 0),
(64, 13, 9, 460, '../_labFiles/LogoSample_ByTailorBrands(1)072920202906.jpg', '2020-07-19 20:29:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `contact` varchar(300) NOT NULL,
  `user_role` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id`, `name`, `username`, `email`, `password`, `contact`, `user_role`, `status`) VALUES
(5, 'Shah Medical Center', 'SMC', 'admin@smc.com', 'Admin123', '03460973906', 1, 1),
(11, 'Laboratory', 'Lab', 'lab@smc.com', 'Lab123', '03460973906', 4, 1),
(12, 'Shah Medical Center', 'SMC', 'manager@smc.com', 'Manager123', '03460973906', 2, 1),
(13, 'Pharmacy', 'Pharma', 'pharmacy@smc.com', 'Pharmacy123', '03460973906', 5, 1),
(14, 'Shah Medical Center', 'SMC Counter', 'counter@smc.com', 'Counter123', '03460973906', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`id`, `category_name`) VALUES
(8, 'Injection'),
(9, 'Syrup'),
(10, 'Suspension');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_order`
--

CREATE TABLE `medicine_order` (
  `id` int(11) NOT NULL,
  `med_id` double NOT NULL,
  `cat_id` double NOT NULL,
  `med_qty` double NOT NULL,
  `med_price` double NOT NULL,
  `med_status` tinyint(4) NOT NULL DEFAULT 1,
  `patient_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reference_no` double NOT NULL,
  `pharmacy_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_order`
--

INSERT INTO `medicine_order` (`id`, `med_id`, `cat_id`, `med_qty`, `med_price`, `med_status`, `patient_id`, `order_date`, `reference_no`, `pharmacy_status`) VALUES
(44, 3, 10, 12, 0, 0, 7, '2020-06-16 12:38:18', 1, 0),
(45, 7, 9, 2, 0, 0, 7, '2020-06-16 12:38:18', 1, 0),
(46, 6, 8, 21, 0, 0, 7, '2020-06-16 12:38:18', 1, 0),
(47, 9, 8, 5, 0, 0, 7, '2020-06-16 12:38:18', 1, 0),
(48, 3, 10, 2, 0, 0, 8, '2020-06-16 12:38:45', 2, 0),
(49, 10, 10, 20, 0, 0, 8, '2020-06-16 12:38:45', 2, 0),
(50, 9, 8, 10, 0, 0, 8, '2020-06-16 12:38:45', 2, 0),
(51, 3, 10, 1, 0, 1, 7, '2020-06-16 12:49:02', 3, 0),
(52, 4, 8, 22, 0, 1, 7, '2020-06-16 12:49:02', 3, 0),
(53, 3, 10, 10, 0, 1, 7, '2020-07-13 15:28:21', 4, 0),
(54, 4, 8, 12, 0, 1, 7, '2020-07-13 15:28:21', 4, 0),
(55, 1, 1, 7, 0, 1, 7, '2020-07-15 12:31:44', 5, 0),
(56, 2, 2, 7, 0, 1, 7, '2020-07-15 12:31:44', 5, 0),
(57, 1, 1, 7, 0, 1, 7, '2020-07-15 12:33:16', 6, 0),
(58, 3, 3, 7, 0, 1, 7, '2020-07-15 12:33:16', 6, 0),
(59, 1, 1, 7, 0, 1, 7, '2020-07-15 12:34:23', 7, 0),
(60, 1, 1, 0, 0, 1, 7, '2020-07-15 12:36:14', 8, 0),
(61, 1, 1, 0, 0, 1, 7, '2020-07-15 12:37:16', 9, 0),
(62, 0, 0, 0, 0, 1, 0, '2020-07-15 12:41:17', 0, 1),
(63, 0, 0, 0, 0, 1, 0, '2020-07-15 12:41:36', 0, 1),
(64, 3, 10, 10, 0, 1, 7, '2020-07-15 12:46:29', 10, 0),
(65, 4, 8, 12, 0, 1, 7, '2020-07-15 12:50:19', 11, 0),
(66, 3, 10, 11, 0, 1, 7, '2020-07-15 12:50:19', 11, 0),
(67, 4, 8, 21, 0, 0, 9, '2020-07-16 16:21:23', 12, 0),
(68, 3, 10, 12, 0, 0, 9, '2020-07-16 16:21:23', 12, 0),
(69, 3, 10, 12, 0, 0, 9, '2020-07-16 20:47:12', 13, 0),
(70, 4, 8, 22, 0, 0, 9, '2020-07-16 20:47:12', 13, 0),
(71, 6, 8, 20, 0, 0, 9, '2020-07-16 20:47:12', 13, 0),
(72, 3, 10, 12, 0, 0, 10, '2020-07-16 20:48:52', 14, 1),
(73, 3, 10, 12, 0, 0, 10, '2020-07-16 20:49:46', 15, 1),
(74, 4, 8, 21, 0, 0, 10, '2020-07-16 20:49:46', 15, 1),
(75, 6, 8, 14, 0, 0, 10, '2020-07-16 20:49:46', 15, 1),
(76, 8, 10, 23, 0, 0, 10, '2020-07-16 20:49:46', 15, 1),
(77, 3, 10, 12, 0, 0, 10, '2020-07-17 10:06:07', 16, 1),
(78, 4, 8, 20, 0, 0, 10, '2020-07-17 10:06:07', 16, 1),
(79, 3, 10, 1, 0, 0, 12, '2020-07-18 23:07:10', 17, 1),
(80, 6, 8, 5, 0, 0, 12, '2020-07-18 23:07:10', 17, 1),
(81, 7, 9, 10, 0, 0, 12, '2020-07-18 23:07:10', 17, 1),
(82, 8, 10, 15, 0, 0, 12, '2020-07-18 23:07:10', 17, 1),
(83, 9, 8, 20, 0, 0, 12, '2020-07-18 23:07:33', 18, 1),
(84, 10, 10, 20, 0, 0, 12, '2020-07-18 23:07:33', 18, 1),
(85, 0, 0, 0, 0, 1, 0, '2020-07-19 04:40:41', 0, 1),
(86, 3, 10, 18, 0, 0, 13, '2020-07-19 20:26:08', 19, 0),
(87, 4, 8, 30, 0, 0, 13, '2020-07-19 20:26:08', 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message_tbl`
--

CREATE TABLE `message_tbl` (
  `id` int(11) NOT NULL,
  `from_device` int(255) NOT NULL,
  `to_device` varchar(250) NOT NULL,
  `message_body` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_tbl`
--

INSERT INTO `message_tbl` (`id`, `from_device`, `to_device`, `message_body`, `status`) VALUES
(6, 1, '03460973906', 'this is test message', 0),
(7, 1, '03460973906', 'Welcome Basit. You can access SMC WebApp using the following details. Email:basit@smc.com, and Password: Pakistan123.', 1),
(8, 1, '03460973906', 'Welcome Yaqoob Khan. You can access SMC WebApp using the following credentials.</br> Email:yaqoob@dconsulting.pk</br> Password: PakistanZindabad.</br>Regards: SMC</br>Thank You!', 1),
(9, 1, '03460973906', 'Dear Naqib Khan. You can access SMC WebApp using the following credentials. Email:naqib@gmail.com and Password: Pakistan123. Regards: SMC. Thank You!', 1),
(10, 1, '12345', 'Dear Khan. You can access SMC WebApp using the following credentials. Email:name@gmail.com and Password: 123. Thank You!', 1),
(11, 1, '03339037585', 'Dear Naqib Khan. Your Credentails. Email: and Password: Pakistan123. Thank You!', 1),
(12, 1, '03339037585', 'Dear Khan. Your Credentails. Email:name@gmail.com and Password: 123. Thank You!', 1),
(13, 1, '3460973905', 'Dear Bilal. Your Credentails. Email:bilal@gmail.com and Password: 123. Thank You!', 1),
(14, 1, '03460973906', 'Dear Bilal. Your Credentails. Email:bilal@gmail.com and Password: 321. Thank You!', 1),
(15, 1, '03460973906', 'Dear Babar., your patient has been admitted. Thank You!', 1),
(16, 1, '03460973906', 'Dear Babar, your patient has been postpone. Thank You! SMC', 1),
(17, 1, '21312312312', 'Dear acascacs, your patient has been admitted. Thank You! SMC', 1),
(18, 1, '21312312312', 'Dear acascacs, your patient has been postpone. Thank You! SMC', 1),
(19, 1, '', 'Dear , your patient has been postpone. Thank You! SMC', 1),
(20, 1, '', 'Dear , your patient has been postpone. Thank You! SMC', 1),
(21, 1, '03460973906', 'Dear Laboratory. You can access SMC WebApp using the following credentials. Email:lab@smc.com and Password: 123. Thank You!', 1),
(22, 1, '03460973906', 'Dear Laboratory. Your Credentails. Email:lab@smc.com and Password: 123. Thank You!', 1),
(23, 1, '03460973906', 'Dear Laboratory. Your Credentails. Email:lab@smc.com and Password: 123. Thank You!', 1),
(24, 1, '03460973906', 'Dear Laboratory. Your Credentails. Email:lab@smc.com and Password: 123. Thank You!', 1),
(25, 1, '03460973906', 'Dear Shah Medical Center. Your Credentails. Email:bilal@gmail.com and Password: Admin123. Thank You!', 1),
(26, 1, '03460973906', 'Dear Laboratory. Your Credentails. Email:lab@smc.com and Password: Lab123. Thank You!', 1),
(27, 1, '03460973906', 'Dear Shah Medical Center. You can access SMC WebApp using the following credentials. Email:manager@smc.com and Password: Manager123. Thank You!', 1),
(28, 1, '03460973906', 'Dear Pharmacy. You can access SMC WebApp using the following credentials. Email:pharmacy@smc.com and Password: Pharmacy123. Thank You!', 1),
(29, 1, '03460973906', 'Dear Shah Medical Center. You can access SMC WebApp using the following credentials. Email:counter@smc.com and Password: Counter123. Thank You!', 1),
(30, 1, '03460973906', 'Dear Basit, your patient has been admitted. Thank You! SMC', 1),
(31, 1, '03460973906', 'Dear Basit, your patient has been postpone. Thank You! SMC', 1),
(32, 1, '03460973906', 'Dear Basit, your patient has been admitted. Thank You! SMC', 1),
(33, 1, '03460973906', 'Dear Basit, your patient has been postpone. Thank You! SMC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ot_items`
--

CREATE TABLE `ot_items` (
  `id` int(11) NOT NULL,
  `ot_item_name` varchar(400) NOT NULL,
  `ot_item_qty` double NOT NULL,
  `ot_item_price` double NOT NULL,
  `ot_item_dop` datetime NOT NULL,
  `ot_item_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot_items`
--

INSERT INTO `ot_items` (`id`, `ot_item_name`, `ot_item_qty`, `ot_item_price`, `ot_item_dop`, `ot_item_status`) VALUES
(1, 'Testing', 222, 10, '2020-06-03 05:25:00', 0),
(2, 'Test', 22, 11, '2020-07-08 14:25:00', 1),
(3, 'Test', 22, 11, '2020-07-08 14:25:00', 1),
(4, 'As', 2, 2, '2020-06-01 09:25:00', 0),
(5, 'As', 2, 2, '2020-06-01 09:25:00', 1),
(6, 'Testing Item', 20, 250, '2020-06-16 12:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient_registration`
--

CREATE TABLE `patient_registration` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(4000) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `patient_gender` int(11) NOT NULL COMMENT '1:Male::2:Female::3:Other',
  `patient_address` varchar(4000) NOT NULL,
  `patient_cnic` double NOT NULL,
  `patient_contact` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `patient_doa` datetime NOT NULL COMMENT 'Date Of Admission',
  `patient_doop` datetime NOT NULL COMMENT 'Date Of Operation',
  `patient_disease` varchar(4000) NOT NULL,
  `patient_operation` varchar(300) NOT NULL,
  `patient_consultant` varchar(300) NOT NULL,
  `patient_yearly_no` varchar(250) NOT NULL,
  `attendent_name` varchar(300) NOT NULL,
  `consultant_charges` double NOT NULL,
  `anasthetic_name` varchar(400) NOT NULL,
  `anesthesia_charges` double NOT NULL,
  `auto_date` date NOT NULL DEFAULT current_timestamp(),
  `category` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_registration`
--

INSERT INTO `patient_registration` (`id`, `patient_name`, `patient_age`, `patient_gender`, `patient_address`, `patient_cnic`, `patient_contact`, `city_id`, `room_id`, `patient_doa`, `patient_doop`, `patient_disease`, `patient_operation`, `patient_consultant`, `patient_yearly_no`, `attendent_name`, `consultant_charges`, `anasthetic_name`, `anesthesia_charges`, `auto_date`, `category`, `added_by`, `updated_by`) VALUES
(7, 'asas', 22, 1, 'sadasd', 23123, '213123', 1, 1, '2020-06-03 16:09:19', '0000-00-00 00:00:00', 'asas', '0', '1', '2020-07', 'dcasdc', 0, '2', 0, '2020-06-03', 'currentPatient', 0, 0),
(11, 'Babar', 26, 1, 'ascasc', 5.165163516531653e16, '', 2, 5, '2020-07-16 16:02:42', '0000-00-00 00:00:00', 'Some', '0', '1', '2020-011', '', 0, '0', 0, '2020-07-16', 'currentPatient', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_bp`
--

CREATE TABLE `pat_observation_bp` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `bp_low` double NOT NULL,
  `bp_high` double NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_bp`
--

INSERT INTO `pat_observation_bp` (`id`, `pat_id`, `bp_low`, `bp_high`, `manual_date`, `auto_date`) VALUES
(1, 7, 69, 150, '2020-07-06 15:05:00', '2020-06-25 18:09:53'),
(2, 10, 80, 111, '2020-07-16 18:20:00', '2020-07-16 18:24:04'),
(3, 10, 50, 200, '2020-07-16 16:00:00', '2020-07-16 18:24:16'),
(4, 13, 77, 152, '2020-07-19 20:25:00', '2020-07-19 20:30:02'),
(5, 9, 65, 138, '2020-07-20 01:00:00', '2020-07-20 00:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_drain`
--

CREATE TABLE `pat_observation_drain` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `drain_measurement` varchar(250) NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_drain`
--

INSERT INTO `pat_observation_drain` (`id`, `pat_id`, `drain_measurement`, `manual_date`, `auto_date`) VALUES
(1, 8, '150mml', '2020-06-30 18:00:00', '2020-06-30 18:03:36'),
(2, 7, '180MML', '2020-07-02 17:15:00', '2020-07-02 17:19:19'),
(3, 10, '150mml', '2020-07-16 18:25:00', '2020-07-16 18:25:35'),
(4, 13, '180ML', '2020-07-19 20:25:00', '2020-07-19 20:30:34'),
(5, 9, '150mml', '2020-07-20 01:00:00', '2020-07-20 00:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_ng`
--

CREATE TABLE `pat_observation_ng` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `ng_measurement` varchar(250) NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_ng`
--

INSERT INTO `pat_observation_ng` (`id`, `pat_id`, `ng_measurement`, `manual_date`, `auto_date`) VALUES
(4, 8, '1500ml/liter', '2020-06-30 18:10:00', '2020-06-30 18:11:45'),
(5, 7, '1500ML/liter', '2020-07-02 17:15:00', '2020-07-02 17:19:30'),
(6, 5, '1500ML/liter', '2020-07-02 17:15:00', '2020-07-06 19:31:29'),
(7, 10, '1500ml/liter', '2020-07-16 18:25:00', '2020-07-16 18:25:47'),
(8, 13, '1500ML/liter', '2020-07-19 20:25:00', '2020-07-19 20:30:41'),
(9, 9, '1500ML/liter', '2020-07-20 01:00:00', '2020-07-20 00:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_pulse`
--

CREATE TABLE `pat_observation_pulse` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `pulse_rate` varchar(250) NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_pulse`
--

INSERT INTO `pat_observation_pulse` (`id`, `pat_id`, `pulse_rate`, `manual_date`, `auto_date`) VALUES
(1, 7, '125', '2020-06-25 18:05:00', '2020-06-25 18:27:33'),
(2, 7, '105', '2020-06-30 16:40:00', '2020-06-30 16:42:40'),
(3, 8, '150/m', '2020-06-30 16:50:00', '2020-06-30 16:52:10'),
(4, 7, '150', '2020-07-02 10:45:00', '2020-07-02 17:16:57'),
(5, 10, '125', '2020-07-15 18:05:00', '2020-07-16 18:24:41'),
(6, 13, '150/m', '2020-07-19 20:25:00', '2020-07-19 20:30:15'),
(7, 9, '150/m', '2020-07-20 01:00:00', '2020-07-20 00:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_respiratory`
--

CREATE TABLE `pat_observation_respiratory` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `respiratory_measurement` varchar(250) NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_respiratory`
--

INSERT INTO `pat_observation_respiratory` (`id`, `pat_id`, `respiratory_measurement`, `manual_date`, `auto_date`) VALUES
(3, 8, '120ML', '2020-06-30 17:46:00', '2020-06-30 17:46:18'),
(4, 7, '120ml', '2020-07-02 17:15:00', '2020-07-02 17:17:31'),
(5, 10, '120ML', '2020-07-16 18:25:00', '2020-07-16 18:25:22'),
(6, 13, '120mml', '2020-07-19 20:25:00', '2020-07-19 20:30:28'),
(7, 9, '120mml', '2020-07-20 01:00:00', '2020-07-20 00:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `pat_observation_urine`
--

CREATE TABLE `pat_observation_urine` (
  `id` int(11) NOT NULL,
  `pat_id` double NOT NULL,
  `urine_measurement` varchar(250) NOT NULL,
  `manual_date` datetime NOT NULL,
  `auto_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pat_observation_urine`
--

INSERT INTO `pat_observation_urine` (`id`, `pat_id`, `urine_measurement`, `manual_date`, `auto_date`) VALUES
(1, 8, '120ml', '2020-06-30 17:15:00', '2020-06-30 17:15:48'),
(2, 7, '120ML', '2020-07-02 17:15:00', '2020-07-02 17:17:07'),
(3, 10, '120ml', '2020-07-16 17:25:00', '2020-07-16 18:25:01'),
(4, 13, '120ml', '2020-07-19 20:25:00', '2020-07-19 20:30:20'),
(5, 9, '120ml', '2020-07-20 01:00:00', '2020-07-20 00:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_amount`
--

CREATE TABLE `pharmacy_amount` (
  `id` int(11) NOT NULL,
  `patient_id` double NOT NULL,
  `room_id` double NOT NULL,
  `medicines_total` double NOT NULL,
  `reference_no` double NOT NULL,
  `dateoforder` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `patient_payment_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy_amount`
--

INSERT INTO `pharmacy_amount` (`id`, `patient_id`, `room_id`, `medicines_total`, `reference_no`, `dateoforder`, `order_status`, `patient_payment_status`) VALUES
(2, 7, 1, 1400, 1, '2020-06-17 11:43:35', 0, 1),
(3, 8, 4, 88, 2, '2020-06-17 15:00:40', 0, 1),
(4, 9, 3, 3000, 12, '2020-07-16 16:22:24', 0, 1),
(5, 9, 3, 60, 13, '2020-07-16 20:48:18', 0, 1),
(6, 10, 2, 500, 14, '2020-07-16 20:49:05', 0, 0),
(7, 10, 2, 7000, 15, '2020-07-16 20:50:00', 0, 0),
(8, 10, 2, 550, 16, '2020-07-17 10:09:31', 0, 0),
(9, 12, 2, 750, 17, '2020-07-18 23:08:27', 0, 0),
(10, 12, 2, 500, 18, '2020-07-18 23:08:38', 0, 0),
(11, 13, 2, 2000, 19, '2020-07-19 20:26:25', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `postpone_patient`
--

CREATE TABLE `postpone_patient` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(4000) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `patient_gender` int(11) NOT NULL,
  `patient_address` varchar(4000) NOT NULL,
  `patient_cnic` double NOT NULL,
  `patient_contact` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `patient_doa` datetime NOT NULL,
  `patient_disease` varchar(4000) NOT NULL,
  `patient_consultant` varchar(300) NOT NULL,
  `patient_yearly_no` varchar(250) NOT NULL,
  `attendent_name` varchar(300) NOT NULL,
  `category` varchar(250) NOT NULL,
  `patient_doop` datetime NOT NULL,
  `patient_operation` varchar(300) NOT NULL,
  `consultant_charges` double NOT NULL,
  `anasthetic_name` varchar(400) NOT NULL,
  `anesthesia_charges` double NOT NULL,
  `postpond_date` datetime NOT NULL DEFAULT current_timestamp(),
  `auto_date` date NOT NULL DEFAULT current_timestamp(),
  `pat_id` double NOT NULL,
  `doctor_advice` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postpone_patient`
--

INSERT INTO `postpone_patient` (`id`, `patient_name`, `patient_age`, `patient_gender`, `patient_address`, `patient_cnic`, `patient_contact`, `city_id`, `room_id`, `patient_doa`, `patient_disease`, `patient_consultant`, `patient_yearly_no`, `attendent_name`, `category`, `patient_doop`, `patient_operation`, `consultant_charges`, `anasthetic_name`, `anesthesia_charges`, `postpond_date`, `auto_date`, `pat_id`, `doctor_advice`) VALUES
(1, 'Yaqoob Khan', 40, 1, 'Odigram', 1560284631482, '03460973906', 1, 2, '2020-05-30 00:00:00', 'Pain', '1', '2020-01', 'Naqib Khan', 'postponePatient', '2020-03-17 15:00:00', '1', 11000, '2', 1600, '2020-06-01 03:26:16', '2020-06-01', 0, ''),
(2, 'asxc', 21, 1, 'qwd', 123213, '123123', 1, 3, '2020-06-01 00:23:55', 'qwd', '1', '2020-03', 'ascasc', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-06-01 03:30:26', '2020-06-01', 0, ''),
(3, 'Yaqoob Khan', 40, 1, 'Odigram', 1560284631482, '03460973906', 1, 2, '2020-03-12 00:00:00', 'Pain', '1', '2020-01', 'Naqib Khan', 'postponePatient', '2020-03-17 15:00:00', '1', 11000, '2', 1600, '2020-06-01 03:34:11', '2020-06-01', 0, ''),
(4, 'scasca', 12, 1, 'ascascasc', 231231, '12312312', 1, 1, '2020-06-01 03:34:58', 'ascsc', '1', '2020-01', 'asdasda', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-06-01 03:44:38', '2020-06-01', 0, ''),
(5, 'ascasc', 123, 2, 'asdasdasd', 123123, '123123', 1, 1, '2020-06-01 03:44:50', 'qsdqwd', '1', '2020-05', 'qsdasd', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-06-01 04:10:09', '2020-06-01', 0, ''),
(6, 'gdfgdf', 22, 1, 'ascasca', 213123, '1231231', 1, 1, '2020-06-01 04:10:11', 'ascasc', '1', '2020-06', 'sdfvsdv', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-06-01 13:34:12', '2020-06-01', 0, ''),
(9, 'ascasc', 12, 1, 'Sacascasc', 213123123, '312312312', 1, 2, '2020-06-05 10:57:46', 'C Section', '1', '2020-08', 'saxcasc', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-20 01:00:03', '2020-07-20', 8, 'ascascasc,\r\nacsasc,\r\nascasc'),
(10, 'ascasc', 12, 1, 'Sacascasc', 213123123, '312312312', 1, 2, '2020-06-05 10:57:46', 'C Section', '1', '2020-08', 'saxcasc', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-20 01:00:26', '2020-07-20', 8, 'ascascasc,\r\nacsasc,\r\nascasc'),
(11, 'ascasc', 12, 1, 'Sacascasc', 213123123, '312312312', 1, 2, '2020-06-05 10:57:46', 'C Section', '1', '2020-08', 'saxcasc', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-20 01:00:31', '2020-07-20', 8, 'ascascasc,\r\nacsasc,\r\nascasc'),
(12, 'ascasc', 12, 1, 'Sacascasc', 213123123, '312312312', 1, 2, '2020-06-05 10:57:46', 'C Section', '1', '2020-08', 'saxcasc', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-20 01:00:35', '2020-07-20', 8, 'ascascasc,\r\nacsasc,\r\nascasc'),
(13, 'asbucia', 26, 1, 'Saidu Sharif', 1560284614213, '03460973906', 2, 2, '2020-07-22 00:40:00', 'Pain', '1', '2020-015', 'Babar', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-22 00:45:39', '2020-07-22', 14, 'ascasc,cascasc,ascascas'),
(14, 'ascasc', 22, 3, 'ascasc', 1212123123, '21312312312', 2, 2, '2020-07-22 14:21:00', 'asc', '1', '2020-016', 'acascacs', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-22 14:22:28', '2020-07-22', 15, 'ascasc'),
(15, '', 0, 0, '', 0, '', 0, 0, '0000-00-00 00:00:00', '', '', '', '', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-22 14:22:40', '2020-07-22', 15, 'ascacs,\r\nascascasc,\r\nascascasc,\r\nascascasc'),
(16, '', 0, 0, '', 0, '', 0, 0, '0000-00-00 00:00:00', '', '', '', '', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-22 14:22:47', '2020-07-22', 15, 'ascacs,\r\nascascasc,\r\nascascasc,\r\nascascasc'),
(17, 'Khan G', 29, 1, 'Madyan', 1560284614213, '03460973906', 2, 3, '2020-07-24 18:34:00', 'Pain', '1', '2020-019', 'Basit', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-24 18:41:34', '2020-07-24', 16, 'ascasc'),
(18, 'Khan G', 29, 1, 'Madyan', 1560284614213, '03460973906', 2, 2, '2020-07-24 18:43:12', 'Pain', '1', '2020-020', 'Basit', 'postponePatient', '0000-00-00 00:00:00', '0', 0, '0', 0, '2020-07-24 18:43:36', '2020-07-24', 17, 'ascasc');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(250) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `room_price` double NOT NULL,
  `room_type` int(11) NOT NULL COMMENT 'SingleBed:1::DoubleBed:2',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Avail::0:Booked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `floor_id`, `room_price`, `room_type`, `status`) VALUES
(1, 'Room No.1', 1, 1000, 2, 0),
(2, 'Room No.2', 1, 1200, 2, 1),
(3, 'Room No.3', 2, 1500, 1, 1),
(4, 'Room No.30', 1, 500, 1, 0),
(5, '', 0, 0, 0, 0),
(6, 'Room No 15', 2, 1500, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_category`
--

CREATE TABLE `staff_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_category`
--

INSERT INTO `staff_category` (`id`, `category_name`) VALUES
(1, 'Nurse'),
(2, 'Anesthesia'),
(3, 'Doctor'),
(4, 'Sweeper');

-- --------------------------------------------------------

--
-- Table structure for table `staff_members`
--

CREATE TABLE `staff_members` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `cnic` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `salary` double NOT NULL,
  `date_of_joining` date NOT NULL,
  `contact` double NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `visit_charges` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Avail::0:Terminated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_members`
--

INSERT INTO `staff_members` (`id`, `name`, `cnic`, `category_id`, `salary`, `date_of_joining`, `contact`, `start_time`, `end_time`, `visit_charges`, `status`) VALUES
(1, 'Aman Ullah', 1560287456841, 3, 10000, '2020-03-17', 3460973906, '02:00:00', '19:30:00', 500, 1),
(2, 'Basit', 1560284614299, 2, 1500, '2020-03-18', 3460973906, '14:00:00', '21:00:00', 0, 1),
(3, 'ABCDEFSSS', 156028468462, 1, 150, '2020-05-27', 3461235469, '14:50:00', '13:45:00', 0, 1),
(5, 'Bilal', 1560284655213, 2, 1500, '2020-07-18', 3460973906, '09:00:00', '22:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `surgeries`
--

CREATE TABLE `surgeries` (
  `id` int(11) NOT NULL,
  `surgery_name` varchar(400) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgeries`
--

INSERT INTO `surgeries` (`id`, `surgery_name`, `member_id`, `status`) VALUES
(1, 'Apendix', 1, 1),
(2, 'C Section', 1, 1),
(3, 'C Section', 2, 1),
(4, 'C Section', 5, 1),
(5, 'aslncakns', 2, 1),
(6, 'aslncakns', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_medicines`
--
ALTER TABLE `add_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anesthetic_surgery_charges`
--
ALTER TABLE `anesthetic_surgery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anethetic_paid_amount`
--
ALTER TABLE `anethetic_paid_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tbl`
--
ALTER TABLE `device_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discharge_patients`
--
ALTER TABLE `discharge_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discharge_patients_charges`
--
ALTER TABLE `discharge_patients_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_paid_amount`
--
ALTER TABLE `doctor_paid_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_surgery_charges`
--
ALTER TABLE `doctor_surgery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_visit_charges`
--
ALTER TABLE `doctor_visit_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_designation`
--
ALTER TABLE `employee_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_registration`
--
ALTER TABLE `employee_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_advance_payment`
--
ALTER TABLE `emp_advance_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_order`
--
ALTER TABLE `lab_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_test_category`
--
ALTER TABLE `lab_test_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_test_report`
--
ALTER TABLE `lab_test_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_order`
--
ALTER TABLE `medicine_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_tbl`
--
ALTER TABLE `message_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_items`
--
ALTER TABLE `ot_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_registration`
--
ALTER TABLE `patient_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_bp`
--
ALTER TABLE `pat_observation_bp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_drain`
--
ALTER TABLE `pat_observation_drain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_ng`
--
ALTER TABLE `pat_observation_ng`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_pulse`
--
ALTER TABLE `pat_observation_pulse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_respiratory`
--
ALTER TABLE `pat_observation_respiratory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pat_observation_urine`
--
ALTER TABLE `pat_observation_urine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_amount`
--
ALTER TABLE `pharmacy_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postpone_patient`
--
ALTER TABLE `postpone_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_category`
--
ALTER TABLE `staff_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surgeries`
--
ALTER TABLE `surgeries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_medicines`
--
ALTER TABLE `add_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `anesthetic_surgery_charges`
--
ALTER TABLE `anesthetic_surgery_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anethetic_paid_amount`
--
ALTER TABLE `anethetic_paid_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `device_tbl`
--
ALTER TABLE `device_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discharge_patients`
--
ALTER TABLE `discharge_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discharge_patients_charges`
--
ALTER TABLE `discharge_patients_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_paid_amount`
--
ALTER TABLE `doctor_paid_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_surgery_charges`
--
ALTER TABLE `doctor_surgery_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_visit_charges`
--
ALTER TABLE `doctor_visit_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_designation`
--
ALTER TABLE `employee_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_registration`
--
ALTER TABLE `employee_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emp_advance_payment`
--
ALTER TABLE `emp_advance_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lab_order`
--
ALTER TABLE `lab_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lab_test_category`
--
ALTER TABLE `lab_test_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lab_test_report`
--
ALTER TABLE `lab_test_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicine_order`
--
ALTER TABLE `medicine_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `message_tbl`
--
ALTER TABLE `message_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ot_items`
--
ALTER TABLE `ot_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_registration`
--
ALTER TABLE `patient_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pat_observation_bp`
--
ALTER TABLE `pat_observation_bp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pat_observation_drain`
--
ALTER TABLE `pat_observation_drain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pat_observation_ng`
--
ALTER TABLE `pat_observation_ng`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pat_observation_pulse`
--
ALTER TABLE `pat_observation_pulse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pat_observation_respiratory`
--
ALTER TABLE `pat_observation_respiratory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pat_observation_urine`
--
ALTER TABLE `pat_observation_urine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pharmacy_amount`
--
ALTER TABLE `pharmacy_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `postpone_patient`
--
ALTER TABLE `postpone_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_category`
--
ALTER TABLE `staff_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_members`
--
ALTER TABLE `staff_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surgeries`
--
ALTER TABLE `surgeries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
