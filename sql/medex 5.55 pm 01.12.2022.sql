-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2022 at 08:29 AM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medex`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
DROP Database `medex`;
CREATE Database `medex`;
USE `medex`;
--


DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery`
(
    `reqId`      varchar(50) NOT NULL,
    `deliveryId` varchar(50) NOT NULL,
    `acceptDate` timestamp   NOT NULL,
    PRIMARY KEY (`reqId`, `deliveryId`),
    KEY `deliveryId` (`deliveryId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`reqId`, `deliveryId`, `acceptDate`)
VALUES ('delReq0001', 'D0002', '2022-11-01 09:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `deliverypartner`
--

DROP TABLE IF EXISTS `deliverypartner`;
CREATE TABLE IF NOT EXISTS `deliverypartner`
(
    `id`                varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `username`          varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `password`          varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `name`              varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `license_id`        varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `driverLicenseName` varchar(100)                                                  NOT NULL,
    `vehicle_no`        varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `vehicle_type`      varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `delivery_location` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `max_load`          int                                                           NOT NULL,
    `reg_date`          date                                                          NOT NULL,
    `refrigerators`     varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `license_id` (`license_id`, `driverLicenseName`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deliverypartner`
--

INSERT INTO `deliverypartner` (`id`, `username`, `password`, `name`, `license_id`, `driverLicenseName`, `vehicle_no`,
                               `vehicle_type`, `delivery_location`, `max_load`, `reg_date`, `refrigerators`)
VALUES ('35152399', 'testDelivery', '$2y$10$AMYRUaq6zsZNK.I26LlbM.JvbKSr3t0ByEsA1g.tqvejcUQ1uw4Uu', 'Test Delivery',
        'TestID', 'TestLicense', 'askdhgk', 'TestVehicle', 'TestCity', 4, '2022-12-01', 'on'),
       ('D0001', 'Amal', 'Amal@123', 'Amal Delivery', 'CE573951', 'license01', 'QL-9002', 'Lorry', 'Galle', 12000,
        '2022-09-06', '1'),
       ('D0002', 'ImpEx', 'ImpEx@123', 'ImpEx Deliveries', 'CE565680', 'license02', 'QV-2213', 'Lorry', 'Colombo',
        10000, '2022-04-23', '0');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryreq`
--

DROP TABLE IF EXISTS `deliveryreq`;
CREATE TABLE IF NOT EXISTS `deliveryreq`
(
    `id`         varchar(50)  NOT NULL,
    `location`   varchar(100) NOT NULL,
    `pharmacyId` varchar(50)  NOT NULL,
    `orderId`    varchar(50)  NOT NULL,
    `status`     tinyint(1)   NOT NULL,
    PRIMARY KEY (`id`),
    KEY `pharmacyId` (`pharmacyId`),
    KEY `orderId` (`orderId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deliveryreq`
--

INSERT INTO `deliveryreq` (`id`, `location`, `pharmacyId`, `orderId`, `status`)
VALUES ('delReq0001', 'Morotuwa', 'P0001', 'order0001', 0),
       ('delReq0002', 'Ampara', 'P0002', 'order0002', 0),
       ('delReq0003', 'Galle', 'P0003', 'order0002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_partner_contact`
--

DROP TABLE IF EXISTS `delivery_partner_contact`;
CREATE TABLE IF NOT EXISTS `delivery_partner_contact`
(
    `id`      varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `email`   varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `mobile`  varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    PRIMARY KEY (`id`, `email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `delivery_partner_contact`
--

INSERT INTO `delivery_partner_contact` (`id`, `email`, `address`, `mobile`)
VALUES ('D0001', 'amal@gmail.com', 'No.01, Dodangoda Rd, Rajgama', '0112877770'),
       ('D0002', 'info@impex.lk', 'No/277, Rajamahavihara Rd, Mirihana, Kotte', '0112573691');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee`
(
    `id`        varchar(50)                                                   NOT NULL,
    `username`  varchar(50)                                                   NOT NULL,
    `password`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `fName`     varchar(100)                                                  NOT NULL,
    `lName`     varchar(100)                                                  NOT NULL,
    `age`       int                                                           NOT NULL,
    `managerId` varchar(50) DEFAULT NULL,
    `NIC`       varchar(12)                                                   NOT NULL,
    `regDate`   date                                                          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    KEY `managerId` (`managerId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `password`, `fName`, `lName`, `age`, `managerId`, `NIC`, `regDate`)
VALUES ('35152399', 'testEmployee', '$2y$10$JDu9IM4c6gFv044Ds37nIu0OdzefXsY2UECV1KWVF1j1auGSA3k5u', 'Test', 'Employee',
        20, NULL, '200101802072', '2022-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_contact`
--

DROP TABLE IF EXISTS `employee_contact`;
CREATE TABLE IF NOT EXISTS `employee_contact`
(
    `id`      varchar(50)  NOT NULL,
    `email`   varchar(50)  NOT NULL,
    `address` varchar(200) NOT NULL,
    `mobile`  varchar(10)  NOT NULL,
    PRIMARY KEY (`id`, `email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

DROP TABLE IF EXISTS `laboratory`;
CREATE TABLE IF NOT EXISTS `laboratory`
(
    `id`                        varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `username`                  varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `password`                  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `laboratory_name`           varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `business_registration_id`  varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `laboratory_certificate_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `BusinessRegCertName`       varchar(100)                                                  NOT NULL,
    `LabCertName`               varchar(100)                                                  NOT NULL,
    `reg_date`                  date                                                          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `business_registration_id` (`business_registration_id`, `laboratory_certificate_id`,
                                           `BusinessRegCertName`, `LabCertName`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `username`, `password`, `laboratory_name`, `business_registration_id`,
                          `laboratory_certificate_id`, `BusinessRegCertName`, `LabCertName`, `reg_date`)
VALUES ('18967713343', 'testLab', '$2y$10$hBQMN1qjUKRDD1PbawLb.uf75uAuFDc97bL4Hx4EEjaay3tJi.ARi', 'testLabName',
        'testBRID', 'testLCID', 'testBRN', 'testLCN', '2022-12-01'),
       ('L0001', 'Biovest', 'biovest@2000', 'Biovest', '154644', 'Lab01', 'business06', 'Lab01', '2022-04-01'),
       ('L0002', 'CFC Health', 'Cfc@12', 'CFC Healthcare', '164653', 'Lab02', 'business07', 'lab02', '2022-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_contact`
--

DROP TABLE IF EXISTS `laboratory_contact`;
CREATE TABLE IF NOT EXISTS `laboratory_contact`
(
    `id`      varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `email`   varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `mobile`  varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci  NOT NULL,
    PRIMARY KEY (`id`, `email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laboratory_contact`
--

INSERT INTO `laboratory_contact` (`id`, `email`, `address`, `mobile`)
VALUES ('L0001', 'info@biovest.com', 'No/14/2, Hedges Court', '0112446774'),
       ('L0002', 'info@cfchealth.lk', 'No/730, Malabe Rd, Arangala', '0112846804');

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

DROP TABLE IF EXISTS `labreport`;
CREATE TABLE IF NOT EXISTS `labreport`
(
    `reqId`    varchar(50)  NOT NULL,
    `labId`    varchar(50)  NOT NULL,
    `comment`  varchar(200) NOT NULL,
    `verified` tinyint(1)   NOT NULL,
    PRIMARY KEY (`reqId`, `labId`),
    KEY `labId` (`labId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`reqId`, `labId`, `comment`, `verified`)
VALUES ('Req001', 'L0001', 'Test Passed', 1),
       ('Req002', 'L0001', 'Test Passed', 1),
       ('Req003', 'L0002', 'Test Passed', 1),
       ('Req004', 'L0001', 'Pass', 1);

-- --------------------------------------------------------

--
-- Table structure for table `labreq`
--

DROP TABLE IF EXISTS `labreq`;
CREATE TABLE IF NOT EXISTS `labreq`
(
    `id`          varchar(50) NOT NULL,
    `medId`       varchar(50) NOT NULL,
    `SupId`       varchar(50) NOT NULL,
    `recivedDate` date        NOT NULL,
    `status`      tinyint(1)  NOT NULL,
    PRIMARY KEY (`id`),
    KEY `medId` (`medId`),
    KEY `SupId` (`SupId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `labreq`
--

INSERT INTO `labreq` (`id`, `medId`, `SupId`, `recivedDate`, `status`)
VALUES ('Req001', 'Med0001', 'S0001', '2022-09-01', 1),
       ('Req002', 'Med0003', 'S0002', '2022-10-04', 1),
       ('Req003', 'Med0002', 'S0001', '2022-09-06', 1),
       ('Req004', 'Med0002', 'S0002', '2022-10-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

DROP TABLE IF EXISTS `manufacture`;
CREATE TABLE IF NOT EXISTS `manufacture`
(
    `id`   varchar(50)  NOT NULL,
    `name` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`id`, `name`)
VALUES ('M0001', 'Bio Lab'),
       ('M0002', 'Delta Manufactures');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine`
(
    `id`      varchar(50)  NOT NULL,
    `medName` varchar(100) NOT NULL,
    `weight`  int          NOT NULL,
    `sciName` varchar(100) NOT NULL,
    `manId`   varchar(50)  NOT NULL,
    PRIMARY KEY (`id`),
    KEY `manId` (`manId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `medName`, `weight`, `sciName`, `manId`)
VALUES ('Med0001', 'Panadol', 500, 'Paracetamol', 'M0001'),
       ('Med0002', 'Tylenol', 500, 'Paracetamol', 'M0001'),
       ('Med0003', 'Vamol', 650, 'Paracetamol', 'M0002'),
       ('Med0004', 'Piriton', 4, 'Chlorphenamine', 'M0001'),
       ('Med0005', 'Piriton', 4, 'Chlorphenamine', 'M0002'),
       ('Med0006', 'Allerief', 10, 'Chlorphenamine', 'M0001');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

DROP TABLE IF EXISTS `pharmacy`;
CREATE TABLE IF NOT EXISTS `pharmacy`
(
    `id`                  varchar(50)                                                   NOT NULL,
    `username`            varchar(50)                                                   NOT NULL,
    `password`            varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `name`                varchar(200)                                                  NOT NULL,
    `ownerName`           varchar(200)                                                  NOT NULL,
    `city`                varchar(100)                                                  NOT NULL,
    `pharmacyRegNo`       varchar(100)                                                  NOT NULL,
    `BusinessRegId`       varchar(100)                                                  NOT NULL,
    `pharmacyCertId`      varchar(100)                                                  NOT NULL,
    `BusinessRegCertName` varchar(100)                                                  NOT NULL,
    `pharmacyCertName`    varchar(100)                                                  NOT NULL,
    `verified`            tinyint(1)                                                    NOT NULL,
    `deliveryTime`        time                                                          NOT NULL,
    `regDate`             date                                                          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `pharmacyRegNo` (`pharmacyRegNo`, `BusinessRegId`, `pharmacyCertId`, `BusinessRegCertName`,
                                `pharmacyCertName`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `username`, `password`, `name`, `ownerName`, `city`, `pharmacyRegNo`, `BusinessRegId`,
                        `pharmacyCertId`, `BusinessRegCertName`, `pharmacyCertName`, `verified`, `deliveryTime`,
                        `regDate`)
VALUES ('87965', 'testPharmacy', '$2y$10$bMhqBw0qrsWcY/h7dr5PeOCghzSSclYrSARv25rd8KKn4X9ExQgMK', 'Test PharmacyName',
        'Test OwnName', 'Galle', '123456', '123456', '1234546', 'TestBRN', 'TestCN', 0, '10:00:00', '2022-12-01'),
       ('P0001', 'evolve', 'evolve@123', 'Evolve Health', 'Adesh Perera', 'Moratuwa', '17128/A1', '25615', 'PC001',
        'business01', 'pharmacy01', 1, '10:00:00', '0000-00-00'),
       ('P0002', 'biopharm', 'bio_123', 'Bio pharmacy', 'S Priyantha', 'Ampara', '12328/A1', '51390', 'PC002',
        'business02', 'pharmacy02', 1, '09:00:00', '0000-00-00'),
       ('P0003', 'lifecare', 'lifecare@222', 'Life Care pharmacy', 'D P I Jayaruwan', 'Galle', '12628/B1', '73533',
        'PC003', 'business03', 'pharmacy02', 1, '13:30:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacyorder`
--

DROP TABLE IF EXISTS pharmacy_order;
CREATE TABLE IF NOT EXISTS `pharmacyorder`
(
    `id`         varchar(50) NOT NULL,
    `pharmacyId` varchar(50) NOT NULL,
    `medId`      varchar(50) NOT NULL,
    `quantity`   int         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `pharmacyId` (`pharmacyId`),
    KEY `pharmacyOrder_ibfk_2` (`medId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pharmacyorder`
--

INSERT INTO pharmacy_order (`id`, `pharmacyId`, `medId`, `quantity`)
VALUES ('order0001', 'P0001', 'Med0001', 500),
       ('order0002', 'P0002', 'Med0002', 4000),
       ('order0003', 'P0003', 'Med0002', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_contact`
--

DROP TABLE IF EXISTS `pharmacy_contact`;
CREATE TABLE IF NOT EXISTS `pharmacy_contact`
(
    `id`      varchar(50)  NOT NULL,
    `email`   varchar(50)  NOT NULL,
    `address` varchar(200) NOT NULL,
    `mobile`  varchar(10)  NOT NULL,
    PRIMARY KEY (`id`, `email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pharmacy_contact`
--

INSERT INTO `pharmacy_contact` (`id`, `email`, `address`, `mobile`)
VALUES ('P0001', 'info@evolve.com', '284 Campus Road, Moratuwa 00100', '0112320667'),
       ('P0002', 'admin@biopharmacy.com', 'No.86, Main Street, Akkaraipattu', '0112445605'),
       ('P0003', 'info@lifecare.com', 'No.38/2, Godaduwa Rd, Kapuhempala, Akmeemana', '0112588476');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock`
(
    `id`           varchar(50) NOT NULL,
    `medId`        varchar(50) NOT NULL,
    `pharmacyId`   varchar(50) NOT NULL,
    `receivedDate` date        NOT NULL,
    `remQty`       int         NOT NULL,
    `sellingPrice` int         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `medId` (`medId`),
    KEY `pharmacyId` (`pharmacyId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier`
(
    `id`                  varchar(50)                                                   NOT NULL,
    `username`            varchar(50)                                                   NOT NULL,
    `password`            varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `name`                varchar(200)                                                  NOT NULL,
    `supplierRegNo`       varchar(100)                                                  NOT NULL,
    `BusinessRegId`       varchar(100)                                                  NOT NULL,
    `supplierCertId`      varchar(100)                                                  NOT NULL,
    `BusinessRegCertName` varchar(100)                                                  NOT NULL,
    `supplierCertName`    varchar(100)                                                  NOT NULL,
    `verified`            tinyint(1)                                                    NOT NULL,
    `regDate`             date                                                          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`),
    UNIQUE KEY `supplierRegNo` (`supplierRegNo`, `BusinessRegId`, `supplierCertId`, `BusinessRegCertName`,
                                `supplierCertName`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `username`, `password`, `name`, `supplierRegNo`, `BusinessRegId`, `supplierCertId`,
                        `BusinessRegCertName`, `supplierCertName`, `verified`, `regDate`)
VALUES ('456123', 'testSupplier', '$2y$10$e1he4sBtR3A0l6n748.BTuIY3NCumke.CzPcdKxGeObke..88LvrK', 'Test SupplierName',
        'TestRNO', 'TestBRID', 'TestSCID', 'TestBRN', 'TestSCN', 0, '2022-12-01'),
       ('S0001', 'alphainfi', 'alpha@123', 'Alpha Infinity', '12128/D2', '30981', 'SC001', 'business04', 'supplier01',
        1, '2022-07-01'),
       ('S0002', 'asiahealth', 'Asiahealth@123', 'Asia Heath', '13328/D2', '29515', 'SC002', 'business05', 'supplier02',
        1, '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact`
--

DROP TABLE IF EXISTS `supplier_contact`;
CREATE TABLE IF NOT EXISTS `supplier_contact`
(
    `id`      varchar(50)  NOT NULL,
    `email`   varchar(50)  NOT NULL,
    `address` varchar(200) NOT NULL,
    `mobile`  varchar(10)  NOT NULL,
    PRIMARY KEY (`id`, `email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier_contact`
--

INSERT INTO `supplier_contact` (`id`, `email`, `address`, `mobile`)
VALUES ('S0001', 'admin@asiahealth.com', 'No 7, Chithra Lane', '0112485391'),
       ('S0001', 'info@alpha.com', 'No/89, Old Kottawa Rd, Nawinna, Maharagama', '0112583392');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_medicine`
--

DROP TABLE IF EXISTS `supplier_medicine`;
CREATE TABLE IF NOT EXISTS `supplier_medicine`
(
    `supId`     varchar(50) NOT NULL,
    `medId`     varchar(50) NOT NULL,
    `verified`  tinyint(1)  NOT NULL,
    `quantity`  int         NOT NULL,
    `unitPrice` int         NOT NULL,
    PRIMARY KEY (`supId`, `medId`),
    KEY `medId` (`medId`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier_medicine`
--

INSERT INTO `supplier_medicine` (`supId`, `medId`, `verified`, `quantity`, `unitPrice`)
VALUES ('S0001', 'Med0001', 1, 250000, 10),
       ('S0001', 'Med0002', 1, 100000, 10),
       ('S0002', 'Med0002', 1, 20000, 12),
       ('S0002', 'Med0003', 1, 100000, 20);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
    ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`reqId`) REFERENCES `deliveryreq` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`deliveryId`) REFERENCES `deliverypartner` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `deliveryreq`
--
ALTER TABLE `deliveryreq`
    ADD CONSTRAINT `deliveryReq_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES pharmacy_order (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `delivery_partner_contact`
--
ALTER TABLE `delivery_partner_contact`
    ADD CONSTRAINT `delivery_partner_contact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `deliverypartner` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
    ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`managerId`) REFERENCES `employee` (`id`);

--
-- Constraints for table `employee_contact`
--
ALTER TABLE `employee_contact`
    ADD CONSTRAINT `employee_contact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `laboratory_contact`
--
ALTER TABLE `laboratory_contact`
    ADD CONSTRAINT `Laboratory_contact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `laboratory` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `labreport`
--
ALTER TABLE `labreport`
    ADD CONSTRAINT `labReport_ibfk_1` FOREIGN KEY (`reqId`) REFERENCES `labreq` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `labReport_ibfk_2` FOREIGN KEY (`labId`) REFERENCES `laboratory` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `labreq`
--
ALTER TABLE `labreq`
    ADD CONSTRAINT `labReq_ibfk_1` FOREIGN KEY (`medId`) REFERENCES `medicine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `labReq_ibfk_2` FOREIGN KEY (`SupId`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
    ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`manId`) REFERENCES `manufacture` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pharmacyorder`
--
ALTER TABLE pharmacy_order
    ADD CONSTRAINT `pharmacyOrder_ibfk_1` FOREIGN KEY (`pharmacyId`) REFERENCES `pharmacy` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `pharmacyOrder_ibfk_2` FOREIGN KEY (`medId`) REFERENCES `supplier_medicine` (`medId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pharmacy_contact`
--
ALTER TABLE `pharmacy_contact`
    ADD CONSTRAINT `pharmacy_contact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pharmacy` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
    ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`medId`) REFERENCES `medicine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`pharmacyId`) REFERENCES `pharmacy` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
    ADD CONSTRAINT `supplier_contact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `supplier_medicine`
--
ALTER TABLE `supplier_medicine`
    ADD CONSTRAINT `supplier_medicine_ibfk_1` FOREIGN KEY (`medId`) REFERENCES `medicine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `supplier_medicine_ibfk_2` FOREIGN KEY (`supId`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
