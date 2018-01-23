-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-01-19 07:03:24
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hongruan`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrators`
--

CREATE TABLE `administrators` (
  `AdministratorsID` int(255) UNSIGNED NOT NULL COMMENT '管理员ID',
  `UserName` varchar(15) NOT NULL COMMENT '用户名',
  `Password` varchar(20) NOT NULL COMMENT '密码',
  `Administratorsface` varchar(15) NOT NULL COMMENT '管理员面部信息',
  `Logintime` varchar(15) NOT NULL COMMENT '登录时间',
  `HeadPortrait` varchar(20) NOT NULL COMMENT '头像',
  `PhoneNumber` bigint(20) NOT NULL COMMENT '手机号',
  `Jointime` varchar(15) NOT NULL COMMENT '录入时间',
  `SecurityPermissions` int(255) NOT NULL COMMENT '安全权限'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `companies`
--

CREATE TABLE `companies` (
  `ID` int(255) UNSIGNED NOT NULL COMMENT 'ID',
  `JoinTime` varchar(15) NOT NULL COMMENT '录入时间',
  `MembersNumber` varchar(15) NOT NULL COMMENT '公司规模',
  `Document` varchar(15) NOT NULL COMMENT '公司证件',
  `Members` varchar(15) NOT NULL COMMENT '公司人员',
  `Advantage` varchar(15) NOT NULL COMMENT '擅长方向',
  `CreditRating` int(15) NOT NULL COMMENT '信誉等级',
  `TotalWorkTime` varchar(15) NOT NULL COMMENT '员工总工时',
  `BankCardNumber` varchar(30) NOT NULL COMMENT '公司对公银行卡'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `contractor`
--

CREATE TABLE `contractor` (
  `ContractorID` int(255) UNSIGNED NOT NULL COMMENT '发包人员ID',
  `UserName` varchar(15) NOT NULL COMMENT '姓名',
  `Password` varchar(20) NOT NULL COMMENT '密码',
  `Gender` varchar(15) NOT NULL COMMENT '性别',
  `Birthday` varchar(15) NOT NULL COMMENT '出生日期',
  `Idcard` varchar(15) NOT NULL COMMENT '身份证号',
  `Nation` varchar(15) NOT NULL COMMENT '民族',
  `Height` varchar(15) NOT NULL COMMENT '身高',
  `MaritalStatus` varchar(15) NOT NULL COMMENT '婚姻状况',
  `PhoneNumber` bigint(20) NOT NULL COMMENT '手机号码',
  `EmergencyContactName` varchar(15) NOT NULL COMMENT '紧急联系人姓名',
  `EmergencyContactPhone` varchar(20) NOT NULL COMMENT '紧急联系人电话',
  `BankCardNumber` varchar(30) NOT NULL COMMENT '银行卡号',
  `FaceInformation` varchar(15) NOT NULL COMMENT '脸部信息录入',
  `Logintime` varchar(15) NOT NULL COMMENT '上次登录时间',
  `Jointime` varchar(15) NOT NULL COMMENT '录入时间',
  `FaceInform` varchar(15) NOT NULL COMMENT '登录时录入的面部信息',
  `WorkTime` varchar(15) NOT NULL COMMENT '工作时长',
  `SecurityPermissions` varchar(15) NOT NULL COMMENT '安全权限'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE `project` (
  `ID` int(255) UNSIGNED NOT NULL COMMENT 'ID',
  `Contractor` varchar(15) NOT NULL COMMENT '发包人员',
  `Starttime` varchar(15) NOT NULL COMMENT '发包时间',
  `ConfidentialityAgreement` varchar(15) NOT NULL COMMENT '保密协议',
  `SafetyGrade` varchar(15) NOT NULL COMMENT '安全等级',
  `ProjectName` varchar(15) NOT NULL COMMENT '项目名称',
  `Class` varchar(15) NOT NULL COMMENT '项目类型',
  `ProjectStarttime` varchar(15) NOT NULL COMMENT '项目起始时间',
  `ProjectEndtime` varchar(15) NOT NULL COMMENT '项目截止时间',
  `UserID` varchar(15) NOT NULL COMMENT '接包人员',
  `Plan` varchar(15) NOT NULL COMMENT '实施计划',
  `Resources` varchar(15) NOT NULL COMMENT '项目资源',
  `State` varchar(15) NOT NULL COMMENT '任务状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

CREATE TABLE `resource` (
  `ID` int(255) UNSIGNED NOT NULL COMMENT 'ID',
  `Founder` varchar(15) NOT NULL COMMENT '创建人',
  `CreationDate` text NOT NULL COMMENT '创建日期',
  `ModifiedDate` varchar(15) NOT NULL COMMENT '修改时间',
  `Editor` varchar(15) NOT NULL COMMENT '修改人',
  `SafetyGrade` int(15) NOT NULL COMMENT '安全等级',
  `LocalAddress` varchar(15) NOT NULL COMMENT '地址',
  `ChildID` varchar(15) NOT NULL COMMENT '子资源ID',
  `Type` varchar(15) NOT NULL COMMENT '资源类型'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `UserID` int(255) UNSIGNED NOT NULL COMMENT '接包人员ID',
  `UserName` varchar(15) NOT NULL COMMENT '姓名',
  `Password` varchar(20) NOT NULL COMMENT '密码',
  `Gender` varchar(15) NOT NULL COMMENT '性别',
  `Birthday` varchar(15) NOT NULL COMMENT '出生日期',
  `Idcard` varchar(30) NOT NULL COMMENT '身份证号',
  `Nation` varchar(15) NOT NULL COMMENT '民族',
  `Height` varchar(15) NOT NULL COMMENT '身高',
  `MaritalStatus` varchar(15) NOT NULL COMMENT '婚姻状况',
  `PhoneNumber` bigint(20) NOT NULL COMMENT '手机号码',
  `EmergencyContactName` varchar(15) NOT NULL COMMENT '紧急联系人姓名',
  `EmergencyContactPhone` varchar(20) NOT NULL COMMENT '紧急联系人电话',
  `BankCardNumber` varchar(30) NOT NULL COMMENT '银行卡号',
  `FaceInformation` varchar(15) NOT NULL COMMENT '脸部信息录入',
  `Logintime` varchar(15) NOT NULL COMMENT '上次登录时间',
  `Company` varchar(15) NOT NULL COMMENT '所在公司',
  `Advantage` varchar(15) NOT NULL COMMENT '擅长方向',
  `Jointime` varchar(15) NOT NULL COMMENT '录入时间',
  `FaceInform` varchar(15) NOT NULL COMMENT '登录时录入的面部信息',
  `WorkTime` varchar(15) NOT NULL COMMENT '工作时长',
  `SecurityPermissions` int(15) NOT NULL COMMENT '安全权限',
  `CreditRating` int(15) NOT NULL COMMENT '信誉等级'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`AdministratorsID`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contractor`
--
ALTER TABLE `contractor`
  ADD PRIMARY KEY (`ContractorID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `administrators`
--
ALTER TABLE `administrators`
  MODIFY `AdministratorsID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员ID';
--
-- 使用表AUTO_INCREMENT `companies`
--
ALTER TABLE `companies`
  MODIFY `ID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `contractor`
--
ALTER TABLE `contractor`
  MODIFY `ContractorID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '发包人员ID';
--
-- 使用表AUTO_INCREMENT `project`
--
ALTER TABLE `project`
  MODIFY `ID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `resource`
--
ALTER TABLE `resource`
  MODIFY `ID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '接包人员ID';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
