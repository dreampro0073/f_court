<?php

//Dipanshu 23 May 2023

CREATE TABLE `f_court`.`banks` ( `id` INT NOT NULL AUTO_INCREMENT , `bank_name` VARCHAR(255) NULL DEFAULT NULL , `department_branch` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT into banks (`bank_name`) VALUES ('State Bank of India');
INSERT into banks (`bank_name`) VALUES ('Bank of Baroda');
INSERT into banks (`bank_name`) VALUES ('Bank of India');
INSERT into banks (`bank_name`) VALUES ('Bank of Maharashtra');
INSERT into banks (`bank_name`) VALUES ('Canara Bank');
INSERT into banks (`bank_name`) VALUES ('Central Bank of India');
INSERT into banks (`bank_name`) VALUES ('Indian Bank');
INSERT into banks (`bank_name`) VALUES ('Indian Overseas Bank');
INSERT into banks (`bank_name`) VALUES ('Punjab and Sind Bank');
INSERT into banks (`bank_name`) VALUES ('Punjab National Bank');
INSERT into banks (`bank_name`) VALUES ('UCO Bank');
INSERT into banks (`bank_name`) VALUES ('Union Bank of India');
INSERT into banks (`bank_name`) VALUES ('Axis Bank');
INSERT into banks (`bank_name`) VALUES ('Bandhan Bank');
INSERT into banks (`bank_name`) VALUES ('CSB Bank');
INSERT into banks (`bank_name`) VALUES ('City Union Bank');
INSERT into banks (`bank_name`) VALUES ('DCB Bank');
INSERT into banks (`bank_name`) VALUES ('Dhanlaxmi Bank');
INSERT into banks (`bank_name`) VALUES ('Federal Bank');
INSERT into banks (`bank_name`) VALUES ('HDFC Bank');
INSERT into banks (`bank_name`) VALUES ('ICICI Bank');
INSERT into banks (`bank_name`) VALUES ('IDBI Bank');
INSERT into banks (`bank_name`) VALUES ('IDFC First Bank');
INSERT into banks (`bank_name`) VALUES ('IndusInd Bank');
INSERT into banks (`bank_name`) VALUES ('Jammu & Kashmir Bank');
INSERT into banks (`bank_name`) VALUES ('Karnataka Bank');
INSERT into banks (`bank_name`) VALUES ('Karur Vysya Bank');
INSERT into banks (`bank_name`) VALUES ('Kotak Mahindra Bank');
INSERT into banks (`bank_name`) VALUES ('Nainital Bank');
INSERT into banks (`bank_name`) VALUES ('RBL Bank');
INSERT into banks (`bank_name`) VALUES ('South Indian Bank');
INSERT into banks (`bank_name`) VALUES ('Tamilnad Mercantile Bank');
INSERT into banks (`bank_name`) VALUES ('Yes Bank');
INSERT into banks (`bank_name`) VALUES ('Jana Bank');
INSERT into banks (`bank_name`) VALUES ('Zila Sahkari Bank');
INSERT into banks (`bank_name`) VALUES ('Uttarakhand Grameen Bank');
INSERT into banks (`bank_name`) VALUES ('Prathama U.P. Grameen Bank');
INSERT into banks (`bank_name`) VALUES ('SIDBI Bank');
INSERT into banks (`bank_name`) VALUES ('IBFC First Bank');
INSERT into banks (`bank_name`) VALUES ('Kurmanchal Nagar Sahkari Bank');
INSERT into banks (`bank_name`) VALUES ('Ujjivan Small Finance Bank');
INSERT into banks (`bank_name`) VALUES ('Utkarsh  Small Finance Bank');

CREATE TABLE `f_court`.`companies` ( `id` INT NOT NULL AUTO_INCREMENT , `company_name` VARCHAR(255) NULL DEFAULT NULL , `department_branch` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO companies (`company_name`) VALUES ('Muthoot Finance Ltd');
INSERT INTO companies (`company_name`) VALUES ('LIC Housing Finance Ltd');
INSERT INTO companies (`company_name`) VALUES ('Shriram City Union Finance');
INSERT INTO companies (`company_name`) VALUES ('HDFC Home Loans');
INSERT INTO companies (`company_name`) VALUES ('HDB Financial Services Ltd');
INSERT INTO companies (`company_name`) VALUES ('L&T Finance Ltd');
INSERT INTO companies (`company_name`) VALUES ('Poonawalla Fincorp Ltd');
INSERT INTO companies (`company_name`) VALUES ('P N B Housing Finance LTD');
INSERT INTO companies (`company_name`) VALUES ('Aavas Financiers Ltd');
INSERT INTO companies (`company_name`) VALUES ('LIC Housing Finance Ltd');
INSERT INTO companies (`company_name`) VALUES ('Fullerton INDIA Credit Company Ltd');
INSERT INTO companies (`company_name`) VALUES ('Mahindra & Mahindra Financial Services Ltd');
INSERT INTO companies (`company_name`) VALUES ('Tata Capital Housing Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Indian Bulls');
INSERT INTO companies (`company_name`) VALUES ('Mahindra Finance');
INSERT INTO companies (`company_name`) VALUES ('Bajaj Finserv Limited');
INSERT INTO companies (`company_name`) VALUES ('Electronica Finance (EFL)');
INSERT INTO companies (`company_name`) VALUES ('DMI Housing Finance');
INSERT INTO companies (`company_name`) VALUES ('Fullerton Grahshakti');
INSERT INTO companies (`company_name`) VALUES ('Wonder Home Finance');
INSERT INTO companies (`company_name`) VALUES ('Ummeed Housing Finance Pvt. Ltd.');
INSERT INTO companies (`company_name`) VALUES ('SBFC Finance');
INSERT INTO companies (`company_name`) VALUES ('Aviom Housing Finance');
INSERT INTO companies (`company_name`) VALUES ('CSL Finance');
INSERT INTO companies (`company_name`) VALUES ('Finova Capital Financing');
INSERT INTO companies (`company_name`) VALUES ('Aavas Financiers');
INSERT INTO companies (`company_name`) VALUES ('Save Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Aditya Birla Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Aditya Birla Housing Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Aditya Birla Finance Limited (SEG)');
INSERT INTO companies (`company_name`) VALUES ('Centrum Housing Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Home First Finance Company India Ltd.');
INSERT INTO companies (`company_name`) VALUES ('ICICI HFC Limited.');
INSERT INTO companies (`company_name`) VALUES ('M/s. Protium Finance Ltd.');
INSERT INTO companies (`company_name`) VALUES ('Shubham Housing Finance Limited');
INSERT INTO companies (`company_name`) VALUES ('Varthana Finance Pvt. Ltd.');
INSERT INTO companies (`company_name`) VALUES ('VASTU HOUSING FINANCE CORPORATION LTD');
INSERT INTO companies (`company_name`) VALUES ('General NEC');
INSERT INTO companies (`company_name`) VALUES ('Indian Oil Corporation');
INSERT INTO companies (`company_name`) VALUES ('Bharat Petroleum');


CREATE TABLE `f_court`.`districts` ( `id` INT NOT NULL AUTO_INCREMENT , `state_id` INT NOT NULL DEFAULT '0' , `district_name` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `f_court`.`tehsil` ( `id` INT NOT NULL AUTO_INCREMENT , `district_id` INT NOT NULL DEFAULT '0' , `tehsil_name` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `f_court`.`villages` ( `id` INT NOT NULL AUTO_INCREMENT , `thesil_id` INT NOT NULL DEFAULT '0' , `village_name` VARCHAR(255) NULL DEFAULT NULL , `pargana` VARCHAR(255) NULL DEFAULT NULL , `status` INT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;



INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ajitpur Ahatamal','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ajitpur Mustahkam','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Atmalpur Bongla','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Alawalpur','Roorkee');
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Alipur Ibrahimpur','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ahamedpur Kadachh (within limits of Nagar Nigam)','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ahamedpur Kadachh (out limits of Nagar Nigam)','Jwalapur'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ahmadpur Grunt','Jwalapur');
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Ahmadpur Chidiya','Nazibabad');
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Aaneki Hettampur','Roorkee'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Aasafnagar Grunt','Roorkee'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Aurangabad','Roorkee'); 
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Kalanjna Jadid','Jwalapur');
INSERT INTO villages (`village_name`,`pargana`) VALUES ('Kalubans','Roorkee'); 


INSERT INTO tehsil (`tehsil_name`) VALUES ('Haridwar');
INSERT INTO tehsil (`tehsil_name`) VALUES ('Roorkee');
INSERT INTO tehsil (`tehsil_name`) VALUES ('Bhagwanpur');
INSERT INTO tehsil (`tehsil_name`) VALUES ('Laksar');
INSERT INTO tehsil (`tehsil_name`) VALUES ('Rishikesh');


CREATE TABLE `f_court`.`year_search` ( `id` INT NOT NULL AUTO_INCREMENT , `ys_name` VARCHAR(255) NULL DEFAULT NULL , `status` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;



CREATE TABLE `f_court`.`drafting_types` ( `id` INT NOT NULL AUTO_INCREMENT , `draft_type` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO drafting_types (`draft_type`) VALUES ('Sale Deed');
INSERT INTO drafting_types (`draft_type`) VALUES ('Memorandum');
INSERT INTO drafting_types (`draft_type`) VALUES ('Family Settlement');
INSERT INTO drafting_types (`draft_type`) VALUES ('Court Case Compromise');
INSERT INTO drafting_types (`draft_type`) VALUES ('Gift Deed');
INSERT INTO drafting_types (`draft_type`) VALUES ('Lease Deed');
INSERT INTO drafting_types (`draft_type`) VALUES ('Supplementary Deed');
INSERT INTO drafting_types (`draft_type`) VALUES ('Correction Deed');
INSERT INTO drafting_types (`draft_type`) VALUES ('Exchange Deed');



CREATE TABLE `f_court`.`billing_types` ( `id` INT NOT NULL AUTO_INCREMENT , `bill_type` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO billing_types (`bill_type`) VALUES ('Fully Bill');
INSERT INTO billing_types (`bill_type`) VALUES ('Cash');
INSERT INTO billing_types (`bill_type`) VALUES ('Expenses Cash+ Fee-Bill');
INSERT INTO billing_types (`bill_type`) VALUES ('Other');


CREATE TABLE `f_court`.`through` ( `id` INT NOT NULL AUTO_INCREMENT , `through_type` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO through (`through_type`) VALUES ('Bank');
INSERT INTO through (`through_type`) VALUES ('Party');
INSERT INTO through (`through_type`) VALUES ('New');


CREATE TABLE `f_court`.`notice_types` ( `id` INT NOT NULL AUTO_INCREMENT , `notice_type` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO notice_types (`notice_type`) VALUES ('Legal Notice');
INSERT INTO notice_types (`notice_type`) VALUES ('Reply Notice');
INSERT INTO notice_types (`notice_type`) VALUES ('Reminder Notice');


//1 June 23 Dipanshu


CREATE TABLE `f_court`.`legal_opinion` ( `id` INT NOT NULL AUTO_INCREMENT , `year_search_id` INT NOT NULL DEFAULT '0' , `bank_comp_id` INT NOT NULL DEFAULT '0' , `through_id` INT NOT NULL DEFAULT '0' , `borrower_id` INT NOT NULL , `amount` VARCHAR(255) NULL DEFAULT NULL , `billing_type_id` INT NOT NULL DEFAULT '0' , `contact_no` VARCHAR(255) NOT NULL , `tat` VARCHAR(255) NOT NULL , `status` INT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `f_court`.`lelgal_notices` ( `id` INT NOT NULL AUTO_INCREMENT , `from_id` INT NOT NULL DEFAULT '0' , `to` VARCHAR(255) NULL DEFAULT NULL , `amount_involved` VARCHAR(255) NULL DEFAULT NULL , `time_given` VARCHAR(255) NULL DEFAULT NULL , `next_step` VARCHAR(255) NULL DEFAULT NULL , `billing_type_id` INT NOT NULL DEFAULT '0' , `contact_no` VARCHAR(255) NOT NULL , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `f_court`.`agricultural_finance` ( `id` INT NOT NULL AUTO_INCREMENT , `year_search_id` INT NOT NULL DEFAULT '0' , `bank_comp_id` INT NOT NULL DEFAULT '0' , `through_id` INT NOT NULL DEFAULT '0' , `borrower_name` VARCHAR(255) NULL DEFAULT NULL , `amount` VARCHAR(255) NULL DEFAULT NULL , `billing_type_id` INT NOT NULL DEFAULT '0' , `contact_no` VARCHAR(255) NOT NULL , `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `f_court`.`draftings` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `contact_no` VARCHAR(255) NULL DEFAULT NULL , `drafting_id` INT NOT NULL DEFAULT '0' , `through_id` INT NOT NULL DEFAULT '0' , `billing_type_id` INT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `f_court`.`mutations` ( `id` INT NOT NULL AUTO_INCREMENT , `thesil_id` INT NOT NULL DEFAULT '0' , `name` VARCHAR(255) NULL DEFAULT NULL , `contact_no` VARCHAR(255) NULL DEFAULT NULL , `date_of_apply` DATE NULL DEFAULT NULL , `seller_name` VARCHAR(255) NULL DEFAULT NULL , `purchaser_name` VARCHAR(255) NULL DEFAULT NULL , `village_id` INT NOT NULL DEFAULT '0' , `total_amount` VARCHAR(255) NULL DEFAULT NULL , `document_available` INT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `f_court`.`court_cases` ( `id` INT NOT NULL AUTO_INCREMENT , `bank_comp_id` INT NOT NULL DEFAULT '0' , `case_name_1` TEXT NULL DEFAULT NULL , `case_name_2` TEXT NULL DEFAULT NULL , `case_no_1` VARCHAR(255) NULL DEFAULT NULL , `case_no_2` VARCHAR(255) NULL DEFAULT NULL , `billing_type_id` INT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `f_court`.`daily_attendance` ( `id` INT NOT NULL AUTO_INCREMENT , `date` DATE NOT NULL , `user_id` BIGINT NOT NULL DEFAULT '0' , `attendance` TINYINT NOT NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

// Devendra

RENAME TABLE `f_court`.`lelgal_notices` TO `f_court`.`legal_notices`;

CREATE TABLE `f_court`.`days` ( `id` INT NOT NULL AUTO_INCREMENT , `day` VARCHAR(255) NULL DEFAULT NULL , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `legal_notices` ADD `type` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `agricultural_finance` ADD `type` VARCHAR(255) NULL DEFAULT NULL AFTER `bank_comp_id`;

ALTER TABLE `legal_opinion` CHANGE `borrower_id` `borrower_name` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `temp_bills` CHANGE `payment_type_other` `payment_type_other` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `bill_books` ADD `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `status`, ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `legal_opinion` CHANGE `borrower_id` `borrower_name` INT(11) NOT NULL;

//Devendra 25june23

ALTER TABLE `certified_copy` CHANGE `department` `department` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `certified_copy` CHANGE `docs_received_on_dated` `docs_received_on_dated` DATE NULL DEFAULT NULL;
ALTER TABLE `workstation_mutation` CHANGE `applicant _name` `applicant_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

//28 june 2023

ALTER TABLE `certified_copy` CHANGE `document_date` `document_date` DATE NULL DEFAULT NULL;

// DIpanshu 18th Oct 2023


ALTER TABLE `legal_opinion` CHANGE `contact_no` `contact_no` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `legal_notices` CHANGE `contact_no` `contact_no` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `agricultural_finance` CHANGE `contact_no` `contact_no` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `billing_types` ADD `status` TINYINT NOT NULL AFTER `bill_type`;

ALTER TABLE `billing_types` CHANGE `status` `status` TINYINT(4) NOT NULL DEFAULT '0';
ALTER TABLE `through` ADD `status` TINYINT(1) NOT NULL DEFAULT '0' AFTER `through_type`;

ALTER TABLE `days` ADD `status` TINYINT(1) NOT NULL DEFAULT '0' AFTER `day`;

ALTER TABLE `legal_notices` ADD `advance_fees` VARCHAR(255) NULL DEFAULT NULL AFTER `emi_amount`;

ALTER TABLE `legal_notices` ADD `total_fees` VARCHAR(255) NULL DEFAULT NULL AFTER `advance_fees`;

//Dipanshu Chauhan 26th 



ALTER TABLE `certified_copy` ADD `branch_name` VARCHAR(255) NULL DEFAULT NULL AFTER `bank_comp_id`;