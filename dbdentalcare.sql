/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MariaDB
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : dbdentalcare

 Target Server Type    : MariaDB
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 25/11/2023 12:20:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_appointments
-- ----------------------------
DROP TABLE IF EXISTS `tbl_appointments`;
CREATE TABLE `tbl_appointments`  (
  `AppointmentID` int(11) NOT NULL AUTO_INCREMENT,
  `PatientID` int(11) NULL DEFAULT NULL,
  `DentistLicenseID` int(11) NULL DEFAULT NULL,
  `AppointmentDate` date NULL DEFAULT NULL,
  `AppoinmentTime` time NULL DEFAULT NULL,
  `TreatmentTypeID` int(11) NULL DEFAULT NULL,
  `AssistantID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`AppointmentID`) USING BTREE,
  INDEX `patient`(`PatientID`) USING BTREE,
  INDEX `assistant`(`AssistantID`) USING BTREE,
  INDEX `treatment`(`TreatmentTypeID`) USING BTREE,
  INDEX `dentistlicense`(`DentistLicenseID`) USING BTREE,
  CONSTRAINT `assistant` FOREIGN KEY (`AssistantID`) REFERENCES `tbl_assistant` (`AssistantID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `dentistlicense` FOREIGN KEY (`DentistLicenseID`) REFERENCES `tbl_dentist` (`DentistLicenseID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `patient` FOREIGN KEY (`PatientID`) REFERENCES `tbl_patients` (`PatientID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `treatment` FOREIGN KEY (`TreatmentTypeID`) REFERENCES `tbl_treatmenttypes` (`TreatmentTypeID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_appointments
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_assistant
-- ----------------------------
DROP TABLE IF EXISTS `tbl_assistant`;
CREATE TABLE `tbl_assistant`  (
  `AssistantID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `UserName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`AssistantID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_assistant
-- ----------------------------
INSERT INTO `tbl_assistant` VALUES (8, 'a', 'a', 'a', 'a');

-- ----------------------------
-- Table structure for tbl_dentist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dentist`;
CREATE TABLE `tbl_dentist`  (
  `DentistLicenseID` int(11) NOT NULL AUTO_INCREMENT,
  `DentistName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`DentistLicenseID`) USING BTREE,
  INDEX `DentistName`(`DentistName`) USING BTREE,
  CONSTRAINT `tbl_dentist_ibfk_1` FOREIGN KEY (`DentistLicenseID`) REFERENCES `tbl_prescriptions` (`DentistLicenseID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_dentist
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_gendertypes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gendertypes`;
CREATE TABLE `tbl_gendertypes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_gendertypes
-- ----------------------------
INSERT INTO `tbl_gendertypes` VALUES (1, 'MALE', 'Male');
INSERT INTO `tbl_gendertypes` VALUES (2, 'FEMALE', 'Female');

-- ----------------------------
-- Table structure for tbl_patients
-- ----------------------------
DROP TABLE IF EXISTS `tbl_patients`;
CREATE TABLE `tbl_patients`  (
  `PatientID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ContactNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Gender` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`PatientID`) USING BTREE,
  INDEX `patients_gender`(`Gender`) USING BTREE,
  CONSTRAINT `patients_gender` FOREIGN KEY (`Gender`) REFERENCES `tbl_gendertypes` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_patients
-- ----------------------------
INSERT INTO `tbl_patients` VALUES (1, 'Darlito', 'Cabalse', 'darlito@gmail.com', '09555498285', 1);
INSERT INTO `tbl_patients` VALUES (2, 'Yohan', 'Franco', 'franco@gmail.com', '55553444223', 1);
INSERT INTO `tbl_patients` VALUES (3, 'Klyne', 'Salvan', 'klyne@gmail.com', '12345678998', 1);
INSERT INTO `tbl_patients` VALUES (4, 'Audrey', 'Sabroso', 'drey@gmail.com', '34543453433', 2);

-- ----------------------------
-- Table structure for tbl_prescriptions
-- ----------------------------
DROP TABLE IF EXISTS `tbl_prescriptions`;
CREATE TABLE `tbl_prescriptions`  (
  `MedicineID` int(11) NOT NULL AUTO_INCREMENT,
  `MedicineName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `DentistLicenseID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`MedicineID`) USING BTREE,
  INDEX `DentistLicenseID`(`DentistLicenseID`) USING BTREE,
  CONSTRAINT `tbl_prescriptions_ibfk_1` FOREIGN KEY (`MedicineID`) REFERENCES `tbl_treatmenttypes` (`MedicineID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_prescriptions
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_treatmenttypes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_treatmenttypes`;
CREATE TABLE `tbl_treatmenttypes`  (
  `TreatmentTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `TypeName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Cost` decimal(10, 2) NULL DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `MedicineID` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`TreatmentTypeID`) USING BTREE,
  INDEX `MedicineID`(`MedicineID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_treatmenttypes
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
