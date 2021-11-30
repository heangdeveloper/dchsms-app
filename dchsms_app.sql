-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 30, 2021 at 08:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dchsms_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `year`, `created_at`, `updated_at`) VALUES
(1, '2010 - 2011', '2021-11-02 00:42:50', '2021-11-02 00:42:50'),
(2, '2011 - 2012', '2021-11-02 00:43:03', '2021-11-02 00:43:03'),
(3, '2012 - 2013', '2021-11-02 00:43:13', '2021-11-02 00:43:13'),
(4, '2013 - 2014', '2021-11-02 00:43:23', '2021-11-02 00:43:23'),
(5, '2014 - 2015', '2021-11-02 00:43:32', '2021-11-02 00:43:32'),
(6, '2015 - 2016', '2021-11-02 00:43:43', '2021-11-02 00:43:43'),
(7, '2016 - 2017', '2021-11-02 00:44:00', '2021-11-02 00:44:00'),
(8, '2017 - 2018', '2021-11-02 00:44:09', '2021-11-02 00:44:09'),
(9, '2018 - 2019', '2021-11-02 00:44:20', '2021-11-02 00:44:20'),
(10, '2019 - 2020', '2021-11-02 00:44:31', '2021-11-02 00:44:31'),
(11, '2020 - 2021', '2021-11-02 00:44:42', '2021-11-02 00:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classnum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `classnum`, `grade`, `created_at`, `updated_at`) VALUES
(3, '101', '1A', '2021-11-02 20:14:02', '2021-11-02 20:14:02'),
(6, '102', '1B', '2021-11-02 20:14:12', '2021-11-02 20:14:12'),
(7, '103', '1C', '2021-11-02 20:15:00', '2021-11-02 20:15:00'),
(8, '104', '1D', '2021-11-02 20:15:07', '2021-11-02 20:15:07'),
(9, '105', '1E', '2021-11-02 20:15:15', '2021-11-02 20:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `compuses`
--

CREATE TABLE `compuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_kh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compuses`
--

INSERT INTO `compuses` (`id`, `name_kh`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'សាខាសួនយុវវ័ន', 'Soun Yuwan Campus', NULL, NULL),
(2, 'សាខាសេះស', 'Sessor Campus', NULL, NULL),
(3, 'សាខាបន្ទាយមានជ័យ', 'Banteay Meanchey Campus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `curricula`
--

CREATE TABLE `curricula` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `curriculum_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `curricula`
--

INSERT INTO `curricula` (`id`, `curriculum_name`, `created_at`, `updated_at`) VALUES
(1, 'Khmer Curriculum', '2021-11-02 00:42:04', '2021-11-02 00:42:04'),
(2, 'English Curriculum', '2021-11-02 00:42:14', '2021-11-02 00:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `discount_types`
--

CREATE TABLE `discount_types` (
  `id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `percent_dis` float NOT NULL,
  `from_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` enum('active','unactive') NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount_types`
--

INSERT INTO `discount_types` (`id`, `discount_name`, `percent_dis`, `from_date`, `exp_date`, `note`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Promotion covid 19', 20, '2021-01-01', '2022-01-01', 'Covid', 'active', '2021-11-11', '2021-11-11'),
(5, 'Promotion 2022 New Discount', 20, '2022-01-01', '2022-12-11', 'Promotion 2022', 'active', '2021-11-11', '2021-11-11'),
(6, 'Promotion Discount By CEO', 70, '2019-01-01', '2025-01-01', 'By CEO', 'active', '2021-11-11', '2021-11-11'),
(7, 'Promotion Online Class Covid 19', 30, '2021-11-01', '2021-11-30', 'Promotion Online Class Covid 19', 'active', '2021-11-11', '2021-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `type_id` int(11) NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hire` date NOT NULL,
  `stime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ltime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('Married','Unmarried') COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_type` enum('Full Time','Part Time') COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commune` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `gender`, `dob`, `type_id`, `tel`, `hire`, `stime`, `ltime`, `email`, `national`, `photo`, `marital_status`, `employee_type`, `village`, `commune`, `district`, `province`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Raymond Valdez', 'Carly Stark', 'Female', '2005-02-08', 4, 'Quia consectetur in', '2000-05-19', '03:46', '14:57', 'jiby@mailinator.com', 'Ea et magnam qui nes', 'default.png', 'Unmarried', 'Full Time', 'Repudiandae aperiam', 'Voluptatum aliquip m', 'Omnis est dolor mini', 'Nobis saepe ex minim', 1, '2021-11-01 20:51:47', '2021-11-01 20:51:47'),
(2, 'Jorden Harrington', 'Nero Holder', 'Female', '1988-12-27', 3, 'Voluptatem exercita', '2013-06-28', '06:12', '06:39', 'bema@mailinator.com', 'Repudiandae sit null', '2021-11-02-6180b5f18ab93.jpg', 'Unmarried', 'Part Time', 'Cupidatat aut sequi', 'Eu cupidatat laborio', 'Voluptate et quis la', 'Quam recusandae Rem', 1, '2021-11-01 20:52:18', '2021-11-01 20:52:18'),
(3, 'Uma Baker', 'Nelle Aguirre', 'Female', '1979-01-27', 1, 'Aliquid est atque d', '1998-11-03', '11:05', '12:23', 'simu@mailinator.com', 'Pariatur Consequatu', 'default.png', 'Married', 'Part Time', 'Atque quas eaque qui', 'Velit dolore ad illo', 'Culpa consectetur', 'Enim est ut obcaecat', 1, '2021-11-02 00:11:38', '2021-11-02 00:11:38'),
(4, 'Samuel Macias', 'Bree Walls', 'Female', '1997-04-03', 1, 'Qui repudiandae haru', '2010-09-14', '21:02', '14:41', 'wogot@mailinator.com', 'Qui nulla qui et vol', 'default.png', 'Unmarried', 'Part Time', 'Provident dolore id', 'Itaque nobis volupta', 'Pariatur Reiciendis', 'Exercitation sit co', 1, '2021-11-02 00:11:44', '2021-11-02 00:11:44'),
(5, 'Lara Ford', 'Linda Kaufman', 'Female', '2004-09-16', 1, 'Et elit deleniti te', '2007-04-10', '04:44', '09:01', 'wijybisezo@mailinator.com', 'Molestiae et qui cum', 'default.png', 'Married', 'Full Time', 'Sunt deserunt dignis', 'Illo nemo quas accus', 'Veniam autem nobis', 'Quaerat in rerum fug', 1, '2021-11-02 00:11:50', '2021-11-02 00:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendances`
--

CREATE TABLE `employee_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` enum('Present','Permission','Absent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_attendances`
--

INSERT INTO `employee_attendances` (`id`, `emp_id`, `branch_id`, `status`, `date`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Permission', '2021-11-02', '2021-11-02 02:54:05', '2021-11-02 03:03:29'),
(2, 4, 1, 'Permission', '2021-11-02', '2021-11-02 02:54:05', '2021-11-02 03:03:29'),
(3, 5, 1, 'Permission', '2021-11-02', '2021-11-02 02:54:05', '2021-11-02 03:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee_positions`
--

CREATE TABLE `employee_positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_positions`
--

INSERT INTO `employee_positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Teacher', NULL, NULL),
(2, 'Teacher Assistant', NULL, NULL),
(3, 'Security', NULL, NULL),
(4, 'Administration', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` int(150) NOT NULL,
  `invoice_text` varchar(255) DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `invoice_text`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 1000, NULL, 1, '2021-11-15', '2021-11-15'),
(2, 1001, NULL, 1, '2021-11-22', '2021-11-22'),
(3, 1002, NULL, 1, '2021-11-22', '2021-11-22'),
(4, 1003, NULL, 1, '2021-11-23', '2021-11-23'),
(5, 1004, NULL, 1, '2021-11-24', '2021-11-24'),
(6, 1005, NULL, 1, '2021-11-24', '2021-11-24'),
(7, 1006, NULL, 1, '2021-11-30', '2021-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2021_10_13_083058_create_compuses_table', 1),
(25, '2021_10_13_083509_create_roles_table', 1),
(26, '2021_10_13_083749_create_subjects_table', 1),
(27, '2021_10_13_084046_create_terms_table', 1),
(28, '2021_10_13_084232_create_classrooms_table', 1),
(29, '2021_10_13_084317_create_students_table', 1),
(30, '2021_10_13_084558_create_parents_table', 1),
(31, '2021_10_13_084715_create_academic_years_table', 1),
(32, '2021_10_13_084820_create_student_attendances_table', 1),
(33, '2021_10_13_085107_create_employee_positions_table', 1),
(34, '2021_10_13_085735_create_student_classes_table', 1),
(35, '2021_10_13_085823_create_teacher_classes_table', 1),
(36, '2021_10_13_085853_create_curricula_table', 1),
(37, '2021_10_13_085944_create_employees_table', 1),
(38, '2021_10_13_090049_create_scores_table', 1),
(39, '2021_10_30_041349_create_student_registers_table', 1),
(40, '2021_11_02_022533_create_employee_attendances_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `invoice_des` text NOT NULL,
  `deposit` float DEFAULT NULL,
  `year_academic` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `branch_id`, `payment_date`, `due_date`, `payment_method`, `invoice_des`, `deposit`, `year_academic`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2021-11-24', NULL, 1, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.,Tuition Fee - Half Day 2.5 years old to under 6 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 50, 11, '2021-11-24', '2021-11-24'),
(2, 7, 1, '2021-11-24', NULL, 2, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Semester from(2021-11-01-2022-05-01), No Discount.', NULL, 11, '2021-11-24', '2021-11-24'),
(3, 7, 1, '2021-11-30', NULL, 2, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.,Tuition Fee - Full Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.,Tuition Fee - Half Day 2.5 years old to under 6 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 200, 11, '2021-11-30', '2021-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `id_inovice_type` int(11) NOT NULL,
  `id_pro_service` int(11) NOT NULL,
  `id_payterm` int(11) NOT NULL,
  `user_id_pay` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `ori_price` float NOT NULL,
  `disccount` int(11) NOT NULL,
  `total_amount` float DEFAULT NULL,
  `total_payment` float GENERATED ALWAYS AS (ifnull(`total_amount` - `total_amount` * `disccount` / 100,0)) STORED,
  `lose_piad` float GENERATED ALWAYS AS (ifnull(`total_amount`,0) - ifnull(`total_payment`,0)) STORED,
  `Volidty_of_payment` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `school_year` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `id_invoice`, `id_payment`, `id_inovice_type`, `id_pro_service`, `id_payterm`, `user_id_pay`, `description`, `qty`, `ori_price`, `disccount`, `total_amount`, `Volidty_of_payment`, `expired_date`, `school_year`, `remark`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 3, 12, 1, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 1, 33, 20, 33, '2021-11-01', '2022-11-01', '11', NULL, 1, '2021-11-24 02:29:37', '2021-11-24 02:29:37'),
(2, 5, 1, 1, 9, 12, 1, 'Tuition Fee - Half Day 2.5 years old to under 6 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 1, 55, 20, 55, '2021-11-01', '2022-11-01', '11', NULL, 1, '2021-11-24 02:29:37', '2021-11-24 02:29:37'),
(3, 6, 2, 1, 2, 6, 1, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Semester from(2021-11-01-2022-05-01), No Discount.', 1, 22, 0, 22, '2021-11-01', '2022-05-01', '11', NULL, 1, '2021-11-24 02:49:31', '2021-11-24 02:49:31'),
(4, 7, 3, 1, 3, 12, 1, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 1, 33, 20, 33, '2021-11-01', '2022-11-01', '11', NULL, 1, '2021-11-30 01:40:24', '2021-11-30 01:40:24'),
(5, 7, 3, 1, 6, 12, 1, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 1, 55, 20, 55, '2021-11-01', '2022-11-01', '11', NULL, 1, '2021-11-30 01:40:24', '2021-11-30 01:40:24'),
(6, 7, 3, 1, 9, 12, 1, 'Tuition Fee - Half Day 2.5 years old to under 6 years old::School Year 2020 - 2021::Paid for Per Year from(2021-11-01-2022-11-01), 20% Promotion covid 19.', 1, 55, 20, 55, '2021-11-01', '2022-11-01', '11', NULL, 1, '2021-11-30 01:40:24', '2021-11-30 01:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2021-11-05', '2021-11-05'),
(2, 'Bank', '2021-11-05', '2021-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `pay_type`
--

CREATE TABLE `pay_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_type`
--

INSERT INTO `pay_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Per Month', '2021-11-10', '2021-11-10'),
(2, 'Per Term', '2021-11-10', '2021-11-10'),
(3, 'Per Semester', '2021-11-10', '2021-11-10'),
(4, 'Per Year', '2021-11-10', '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_services`
--

CREATE TABLE `product_services` (
  `id` int(11) NOT NULL,
  `pro_service` varchar(255) NOT NULL,
  `price_service` float NOT NULL,
  `id_service_type` int(11) NOT NULL,
  `id_academic` int(11) NOT NULL,
  `pay_month` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_services`
--

INSERT INTO `product_services` (`id`, `pro_service`, `price_service`, `id_service_type`, `id_academic`, `pay_month`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old', 22, 1, 11, 6, 1, '2021-11-12', '2021-11-12'),
(3, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old', 33, 1, 11, 12, 1, '2021-11-12', '2021-11-12'),
(4, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 205, 1, 11, 3, 1, '2021-11-12', '2021-11-27'),
(5, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 55, 1, 11, 6, 1, '2021-11-12', '2021-11-12'),
(6, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 55, 1, 11, 12, 1, '2021-11-12', '2021-11-12'),
(7, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 55, 1, 11, 3, 1, '2021-11-12', '2021-11-12'),
(8, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 55, 1, 11, 6, 1, '2021-11-12', '2021-11-12'),
(9, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 55, 1, 11, 12, 1, '2021-11-12', '2021-11-12'),
(10, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 55, 1, 11, 3, 1, '2021-11-12', '2021-11-12'),
(11, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 55, 1, 11, 6, 1, '2021-11-12', '2021-11-12'),
(13, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old', 200, 1, 10, 3, 1, '2021-11-27', '2021-11-27'),
(14, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old', 300, 1, 10, 6, 1, '2021-11-27', '2021-11-27'),
(15, 'Tuition Fee - Half Day 1.5 years old to under 2.5 years old', 400, 1, 10, 12, 1, '2021-11-27', '2021-11-27'),
(16, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 500, 1, 10, 3, 1, '2021-11-27', '2021-11-27'),
(17, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 600, 1, 10, 6, 1, '2021-11-27', '2021-11-27'),
(18, 'Tuition Fee - Full Day 1.5 years old to under 2.5 years old', 700, 1, 10, 12, 1, '2021-11-27', '2021-11-27'),
(19, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 100, 1, 10, 3, 1, '2021-11-27', '2021-11-27'),
(20, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 200, 1, 10, 6, 1, '2021-11-27', '2021-11-27'),
(21, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 300, 1, 10, 12, 1, '2021-11-27', '2021-11-27'),
(22, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 400, 1, 10, 3, 1, '2021-11-27', '2021-11-27'),
(23, 'Tuition Fee - Half Day 2.5 years old to under 6 years old', 500, 1, 10, 6, 1, '2021-11-27', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `lart` double NOT NULL,
  `math` double NOT NULL,
  `science` double NOT NULL,
  `art` double NOT NULL,
  `music` double NOT NULL,
  `khmer` double NOT NULL,
  `moral` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services_types`
--

CREATE TABLE `services_types` (
  `id` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services_types`
--

INSERT INTO `services_types` (`id`, `service_type`, `created_at`, `updated_at`) VALUES
(1, 'Tuition Fee', '2021-11-10', '2021-11-10'),
(2, 'Uniform', '2021-11-10', '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stuno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sunamekh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finamekh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sunameen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finameen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `race` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_admission` date NOT NULL,
  `status` enum('Studying','Stop','Suspension') COLLATE utf8mb4_unicode_ci NOT NULL,
  `farther_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farther_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_race` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_race` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_national` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_national` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `stuno`, `sunamekh`, `finamekh`, `sunameen`, `finameen`, `gender`, `race`, `tel`, `national`, `dob`, `village`, `commune`, `district`, `province`, `img`, `level`, `from_school`, `date_admission`, `status`, `farther_name`, `mother_name`, `farther_address`, `mother_address`, `father_job`, `mother_job`, `father_status`, `mother_status`, `father_race`, `mother_race`, `father_national`, `mother_national`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, '0001', 'ខៀវ', 'វិជ្ជា', 'Khiev', 'Vichear', 'Male', 'Khmer', '012345678', 'Khmer', '2002-11-04', 'អូតាគាំ១', 'ទួតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', '2021-11-23-619cbdb3688b7.jpg', '១', 'វិទ្យាល័យព្រះមុន្នីវង្ស', '2021-11-23', 'Studying', 'ម៉ា​ លាភ', 'ស៊ូ ច័ន្ទគ្រីស្ណា', 'បាត់ដំបង', 'បាត់ដំបង', 'ទាហាន', 'លក់ដូរ', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 03:08:51', '2021-11-23 03:08:51'),
(2, '0002', 'រស់', 'រស្មី', 'Ros', 'Raksmei', 'Female', 'Khmer', '0965235143', 'Khmer', '2008-11-10', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', 'default.png', '១', 'វិទ្យាល័យសម្តេចឪ', '2021-11-24', 'Studying', 'Ouch Samang', 'Mul Vithara', 'សៀមរាប', 'សៀមរាប', 'ធ្វើការ', 'គ្រូបង្រៀន', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 18:57:49', '2021-11-23 18:57:49'),
(3, '0003', 'អ៊ុក', 'ស្រអែម', 'Ouk', 'Sraem', 'Female', 'Khmer', '012485693', 'Khmer', '2010-11-02', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', '2021-11-24-619d9f697264c.jpg', '១', 'វិទ្យាល័យព្រះមុន្នីវង្ស', '2021-11-24', 'Studying', 'Eam Montha', 'Loun Ary', 'បាត់ដំបង', 'បាត់ដំបង', 'បុគ្គលិកក្រុមហ៊ុន', 'គ្រូបង្រៀន', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 19:11:53', '2021-11-23 19:11:53'),
(4, '0004', 'វឿម', 'វិចិត្រ', 'Voeum', 'Vichet', 'Male', 'Khmer', '011362548', 'Khmer', '2009-11-03', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', 'default.png', '១', 'វិទ្យាល័យព្រះមុន្នីវង្ស', '2021-11-24', 'Studying', 'Sam Nisay', 'Thith Mau', 'បាត់ដំបង', 'បាត់ដំបង', 'លក់ដូរ', 'លក់ដូរ', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 19:16:04', '2021-11-23 19:16:04'),
(5, '0005', 'អៀម', 'ចរិយា', 'Iam', 'Chakriya', 'Female', 'Khmer', '011653248', 'Khmer', '2021-11-24', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', '2021-11-24-619da12aafec5.jpg', '១', 'វិទ្យាល័យព្រះមុន្នីវង្ស', '2021-11-24', 'Studying', 'Sok Visal', 'Sok Visal', 'បាត់ដំបង', 'បាត់ដំបង', 'លក់ដូរ', 'លក់ដូរ', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 19:19:22', '2021-11-23 19:19:22'),
(6, '0006', 'អ៊ឹង', 'មុន្នី', 'Ung', 'Mony', 'Male', 'Khmer', '01658932', 'Khmer', '2015-11-24', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', 'default.png', '១', 'វិទ្យាល័យសម្តេចឪ', '2021-11-24', 'Studying', 'Yun Sokhom', 'Chea Kannitha', 'បាត់ដំបង', 'បាត់ដំបង', 'លក់ដូរ', 'លក់ដូរ', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 19:25:27', '2021-11-23 19:25:27'),
(7, '0007', 'អ៊ុច', 'សុភ័ណ្ឌ', 'Uch', 'Sophorn', 'Female', 'Khmer', '012548632', 'Khmer', '2016-11-16', 'អូតាគាំ១', 'ទួលតាឯក', 'បាត់ដំបង', 'បាត់ដំបង', '2021-11-24-619da7b8e8a21.jpg', '1', 'វិទ្យាល័យសម្តេចឪ', '2021-11-24', 'Studying', 'Chen Chhay', 'Yos Sophon', 'បាត់ដំបង', 'បាត់ដំបង', 'លក់ដូរ', 'លក់ដូរ', 'Alive', 'Alive', 'Khmer', 'Khmer', 'Cambodia', 'Cambodia', 1, '2021-11-23 19:47:21', '2021-11-23 19:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` enum('Present','Permission','Absent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `class_id`, `stu_id`, `branch_id`, `status`, `reason`, `date`, `created_at`, `updated_at`) VALUES
(27, 3, 1, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(28, 3, 2, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(29, 3, 3, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(30, 3, 4, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(31, 3, 1, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(32, 3, 2, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(33, 3, 3, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(34, 3, 4, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(35, 3, 5, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57'),
(36, 3, 6, 1, 'Present', '', '2021-11-26', '2021-11-25 20:35:57', '2021-11-25 20:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `stime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`id`, `stu_id`, `class_id`, `academic_year_id`, `stime`, `etime`, `curriculum_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(2, 2, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(3, 3, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(4, 4, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(5, 5, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(6, 6, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48'),
(7, 7, 3, 11, '07:00', '11:00', 2, 1, '2021-11-25 21:20:48', '2021-11-25 21:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Khmer', '2021-11-02 00:12:37', '2021-11-02 00:12:37'),
(2, 'English', '2021-11-02 00:12:45', '2021-11-02 00:12:45'),
(3, 'Math', '2021-11-02 00:12:51', '2021-11-02 00:12:51'),
(4, 'Music', '2021-11-02 00:13:07', '2021-11-02 00:13:07'),
(5, 'Chemistry', '2021-11-02 00:13:25', '2021-11-02 00:13:25'),
(6, 'Physics', '2021-11-02 00:13:40', '2021-11-02 00:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_classes`
--

CREATE TABLE `teacher_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teaid` int(11) NOT NULL,
  `claid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_classes`
--

INSERT INTO `teacher_classes` (`id`, `teaid`, `claid`, `subid`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 2, 1, '2021-11-25 21:19:44', '2021-11-25 21:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `term_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_title`, `created_at`, `updated_at`) VALUES
(1, 'Term 1', '2021-11-02 00:14:48', '2021-11-02 00:14:48'),
(2, 'Term 2', '2021-11-02 00:14:55', '2021-11-02 00:14:55'),
(3, 'Term 3', '2021-11-02 00:15:01', '2021-11-02 00:15:01'),
(4, 'Term 4', '2021-11-02 00:15:07', '2021-11-02 00:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `date_join` date NOT NULL,
  `status` enum('active','unactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `campus_id`, `role_id`, `fullname`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `date_join`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Administrator', 'admin', 'admin@email.com', NULL, '$2y$10$3Hjfa0HdBawKOKxGyHSG6ejqJWDCwWMFNRbvUk/nm06rpvEQ/Xnka', 'default.png', '2021-11-02', 'active', NULL, NULL, '2021-11-24 21:37:42'),
(4, 1, 1, 'Cedric Cervantes', 'Lesley Rivers', 'mymy@mailinator.com', NULL, '$2y$10$Z0K0eUWThSaoayoNGrb.6uztn5JfBwj1O4tZ3dTwBso7Spv4El9gy', '2021-11-25-619f14fd5c6cf.jpg', '2021-11-25', 'active', NULL, '2021-11-24 21:45:49', '2021-11-24 21:45:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compuses`
--
ALTER TABLE `compuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curricula`
--
ALTER TABLE `curricula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_types`
--
ALTER TABLE `discount_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_positions`
--
ALTER TABLE `employee_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_type`
--
ALTER TABLE `pay_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_types`
--
ALTER TABLE `services_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `compuses`
--
ALTER TABLE `compuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `curricula`
--
ALTER TABLE `curricula`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount_types`
--
ALTER TABLE `discount_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_positions`
--
ALTER TABLE `employee_positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pay_type`
--
ALTER TABLE `pay_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services_types`
--
ALTER TABLE `services_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
