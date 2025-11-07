-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2025 at 07:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wh_servvo`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori_barang` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `kategori_barang`, `created_at`, `updated_at`) VALUES
('01.00.11.12.3', 'P 100 ABC SA2', 'PCS', 'bahanbaku', NULL, NULL),
('01.01.24.05', 'B 100 SV-5 SKND', 'PCS', 'barangjadi', NULL, NULL),
('05.00.11.00', 'POWDER ABC 55%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.12.00', 'POWDER ABC 90%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.12.00 (P)', 'POWDER ABC 90% (PAIL)', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.13.00', 'POWDER D-met 85%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.14.00', 'POWDER BC PK 80%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.14.01', 'POWDER BC 80%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.16.00', 'POWDER ABC T40%', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.21.00', 'AFFF 6% ( LITER )', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.23.00', 'AFFF AR 6% ( LITER )', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.24.00', 'WET CHEMICAL ( L )', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.26.00', 'HFC 236fa', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.27.00', 'HFC 227ea', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.30.00', 'CARBONDIOXIDE', 'Kg', 'Bahan Baku', NULL, NULL),
('05.00.36.00', 'FE-36', 'Kg', 'Bahan Baku', NULL, NULL),
('06.01.00.05', 'CYLINDER 1 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.01.00.20 (D)', 'CYLINDER 1 KG SA 1.2 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.01.00.20 (T)', 'CYLINDER 1 KG SA 1.2 MM (TROLLEY)', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.01.00.50 (D)', 'CYLINDER 1 KG SA 1.5 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.01.00.50 (T)', 'CYLINDER 1 KG SA 1.5 MM (TROLLEY)', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.02.00.05', 'CYLINDER 2 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.02.30.28', 'CYLINDER 2 KG CO2 MS', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.03.00.05', 'CYLINDER 3 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.03.00.06', 'CYLINDER 3 KG M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.03.00.101', 'CYLINDER 3 KG M30 IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.05.00.20 (D)', 'CYLINDER 0,5 KG SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.05.00.20 (D2)', 'CYLINDER 0,5 KG SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.05.00.20 (T)', 'CYLINDER 0,5 KG SA (TROLLEY)', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.05.30.28', 'CYLINDER 5 KG CO2 MS', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.06.00.05 (D)', 'CYLINDER 6 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.06.00.05 (D2)', 'CYLINDER 6 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.06.00.06', 'CYLINDER 6 KG M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.06.00.101', 'CYLINDER 6 KG M30 IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.06.00.102', 'CYLINDER 6 KG M50 IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.09.00.05 (D)', 'CYLINDER 9 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.09.00.05 (D2)', 'CYLINDER 9 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.09.00.101', 'CYLINDER 9 KG M30 IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.09.30.28', 'CYLINDER 9 KG CO2 MS', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.12.00.05', 'CYLINDER 12 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.23.30.29', 'CYLINDER 23 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.23.30.45', 'CYLINDER 23 KG CO2 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.45.00.05 (D)', 'CYLINDER 4.5 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.45.00.05 (D2)', 'CYLINDER 4.5 KG M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.45.30.29', 'CYLINDER 45 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.45.30.45', 'CYLINDER 45 KG CO2 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.52.00.32 (D)', 'CYLINDER 2 - 5 KG THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.52.00.32 (D2)', 'CYLINDER 2 - 5 KG THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.59.00.47', 'BOTTOM CYLINDER 50-90 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.59.00.52', 'FOOTRING CYLINDER 50-90 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('06.68.30.28', 'CYLINDER 6.8 KG CO2 MS', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.06', 'VALVE M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.11', 'VALVE M30 SBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.12', 'VALVE M30 SBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.13', 'VALVE M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.14', 'VALVE M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.20', 'HEAD VALVE SA (JIADUN)', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.21', 'HEAD VALVE SA SAFETY (SHANGHAI SAFEWAY)', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.00.22', 'HEAD VALVE SA SAFETY (MIRROR)', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.10.21', 'HEAD VALVE SA SAFETY (HENGJIA)', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.30.04', 'VALVE CO2 TROLLEY', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.30.29', 'VALVE CO2 STEEL', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.30.95', 'VALVE CO2 SYSTEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('07.00.62.04', 'VALVE TROLLEY 1� WITH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('08.06.00.06', 'BRACKET ASSY 6 KG M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.01.00.00', 'HANGER BRACKET 1 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.32.00.00', 'HANGER BRACKET 2 - 3 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.46.00.00', 'HANGER BRACKET 4,5 - 6 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.52.00.32', 'HANGER BRACKET 2 - 5 KG THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.52.06.32', 'HANGER BRACKET 2 - 5 KG THERMATIC BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('09.91.00.00', 'HANGER BRACKET 9 - 12 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.22', 'TRANSPORT BRACKET 1 KG SA2', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.23', 'TRANSPORT BRACKET 1 KG SA3', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.35', 'TRANSPORT BRACKET 1 KG VE-EX  HITAM AWSP', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.41', 'TRANSPORT BRACKET 1 KG SAE ADM', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.42', 'TRANSPORT BRACKET 1 KG SAE SUZUKI  REGULER', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.43', 'TRANSPORT BRACKET 1 KG SAE HONDA', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.44', 'TRANSPORT BRACKET 1 KG SAE HINO M', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.45', 'TRANSPORT BRACKET 1 KG SAE HINO L', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.00.95', 'T. BRACKET 1 KG SAE UD TRUCK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.22', 'TRANSPORT BRACKET 1 KG SA2 BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.23', 'TRANSPORT BRACKET 1 KG SA3 BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.41', 'TRANSPORT BRACKET 1 KG SAE ADM BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.42', 'TRANSPORT BRACKET 1  KG SAE SUZUKI BLANK REGULER', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.43', 'TRANSPORT BRACKET 1 KG SAE HONDA BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.44', 'TRANSPORT BRACKET 1 KG HINO M BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.45', 'TRANSPORT BRACKET 1 KG SAE HINO L BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.06.95', 'T. BRACKET 1 KG SAE UD TRUCK BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.22', 'TRANSPORT BRACKET 1 KG SA2 COATED MERAH', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.23', 'TRANSPORT BRACKET 1 KG SA3 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.41', 'TRANSPORT BRACKET 1 KG SAE ADM COATED/ trolley', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.42', 'TRANSPORT BRACKET 1 KG SAE SUZUKI COATED REGULER', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.43', 'TRANSPORT BRACKET 1 KG SAE HONDA COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.44', 'TRANSPORT BRACKET 1 KG SAE HINO M COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.45', 'TRANSPORT BRACKET 1 KG SAE HINO L COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F COATED trolley', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.45.95', 'T. BRACKET 1 KG SAE UD TRUCK COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.01.46.35', 'TRANSPORT BRACKET 1 KG  VE-EX COATED HITAM AWSP', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.03.40.115', 'TRANSPORT BRACKET SFT 300', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.06.40.115', 'TRANSPORT BRACKET SFT 600', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.15.40.115', 'TRANSPORT BRACKET SFT 150', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.45.40.115', 'TRANSPORT BRACKET SFT 450', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.50.00.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.50.06.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM BLANK', 'Pcs', 'Bahan Baku', NULL, NULL),
('10.50.45.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM COATED/ trolley', 'Pcs', 'Bahan Baku', NULL, NULL),
('11.00.00.106', 'HOSE 3/4�', 'Pcs', 'Bahan Baku', NULL, NULL),
('11.00.00.130', 'HOSE 3/8\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('11.00.00.42', 'HOSE 1/2\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('11.00.30.116', 'HOSE 1/4\" (HYDRAULIC) (mtr)', 'Pcs', 'Bahan Baku', NULL, NULL),
('11.00.60.55', 'HOSE GETEX 1,5\" (mtr)', 'Mtr', 'Bahan Baku', NULL, NULL),
('11.00.60.57', 'HOSE GETEX 2,5\" (mtr)', 'Mtr', 'Bahan Baku', NULL, NULL),
('11.00.70.55', 'HOSE GUARDMAN 1,5\"', 'Mtr', 'Bahan Baku', NULL, NULL),
('11.00.70.57', 'HOSE GUARDMAN 2,5\" (mtr)', 'Mtr', 'Bahan Baku', NULL, NULL),
('12.00.00.106', 'SIPHON TUBE 3/4\" (50 KG)', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.00.00.41', 'SIPHON TUBE 5/8\" ( METER )', 'Mtr', 'Bahan Baku', NULL, NULL),
('12.02.30.00', 'SIPHON TUBE 2 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.05.30.00', 'SIPHON TUBE 5 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.09.30.00', 'SIPHON TUBE 9 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.24.30.00', 'SIPHON TUBE 23-45 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.68.30.00', 'SIPHON TUBE 6,8KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.69.20.00', 'SIPHON TUBE 6 - 9 LT FOAM', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.70.00.106', 'SIPHON TUBE 3/4\" (70 KG)', 'Pcs', 'Bahan Baku', NULL, NULL),
('12.90.00.106', 'SIPHON TUBE 3/4\" (90 KG)', 'Pcs', 'Bahan Baku', NULL, NULL),
('13.03.00.00', 'SKIRT 3 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('13.46.00.00', 'SKIRT 4,5 - 6 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('13.91.00.00', 'SKIRT 9 - 12 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.01.00.01', 'SOFT CASE 1 KG (BYD)', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.01.00.36', 'SOFT CASE', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.01.00.37', 'JACKET', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.05.00.01', 'SOFT CASE 0.5 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.06.00.01', 'SOFT CASE 0.6 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.06.00.02', 'SOFT CASE 0,6 KG (HYUNDAI)', 'Pcs', 'Bahan Baku', NULL, NULL),
('14.06.00.03', 'SOFT CASE 0,6 KG (GENESIS)', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.00.10.04', 'NOZZLE POWDER TROLLEY (TIDAK DI PAKAI)', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.00.20.03', 'NOZZLE FOAM PORTABLE TIDAK DI PAKAI', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.01.00.20', 'NOZZLE 1 KG SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.01.10.00', 'NOZZLE 1 KG POWDER', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.02.10.00', 'NOZZLE 2 KG POWDER', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.05.00.20', 'NOZZLE 0.5 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('15.31.10.00', 'NOZZLE 3 - 12 KG POWDER', 'Pcs', 'Bahan Baku', NULL, NULL),
('16.00.00.36', 'HOSE TAIL CROME BRASS', 'Pcs', 'Bahan Baku', NULL, NULL),
('16.00.00.37', 'HOSE TAIL NYLON', 'Pcs', 'Bahan Baku', NULL, NULL),
('17.00.00.03', 'PULL PIN PORTABLE', 'Pcs', 'Bahan Baku', NULL, NULL),
('18.00.00.07', 'PRESSURE GAUGE 7 BAR', 'Pcs', 'Bahan Baku', NULL, NULL),
('18.00.10.44', 'PRESSURE GAUGE 15 BAR (23A202S) - SAFESTAR', 'Pcs', 'Bahan Baku', NULL, NULL),
('18.00.15.44', 'PRESSURE GAUGE 15 BAR (23A202S) - HENGJIA', 'Pcs', 'Bahan Baku', NULL, NULL),
('19.00.00.00', 'FERRULE', 'Pcs', 'Bahan Baku', NULL, NULL),
('19.00.00.106', 'FERRULE 3/4�', 'Pcs', 'Bahan Baku', NULL, NULL),
('19.00.00.116', 'FERRULE 1/4�', 'Pcs', 'Bahan Baku', NULL, NULL),
('19.00.00.130', 'FERRULE 3/8\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('19.00.00.42', 'FERRULE 1/2�', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.09.30.45', 'TROLLEY 9 KG CO2 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.23.30.45', 'TROLLEY 23 KG CO2 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.45.30.45', 'TROLLEY 45 KG CO2 COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.50.00.100', 'TROLLEY 50 KG IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.50.00.90', 'TROLLEY 50 KG COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.70.00.100', 'TROLLEY 70 KG IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.70.00.90', 'TROLLEY 70 KG COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.90.00.100', 'TROLLEY 90 KG IC', 'Pcs', 'Bahan Baku', NULL, NULL),
('20.90.00.90', 'TROLLEY 90 KG COATED', 'Pcs', 'Bahan Baku', NULL, NULL),
('21.00.00.00', 'SWIVEL HORN', 'Pcs', 'Bahan Baku', NULL, NULL),
('22.00.00.00', 'HOSE & HORN', 'Pcs', 'Bahan Baku', NULL, NULL),
('23.00.00.00', 'HORN', 'Pcs', 'Bahan Baku', NULL, NULL),
('23.00.00.108', 'MULTIJET HORN BLACK', 'Pcs', 'Bahan Baku', NULL, NULL),
('24.00.20.03', 'FILTER FOR PORTABLE FE', 'Pcs', 'Bahan Baku', NULL, NULL),
('24.00.20.04', 'FILTER FOR TROLLEY FE', 'Pcs', 'Bahan Baku', NULL, NULL),
('24.00.30.07', 'PLUG VALVE CO2 SYSTEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('25.00.00.00', 'CABLE TIES', 'Pcs', 'Bahan Baku', NULL, NULL),
('25.00.00.115', 'CABLE TIES SFT', 'Pcs', 'Bahan Baku', NULL, NULL),
('26.00.00.00', 'PULLTIES HIJAU', 'Pcs', 'Bahan Baku', NULL, NULL),
('26.00.00.01', 'PULLTIES KUNING', 'Pcs', 'Bahan Baku', NULL, NULL),
('26.03.25.00', 'SAFETY BELT 3 LT', 'Pcs', 'Bahan Baku', NULL, NULL),
('26.69.25.00', 'SAFETY BELT 6 - 9 LT', 'Pcs', 'Bahan Baku', NULL, NULL),
('27.00.00.130', 'ADAPTOR HOSE 3/8\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('27.00.30.07', 'ADAPTOR VALVE CO2 SYSTEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('27.00.30.11', 'ADAPTOR HOSE CO2 SYSTEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('27.00.30.18', 'ADAPTOR PRESSURE CO2 SYSTEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('27.00.32.00', 'ADAPTOR HORN', 'Pcs', 'Bahan Baku', NULL, NULL),
('29.25.45.05', 'EVA FOAM 25x45x5mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('29.25.50.05', 'EVA FOAM 25x50x5mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('30.00.00.43', 'SPRINKLER  68OC', 'Pcs', 'Bahan Baku', NULL, NULL),
('30.00.00.57', 'SPRINKLER  57', 'Pcs', 'Bahan Baku', NULL, NULL),
('32.00.00.00', 'GUN SPRAY', 'Pcs', 'Bahan Baku', NULL, NULL),
('33.00.00.32', 'GUARD THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('34.00.00.20', 'PLASTIC COVER SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('34.50.00.20', 'PLASTIC COVER SA1 (0.5 KG) MIRROR', 'Pcs', 'Bahan Baku', NULL, NULL),
('34.50.00.21', 'PLASTIC COVER SA1 (0.5 KG) ADM', 'Pcs', 'Bahan Baku', NULL, NULL),
('35.00.00.00', 'METRON ACTUATOR', 'Pcs', 'Bahan Baku', NULL, NULL),
('36.00.00.39', 'RODA KECIL 5�', 'Pcs', 'Bahan Baku', NULL, NULL),
('36.00.00.40', 'RODA 13\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.00.00.01', 'STICKER QC PASSED', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.00.00.13', 'STICKER GARANSI', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.00.00.14', 'STICKER SCHEDULE SERVICE', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.00.00.94', 'STICKER SOLENOID PILOT CYLINDER', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.01.00.21', 'STICKER BULAT HOLOGRAM', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.02.30.02', 'STICKER FC 200 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.05.30.02', 'STICKER FC 500 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.09.30.01', 'STICKER C 900 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.09.30.02', 'STICKER FC 900 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.16.12.01', 'STICKER P 16000 ABC90', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.20.12.94', 'STICKER P 2000 ABC90 BS', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.23.30.01', 'STICKER C 2300 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.23.30.02', 'STICKER FC 2300 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.25.11.02', 'STICKER FP 2500 ABC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.25.12.01', 'STICKER P 2500 ABC90', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.25.13.01', 'STICKER P 2500 D', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.25.14.01', 'STICKER P 2500 BC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.30.21.01', 'STICKER F 3000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.30.21.02', 'STICKER FF 3000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.45.30.01', 'STICKER C 4500 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.45.30.02', 'STICKER FC 4500 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.11.02', 'STICKER FP 5000 ABC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.12.01', 'STICKER P 5000 ABC90', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.14.01', 'STICKER P 5000 BC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.21.01', 'STICKER F 5000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.21.02', 'STICKER FF 5000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.50.36.01', 'STICKER D 5000 FE-36', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.11.02', 'STICKER FP 6800 ABC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.12.01', 'STICKER P 6800 ABC90', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.14.01', 'STICKER P 6800 BC', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.30.01', 'STICKER C 680 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.30.02', 'STICKER FC 680 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.68.30.124', 'STICKER MC 680 CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.80.12.01', 'STICKER P 8000 ABC90', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.90.21.01', 'STICKER F 9000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('37.90.21.02', 'STICKER FF 9000 AF3', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.01', 'CARTON 1 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.02', 'CARTON 1 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.100', 'CARTON BOX 1 KG SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.101', 'CARTON 1 KG POLOS', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.102', 'CARTON 1 KG TAM (P2)', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.103', 'CARTON 1 KG TAM (P1)', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.104', 'CARTON 1 KG SERVVO (KUNING) / NEW ITEM', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.129', 'CARTON 1 KG Ve-EX ACE HARDWARE', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.21', 'CARTON 1 KG SA1 (D)', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.22', 'CARTON 1 KG SA2 (T)', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.35', 'CARTON 1 KG Ve-EX (P 100 SA)', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.00.93', 'CARTON 1 KG ACE HARDWARE', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.01.02.144', 'CARTON 1 KG F MITRA 10', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.02.00.01', 'CARTON 2 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.02.00.02', 'CARTON 2 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.02.30.01', 'CARTON 2 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.02.30.02', 'CARTON 2 KG CO2 FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.03.00.01', 'CARTON 3 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.03.00.02', 'CARTON 3 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.03.00.93', 'CARTON 3 KG ACE HARDWARE', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.03.02.144', 'CARTON 3 KG F MITRA 10', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.05.30.01', 'CARTON 5 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.05.30.02', 'CARTON 5 KG CO2 FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.06.00.01', 'CARTON 6 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.06.00.02', 'CARTON 6 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.06.00.93', 'CARTON 6 KG ACE HARDWARE', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.06.02.144', 'CARTON 6 KG F MITRA 10', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.09.00.01', 'CARTON 9 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.09.00.02', 'CARTON 9 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.12.00.01', 'CARTON 12 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.12.00.02', 'CARTON 12 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.45.00.01', 'CARTON 4,5 KG', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.45.00.02', 'CARTON 4,5 KG FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.52.40.32', 'CARTON 2 - 5 KG THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.68.30.01', 'CARTON 6,8 KG CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('38.68.30.02', 'CARTON 6,8 KG CO2 FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('39.00.00.23', 'BOLT W/ WASHER', 'Pcs', 'Bahan Baku', NULL, NULL),
('39.00.00.79', 'BAUT PH (+) 10 x 1 1/4\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('39.05.00.12', 'BAUT L 5 MM X 12 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('41.00.00.00', 'PIPA SS 304. t 1.2 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.11', 'VALVE ASSY 1 KG M30 SBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.12', 'VALVE ASSY 1 KG M30 SBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.20', 'VALVE ASSY 1 KG SA (JIADUN)', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.21', 'VALVE ASSY 1 KG SA SAFETY (SHANGHAI SAFEWAY)', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.22', 'VALVE ASSY 0.5 KG SA SAFETY (MIRROR)', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.67', 'VALVE ASSY 1 KG M30 SA SBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.00.68', 'VALVE ASSY 1 KG M30 SA SBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.01.10.21', 'VALVE ASSY 1 KG SA SAFETY (HENGJIA)', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.02.00.11', 'VALVE ASSY 2 KG M30 SBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.02.00.12', 'VALVE ASSY 2 KG M30 SBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.03.00.06', 'VALVE ASSY 3 KG M50 TIDAK DI PAKAI', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.03.00.13', 'VALVE ASSY 3 KG M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.03.00.14', 'VALVE ASSY 3 KG M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.03.20.13', 'VALVE ASSY 3 LT FOAM M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.00.06', 'VALVE ASSY 6 KG M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.00.13', 'VALVE ASSY 6 KG M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.00.14', 'VALVE ASSY 6 KG M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.20.06', 'VALVE ASSY 6 LT FOAM M50 TIDAK DI PAKAI', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.20.13', 'VALVE ASSY 6 LT FOAM M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.06.20.14', 'VALVE ASSY 6 LT FOAM M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.00.06', 'VALVE ASSY 9 KG M50 TIDAK DI PAKAI', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.00.13', 'VALVE ASSY 9 KG M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.00.14', 'VALVE ASSY 9 KG M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.20.06', 'VALVE ASSY 9 LT FOAM M50 TIDAK DI PAKAI', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.20.13', 'VALVE ASSY 9 LT FOAM M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.09.20.14', 'VALVE ASSY 9 LT FOAM M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.12.00.06', 'VALVE ASSY 12 KG M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.12.00.13', 'VALVE ASSY 12 KG M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.12.00.14', 'VALVE ASSY 12 KG M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.45.00.13', 'VALVE ASSY 4,5 KG M30 LBH SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.45.00.14', 'VALVE ASSY 4,5 KG M30 LBH W/O SAFETY', 'Pcs', 'Bahan Baku', NULL, NULL),
('42.45.30.29', 'VALVE ASSY 45 KG CO2', 'PCS', 'bahanbaku', NULL, NULL),
('43.00.30.04', 'HOSE ASSY CO2 TROLLEY', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.00.50.04', 'HOSE ASSY POWDER/FOAM TROLLEY', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.03.20.01', 'HOSE ASSY 3 LT FOAM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.03.20.02', 'HOSE ASSY 3 LT FOAM FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.03.25.01', 'HOSE ASSY 3 LT WET CHEM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.06.10.01', 'HOSE ASSY 6 KG POWDER SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.06.10.02', 'HOSE ASSY 6 KG POWDER FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.06.20.01', 'HOSE ASSY 6 LT FOAM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.06.20.02', 'HOSE ASSY 6 LT FOAM FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.06.25.01', 'HOSE ASSY 6 LT WET CHEM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.09.10.01', 'HOSE ASSY 9 KG POWDER SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.09.10.02', 'HOSE ASSY 9 KG POWDER FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.09.20.01', 'HOSE ASSY 9 LT FOAM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.09.20.02', 'HOSE ASSY 9 LT FOAM FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.09.25.01', 'HOSE ASSY 9 LT WET CHEM SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.12.10.01', 'HOSE ASSY 12 KG POWDER SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.12.10.02', 'HOSE ASSY 12 KG POWDER FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.34.10.01', 'HOSE ASSY 3 - 4,5 KG POWDER SERVVO', 'Pcs', 'Bahan Baku', NULL, NULL),
('43.34.10.02', 'HOSE ASSY 3 - 4,5 KG POWDER FUHRER', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.05', 'NECKRING M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.06', 'NECKRING M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.46', 'NECKRING ATAS THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.47', 'NECKRING BAWAH THERMATIC', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.60', 'NECKRING M60', 'Pcs', 'Bahan Baku', NULL, NULL),
('46.00.00.66', 'NECKRING M30 SA', 'Pcs', 'Bahan Baku', NULL, NULL),
('47.00.00.05', 'O-RING M30', 'Pcs', 'Bahan Baku', NULL, NULL),
('47.00.00.06', 'O-RING M50', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.10', 'VELCRO UK.16X100 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.13', 'VELCRO UK.16X130 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.25', 'VELCRO UK.16X25 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.30', 'VELCRO UK.16X30 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.38', 'VELCRO UK.16X38 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.45', 'VELCRO UK.16X45 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.63', 'VELCRO UK.16X163 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.80', 'VELCRO UK.16X80 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.16.00.85', 'VELCRO UK.16X85 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.30.00.30', 'VELCRO UK.30X30 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('50.30.00.35', 'VELCRO UK.30X35 MM', 'Pcs', 'Bahan Baku', NULL, NULL),
('51.38.16.01', 'PAD EPDM Uk.38x16x1mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('52.00.07.78', 'SEAL VALVE TROLLEY 1�', 'Pcs', 'Bahan Baku', NULL, NULL),
('52.00.77.78', 'SEAL FEMALE COUPLING 1�', 'Pcs', 'Bahan Baku', NULL, NULL),
('52.15.00.37', 'SEAL NYLON (OD.15 x ID. 8 x t.1,5 mm)', 'Pcs', 'Bahan Baku', NULL, NULL),
('52.20.00.37', 'SEAL NYLON (OD.20 x ID. 8 x t.2 mm)', 'Pcs', 'Bahan Baku', NULL, NULL),
('53.00.00.04', 'AS RODA TROLLEY', 'Pcs', 'Bahan Baku', NULL, NULL),
('53.09.30.04', 'AS RODA 9 KG CO2 TROLLEY', 'Pcs', 'Bahan Baku', NULL, NULL),
('55.00.00.71', 'MUR (P) n10', 'Pcs', 'Bahan Baku', NULL, NULL),
('55.00.00.72', 'MUR (P) n20', 'Pcs', 'Bahan Baku', NULL, NULL),
('55.05.00.01', 'MUR M5 PUTIH', 'Pcs', 'Bahan Baku', NULL, NULL),
('56.00.00.06', 'BAUT & MUR M6 x 20 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('56.00.00.08', 'BAUT & MUR (P) 8 x 20 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('56.00.00.34', 'BAUT PLASTIC COVER', 'Pcs', 'Bahan Baku', NULL, NULL),
('56.00.00.73', 'BAUT & MUR (P) 10 x 35 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('56.00.00.74', 'BAUT & MUR (P) 10 x 20 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('57.00.00.06', 'RING PLAT TBL M6', 'Pcs', 'Bahan Baku', NULL, NULL),
('57.00.00.75', 'RING PLAT TBL n10', 'Pcs', 'Bahan Baku', NULL, NULL),
('57.00.00.76', 'RING PLAT TBL n20', 'Pcs', 'Bahan Baku', NULL, NULL),
('69.00.00.04', 'HAND GRIP', 'Pcs', 'Bahan Baku', NULL, NULL),
('70.00.00.00', 'KARET BAMPER', 'Pcs', 'Bahan Baku', NULL, NULL),
('74.00.00.105', 'VISER S8', 'Pcs', 'Bahan Baku', NULL, NULL),
('75.00.00.106', 'SPRING 3/4�', 'Pcs', 'Bahan Baku', NULL, NULL),
('75.00.00.115', 'SPRING SFT (TIDAK DI PAKAI LAGI)', 'Pcs', 'Bahan Baku', NULL, NULL),
('76.00.00.116', 'MALE COUPLING 1/4\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('76.00.00.42', 'MALE COUPLING 1/2\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('77.00.00.130', 'FEMALE COUPLING 3/8\"', 'Pcs', 'Bahan Baku', NULL, NULL),
('77.00.00.42', 'FEMALE COUPLING 1/2�', 'Pcs', 'Bahan Baku', NULL, NULL),
('77.00.00.78', 'FEMALE COUPLING 1�', 'Pcs', 'Bahan Baku', NULL, NULL),
('77.00.30.130', 'FEMALE COUPLING VALVE CO2', 'Pcs', 'Bahan Baku', NULL, NULL),
('80.00.00.43', 'MANUAL BOOK HPM', 'Pcs', 'Bahan Baku', NULL, NULL),
('80.00.00.46', 'MANUAL BOOK TMMIN', 'Pcs', 'Bahan Baku', NULL, NULL),
('80.05.00.46', 'MANUAL BOOK TMMIN 0.5 kg', 'Pcs', 'Bahan Baku', NULL, NULL),
('82.00.00.118', 'TUBE 6 x 4 mm', 'Pcs', 'Bahan Baku', NULL, NULL),
('83.00.00.115', 'TUBING SHOCK SFT (OVAL UNION TUBING SPU 6)', 'Pcs', 'Bahan Baku', NULL, NULL),
('84.00.00.115', 'BLANKING PLUG SFT', 'Pcs', 'Bahan Baku', NULL, NULL),
('85.00.00.115', 'MOUNTING BASE SFT', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.01.06.00', 'PLAT STEEL CYLINDER 1 KG (SPCC 1.5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.01.06.02', 'PLAT STEEL CYLINDER 1 KG (SPCE 1.2)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.01.07.00', 'PLAT STEEL BOTTOM CYLINDER 1 KG (SPCC 1,5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.01.07.02', 'PLAT STEEL BOTTOM CYLINDER 1 KG (SPCE 1,2)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.03.06.00', 'PLAT STEEL CYLINDER 3 KG (SPCC 1.5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.03.06.120', 'PLAT STEEL BOTTOM CYLINDER 2 - 3 KG (SPCC 1,5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.05.06.02', 'PLAT STEEL CYLINDER 0.5 KG (SPCE 1.2)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.05.07.02', 'PLAT STEEL BOTTOM CYLINDER 0.5 KG (SPCE 1,2)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.06.06.00', 'PLAT STEEL CYLINDER 6 KG (SPCC 1.5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.09.06.00', 'PLAT STEEL CYLINDER 9 KG (SPCC 1.5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.12.01.01', 'COIL SPCE 1.2 MM (1120 MM x COIL) 1 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.12.01.02', 'COIL SPCE 1.2 MM (99 MM x COIL) BOTTOM 1 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.12.05.01', 'COIL SPCE 1.2 MM (1040 MM x COIL) 0.5 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.01.01', 'COIL SPCC 1.5 MM (1120 MM x COIL) 1 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.01.02', 'COIL SPCC 1.5 MM (99 MM x COIL) BOTTOM 1 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.02.01', 'COIL SPCC 1.5 MM (390 MM x COIL) 2 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.02.12', 'COIL SPCC 1.5 MM (200 MM x COIL) BOTTOM 2 - 12 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.03.01', 'COIL SPCC 1.5 MM (440 MM x COIL) 3 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.06.22', 'COIL SPCC 1.5 MM (220 MM x COIL) BOTTOM 6 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.06.54', 'COIL SPCC 1.5 MM (540 MM x COIL) 6 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.09.01', 'COIL SPCC 1.5 MM (620 MM x COIL) 9 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.09.02', 'COIL SPCC 1.5 MM (237 MM x COIL) BOTTOM 9 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.15.45.01', 'COIL SPCC 1.5 MM (500 MM x COIL) 4.5 KG', 'kg', 'Bahan Baku', NULL, NULL),
('87.45.06.00', 'PLAT STEEL CYLINDER 4.5 KG (SPCC 1.5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.46.06.120', 'PLAT STEEL BOTTOM CYLINDER 4.5 - 6 KG (SPCC 1,5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('87.91.06.120', 'PLAT STEEL BOTTOM CYLINDER 9 - 12 KG (SPCC 1,5)', 'Pcs', 'Bahan Baku', NULL, NULL),
('88.00.00.108', 'POWDER COATING PE HITAM KG', 'kg', 'Bahan Baku', NULL, NULL),
('88.00.00.121', 'POWDER COATING PE MERAH KG', 'kg', 'Bahan Baku', NULL, NULL),
('90.00.00.43', 'RIVET SD-648-HS', 'Pcs', 'Bahan Baku', NULL, NULL),
('NINJA', 'NINJATES', 'Pcs', 'Bahan Baku', '2025-07-12 05:35:55', '2025-07-12 05:35:55'),
('tes', 'tesaja', 'PCS', 'bahanbaku', NULL, NULL),
('test', 'aa', 'pcs', 'barangjadi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `no_dokumen_masuk` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori_barang` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `nama_lorong` varchar(255) NOT NULL,
  `nama_rak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `no_dokumen_masuk`, `tanggal_masuk`, `kode_barang`, `nama_barang`, `kategori_barang`, `jumlah`, `kapasitas`, `nama_lorong`, `nama_rak`) VALUES
(261, 'milasa', '2025-10-02', '07.00.00.06', 'VALVE M50', 'VALVE', 1700, 1700, 'LORONG 1', 'B-A-01-02'),
(262, 'milasa', '2025-10-02', '07.00.00.06', 'VALVE M50', 'VALVE', 1700, 1700, 'LORONG 1', 'B-A-01-01'),
(263, 'milasa', '2025-10-02', '07.00.00.11', 'VALVE M30 SBH SAFETY', 'VALVE', 3000, 3000, 'LORONG 1', 'B-A-01-03'),
(264, 'safva', '2025-10-08', '07.00.00.20', 'HEAD VALVE SA (JIADUN)', 'VALVE', 6400, 6400, 'LORONG 1', 'B-A-01-04'),
(265, 'ipsaoas', '2025-11-07', '07.00.00.11', 'VALVE M30 SBH SAFETY', 'VALVE', 3000, 3000, 'LORONG 1', 'B-A-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `formula`
--

CREATE TABLE `formula` (
  `id` int(11) NOT NULL,
  `kode_formula` varchar(50) NOT NULL,
  `nama_formula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formula`
--

INSERT INTO `formula` (`id`, `kode_formula`, `nama_formula`) VALUES
(1, '01.01.24.05', 'B 100 SV-5 SKND'),
(9, '01.00.11.12.3', 'P 100 ABC SA2'),
(14, '07.00.10.21', 'HEAD VALVE SA SAFETY (HENGJIA)'),
(15, '06.01.00.05', 'CYLINDER 1 KG M30'),
(16, '06.03.00.101', 'CYLINDER 3 KG M30 IC');

-- --------------------------------------------------------

--
-- Table structure for table `formula_detail`
--

CREATE TABLE `formula_detail` (
  `id` int(11) NOT NULL,
  `kode_formula` varchar(50) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formula_detail`
--

INSERT INTO `formula_detail` (`id`, `kode_formula`, `kode_barang`, `nama_barang`, `jumlah`) VALUES
(25, '01.01.24.05', '07.00.00.06', 'VALVE M50', 1),
(26, '01.01.24.05', '07.00.00.11', 'VALVE M30 SBH SAFETY', 1),
(28, '01.00.11.12.3', '07.00.00.06', 'VALVE M50', 1),
(29, '01.00.11.12.3', '07.00.00.11', 'VALVE M30 SBH SAFETY', 1),
(35, '07.00.10.21', '07.00.00.20', 'HEAD VALVE SA (JIADUN)', 1),
(36, '06.01.00.05', '07.00.00.20', 'HEAD VALVE SA (JIADUN)', 1),
(37, '06.03.00.101', '07.00.00.11', 'VALVE M30 SBH SAFETY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`) VALUES
(6, 'MATI LAMPU'),
(4, 'TEST'),
(5, 'testing'),
(1, 'WH-FG'),
(2, 'WH-MATERIAL');

-- --------------------------------------------------------

--
-- Table structure for table `lorong`
--

CREATE TABLE `lorong` (
  `id_lorong` int(11) NOT NULL,
  `nama_lorong` varchar(255) NOT NULL,
  `nama_gudang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lorong`
--

INSERT INTO `lorong` (`id_lorong`, `nama_lorong`, `nama_gudang`) VALUES
(5, 'LORONG 1', 'WH-MATERIAL'),
(6, 'LORONG 2', 'WH-MATERIAL'),
(7, 'LORONG 3', 'WH-MATERIAL'),
(8, 'LORONG 4', 'WH-MATERIAL'),
(9, 'LORONG 5', 'WH-MATERIAL'),
(10, 'LORONG 6', 'WH-MATERIAL'),
(14, 'testlorog', 'TEST'),
(15, 'LORONG FG', 'WH-FG'),
(17, 'TEST aja', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lorong` varchar(255) NOT NULL,
  `kapasitas_total` int(11) NOT NULL,
  `kapasitas_tersedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `nama_lorong`, `kapasitas_total`, `kapasitas_tersedia`) VALUES
(1006, 'B-A-01-05', 'LORONG 1', 1000000, 997000),
(1007, 'B-A-01-04', 'LORONG 1', 1000000, 993600),
(1008, 'B-A-01-03', 'LORONG 1', 1000000, 997100),
(1009, 'B-A-01-02', 'LORONG 1', 1000000, 1001700),
(1010, 'B-A-01-01', 'LORONG 1', 1000000, 1000000),
(1011, 'B-A-03-05', 'LORONG 1', 1000000, 1000000),
(1012, 'B-A-03-04', 'LORONG 1', 1000000, 1000000),
(1013, 'B-A-03-03', 'LORONG 1', 1000000, 1000000),
(1014, 'B-A-03-02', 'LORONG 1', 1000000, 1000000),
(1015, 'B-A-05-05', 'LORONG 1', 1000000, 1000000),
(1016, 'B-A-05-04', 'LORONG 1', 1000000, 1000000),
(1017, 'B-A-05-03', 'LORONG 1', 1000000, 1000000),
(1018, 'B-A-05-02', 'LORONG 1', 1000000, 1000000),
(1019, 'B-A-05-01', 'LORONG 1', 1000000, 1000000),
(1020, 'B-A-07-05', 'LORONG 1', 1000000, 1000000),
(1021, 'B-A-07-04', 'LORONG 1', 1000000, 1000000),
(1022, 'B-A-07-03', 'LORONG 1', 1000000, 1000000),
(1023, 'B-A-07-02', 'LORONG 1', 1000000, 1000000),
(1024, 'B-A-07-01', 'LORONG 1', 1000000, 1000000),
(1025, 'B-A-09-05', 'LORONG 1', 1000000, 1000000),
(1026, 'B-A-09-04', 'LORONG 1', 1000000, 1000000),
(1027, 'B-A-09-03', 'LORONG 1', 1000000, 1000000),
(1028, 'B-A-09-02', 'LORONG 1', 1000000, 1000000),
(1029, 'B-A-09-01', 'LORONG 1', 1000000, 1000000),
(1030, 'B-A-11-05', 'LORONG 1', 1000000, 1000000),
(1031, 'B-A-11-04', 'LORONG 1', 1000000, 1000000),
(1032, 'B-A-11-03', 'LORONG 1', 1000000, 1000000),
(1033, 'B-A-11-02', 'LORONG 1', 1000000, 1000000),
(1034, 'B-A-11-01', 'LORONG 1', 1000000, 1000000),
(1035, 'B-A-13-05', 'LORONG 1', 1000000, 1000000),
(1036, 'B-A-13-04', 'LORONG 1', 1000000, 1000000),
(1037, 'B-A-13-03', 'LORONG 1', 1000000, 1000000),
(1038, 'B-A-13-02', 'LORONG 1', 1000000, 1000000),
(1039, 'B-A-13-01', 'LORONG 1', 1000000, 1000000),
(1040, 'B-A-15-05', 'LORONG 1', 1000000, 1000000),
(1041, 'B-A-15-04', 'LORONG 1', 1000000, 1000000),
(1042, 'B-A-15-03', 'LORONG 1', 1000000, 1000000),
(1043, 'B-A-15-02', 'LORONG 1', 1000000, 1000000),
(1044, 'B-A-15-01', 'LORONG 1', 1000000, 1000000),
(1045, 'B-A-17-05', 'LORONG 1', 1000000, 1000000),
(1046, 'B-A-17-04', 'LORONG 1', 1000000, 1000000),
(1047, 'B-A-17-03', 'LORONG 1', 1000000, 1000000),
(1048, 'B-A-17-02', 'LORONG 1', 1000000, 1000000),
(1049, 'B-A-17-01', 'LORONG 1', 1000000, 1000000),
(1050, 'B-A-19-05', 'LORONG 1', 1000000, 1000000),
(1051, 'B-A-19-04', 'LORONG 1', 1000000, 1000000),
(1052, 'B-A-19-03', 'LORONG 1', 1000000, 1000000),
(1053, 'B-A-19-02', 'LORONG 1', 1000000, 1000000),
(1054, 'B-A-19-01', 'LORONG 1', 1000000, 1000000),
(1055, 'B-B-01-05', 'LORONG 1', 1000000, 1000000),
(1056, 'B-B-01-04', 'LORONG 1', 1000000, 1000000),
(1057, 'B-B-01-03', 'LORONG 1', 1000000, 1000000),
(1058, 'B-B-01-02', 'LORONG 1', 1000000, 1000000),
(1059, 'B-B-01-01', 'LORONG 1', 1000000, 1000000),
(1060, 'B-B-03-05', 'LORONG 1', 1000000, 1000000),
(1061, 'B-B-03-04', 'LORONG 1', 1000000, 1000000),
(1062, 'B-B-03-03', 'LORONG 1', 1000000, 1000000),
(1063, 'B-B-03-02', 'LORONG 1', 1000000, 1000000),
(1064, 'B-B-03-01', 'LORONG 1', 1000000, 1000000),
(1065, 'B-B-05-05', 'LORONG 1', 1000000, 1000000),
(1066, 'B-B-05-04', 'LORONG 1', 1000000, 1000000),
(1067, 'B-B-05-03', 'LORONG 1', 1000000, 1000000),
(1068, 'B-B-05-02', 'LORONG 1', 1000000, 1000000),
(1069, 'B-B-05-01', 'LORONG 1', 1000000, 1000000),
(1070, 'B-B-07-05', 'LORONG 1', 1000000, 1000000),
(1071, 'B-B-07-04', 'LORONG 1', 1000000, 1000000),
(1072, 'B-B-07-03', 'LORONG 1', 1000000, 1000000),
(1073, 'B-B-07-02', 'LORONG 1', 1000000, 1000000),
(1074, 'B-B-07-01', 'LORONG 1', 1000000, 1000000),
(1075, 'B-B-09-05', 'LORONG 1', 1000000, 1000000),
(1076, 'B-B-09-04', 'LORONG 1', 1000000, 1000000),
(1077, 'B-B-09-03', 'LORONG 1', 1000000, 1000000),
(1078, 'B-B-09-02', 'LORONG 1', 1000000, 1000000),
(1079, 'B-B-09-01', 'LORONG 1', 1000000, 1000000),
(1080, 'B-B-11-05', 'LORONG 1', 1000000, 1000000),
(1081, 'B-B-11-04', 'LORONG 1', 1000000, 1000000),
(1082, 'B-B-11-03', 'LORONG 1', 1000000, 1000000),
(1083, 'B-B-11-02', 'LORONG 1', 1000000, 1000000),
(1084, 'B-B-11-01', 'LORONG 1', 1000000, 1000000),
(1085, 'B-B-13-05', 'LORONG 1', 1000000, 1000000),
(1086, 'B-B-13-04', 'LORONG 1', 1000000, 1000000),
(1087, 'B-B-13-03', 'LORONG 1', 1000000, 1000000),
(1088, 'B-B-13-02', 'LORONG 1', 1000000, 1000000),
(1089, 'B-B-13-01', 'LORONG 1', 1000000, 1000000),
(1090, 'B-B-15-05', 'LORONG 1', 1000000, 1000000),
(1091, 'B-B-15-04', 'LORONG 1', 1000000, 1000000),
(1092, 'B-B-15-03', 'LORONG 1', 1000000, 1000000),
(1093, 'B-B-15-02', 'LORONG 1', 1000000, 1000000),
(1094, 'B-B-15-01', 'LORONG 1', 1000000, 1000000),
(1095, 'B-B-17-05', 'LORONG 1', 1000000, 1000000),
(1096, 'B-B-17-04', 'LORONG 1', 1000000, 1000000),
(1097, 'B-B-17-03', 'LORONG 1', 1000000, 1000000),
(1098, 'B-B-17-02', 'LORONG 1', 1000000, 1000000),
(1099, 'B-B-17-01', 'LORONG 1', 1000000, 1000000),
(1100, 'B-B-19-05', 'LORONG 1', 1000000, 1000000),
(1101, 'B-B-19-04', 'LORONG 1', 1000000, 1000000),
(1102, 'B-B-19-03', 'LORONG 1', 1000000, 1000000),
(1103, 'B-B-19-02', 'LORONG 1', 1000000, 1000000),
(1104, 'B-B-19-01', 'LORONG 1', 1000000, 1000000),
(1105, 'B-B-01-05', 'LORONG 1', 1000000, 1000000),
(1106, 'B-B-01-03', 'LORONG 1', 1000000, 1000000),
(1107, 'B-B-01-02', 'LORONG 1', 1000000, 1000000),
(1108, 'B-C-01-05', 'LORONG 2', 1000000, 1000000),
(1109, 'B-C-01-04', 'LORONG 2', 1000000, 1000000),
(1110, 'B-C-01-03', 'LORONG 2', 1000000, 1000000),
(1111, 'B-C-01-02', 'LORONG 2', 1000000, 1000000),
(1112, 'B-C-01-01', 'LORONG 2', 1000000, 1000000),
(1113, 'B-C-03-05', 'LORONG 2', 1000000, 1000000),
(1114, 'B-C-03-04', 'LORONG 2', 1000000, 1000000),
(1115, 'B-C-03-03', 'LORONG 2', 1000000, 1000000),
(1116, 'B-C-03-02', 'LORONG 2', 1000000, 1000000),
(1117, 'B-C-03-01', 'LORONG 2', 1000000, 1000000),
(1118, 'B-C-05-05', 'LORONG 2', 1000000, 1000000),
(1119, 'B-C-05-04', 'LORONG 2', 1000000, 1000000),
(1120, 'B-C-05-03', 'LORONG 2', 1000000, 1000000),
(1121, 'B-C-05-02', 'LORONG 2', 1000000, 1000000),
(1122, 'B-C-05-01', 'LORONG 2', 1000000, 1000000),
(1123, 'B-C-07-05', 'LORONG 2', 1000000, 1000000),
(1124, 'B-C-07-04', 'LORONG 2', 1000000, 1000000),
(1125, 'B-C-07-03', 'LORONG 2', 1000000, 1000000),
(1126, 'B-C-07-02', 'LORONG 2', 1000000, 1000000),
(1127, 'B-C-07-01', 'LORONG 2', 1000000, 1000000),
(1128, 'B-C-09-05', 'LORONG 2', 1000000, 1000000),
(1129, 'B-C-09-04', 'LORONG 2', 1000000, 1000000),
(1130, 'B-C-09-03', 'LORONG 2', 1000000, 1000000),
(1131, 'B-C-09-02', 'LORONG 2', 1000000, 1000000),
(1132, 'B-C-09-01', 'LORONG 2', 1000000, 1000000),
(1133, 'B-C-11-05', 'LORONG 2', 1000000, 1000000),
(1134, 'B-C-11-04', 'LORONG 2', 1000000, 1000000),
(1135, 'B-C-11-03', 'LORONG 2', 1000000, 1000000),
(1136, 'B-C-11-02', 'LORONG 2', 1000000, 1000000),
(1137, 'B-C-11-01', 'LORONG 2', 1000000, 1000000),
(1138, 'B-C-13-05', 'LORONG 2', 1000000, 1000000),
(1139, 'B-C-13-04', 'LORONG 2', 1000000, 1000000),
(1140, 'B-C-13-03', 'LORONG 2', 1000000, 1000000),
(1141, 'B-C-13-02', 'LORONG 2', 1000000, 1000000),
(1142, 'B-C-13-01', 'LORONG 2', 1000000, 1000000),
(1143, 'B-C-15-05', 'LORONG 2', 1000000, 1000000),
(1144, 'B-C-15-04', 'LORONG 2', 1000000, 1000000),
(1145, 'B-C-15-03', 'LORONG 2', 1000000, 1000000),
(1146, 'B-C-15-02', 'LORONG 2', 1000000, 1000000),
(1147, 'B-C-15-01', 'LORONG 2', 1000000, 1000000),
(1148, 'B-C-17-05', 'LORONG 2', 1000000, 1000000),
(1149, 'B-C-17-04', 'LORONG 2', 1000000, 1000000),
(1150, 'B-C-17-03', 'LORONG 2', 1000000, 1000000),
(1151, 'B-C-17-02', 'LORONG 2', 1000000, 1000000),
(1152, 'B-C-17-01', 'LORONG 2', 1000000, 1000000),
(1153, 'B-C-19-05', 'LORONG 2', 1000000, 1000000),
(1154, 'B-C-19-04', 'LORONG 2', 1000000, 1000000),
(1155, 'B-C-19-03', 'LORONG 2', 1000000, 1000000),
(1156, 'B-C-19-02', 'LORONG 2', 1000000, 1000000),
(1157, 'B-C-19-01', 'LORONG 2', 1000000, 1000000),
(1158, 'B-C-01-05', 'LORONG 2', 1000000, 1000000),
(1159, 'B-C-01-04', 'LORONG 2', 1000000, 1000000),
(1160, 'B-C-01-03', 'LORONG 2', 1000000, 1000000),
(1161, 'B-C-01-02', 'LORONG 2', 1000000, 1000000),
(1162, 'B-C-01-01', 'LORONG 2', 1000000, 1000000),
(1163, 'B-D-01-05', 'LORONG 2', 1000000, 1000000),
(1164, 'B-D-01-04', 'LORONG 2', 1000000, 1000000),
(1165, 'B-D-01-03', 'LORONG 2', 1000000, 1000000),
(1166, 'B-D-01-02', 'LORONG 2', 1000000, 1000000),
(1167, 'B-D-01-01', 'LORONG 2', 1000000, 1000000),
(1168, 'B-D-03-05', 'LORONG 2', 1000000, 1000000),
(1169, 'B-D-03-04', 'LORONG 2', 1000000, 1000000),
(1170, 'B-D-03-03', 'LORONG 2', 1000000, 1000000),
(1171, 'B-D-03-02', 'LORONG 2', 1000000, 1000000),
(1172, 'B-D-03-01', 'LORONG 2', 1000000, 1000000),
(1173, 'B-D-05-05', 'LORONG 2', 1000000, 1000000),
(1174, 'B-D-05-04', 'LORONG 2', 1000000, 1000000),
(1175, 'B-D-05-03', 'LORONG 2', 1000000, 1000000),
(1176, 'B-D-05-02', 'LORONG 2', 1000000, 1000000),
(1177, 'B-D-05-01', 'LORONG 2', 1000000, 1000000),
(1178, 'B-D-07-05', 'LORONG 2', 1000000, 1000000),
(1179, 'B-D-07-04', 'LORONG 2', 1000000, 1000000),
(1180, 'B-D-07-03', 'LORONG 2', 1000000, 1000000),
(1181, 'B-D-07-02', 'LORONG 2', 1000000, 1000000),
(1182, 'B-D-07-01', 'LORONG 2', 1000000, 1000000),
(1183, 'B-D-09-05', 'LORONG 2', 1000000, 1000000),
(1184, 'B-D-09-04', 'LORONG 2', 1000000, 1000000),
(1185, 'B-D-09-03', 'LORONG 2', 1000000, 1000000),
(1186, 'B-D-09-02', 'LORONG 2', 1000000, 1000000),
(1187, 'B-D-09-01', 'LORONG 2', 1000000, 1000000),
(1188, 'B-D-11-05', 'LORONG 2', 1000000, 1000000),
(1189, 'B-D-11-04', 'LORONG 2', 1000000, 1000000),
(1190, 'B-D-11-03', 'LORONG 2', 1000000, 1000000),
(1191, 'B-D-11-02', 'LORONG 2', 1000000, 1000000),
(1192, 'B-D-11-01', 'LORONG 2', 1000000, 1000000),
(1193, 'B-D-13-05', 'LORONG 2', 1000000, 1000000),
(1194, 'B-D-13-04', 'LORONG 2', 1000000, 1000000),
(1195, 'B-D-13-03', 'LORONG 2', 1000000, 1000000),
(1196, 'B-D-13-02', 'LORONG 2', 1000000, 1000000),
(1197, 'B-D-13-01', 'LORONG 2', 1000000, 1000000),
(1198, 'B-D-15-05', 'LORONG 2', 1000000, 1000000),
(1199, 'B-D-15-04', 'LORONG 2', 1000000, 1000000),
(1200, 'B-D-15-03', 'LORONG 2', 1000000, 1000000),
(1201, 'B-D-15-02', 'LORONG 2', 1000000, 1000000),
(1202, 'B-D-15-01', 'LORONG 2', 1000000, 1000000),
(1203, 'B-D-17-05', 'LORONG 2', 1000000, 1000000),
(1204, 'B-D-17-04', 'LORONG 2', 1000000, 1000000),
(1205, 'B-D-17-03', 'LORONG 2', 1000000, 1000000),
(1206, 'B-D-17-02', 'LORONG 2', 1000000, 1000000),
(1207, 'B-D-17-01', 'LORONG 2', 1000000, 1000000),
(1208, 'B-D-19-05', 'LORONG 2', 1000000, 1000000),
(1209, 'B-D-19-04', 'LORONG 2', 1000000, 1000000),
(1210, 'B-D-19-03', 'LORONG 2', 1000000, 1000000),
(1211, 'B-D-19-02', 'LORONG 2', 1000000, 1000000),
(1212, 'B-D-19-01', 'LORONG 2', 1000000, 1000000),
(1213, 'B-D-21-05', 'LORONG 2', 1000000, 1000000),
(1214, 'B-D-21-04', 'LORONG 2', 1000000, 1000000),
(1215, 'B-D-21-03', 'LORONG 2', 1000000, 1000000),
(1216, 'B-D-21-02', 'LORONG 2', 1000000, 1000000),
(1217, 'B-D-21-01', 'LORONG 2', 1000000, 1000000),
(1218, 'B-E-01-05', 'LORONG 3', 1000000, 1000000),
(1219, 'B-E-01-04', 'LORONG 3', 1000000, 1000000),
(1220, 'B-E-01-03', 'LORONG 3', 1000000, 1000000),
(1221, 'B-E-01-02', 'LORONG 3', 1000000, 1000000),
(1222, 'B-E-01-01', 'LORONG 3', 1000000, 1000000),
(1223, 'B-E-03-05', 'LORONG 3', 1000000, 1000000),
(1224, 'B-E-03-04', 'LORONG 3', 1000000, 1000000),
(1225, 'B-E-03-03', 'LORONG 3', 1000000, 1000000),
(1226, 'B-E-03-02', 'LORONG 3', 1000000, 1000000),
(1227, 'B-E-03-01', 'LORONG 3', 1000000, 1000000),
(1228, 'B-E-05-05', 'LORONG 3', 1000000, 1000000),
(1229, 'B-E-05-04', 'LORONG 3', 1000000, 1000000),
(1230, 'B-E-05-03', 'LORONG 3', 1000000, 1000000),
(1231, 'B-E-05-02', 'LORONG 3', 1000000, 1000000),
(1232, 'B-E-05-01', 'LORONG 3', 1000000, 1000000),
(1233, 'B-E-07-05', 'LORONG 3', 1000000, 1000000),
(1234, 'B-E-07-04', 'LORONG 3', 1000000, 1000000),
(1235, 'B-E-07-03', 'LORONG 3', 1000000, 1000000),
(1236, 'B-E-07-02', 'LORONG 3', 1000000, 1000000),
(1237, 'B-E-07-01', 'LORONG 3', 1000000, 1000000),
(1238, 'B-E-09-05', 'LORONG 3', 1000000, 1000000),
(1239, 'B-E-09-04', 'LORONG 3', 1000000, 1000000),
(1240, 'B-E-09-03', 'LORONG 3', 1000000, 1000000),
(1241, 'B-E-09-02', 'LORONG 3', 1000000, 1000000),
(1242, 'B-E-09-01', 'LORONG 3', 1000000, 1000000),
(1243, 'B-E-11-05', 'LORONG 3', 1000000, 1000000),
(1244, 'B-E-11-04', 'LORONG 3', 1000000, 1000000),
(1245, 'B-E-11-03', 'LORONG 3', 1000000, 1000000),
(1246, 'B-E-11-02', 'LORONG 3', 1000000, 1000000),
(1247, 'B-E-11-01', 'LORONG 3', 1000000, 1000000),
(1248, 'B-E-13-05', 'LORONG 3', 1000000, 1000000),
(1249, 'B-E-13-04', 'LORONG 3', 1000000, 1000000),
(1250, 'B-E-13-03', 'LORONG 3', 1000000, 1000000),
(1251, 'B-E-13-02', 'LORONG 3', 1000000, 1000000),
(1252, 'B-E-13-01', 'LORONG 3', 1000000, 1000000),
(1253, 'B-E-15-05', 'LORONG 3', 1000000, 1000000),
(1254, 'B-E-15-04', 'LORONG 3', 1000000, 1000000),
(1255, 'B-E-15-03', 'LORONG 3', 1000000, 1000000),
(1256, 'B-E-15-02', 'LORONG 3', 1000000, 1000000),
(1257, 'B-E-15-01', 'LORONG 3', 1000000, 1000000),
(1258, 'B-E-17-05', 'LORONG 3', 1000000, 1000000),
(1259, 'B-E-17-04', 'LORONG 3', 1000000, 1000000),
(1260, 'B-E-17-03', 'LORONG 3', 1000000, 1000000),
(1261, 'B-E-17-02', 'LORONG 3', 1000000, 1000000),
(1262, 'B-E-17-01', 'LORONG 3', 1000000, 1000000),
(1263, 'B-E-19-05', 'LORONG 3', 1000000, 1000000),
(1264, 'B-E-19-04', 'LORONG 3', 1000000, 1000000),
(1265, 'B-E-19-03', 'LORONG 3', 1000000, 1000000),
(1266, 'B-E-19-02', 'LORONG 3', 1000000, 1000000),
(1267, 'B-E-19-01', 'LORONG 3', 1000000, 1000000),
(1268, 'B-E-21-05', 'LORONG 3', 1000000, 1000000),
(1269, 'B-E-21-04', 'LORONG 3', 1000000, 1000000),
(1270, 'B-E-21-03', 'LORONG 3', 1000000, 1000000),
(1271, 'B-E-21-02', 'LORONG 3', 1000000, 1000000),
(1272, 'B-E-21-01', 'LORONG 3', 1000000, 1000000),
(1273, 'B-F-01-05', 'LORONG 3', 1000000, 1000000),
(1274, 'B-F-01-04', 'LORONG 3', 1000000, 1000000),
(1275, 'B-F-01-03', 'LORONG 3', 1000000, 1000000),
(1276, 'B-F-01-02', 'LORONG 3', 1000000, 1000000),
(1277, 'B-F-01-01', 'LORONG 3', 1000000, 1000000),
(1278, 'B-F-03-05', 'LORONG 3', 1000000, 1000000),
(1279, 'B-F-03-04', 'LORONG 3', 1000000, 1000000),
(1280, 'B-F-03-03', 'LORONG 3', 1000000, 1000000),
(1281, 'B-F-03-02', 'LORONG 3', 1000000, 1000000),
(1282, 'B-F-03-01', 'LORONG 3', 1000000, 1000000),
(1283, 'B-F-05-05', 'LORONG 3', 1000000, 1000000),
(1284, 'B-F-05-04', 'LORONG 3', 1000000, 1000000),
(1285, 'B-F-05-03', 'LORONG 3', 1000000, 1000000),
(1286, 'B-F-05-02', 'LORONG 3', 1000000, 1000000),
(1287, 'B-F-05-01', 'LORONG 3', 1000000, 1000000),
(1288, 'B-F-07-05', 'LORONG 3', 1000000, 1000000),
(1289, 'B-F-07-04', 'LORONG 3', 1000000, 1000000),
(1290, 'B-F-07-03', 'LORONG 3', 1000000, 1000000),
(1291, 'B-F-07-02', 'LORONG 3', 1000000, 1000000),
(1292, 'B-F-07-01', 'LORONG 3', 1000000, 1000000),
(1293, 'B-F-09-05', 'LORONG 3', 1000000, 1000000),
(1294, 'B-F-09-04', 'LORONG 3', 1000000, 1000000),
(1295, 'B-F-09-03', 'LORONG 3', 1000000, 1000000),
(1296, 'B-F-09-02', 'LORONG 3', 1000000, 1000000),
(1297, 'B-F-09-01', 'LORONG 3', 1000000, 1000000),
(1298, 'B-F-11-05', 'LORONG 3', 1000000, 1000000),
(1299, 'B-F-11-04', 'LORONG 3', 1000000, 1000000),
(1300, 'B-F-11-03', 'LORONG 3', 1000000, 1000000),
(1301, 'B-F-11-02', 'LORONG 3', 1000000, 1000000),
(1302, 'B-F-11-01', 'LORONG 3', 1000000, 1000000),
(1303, 'B-F-13-05', 'LORONG 3', 1000000, 1000000),
(1304, 'B-F-13-04', 'LORONG 3', 1000000, 1000000),
(1305, 'B-F-13-03', 'LORONG 3', 1000000, 1000000),
(1306, 'B-F-13-02', 'LORONG 3', 1000000, 1000000),
(1307, 'B-F-13-01', 'LORONG 3', 1000000, 1000000),
(1308, 'B-F-15-05', 'LORONG 3', 1000000, 1000000),
(1309, 'B-F-15-04', 'LORONG 3', 1000000, 1000000),
(1310, 'B-F-15-03', 'LORONG 3', 1000000, 1000000),
(1311, 'B-F-15-02', 'LORONG 3', 1000000, 1000000),
(1312, 'B-F-15-01', 'LORONG 3', 1000000, 1000000),
(1313, 'B-F-17-05', 'LORONG 3', 1000000, 1000000),
(1314, 'B-F-17-04', 'LORONG 3', 1000000, 1000000),
(1315, 'B-F-17-03', 'LORONG 3', 1000000, 1000000),
(1316, 'B-F-17-02', 'LORONG 3', 1000000, 1000000),
(1317, 'B-F-17-01', 'LORONG 3', 1000000, 1000000),
(1318, 'B-F-19-05', 'LORONG 3', 1000000, 1000000),
(1319, 'B-F-19-04', 'LORONG 3', 1000000, 1000000),
(1320, 'B-F-19-03', 'LORONG 3', 1000000, 1000000),
(1321, 'B-F-19-02', 'LORONG 3', 1000000, 1000000),
(1322, 'B-F-19-01', 'LORONG 3', 1000000, 1000000),
(1323, 'B-F-21-05', 'LORONG 3', 1000000, 1000000),
(1324, 'B-F-21-04', 'LORONG 3', 1000000, 1000000),
(1325, 'B-F-21-03', 'LORONG 3', 1000000, 1000000),
(1326, 'B-F-21-02', 'LORONG 3', 1000000, 1000000),
(1327, 'B-F-21-01', 'LORONG 3', 1000000, 1000000),
(1328, 'C-A-01-05', 'LORONG 4', 1000000, 1000000),
(1329, 'C-A-01-04', 'LORONG 4', 1000000, 1000000),
(1330, 'C-A-01-03', 'LORONG 4', 1000000, 1000000),
(1331, 'C-A-02-05', 'LORONG 4', 1000000, 1000000),
(1332, 'C-A-02-04', 'LORONG 4', 1000000, 1000000),
(1333, 'C-A-02-03', 'LORONG 4', 1000000, 1000000),
(1334, 'B-C-01-01', 'LORONG 2', 1000000, 1000000),
(1335, 'B-C-01-01-02', 'LORONG 2', 1000000, 1000000),
(1336, 'test terus bre', 'LORONG 1', 1000000, 1000000),
(1337, 'UJIajadong', 'LORONG 1', 1000000, 1000000),
(1338, 'B-C-01-01-05', 'LORONG 1', 1000000, 1000000),
(1339, 'B-C-01-01-06', 'LORONG 2', 1000000, 1000000),
(1340, 'test fg', 'LORONG FG', 1000000, 999900),
(1341, 'rak fg', 'LORONG FG', 100000, 99900);

-- --------------------------------------------------------

--
-- Table structure for table `standar_rak_pallet`
--

CREATE TABLE `standar_rak_pallet` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori_barang` varchar(50) NOT NULL,
  `uom` varchar(20) NOT NULL,
  `kapasitas` int(50) NOT NULL,
  `isi_per_pallet` decimal(10,2) NOT NULL,
  `isi_dus_per_pallet` decimal(10,2) NOT NULL,
  `berat_dus` decimal(10,2) NOT NULL,
  `berat_per_pallet` decimal(10,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_berlaku` date NOT NULL,
  `nama_lorong` varchar(50) NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `standar_rak_pallet`
--

INSERT INTO `standar_rak_pallet` (`id`, `kode_barang`, `nama_barang`, `kategori_barang`, `uom`, `kapasitas`, `isi_per_pallet`, `isi_dus_per_pallet`, `berat_dus`, `berat_per_pallet`, `deskripsi`, `tanggal_berlaku`, `nama_lorong`, `status`, `created_at`, `updated_at`) VALUES
(13, '05.00.11.00', 'POWDER ABC 55%', 'POWDER', 'Kg', 1000, 40.00, 0.00, 25.00, 1000.00, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(14, '05.00.12.00', 'POWDER ABC 90%', 'POWDER', 'Kg', 1000, 1.00, 0.00, 1000.00, 1000.00, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(15, '05.00.12.00 (P)', 'POWDER ABC 90% (PAIL)', 'POWDER', 'Kg', 816, 36.00, 0.00, 22.68, 852.48, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(16, '05.00.13.00', 'POWDER D-met 85%', 'POWDER', 'Kg', 816, 36.00, 0.00, 22.68, 852.48, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(17, '05.00.14.00', 'POWDER BC PK 80%', 'POWDER', 'Kg', 816, 36.00, 0.00, 22.68, 852.48, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(18, '05.00.16.00', 'POWDER ABC T40%', 'POWDER', 'Kg', 1000, 40.00, 0.00, 25.00, 1000.00, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(19, '05.00.14.01', 'POWDER BC 80%', 'POWDER', 'Kg', 1000, 40.00, 0.00, 25.00, 1000.00, '', '0000-00-00', 'GUDANG POWDER', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(20, '05.00.21.00', 'AFFF 6% ( LITER )', 'CHEMICAL', 'Kg', 200, 10.00, 0.00, 20.00, 200.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(21, '05.00.23.00', 'AFFF AR 6% ( LITER )', 'CHEMICAL', 'Kg', 200, 10.00, 0.00, 20.00, 200.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(22, '05.00.30.00', 'CARBONDIOXIDE', 'GAS', 'Kg', 10000, 1.00, 0.00, 10000.00, 10000.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(23, '05.00.36.00', 'FE-36', 'CHEMICAL', 'Kg', 500, 1.00, 0.00, 500.00, 500.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(24, '05.00.24.00', 'WET CHEMICAL ( L )', 'CHEMICAL', 'Kg', 800, 4.00, 0.00, 200.00, 800.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(25, '05.00.26.00', 'HFC 236fa', 'CHEMICAL', 'Kg', 1000, 1.00, 0.00, 1000.00, 1000.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(26, '05.00.27.00', 'HFC 227ea', 'CHEMICAL', 'Kg', 1000, 1.00, 0.00, 1000.00, 1000.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(27, '06.05.00.20 (D)', 'CYLINDER 0,5 KG SA', 'CYLINDER', 'Pcs', 480, 24.00, 20.00, 0.00, 0.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(28, '06.05.00.20 (D2)', 'CYLINDER 0,5 KG SA', 'CYLINDER', 'Pcs', 720, 24.00, 30.00, 13.76, 330.24, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(29, '06.05.00.20 (T)', 'CYLINDER 0,5 KG SA (TROLLEY)', 'CYLINDER', 'Pcs', 364, 0.00, 0.00, 0.00, 0.00, '', '0000-00-00', 'lorong 4', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(30, '06.01.00.05', 'CYLINDER 1 KG M30', 'CYLINDER', 'Pcs', 480, 24.00, 20.00, 14.21, 341.04, NULL, '2025-08-11', 'LORONG 3', 'aktif', '2025-02-19 02:53:26', '2025-08-11 06:55:10'),
(31, '06.01.00.20 (T)', 'CYLINDER 1 KG SA 1.2 MM (TROLLEY)', 'CYLINDER', 'Pcs', 364, 1.00, 364.00, 283.00, 283.00, '', '0000-00-00', 'lorong 4', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(32, '06.01.00.20 (D)', 'CYLINDER 1 KG SA 1.2 MM', 'CYLINDER', 'Pcs', 480, 24.00, 20.00, 15.55, 373.20, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(33, '06.01.00.50 (T)', 'CYLINDER 1 KG SA 1.5 MM (TROLLEY)', 'CYLINDER', 'Pcs', 364, 1.00, 364.00, 283.00, 283.00, '', '0000-00-00', 'lorong 4', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(34, '06.01.00.50 (D)', 'CYLINDER 1 KG SA 1.5 MM', 'CYLINDER', 'Pcs', 480, 24.00, 20.00, 17.82, 427.68, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(35, '06.02.00.05', 'CYLINDER 2 KG M30', 'CYLINDER', 'Pcs', 144, 12.00, 12.00, 19.27, 231.24, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(36, '06.02.30.28', 'CYLINDER 2 KG CO2 MS', 'CYLINDER', 'Pcs', 180, 180.00, 1.00, 5.18, 932.40, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(37, '06.03.00.05', 'CYLINDER 3 KG M30', 'CYLINDER', 'Pcs', 144, 12.00, 12.00, 21.46, 257.52, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(38, '06.03.00.06', 'CYLINDER 3 KG M50', 'CYLINDER', 'Pcs', 144, 12.00, 12.00, 21.46, 257.52, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(39, '06.03.00.101', 'CYLINDER 3 KG M30 IC', 'CYLINDER', 'Pcs', 144, 12.00, 12.00, 21.46, 257.52, NULL, '2025-10-01', 'LORONG 3', 'aktif', '2025-02-19 02:53:26', '2025-10-08 01:13:45'),
(40, '06.05.30.28', 'CYLINDER 5 KG CO2 MS', 'CYLINDER', 'Pcs', 98, 98.00, 1.00, 10.52, 1030.96, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(41, '06.06.00.05 (D)', 'CYLINDER 6 KG M30', 'CYLINDER', 'Pcs', 108, 12.00, 9.00, 24.96, 299.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(42, '06.06.00.05 (D2)', 'CYLINDER 6 KG M30', 'CYLINDER', 'Pcs', 72, 8.00, 9.00, 24.96, 199.68, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(43, '06.06.00.06', 'CYLINDER 6 KG M50', 'CYLINDER', 'Pcs', 108, 12.00, 9.00, 26.90, 322.80, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(44, '06.06.00.101', 'CYLINDER 6 KG M30 IC', 'CYLINDER', 'Pcs', 72, 8.00, 9.00, 24.96, 199.68, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(45, '06.06.00.102', 'CYLINDER 6 KG M50 IC', 'CYLINDER', 'Pcs', 72, 8.00, 9.00, 24.96, 199.68, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(46, '06.09.00.05 (D)', 'CYLINDER 9 KG M30', 'CYLINDER', 'Pcs', 72, 12.00, 6.00, 21.63, 259.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(47, '06.09.00.05 (D2)', 'CYLINDER 9 KG M30', 'CYLINDER', 'Pcs', 48, 8.00, 6.00, 21.63, 173.04, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(48, '06.09.00.101', 'CYLINDER 9 KG M30 IC', 'CYLINDER', 'Pcs', 48, 8.00, 6.00, 25.00, 200.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(49, '06.09.30.28', 'CYLINDER 9 KG CO2 MS', 'CYLINDER', 'Pcs', 48, 48.00, 1.00, 16.71, 802.08, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(50, '06.12.00.05', 'CYLINDER 12 KG M30', 'CYLINDER', 'Pcs', 48, 12.00, 6.00, 24.03, 288.36, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(51, '06.23.30.29', 'CYLINDER 23 KG CO2 ', 'CYLINDER', 'Pcs', 25, 25.00, 1.00, 48.00, 1200.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(52, '06.23.30.45', 'CYLINDER 23 KG CO2 COATED', 'CYLINDER', 'Pcs', 25, 25.00, 1.00, 48.00, 1200.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(53, '06.45.00.05 (D)', 'CYLINDER 4.5 KG M30', 'CYLINDER', 'Pcs', 72, 8.00, 9.00, 20.22, 161.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:26', '2025-02-19 02:53:26'),
(54, '06.45.00.05 (D2)', 'CYLINDER 4.5 KG M30', 'CYLINDER', 'Pcs', 108, 12.00, 9.00, 20.22, 242.64, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(55, '06.45.30.29', 'CYLINDER 45 KG CO2', 'CYLINDER', 'Pcs', 16, 16.00, 1.00, 68.00, 256.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(56, '06.45.30.45', 'CYLINDER 45 KG CO2 COATED', 'CYLINDER', 'Pcs', 16, 16.00, 1.00, 68.00, 256.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(57, '06.52.00.32 (D)', 'CYLINDER 2 - 5 KG THERMATIC', 'CYLINDER', 'Pcs', 48, 12.00, 4.00, 11.28, 135.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(58, '06.52.00.32 (D2)', 'CYLINDER 2 - 5 KG THERMATIC', 'CYLINDER', 'Pcs', 80, 20.00, 4.00, 11.28, 225.60, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(59, '06.59.00.47', 'BOTTOM CYLINDER 50-90 KG', 'CYLINDER', 'Pcs', 80, 80.00, 1.00, 4.59, 367.20, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(60, '06.59.00.52', 'FOOTRING CYLINDER 50-90 KG', 'CYLINDER', 'Pcs', 90, 90.00, 1.00, 2.05, 184.50, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(61, '06.68.30.28', 'CYLINDER 6.8 KG CO2 MS', 'CYLINDER', 'Pcs', 48, 48.00, 1.00, 15.59, 748.32, '', '2025-06-15', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-06-15 10:57:01'),
(62, '07.00.00.06', 'VALVE M50', 'VALVE', 'Pcs', 1700, 68.00, 25.00, 14.64, 995.52, '', '2025-06-15', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-06-15 10:55:19'),
(63, '07.00.00.11', 'VALVE M30 SBH SAFETY', 'VALVE', 'Pcs', 3000, 60.00, 50.00, 14.00, 840.00, '', '2025-06-16', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-06-16 03:45:22'),
(64, '07.00.00.12', 'VALVE M30 SBH W/O SAFETY', 'VALVE', 'Pcs', 3000, 60.00, 50.00, 14.00, 840.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(65, '07.00.00.13', 'VALVE M30 LBH SAFETY', 'VALVE', 'Pcs', 2700, 54.00, 50.00, 17.50, 945.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(66, '07.00.00.14', 'VALVE M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 2700, 54.00, 50.00, 17.50, 945.00, NULL, '2025-08-01', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-08-17 23:12:17'),
(67, '07.00.00.20', 'HEAD VALVE SA (JIADUN)', 'VALVE', 'Pcs', 6400, 64.00, 100.00, 15.00, 960.00, '', '2025-06-04', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-06-04 03:01:32'),
(69, '07.00.10.21', 'HEAD VALVE SA SAFETY (HENGJIA)', 'VALVE', 'Pcs', 6400, 64.00, 100.00, 15.00, 960.00, NULL, '2025-08-01', 'LORONG 1', 'aktif', '2025-02-19 02:53:27', '2025-08-12 00:08:28'),
(70, '07.00.00.22', 'HEAD VALVE SA SAFETY (MIRROR)', 'VALVE', 'Pcs', 6400, 64.00, 100.00, 15.00, 960.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(71, '07.00.30.04', 'VALVE CO2 TROLLEY', 'VALVE', 'Pcs', 500, 20.00, 25.00, 19.50, 390.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(72, '07.00.30.29', 'VALVE CO2 STEEL', 'VALVE', 'Pcs', 2250, 45.00, 50.00, 19.50, 877.50, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(73, '07.00.62.04', 'VALVE TROLLEY 1” WITH SAFETY', 'VALVE', 'Pcs', 900, 45.00, 20.00, 19.00, 855.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(74, '07.00.30.95', 'VALVE CO2 SYSTEM', 'VALVE', 'Pcs', 100, 0.00, 100.00, 0.79, 79.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(75, '08.06.00.06', 'BRACKET ASSY 6 KG M50', 'BRACKET', 'Pcs', 400, 8.00, 50.00, 0.31, 124.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(76, '09.01.00.00', 'HANGER BRACKET 1 KG', 'HANGER BRACKET', 'Pcs', 2000, 4.00, 500.00, 0.07, 140.00, NULL, '2025-08-12', 'LORONG 2', 'aktif', '2025-02-19 02:53:27', '2025-08-17 23:23:47'),
(77, '09.32.00.00', 'HANGER BRACKET 2 - 3 KG', 'HANGER BRACKET', 'Pcs', 2000, 10.00, 200.00, 0.09, 180.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(78, '09.46.00.00', 'HANGER BRACKET 4,5 - 6 KG', 'HANGER BRACKET', 'Pcs', 2000, 10.00, 200.00, 0.10, 200.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(79, '09.52.00.32', 'HANGER BRACKET 2 - 5 KG THERMATIC', 'HANGER BRACKET', 'Pcs', 500, 10.00, 50.00, 0.32, 160.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(80, '09.52.06.32', 'HANGER BRACKET 2 - 5 KG THERMATIC BLANK', 'HANGER BRACKET', 'Pcs', 500, 10.00, 50.00, 0.32, 160.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(81, '09.91.00.00', 'HANGER BRACKET 9 - 12 KG', 'HANGER BRACKET', 'Pcs', 2000, 10.00, 200.00, 0.09, 180.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(83, '10.01.45.95', 'T. BRACKET 1 KG SAE UD TRUCK COATED', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.20, 200.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(84, '10.01.00.95', 'T. BRACKET 1 KG SAE UD TRUCK ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.21, 210.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(85, '10.01.06.22', 'TRANSPORT BRACKET 1 KG SA2 BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.15, 150.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(86, '10.01.45.22', 'TRANSPORT BRACKET 1 KG SA2 COATED MERAH', 'BRACKET', 'Pcs', 1800, 20.00, 50.00, 0.16, 160.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(87, '10.01.00.22', 'TRANSPORT BRACKET 1 KG SA2', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.17, 170.00, NULL, '2025-08-01', 'LORONG 4', 'aktif', '2025-02-19 02:53:27', '2025-10-07 22:13:36'),
(88, '10.01.06.23', 'TRANSPORT BRACKET 1 KG SA3 BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.30, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(89, '10.01.45.23', 'TRANSPORT BRACKET 1 KG SA3 COATED', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.31, 310.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(90, '10.01.00.23', 'TRANSPORT BRACKET 1 KG SA3 ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.32, 320.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(91, '10.01.46.35', 'TRANSPORT BRACKET 1 KG  VE-EX COATED HITAM AWSP', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.16, 160.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(92, '10.01.00.35', 'TRANSPORT BRACKET 1 KG VE-EX  HITAM AWSP', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.17, 170.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(93, '10.50.06.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.19, 190.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(94, '10.50.45.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM COATED/ trolley', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.15, 270.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(95, '10.50.00.41', 'TRANSPORT BRACKET 0,5 KG SAE ADM ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.19, 190.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(96, '10.01.06.41', 'TRANSPORT BRACKET 1 KG SAE ADM BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.19, 190.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(97, '10.01.45.41', 'TRANSPORT BRACKET 1 KG SAE ADM COATED/ trolley ', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.15, 270.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(98, '10.01.00.41', 'TRANSPORT BRACKET 1 KG SAE ADM ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.21, 210.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(99, '10.01.06.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.30, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(100, '10.01.45.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F COATED trolley', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.22, 270.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(101, '10.01.00.48', 'TRANSPORT BRACKET 1 KG SAE TMMIN I/F ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.32, 320.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(102, '10.01.06.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.30, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(103, '10.01.45.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y COATED', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.22, 396.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(104, '10.01.00.46', 'TRANSPORT BRACKET 1 KG SAE TMMIN V/Y ', 'BRACKET', 'Pcs', 1000, 20.00, 1000.00, 0.32, 320.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(105, '10.01.06.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 1000.00, 0.30, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(106, '10.01.45.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S COATED', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.22, 396.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(107, '10.01.00.47', 'TRANSPORT BRACKET 1 KG SAE TMMIN S ', 'BRACKET', 'Pcs', 1000, 20.00, 1000.00, 0.32, 320.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(108, '10.01.06.42', 'TRANSPORT BRACKET 1  KG SAE SUZUKI BLANK REGULER', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.19, 190.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(109, '10.01.45.42', 'TRANSPORT BRACKET 1 KG SAE SUZUKI COATED REGULER', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.20, 360.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(110, '10.01.00.42', 'TRANSPORT BRACKET 1 KG SAE SUZUKI  REGULER', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.21, 210.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(111, '10.01.06.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.20, 200.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(112, '10.01.45.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU COATED', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.21, 378.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(113, '10.01.00.50', 'TRANSPORT BRACKET 1 KG SAE SUZUKI CBU ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.22, 220.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(114, '10.01.06.43', 'TRANSPORT BRACKET 1 KG SAE HONDA BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.22, 220.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(115, '10.01.45.43', 'TRANSPORT BRACKET 1 KG SAE HONDA COATED', 'BRACKET', 'Pcs', 1800, 1.00, 1800.00, 0.23, 414.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(116, '10.01.00.43', 'TRANSPORT BRACKET 1 KG SAE HONDA ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.24, 240.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(117, '10.01.06.44', 'TRANSPORT BRACKET 1 KG HINO M BLANK', 'BRACKET', 'Pcs', 800, 20.00, 40.00, 0.31, 248.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(118, '10.01.45.44', 'TRANSPORT BRACKET 1 KG SAE HINO M COATED', 'BRACKET', 'Pcs', 1080, 1.00, 1080.00, 0.32, 345.60, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(119, '10.01.00.44', 'TRANSPORT BRACKET 1 KG SAE HINO M ', 'BRACKET', 'Pcs', 800, 20.00, 40.00, 0.33, 264.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(120, '10.01.06.45', 'TRANSPORT BRACKET 1 KG SAE HINO L BLANK', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.30, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(121, '10.01.45.45', 'TRANSPORT BRACKET 1 KG SAE HINO L COATED', 'BRACKET', 'Pcs', 1440, 1.00, 1440.00, 0.31, 446.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(122, '10.01.00.45', 'TRANSPORT BRACKET 1 KG SAE HINO L ', 'BRACKET', 'Pcs', 1000, 20.00, 50.00, 0.32, 320.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(123, '10.03.40.115', 'TRANSPORT BRACKET SFT 300', 'BRACKET', 'Pcs', 250, 5.00, 50.00, 0.46, 115.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(124, '10.06.40.115', 'TRANSPORT BRACKET SFT 600', 'BRACKET', 'Pcs', 250, 5.00, 50.00, 0.52, 130.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(125, '10.15.40.115', 'TRANSPORT BRACKET SFT 150', 'BRACKET', 'Pcs', 250, 5.00, 50.00, 0.29, 72.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(126, '10.45.40.115', 'TRANSPORT BRACKET SFT 450', 'BRACKET', 'Pcs', 250, 5.00, 50.00, 0.60, 150.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(127, '11.00.00.106', 'HOSE 3/4”', 'HOSE', 'Pcs', 300, 50.00, 6.00, 3.00, 150.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(128, '11.00.00.130', 'HOSE 3/8\"', 'HOSE', 'Pcs', 200, 50.00, 4.00, 1.29, 64.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(129, '11.00.00.42', 'HOSE 1/2\"', 'HOSE', 'Pcs', 1000, 100.00, 10.00, 2.37, 237.00, NULL, '2025-08-11', 'LORONG 2', 'aktif', '2025-02-19 02:53:27', '2025-08-18 00:03:18'),
(130, '11.00.30.116', 'HOSE 1/4\" (HYDRAULIC) (mtr)', 'HOSE', 'Pcs', 70, 0.00, 0.00, 20.00, 20.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(131, '11.00.60.55', 'HOSE GETEX 1,5\" (mtr)', 'HOSE', 'Mtr', 240, 4.00, 60.00, 15.00, 60.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(132, '11.00.60.57', 'HOSE GETEX 2,5\" (mtr)', 'HOSE', 'Mtr', 480, 8.00, 60.00, 20.00, 160.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(133, '11.00.70.55', 'HOSE GUARDMAN 1,5\"', 'HOSE', 'Mtr', 600, 6.00, 10.00, 30.00, 180.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(134, '11.00.70.57', 'HOSE GUARDMAN 2,5\" (mtr)', 'HOSE', 'Mtr', 120, 2.00, 60.00, 35.00, 70.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(135, '12.00.00.106', 'SIPHON TUBE 3/4\" (50 KG)', 'SIPHON TUBE', 'Pcs', 400, 0.00, 400.00, 0.17, 68.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(136, '12.70.00.106', 'SIPHON TUBE 3/4\" (70 KG)', 'SIPHON TUBE', 'Pcs', 400, 0.00, 400.00, 0.25, 100.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(137, '12.90.00.106', 'SIPHON TUBE 3/4\" (90 KG)', 'SIPHON TUBE', 'Pcs', 400, 0.00, 400.00, 0.31, 124.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(138, '12.00.00.41', 'SIPHON TUBE 5/8\" ( METER )', 'SIPHON TUBE', 'Mtr', 8000, 0.00, 2000.00, 0.27, 540.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(139, '12.02.30.00', 'SIPHON TUBE 2 KG CO2 ', 'SIPHON TUBE', 'Pcs', 500, 0.00, 500.00, 0.02, 8.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(140, '12.05.30.00', 'SIPHON TUBE 5 KG CO2 ', 'SIPHON TUBE', 'Pcs', 500, 0.00, 500.00, 0.03, 12.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(141, '12.09.30.00', 'SIPHON TUBE 9 KG CO2', 'SIPHON TUBE', 'Pcs', 500, 0.00, 500.00, 0.04, 20.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(142, '12.24.30.00', 'SIPHON TUBE 23-45 KG CO2', 'SIPHON TUBE', 'Pcs', 500, 0.00, 500.00, 0.07, 35.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(143, '12.68.30.00', 'SIPHON TUBE 6,8KG CO2', 'SIPHON TUBE', 'Pcs', 500, 0.00, 500.00, 0.03, 16.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(144, '12.69.20.00', 'SIPHON TUBE 6 - 9 LT FOAM ', 'SIPHON TUBE', 'Pcs', 200, 0.00, 200.00, 0.07, 14.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(145, '41.00.00.00', 'PIPA SS 304. t 1.2 mm', 'PIPA', 'Pcs', 100, 0.00, 100.00, 0.40, 40.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(146, '13.03.00.00', 'SKIRT 3 KG', 'SKIRT', 'Pcs', 1620, 30.00, 54.00, 0.81, 131.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(147, '13.46.00.00', 'SKIRT 4,5 - 6 KG', 'SKIRT', 'Pcs', 1050, 30.00, 35.00, 0.13, 136.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(148, '13.91.00.00', 'SKIRT 9 - 12 KG', 'SKIRT', 'Pcs', 840, 30.00, 28.00, 0.18, 151.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(149, '15.00.10.04', 'NOZZLE POWDER TROLLEY (TIDAK DI PAKAI)', 'NOZZLE', 'Pcs', 150, 0.00, 150.00, 0.12, 18.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(150, '15.00.20.03', 'NOZZLE FOAM PORTABLE TIDAK DI PAKAI', 'NOZZLE', 'Pcs', 100, 0.00, 100.00, 0.15, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(151, '15.05.00.20', 'NOZZLE 0.5 KG', 'NOZZLE', 'Pcs', 10000, 10.00, 1000.00, 0.00, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(152, '15.01.00.20', 'NOZZLE 1 KG SA', 'NOZZLE', 'Pcs', 28000, 4.00, 7000.00, 0.00, 21.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(153, '15.01.10.00', 'NOZZLE 1 KG POWDER', 'NOZZLE', 'Pcs', 20000, 4.00, 5000.00, 0.00, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(154, '15.02.10.00', 'NOZZLE 2 KG POWDER', 'NOZZLE', 'Pcs', 20000, 4.00, 5000.00, 0.00, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(155, '15.31.10.00', 'NOZZLE 3 - 12 KG POWDER', 'NOZZLE', 'Pcs', 6000, 4.00, 1500.00, 0.01, 12.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(156, '16.00.00.36', 'HOSE TAIL CROME BRASS', 'HOSE', 'Pcs', 32000, 32.00, 1000.00, 30.00, 960.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(157, '16.00.00.37', 'HOSE TAIL NYLON', 'HOSE', 'Pcs', 12000, 4.00, 3000.00, 0.01, 60.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(158, '17.00.00.03', 'PULL PIN PORTABLE', 'PULL PIN', 'Pcs', 12000, 4.00, 3000.00, 0.01, 30.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(159, '18.00.00.07', 'PRESSURE GAUGE 7 BAR  ', 'PRESSURE GAUGE', 'Pcs', 32000, 64.00, 500.00, 15.00, 960.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(160, '18.00.10.44', 'PRESSURE GAUGE 15 BAR (23A202S) - SAFESTAR', 'PRESSURE GAUGE', 'Pcs', 32000, 64.00, 500.00, 15.00, 960.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(161, '18.00.15.44', 'PRESSURE GAUGE 15 BAR (23A202S) - HENGJIA', 'PRESSURE GAUGE', 'Pcs', 32000, 64.00, 500.00, 15.00, 960.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(162, '19.00.00.00', 'FERRULE ', 'FERRULE ', 'Pcs', 16000, 16.00, 1000.00, 0.06, 88.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(163, '19.00.00.106', 'FERRULE 3/4”', 'FERRULE ', 'Pcs', 2000, 4.00, 500.00, 0.08, 160.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(164, '19.00.00.116', 'FERRULE 1/4”', 'FERRULE ', 'Pcs', 2000, 4.00, 500.00, 0.06, 110.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(165, '19.00.00.130', 'FERRULE 3/8\"', 'FERRULE ', 'Pcs', 2000, 4.00, 500.00, 0.03, 60.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(166, '19.00.00.42', 'FERRULE 1/2”', 'FERRULE ', 'Pcs', 2000, 4.00, 500.00, 0.06, 120.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(167, '20.09.30.45', 'TROLLEY 9 KG CO2 COATED ', 'TROLLEY', 'Pcs', 50, 1.00, 50.00, 0.73, 36.50, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(168, '20.23.30.45', 'TROLLEY 23 KG CO2 COATED ', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 8.25, 66.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(169, '20.45.30.45', 'TROLLEY 45 KG CO2 COATED ', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 9.79, 78.32, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(170, '20.50.00.100', 'TROLLEY 50 KG IC', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 26.00, 130.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(171, '20.50.00.90', 'TROLLEY 50 KG COATED ', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 25.00, 125.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(172, '20.70.00.90', 'TROLLEY 70 KG COATED ', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 32.00, 160.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(173, '20.70.00.100', 'TROLLEY 70 KG IC', 'TROLLEY', 'Pcs', 5, 5.00, 5.00, 33.00, 165.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(174, '20.90.00.100', 'TROLLEY 90 KG IC', 'TROLLEY', 'Pcs', 3, 3.00, 3.00, 41.00, 123.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(175, '20.90.00.90', 'TROLLEY 90 KG COATED', 'TROLLEY', 'Pcs', 3, 3.00, 3.00, 40.00, 200.00, '', '0000-00-00', 'Lorong 3', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(176, '21.00.00.00', 'SWIVEL HORN', 'HORN', 'Pcs', 400, 8.00, 50.00, 10.36, 82.88, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(177, '22.00.00.00', 'HOSE & HORN', 'HORN', 'Pcs', 270, 9.00, 30.00, 17.20, 156.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(178, '23.00.00.00', 'HORN', 'HORN', 'Pcs', 100, 1.00, 100.00, 0.10, 10.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(179, '23.00.00.108', 'MULTIJET HORN BLACK', 'HORN', 'Pcs', 100, 25.00, 4.00, 1.00, 100.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(180, '24.00.20.03', 'FILTER FOR PORTABLE FE', 'FILTER', 'Pcs', 2000, 0.00, 2000.00, 0.00, 9.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(181, '24.00.20.04', 'FILTER FOR TROLLEY FE', 'FILTER', 'Pcs', 1000, 0.00, 1000.00, 0.02, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(182, '24.00.30.07', 'PLUG VALVE CO2 SYSTEM', 'VALVE', 'Pcs', 100, 4.00, 25.00, 0.79, 80.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(183, '25.00.00.00', 'CABLE TIES', 'CABLE TIES', 'Pcs', 3000, 30.00, 100.00, 0.25, 7.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(184, '25.00.00.115', 'CABLE TIES SFT', 'CABLE TIES', 'Pcs', 10000, 100.00, 100.00, 0.03, 2.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(185, '26.00.00.00', 'PULLTIES HIJAU', 'PULLTIES', 'Pcs', 2400, 24.00, 100.00, 0.10, 2.40, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(186, '26.00.00.01', 'PULLTIES KUNING', 'PULLTIES', 'Pcs', 2400, 24.00, 100.00, 0.10, 2.40, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(187, '26.03.25.00', 'SAFETY BELT 3 LT', 'SAFETY BELT', 'Pcs', 100, 1.00, 100.00, 0.01, 1.40, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(188, '26.69.25.00', 'SAFETY BELT 6 - 9 LT', 'SAFETY BELT', 'Pcs', 100, 1.00, 100.00, 0.02, 1.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(189, '27.00.00.130', 'ADAPTOR HOSE 3/8\"', 'ADAPTOR', 'Pcs', 100, 1.00, 100.00, 0.05, 4.80, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(190, '27.00.30.07', 'ADAPTOR VALVE CO2 SYSTEM', 'ADAPTOR', 'Pcs', 100, 1.00, 100.00, 0.04, 4.10, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(191, '27.00.30.11', 'ADAPTOR HOSE CO2 SYSTEM', 'ADAPTOR', 'Pcs', 100, 1.00, 100.00, 0.04, 4.10, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(192, '27.00.30.18', 'ADAPTOR PRESSURE CO2 SYSTEM', 'ADAPTOR', 'Pcs', 100, 1.00, 100.00, 0.04, 4.10, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(193, '27.00.32.00', 'ADAPTOR HORN', 'ADAPTOR', 'Pcs', 100, 1.00, 100.00, 0.04, 4.10, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(194, '30.00.00.43', 'SPRINKLER  68OC', 'SPRINKLER', 'Pcs', 500, 5.00, 100.00, 14.00, 70.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(195, '30.00.00.57', 'SPRINKLER  57 ', 'SPRINKLER', 'Pcs', 500, 5.00, 100.00, 14.00, 70.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(196, '32.00.00.00', 'GUN SPRAY', 'GUN SPRAY', 'Pcs', 50, 4.00, 50.00, 0.90, 200.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(197, '33.00.00.32', 'GUARD THERMATIC', 'GUARD THERMATIC', 'Pcs', 1200, 12.00, 200.00, 0.16, 192.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(198, '34.00.00.20', 'PLASTIC COVER SA', 'PLASTIC COVER', 'Pcs', 2000, 20.00, 100.00, 8.00, 160.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(199, '34.50.00.20', 'PLASTIC COVER SA1 (0.5 KG) MIRROR', 'PLASTIC COVER', 'Pcs', 2000, 20.00, 100.00, 7.24, 144.80, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(200, '34.50.00.21', 'PLASTIC COVER SA1 (0.5 KG) ADM', 'PLASTIC COVER', 'Pcs', 2000, 20.00, 100.00, 7.24, 144.80, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(201, '35.00.00.00', 'METRON ACTUATOR', 'METRON ACTUATOR', 'Pcs', 500, 0.00, 500.00, 0.03, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(202, '36.00.00.39', 'RODA KECIL 5”', 'RODA', 'Pcs', 100, 0.00, 100.00, 0.50, 50.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(203, '36.00.00.40', 'RODA 13\"', 'RODA', 'Pcs', 135, 1.00, 110.00, 6.79, 747.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(204, '37.00.00.13', 'STICKER GARANSI', 'STICKER', 'Pcs', 72000, 24.00, 3000.00, 13.83, 331.92, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(205, '37.00.00.14', 'STICKER SCHEDULE SERVICE', 'STICKER', 'Pcs', 93000, 6.00, 15500.00, 18.24, 109.44, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(206, '37.00.00.01', 'STICKER QC PASSED', 'STICKER', 'Pcs', 20000, 0.00, 20000.00, 0.00, 0.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(207, '37.00.00.94', 'STICKER SOLENOID PILOT CYLINDER', 'STICKER', 'Pcs', 20000, 0.00, 20000.00, 0.00, 0.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(208, '37.01.00.21', 'STICKER BULAT HOLOGRAM', 'STICKER', 'Pcs', 20000, 0.00, 20000.00, 0.00, 0.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(209, '37.02.30.02', 'STICKER FC 200 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(210, '37.05.30.02', 'STICKER FC 500 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(211, '37.09.30.01', 'STICKER C 900 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(212, '37.09.30.02', 'STICKER FC 900 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:27', '2025-02-19 02:53:27'),
(213, '37.16.12.01', 'STICKER P 16000 ABC90', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(214, '37.20.12.94', 'STICKER P 2000 ABC90 BS', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(215, '37.25.13.01', 'STICKER P 2500 D', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(216, '37.23.30.01', 'STICKER C 2300 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(217, '37.23.30.02', 'STICKER FC 2300 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(218, '37.25.11.02', 'STICKER FP 2500 ABC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(219, '37.25.12.01', 'STICKER P 2500 ABC90', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(220, '37.25.14.01', 'STICKER P 2500 BC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(221, '37.30.21.01', 'STICKER F 3000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(222, '37.30.21.02', 'STICKER FF 3000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(223, '37.45.30.01', 'STICKER C 4500 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(224, '37.45.30.02', 'STICKER FC 4500 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(225, '37.50.11.02', 'STICKER FP 5000 ABC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(226, '37.50.12.01', 'STICKER P 5000 ABC90', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(227, '37.50.14.01', 'STICKER P 5000 BC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(228, '37.50.21.01', 'STICKER F 5000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(229, '37.50.21.02', 'STICKER FF 5000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(230, '37.50.36.01', 'STICKER D 5000 FE-36', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(231, '37.68.11.02', 'STICKER FP 6800 ABC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(232, '37.68.12.01', 'STICKER P 6800 ABC90', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(233, '37.68.14.01', 'STICKER P 6800 BC', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(234, '37.68.30.124', 'STICKER MC 680 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(235, '37.68.30.01', 'STICKER C 680 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(236, '37.68.30.02', 'STICKER FC 680 CO2', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(237, '37.80.12.01', 'STICKER P 8000 ABC90', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(238, '37.90.21.01', 'STICKER F 9000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(239, '37.90.21.02', 'STICKER FF 9000 AF3', 'STICKER', 'Pcs', 50, 0.00, 50.00, 0.00, 0.00, '', '0000-00-00', 'Office', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(240, '38.01.00.01', 'CARTON 1 KG', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(241, '38.01.00.02', 'CARTON 1 KG FUHRER', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(242, '38.01.00.129', 'CARTON 1 KG Ve-EX ACE HARDWARE', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 2.49, 249.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(243, '38.01.00.35', 'CARTON 1 KG Ve-EX (P 100 SA)', 'CARTON', 'Pcs', 2400, 120.00, 20.00, 1.93, 231.60, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(244, '38.01.00.21', 'CARTON 1 KG SA1 (D)', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(245, '38.01.00.22', 'CARTON 1 KG SA2 (T)', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(246, '38.01.00.100', 'CARTON BOX 1 KG SA', 'CARTON', 'Pcs', 2400, 120.00, 20.00, 1.93, 231.60, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(247, '38.01.00.101', 'CARTON 1 KG POLOS', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(248, '38.01.00.102', 'CARTON 1 KG TAM (P2)', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(249, '38.01.00.103', 'CARTON 1 KG TAM (P1)', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 1.93, 193.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(250, '38.01.00.104', 'CARTON 1 KG SERVVO (KUNING) / NEW ITEM', 'CARTON', 'Pcs', 2000, 40.00, 50.00, 7.50, 300.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(251, '38.01.00.93', 'CARTON 1 KG ACE HARDWARE', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 2.49, 249.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(252, '38.01.02.144', 'CARTON 1 KG F MITRA 10', 'CARTON', 'Pcs', 1000, 100.00, 10.00, 2.49, 249.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(253, '38.02.00.01', 'CARTON 2 KG', 'CARTON', 'Pcs', 500, 50.00, 10.00, 3.00, 150.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(254, '38.02.00.02', 'CARTON 2 KG FUHRER', 'CARTON', 'Pcs', 500, 50.00, 10.00, 3.00, 150.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(255, '38.02.30.01', 'CARTON 2 KG CO2', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.10, 164.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(256, '38.02.30.02', 'CARTON 2 KG CO2 FUHRER', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.10, 164.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(257, '38.03.00.01', 'CARTON 3 KG', 'CARTON', 'Pcs', 400, 40.00, 10.00, 3.71, 148.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(258, '38.03.00.02', 'CARTON 3 KG FUHRER', 'CARTON', 'Pcs', 400, 40.00, 10.00, 3.71, 148.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(259, '38.03.00.93', 'CARTON 3 KG ACE HARDWARE', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.52, 180.80, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(260, '38.03.02.144', 'CARTON 3 KG F MITRA 10', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.52, 180.80, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(261, '38.05.30.01', 'CARTON 5 KG CO2', 'CARTON', 'Pcs', 200, 20.00, 10.00, 6.32, 126.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(262, '38.05.30.02', 'CARTON 5 KG CO2 FUHRER', 'CARTON', 'Pcs', 200, 20.00, 10.00, 6.32, 126.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(263, '38.06.00.01', 'CARTON 6 KG', 'CARTON', 'Pcs', 500, 50.00, 10.00, 5.00, 250.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(264, '38.06.00.02', 'CARTON 6 KG FUHRER', 'CARTON', 'Pcs', 500, 50.00, 10.00, 5.00, 250.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(265, '38.06.00.93', 'CARTON 6 KG ACE HARDWARE', 'CARTON', 'Pcs', 500, 50.00, 10.00, 7.00, 250.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(266, '38.06.02.144', 'CARTON 6 KG F MITRA 10', 'CARTON', 'Pcs', 500, 50.00, 10.00, 7.00, 250.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(267, '38.09.00.01', 'CARTON 9 KG', 'CARTON', 'Pcs', 300, 30.00, 10.00, 5.82, 174.60, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(268, '38.09.00.02', 'CARTON 9 KG FUHRER', 'CARTON', 'Pcs', 300, 30.00, 10.00, 5.82, 174.60, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(269, '38.12.00.01', 'CARTON 12 KG', 'CARTON', 'Pcs', 200, 20.00, 10.00, 6.77, 135.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(270, '38.12.00.02', 'CARTON 12 KG FUHRER', 'CARTON', 'Pcs', 200, 20.00, 10.00, 6.77, 135.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(271, '38.45.00.01', 'CARTON 4,5 KG', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.61, 184.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(272, '38.45.00.02', 'CARTON 4,5 KG FUHRER', 'CARTON', 'Pcs', 400, 40.00, 10.00, 4.61, 184.40, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(273, '38.52.40.32', 'CARTON 2 - 5 KG THERMATIC', 'CARTON', 'Pcs', 300, 30.00, 10.00, 5.15, 154.50, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(274, '38.68.30.01', 'CARTON 6,8 KG CO2', 'CARTON', 'Pcs', 200, 20.00, 10.00, 8.10, 162.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(275, '38.68.30.02', 'CARTON 6,8 KG CO2 FUHRER', 'CARTON', 'Pcs', 200, 20.00, 10.00, 8.10, 162.00, '', '0000-00-00', 'Lorong 4', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(276, '39.00.00.23', 'BOLT W/ WASHER', 'BAUT', 'Pcs', 10000, 0.00, 10000.00, 0.01, 75.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(277, '39.00.00.79', 'BAUT PH (+) 10 x 1 1/4\"', 'BAUT', 'Pcs', 10000, 0.00, 10000.00, 0.00, 40.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(278, '55.00.00.71', 'MUR (P) n10', 'MUR', 'Pcs', 100, 0.00, 100.00, 0.01, 1.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(279, '55.00.00.72', 'MUR (P) n20', 'MUR', 'Pcs', 1000, 0.00, 1000.00, 0.06, 58.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(280, '56.00.00.34', 'BAUT PLASTIC COVER', 'BAUT', 'Pcs', 10000, 10.00, 1000.00, 3.31, 33.10, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(281, '56.00.00.73', 'BAUT & MUR (P) 10 x 35 mm', 'BAUT', 'Pcs', 500, 0.00, 500.00, 0.04, 19.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(282, '56.00.00.74', 'BAUT & MUR (P) 10 x 20 mm', 'BAUT', 'Pcs', 1000, 0.00, 1000.00, 0.03, 31.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(283, '56.00.00.08', 'BAUT & MUR (P) 8 x 20 mm', 'BAUT', 'Pcs', 1000, 0.00, 1000.00, 0.02, 16.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(284, '56.00.00.06', 'BAUT & MUR M6 x 20 mm', 'BAUT', 'Pcs', 1000, 0.00, 1000.00, 0.01, 8.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(285, '39.05.00.12', 'BAUT L 5 MM X 12 MM', 'BAUT', 'Pcs', 4000, 10.00, 400.00, 1.12, 11.20, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(286, '55.05.00.01', 'MUR M5 PUTIH', 'MUR', 'Pcs', 2000, 0.00, 2000.00, 1.74, 1.74, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28');
INSERT INTO `standar_rak_pallet` (`id`, `kode_barang`, `nama_barang`, `kategori_barang`, `uom`, `kapasitas`, `isi_per_pallet`, `isi_dus_per_pallet`, `berat_dus`, `berat_per_pallet`, `deskripsi`, `tanggal_berlaku`, `nama_lorong`, `status`, `created_at`, `updated_at`) VALUES
(287, '57.00.00.06', 'RING PLAT TBL M6', 'RING PLAT', 'Pcs', 500, 0.00, 500.00, 0.00, 0.38, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(288, '57.00.00.75', 'RING PLAT TBL n10', 'RING PLAT', 'Pcs', 2000, 0.00, 2000.00, 0.01, 10.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(289, '57.00.00.76', 'RING PLAT TBL n20', 'RING PLAT', 'Pcs', 1000, 0.00, 1000.00, 0.02, 22.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(290, '42.01.00.11', 'VALVE ASSY 1 KG M30 SBH SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(291, '42.01.00.12', 'VALVE ASSY 1 KG M30 SBH W/O SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(292, '42.01.00.20', 'VALVE ASSY 1 KG SA (JIADUN)', 'VALVE', 'Pcs', 1600, 8.00, 200.00, 38.71, 304.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(293, '42.01.00.21', 'VALVE ASSY 1 KG SA SAFETY (SHANGHAI SAFEWAY)', 'VALVE', 'Pcs', 1600, 8.00, 200.00, 38.71, 304.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(294, '42.01.10.21', 'VALVE ASSY 1 KG SA SAFETY (HENGJIA)', 'VALVE', 'Pcs', 1600, 8.00, 200.00, 38.71, 304.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(295, '42.01.00.22', 'VALVE ASSY 0.5 KG SA SAFETY (MIRROR)', 'VALVE', 'Pcs', 2000, 8.00, 250.00, 46.84, 375.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(296, '42.01.00.67', 'VALVE ASSY 1 KG M30 SA SBH SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 32.75, 262.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(297, '42.01.00.68', 'VALVE ASSY 1 KG M30 SA SBH W/O SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 32.75, 262.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(298, '42.02.00.11', 'VALVE ASSY 2 KG M30 SBH SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 32.75, 262.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(299, '42.02.00.12', 'VALVE ASSY 2 KG M30 SBH W/O SAFETY', 'VALVE', 'Pcs', 800, 8.00, 100.00, 32.75, 262.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(300, '42.03.00.06', 'VALVE ASSY 3 KG M50 TIDAK DI PAKAI', 'VALVE', 'Pcs', 240, 12.00, 100.00, 32.75, 393.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(301, '42.03.00.13', 'VALVE ASSY 3 KG M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 8.00, 75.00, 37.50, 300.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(302, '42.03.00.14', 'VALVE ASSY 3 KG M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 8.00, 75.00, 37.50, 300.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(303, '42.03.20.13', 'VALVE ASSY 3 LT FOAM M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 8.00, 75.00, 37.50, 300.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(304, '42.06.00.06', 'VALVE ASSY 6 KG M50', 'VALVE', 'Pcs', 600, 8.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(305, '42.06.00.13', 'VALVE ASSY 6 KG M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(306, '42.06.00.14', 'VALVE ASSY 6 KG M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(307, '42.06.20.06', 'VALVE ASSY 6 LT FOAM M50 TIDAK DI PAKAI', 'VALVE', 'Pcs', 600, 12.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(308, '42.06.20.13', 'VALVE ASSY 6 LT FOAM M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(309, '42.06.20.14', 'VALVE ASSY 6 LT FOAM M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 20.98, 251.76, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(310, '42.09.00.06', 'VALVE ASSY 9 KG M50 TIDAK DI PAKAI ', 'VALVE', 'Pcs', 0, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(311, '42.09.00.13', 'VALVE ASSY 9 KG M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(312, '42.09.00.14', 'VALVE ASSY 9 KG M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(313, '42.09.20.06', 'VALVE ASSY 9 LT FOAM M50 TIDAK DI PAKAI', 'VALVE', 'Pcs', 0, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(314, '42.09.20.13', 'VALVE ASSY 9 LT FOAM M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(315, '42.09.20.14', 'VALVE ASSY 9 LT FOAM M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.37, 256.44, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(316, '42.12.00.06', 'VALVE ASSY 12 KG M50', 'VALVE', 'Pcs', 0, 12.00, 50.00, 21.26, 255.12, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(317, '42.12.00.13', 'VALVE ASSY 12 KG M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.26, 255.12, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(318, '42.12.00.14', 'VALVE ASSY 12 KG M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 12.00, 50.00, 21.26, 255.12, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:28', '2025-02-19 02:53:28'),
(319, '42.45.00.13', 'VALVE ASSY 4,5 KG M30 LBH SAFETY', 'VALVE', 'Pcs', 600, 4.00, 100.00, 0.39, 234.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(320, '42.45.00.14', 'VALVE ASSY 4,5 KG M30 LBH W/O SAFETY', 'VALVE', 'Pcs', 600, 4.00, 100.00, 0.39, 234.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(321, '43.00.30.04', 'HOSE ASSY CO2 TROLLEY ', 'HOSE', 'Pcs', 50, 0.00, 50.00, 1.50, 75.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(322, '43.00.50.04', 'HOSE ASSY POWDER/FOAM TROLLEY', 'HOSE', 'Pcs', 50, 0.00, 50.00, 4.04, 201.95, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(323, '43.03.25.01', 'HOSE ASSY 3 LT WET CHEM SERVVO', 'HOSE', 'Pcs', 400, 4.00, 100.00, 0.13, 13.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(324, '43.06.25.01', 'HOSE ASSY 6 LT WET CHEM SERVVO', 'HOSE', 'Pcs', 400, 4.00, 100.00, 0.14, 14.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(325, '43.09.25.01', 'HOSE ASSY 9 LT WET CHEM SERVVO', 'HOSE', 'Pcs', 400, 4.00, 100.00, 0.15, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(326, '43.03.20.01', 'HOSE ASSY 3 LT FOAM SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.14, 112.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(327, '43.03.20.02', 'HOSE ASSY 3 LT FOAM FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.14, 112.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(328, '43.06.10.01', 'HOSE ASSY 6 KG POWDER SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(329, '43.06.10.02', 'HOSE ASSY 6 KG POWDER FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.15, 120.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(330, '43.06.20.01', 'HOSE ASSY 6 LT FOAM SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(331, '43.06.20.02', 'HOSE ASSY 6 LT FOAM FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.15, 120.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(332, '43.09.10.01', 'HOSE ASSY 9 KG POWDER SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.17, 136.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(333, '43.09.10.02', 'HOSE ASSY 9 KG POWDER FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(334, '43.09.20.01', 'HOSE ASSY 9 LT FOAM SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.17, 136.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(335, '43.09.20.02', 'HOSE ASSY 9 LT FOAM FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(336, '43.12.10.01', 'HOSE ASSY 12 KG POWDER SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.18, 144.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(337, '43.12.10.02', 'HOSE ASSY 12 KG POWDER FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.16, 128.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(338, '43.34.10.01', 'HOSE ASSY 3 - 4,5 KG POWDER SERVVO', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.14, 112.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(339, '43.34.10.02', 'HOSE ASSY 3 - 4,5 KG POWDER FUHRER', 'HOSE', 'Pcs', 800, 8.00, 100.00, 0.14, 112.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(340, '46.00.00.05', 'NECKRING M30', 'NECKRING', 'Pcs', 10368, 18.00, 576.00, 0.08, 870.91, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(341, '46.00.00.06', 'NECKRING M50', 'NECKRING', 'Pcs', 500, 1.00, 500.00, 0.19, 93.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(342, '46.00.00.46', 'NECKRING ATAS THERMATIC', 'NECKRING', 'Pcs', 1000, 2.00, 500.00, 0.31, 153.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(343, '46.00.00.47', 'NECKRING BAWAH THERMATIC', 'NECKRING', 'Pcs', 1000, 2.00, 500.00, 0.14, 70.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(344, '46.00.00.60', 'NECKRING M60', 'NECKRING', 'Pcs', 500, 1.00, 500.00, 0.25, 126.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(345, '46.00.00.66', 'NECKRING M30 SA', 'NECKRING', 'Pcs', 20736, 24.00, 864.00, 0.04, 891.65, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(346, '47.00.00.05', 'O-RING M30', 'O-RING', 'Pcs', 20000, 200.00, 100.00, 0.09, 18.60, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(347, '47.00.00.06', 'O-RING M50', 'O-RING', 'Pcs', 20000, 200.00, 100.00, 0.36, 72.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(348, '52.00.07.78', 'SEAL VALVE TROLLEY 1”', 'SEAL', 'Pcs', 500, 0.00, 500.00, 0.00, 1.75, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(349, '52.00.77.78', 'SEAL FEMALE COUPLING 1”', 'SEAL', 'Pcs', 500, 0.00, 500.00, 0.00, 0.25, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(350, '52.15.00.37', 'SEAL NYLON (OD.15 x ID. 8 x t.1,5 mm)', 'SEAL', 'Pcs', 1000, 0.00, 1000.00, 0.00, 0.45, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(351, '52.20.00.37', 'SEAL NYLON (OD.20 x ID. 8 x t.2 mm)', 'SEAL', 'Pcs', 1000, 0.00, 1000.00, 0.00, 0.65, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(352, '53.00.00.04', 'AS RODA TROLLEY', 'AS RODA', 'Pcs', 800, 4.00, 200.00, 0.80, 160.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(353, '53.09.30.04', 'AS RODA 9 KG CO2 TROLLEY', 'AS RODA', 'Pcs', 800, 4.00, 200.00, 0.11, 22.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(354, '69.00.00.04', 'HAND GRIP', 'HAND GRIP', 'Pcs', 500, 1.00, 500.00, 0.08, 38.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(355, '70.00.00.00', 'KARET BAMPER', 'KARET BAMPER', 'Pcs', 420, 0.00, 140.00, 0.12, 50.40, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(356, '74.00.00.105', 'VISER S8', 'VISER', 'Pcs', 10000, 100.00, 100.00, 0.10, 9.70, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(357, '75.00.00.106', 'SPRING 3/4”', 'SPRING', 'Pcs', 500, 0.00, 500.00, 0.17, 84.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(358, '75.00.00.115', 'SPRING SFT (TIDAK DI PAKAI LAGI)', 'SPRING', 'Pcs', 0, 0.00, 500.00, 0.01, 7.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(359, '76.00.00.116', 'MALE COUPLING 1/4\"', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.03, 15.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(360, '76.00.00.42', 'MALE COUPLING 1/2\"', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.11, 54.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(361, '77.00.00.130', 'FEMALE COUPLING 3/8\"', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.05, 25.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(362, '77.00.00.42', 'FEMALE COUPLING 1/2”', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.11, 54.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(363, '77.00.00.78', 'FEMALE COUPLING 1”', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.21, 104.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(364, '77.00.30.130', 'FEMALE COUPLING VALVE CO2', 'COUPLING', 'Pcs', 500, 0.00, 500.00, 0.08, 42.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(365, '82.00.00.118', 'TUBE 6 x 4 mm', 'TUBE', 'Pcs', 1000, 10.00, 100.00, 1.83, 18.29, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(366, '83.00.00.115', 'TUBING SHOCK SFT (OVAL UNION TUBING SPU 6)', 'TUBING SHOCK', 'Pcs', 500, 5.00, 100.00, 0.01, 2.75, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(367, '84.00.00.115', 'BLANKING PLUG SFT', 'BLANKING PLUG', 'Pcs', 500, 0.00, 500.00, 0.00, 0.30, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(368, '85.00.00.115', 'MOUNTING BASE SFT', 'MOUNTING BASE', 'Pcs', 1000, 10.00, 100.00, 0.19, 1.90, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(369, '87.12.05.01', 'COIL SPCE 1.2 MM (1040 MM x COIL) 0.5 KG', 'COIL', 'kg', 16000, 4.00, 1.00, 4000.00, 16000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(370, '87.12.01.01', 'COIL SPCE 1.2 MM (1120 MM x COIL) 1 KG', 'COIL', 'kg', 40000, 8.00, 1.00, 5000.00, 40000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(371, '87.12.01.02', 'COIL SPCE 1.2 MM (99 MM x COIL) BOTTOM 1 KG', 'COIL', 'kg', 24000, 6.00, 1.00, 400.00, 24000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(372, '87.15.01.01', 'COIL SPCC 1.5 MM (1120 MM x COIL) 1 KG', 'COIL', 'kg', 40000, 8.00, 1.00, 5000.00, 40000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(373, '87.15.02.01', 'COIL SPCC 1.5 MM (390 MM x COIL) 2 KG', 'COIL', 'kg', 10000, 5.00, 0.00, 2000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(374, '87.15.03.01', 'COIL SPCC 1.5 MM (440 MM x COIL) 3 KG', 'COIL', 'kg', 10000, 5.00, 0.00, 2000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(375, '87.15.45.01', 'COIL SPCC 1.5 MM (500 MM x COIL) 4.5 KG', 'COIL', 'kg', 10000, 5.00, 0.00, 2000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(376, '87.15.06.54', 'COIL SPCC 1.5 MM (540 MM x COIL) 6 KG', 'COIL', 'kg', 16000, 8.00, 0.00, 2000.00, 16000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(377, '87.15.09.01', 'COIL SPCC 1.5 MM (620 MM x COIL) 9 KG', 'COIL', 'kg', 16000, 8.00, 0.00, 2000.00, 16000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(378, '87.15.01.02', 'COIL SPCC 1.5 MM (99 MM x COIL) BOTTOM 1 KG', 'COIL', 'kg', 16000, 40.00, 0.00, 400.00, 16000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(379, '87.15.09.02', 'COIL SPCC 1.5 MM (237 MM x COIL) BOTTOM 9 KG', 'COIL', 'kg', 10000, 10.00, 0.00, 1000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(380, '87.15.06.22', 'COIL SPCC 1.5 MM (220 MM x COIL) BOTTOM 6 KG', 'COIL', 'kg', 10000, 10.00, 0.00, 1000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(381, '87.15.02.12', 'COIL SPCC 1.5 MM (200 MM x COIL) BOTTOM 2 - 12 KG', 'COIL', 'kg', 10000, 10.00, 0.00, 1000.00, 10000.00, '', '0000-00-00', 'AREA COIL', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(382, '87.05.06.02', 'PLAT STEEL CYLINDER 0.5 KG (SPCE 1.2)', 'PLAT STEEL', 'Pcs', 1000, 0.00, 1000.00, 0.50, 500.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(383, '87.01.06.02', 'PLAT STEEL CYLINDER 1 KG (SPCE 1.2)', 'PLAT STEEL', 'Pcs', 900, 0.00, 900.00, 0.62, 558.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(384, '87.01.06.00', 'PLAT STEEL CYLINDER 1 KG (SPCC 1.5)', 'PLAT STEEL', 'Pcs', 700, 0.00, 700.00, 0.77, 539.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(385, '87.03.06.00', 'PLAT STEEL CYLINDER 3 KG (SPCC 1.5)', 'PLAT STEEL', 'Pcs', 300, 0.00, 300.00, 1.70, 510.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(386, '87.45.06.00', 'PLAT STEEL CYLINDER 4.5 KG (SPCC 1.5)', 'PLAT STEEL', 'Pcs', 280, 0.00, 280.00, 1.85, 518.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(387, '87.06.06.00', 'PLAT STEEL CYLINDER 6 KG (SPCC 1.5)', 'PLAT STEEL', 'Pcs', 200, 0.00, 200.00, 2.46, 492.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(388, '87.09.06.00', 'PLAT STEEL CYLINDER 9 KG (SPCC 1.5)', 'PLAT STEEL', 'Pcs', 150, 0.00, 150.00, 3.45, 517.50, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(389, '87.05.07.02', 'PLAT STEEL BOTTOM CYLINDER 0.5 KG (SPCE 1,2)', 'PLAT STEEL', 'Pcs', 15000, 3.00, 5000.00, 0.03, 480.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(390, '87.01.07.02', 'PLAT STEEL BOTTOM CYLINDER 1 KG (SPCE 1,2)', 'PLAT STEEL', 'Pcs', 8600, 4.00, 2150.00, 0.06, 507.40, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(391, '87.01.07.00', 'PLAT STEEL BOTTOM CYLINDER 1 KG (SPCC 1,5)', 'PLAT STEEL', 'Pcs', 8600, 4.00, 2150.00, 0.08, 653.60, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(392, '87.03.06.120', 'PLAT STEEL BOTTOM CYLINDER 2 - 3 KG (SPCC 1,5)', 'PLAT STEEL', 'Pcs', 4000, 4.00, 1000.00, 0.16, 640.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(393, '87.46.06.120', 'PLAT STEEL BOTTOM CYLINDER 4.5 - 6 KG (SPCC 1,5)', 'PLAT STEEL', 'Pcs', 3000, 4.00, 750.00, 0.24, 720.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(394, '87.91.06.120', 'PLAT STEEL BOTTOM CYLINDER 9 - 12 KG (SPCC 1,5)', 'PLAT STEEL', 'Pcs', 1500, 2.00, 750.00, 0.34, 510.00, '', '0000-00-00', 'AREA PLAT', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(395, '88.00.00.108', 'POWDER COATING PE HITAM KG', 'POWDER', 'kg', 500, 25.00, 20.00, 20.00, 500.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(396, '88.00.00.121', 'POWDER COATING PE MERAH KG', 'POWDER', 'kg', 500, 25.00, 20.00, 20.00, 500.00, '', '0000-00-00', 'AREA LUAR', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(397, '90.00.00.43', 'RIVET SD-648-HS', 'RIVET', 'Pcs', 10000, 10.00, 1000.00, 4.00, 40.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(398, '14.01.00.37', 'JACKET', 'SOFT CASE', 'Pcs', 1200, 12.00, 100.00, 5.14, 61.68, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(399, '14.01.00.36', 'SOFT CASE', 'SOFT CASE', 'Pcs', 192, 12.00, 16.00, 0.24, 46.66, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(400, '14.01.00.01', 'SOFT CASE 1 KG (BYD)', 'SOFT CASE', 'Pcs', 1000, 8.00, 200.00, 0.66, 66.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(401, '14.05.00.01', 'SOFT CASE 0.5 KG', 'SOFT CASE', 'Pcs', 1000, 8.00, 200.00, 0.55, 55.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(402, '14.06.00.01', 'SOFT CASE 0.6 KG', 'SOFT CASE', 'Pcs', 1000, 8.00, 200.00, 0.40, 39.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(403, '14.06.00.02', 'SOFT CASE 0,6 KG (HYUNDAI)', 'SOFT CASE', 'Pcs', 1000, 8.00, 200.00, 0.40, 39.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(404, '14.06.00.03', 'SOFT CASE 0,6 KG (GENESIS)', 'SOFT CASE', 'Pcs', 1000, 8.00, 200.00, 0.40, 39.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(405, '80.00.00.43', 'MANUAL BOOK HPM', 'MANUAL BOOK', 'Pcs', 20000, 10.00, 20.00, 23.00, 230.00, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(406, '80.00.00.46', 'MANUAL BOOK TMMIN', 'MANUAL BOOK', 'Pcs', 19500, 13.00, 1500.00, 13.50, 175.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(407, '80.05.00.46', 'MANUAL BOOK TMMIN 0.5 kg', 'MANUAL BOOK', 'Pcs', 19500, 13.00, 1500.00, 13.50, 175.50, '', '0000-00-00', 'Lorong 2', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(408, '29.25.50.05', 'EVA FOAM 25x50x5mm', 'VELCRO', 'Pcs', 33000, 6.00, 5500.00, 5.72, 34.32, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(409, '29.25.45.05', 'EVA FOAM 25x45x5mm', 'VELCRO', 'Pcs', 33000, 6.00, 5500.00, 5.72, 34.32, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(410, '50.16.00.80', 'VELCRO UK.16X80 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.81, 8.10, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(411, '50.30.00.30', 'VELCRO UK.30X30 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.73, 7.30, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(412, '50.30.00.35', 'VELCRO UK.30X35 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.71, 7.10, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(413, '50.16.00.30', 'VELCRO UK.16X30 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.33, 3.30, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(414, '50.16.00.38', 'VELCRO UK.16X38 MM', 'VELCRO', 'Pcs', 20000, 20.00, 1000.00, 0.40, 8.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(415, '50.16.00.45', 'VELCRO UK.16X45 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.46, 4.60, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(416, '50.16.00.85', 'VELCRO UK.16X85 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 0.87, 8.70, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(417, '50.16.00.13', 'VELCRO UK.16X130 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 1.30, 13.00, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(418, '50.16.00.10', 'VELCRO UK.16X100 MM', 'VELCRO', 'Pcs', 10000, 10.00, 1000.00, 1.02, 10.20, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(419, '50.16.00.63', 'VELCRO UK.16X163 MM', 'VELCRO', 'Pcs', 8000, 8.00, 1000.00, 1.61, 12.88, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(420, '50.16.00.25', 'VELCRO UK.16X25 MM', 'VELCRO', 'Pcs', 20000, 20.00, 1000.00, 0.31, 6.20, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(421, '51.38.16.01', 'PAD EPDM Uk.38x16x1mm', 'VELCRO', 'Pcs', 20000, 20.00, 1000.00, 0.96, 19.20, '', '0000-00-00', 'Lorong 1', 'aktif', '2025-02-19 02:53:29', '2025-02-19 02:53:29'),
(424, '119', 'kak', 'VELCRO', 'Pcs', 20000, 20.00, 1000.00, 0.96, 19.20, NULL, '2020-10-10', 'Lorong 1', 'aktif', '2025-07-16 23:52:26', '2025-07-16 23:52:26'),
(425, '01.00.11.12.3', 'P 100 ABC SA2', 'Barang Jadi', 'Pcs', 100, 100.00, 100.00, 1.00, 1.00, 'contoh ini', '2025-07-16', 'LORONG FG', 'aktif', '2025-07-24 19:32:49', '2025-07-24 19:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `no_dokumen_masuk` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `nama_lorong` varchar(100) NOT NULL,
  `nama_rak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`no_dokumen_masuk`, `tanggal_masuk`, `kode_barang`, `nama_barang`, `jumlah_masuk`, `nama_lorong`, `nama_rak`) VALUES
('0', '0000-00-00', '42.45.30.29', '', 12800, 'LORONG 1', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `sub_rak`
--

CREATE TABLE `sub_rak` (
  `id` int(11) NOT NULL,
  `nama_rak` varchar(50) DEFAULT NULL,
  `kode_sub_rak` varchar(10) DEFAULT NULL,
  `label_full` varchar(100) DEFAULT NULL,
  `kapasitas` int(11) NOT NULL,
  `kapasitas_tersedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_rak`
--

INSERT INTO `sub_rak` (`id`, `nama_rak`, `kode_sub_rak`, `label_full`, `kapasitas`, `kapasitas_tersedia`) VALUES
(2, 'B-C-01-01', '01', 'B-C-01-01-01', 10000, 10000),
(3, 'B-C-01-05', NULL, NULL, 100000, 100000),
(4, 'B-C-01-05', NULL, NULL, 100000, 100000),
(5, 'B-C-01-02', '01', 'B-C-01-02-01', 100000, 100000),
(9, 'B-C-01-02', '01', 'B-C-01-02-01', 100000, 100000),
(10, 'B-C-01-01', '01', 'B-C-01-01-01', 10000, 10000),
(11, 'B-C-01-01', '02', 'B-C-01-01-02', 10000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrator', 'Sasa1234!', '2025-07-06 15:02:18', '2025-07-06 15:02:18'),
(2, 'ryan', 'administrator', '$2y$10$TXlHO6/ZtjSvttuDdOsPnuYQ7bLbeGOmcLUvdCJ6o.ylT54F4diuW', '2025-07-06 08:54:09', '2025-07-06 08:54:09'),
(3, 'operator', 'Operator', 'Sasa1234!', '2025-07-13 06:59:08', '2025-07-13 06:59:08'),
(4, 'onig', 'Operator', '$2y$10$HXppyi6lPSXgi.i4i1gLp.Gxb5q0AThwFU47rGCmSRbYX69LgKdou', '2025-07-13 00:06:24', '2025-07-13 00:06:24'),
(5, 'supervisor', 'supervisor', '$2y$10$o9ODElSL8sfzv6vOLyNyeOWew1E9/diKK54AVfyyNzNAhSIF8YkES', '2025-07-13 00:10:05', '2025-07-13 00:10:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formula`
--
ALTER TABLE `formula`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_formula` (`kode_formula`);

--
-- Indexes for table `formula_detail`
--
ALTER TABLE `formula_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `fk_formula_detail` (`kode_formula`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD UNIQUE KEY `nama_gudang` (`nama_gudang`);

--
-- Indexes for table `lorong`
--
ALTER TABLE `lorong`
  ADD PRIMARY KEY (`id_lorong`),
  ADD UNIQUE KEY `nama_lorong` (`nama_lorong`),
  ADD KEY `nama_gudang` (`nama_gudang`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`),
  ADD UNIQUE KEY `uq_rak_id_rak` (`id_rak`),
  ADD KEY `nama_lorong` (`nama_lorong`);

--
-- Indexes for table `standar_rak_pallet`
--
ALTER TABLE `standar_rak_pallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`no_dokumen_masuk`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `sub_rak`
--
ALTER TABLE `sub_rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `formula`
--
ALTER TABLE `formula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `formula_detail`
--
ALTER TABLE `formula_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lorong`
--
ALTER TABLE `lorong`
  MODIFY `id_lorong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1342;

--
-- AUTO_INCREMENT for table `standar_rak_pallet`
--
ALTER TABLE `standar_rak_pallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `sub_rak`
--
ALTER TABLE `sub_rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formula_detail`
--
ALTER TABLE `formula_detail`
  ADD CONSTRAINT `fk_formula_detail` FOREIGN KEY (`kode_formula`) REFERENCES `formula` (`kode_formula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formula_detail_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);

--
-- Constraints for table `lorong`
--
ALTER TABLE `lorong`
  ADD CONSTRAINT `lorong_ibfk_1` FOREIGN KEY (`nama_gudang`) REFERENCES `gudang` (`nama_gudang`);

--
-- Constraints for table `rak`
--
ALTER TABLE `rak`
  ADD CONSTRAINT `rak_ibfk_1` FOREIGN KEY (`nama_lorong`) REFERENCES `lorong` (`nama_lorong`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
