DROP TABLE IF EXISTS `receipt`;
DROP TABLE IF EXISTS `norm`;
DROP TABLE IF EXISTS `employee`;
DROP TABLE IF EXISTS `department`;
DROP TABLE IF EXISTS `kinds_of_purchase`;

CREATE TABLE IF NOT EXISTS `kinds_of_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `kinds_of_purchase_active` AS
SELECT * FROM `kinds_of_purchase` WHERE `status` = 1;

INSERT INTO `kinds_of_purchase` (`name`, `description`) VALUES('Канцтовари', 'Витратні канцелярські товари');
INSERT INTO `kinds_of_purchase` (`name`, `description`) VALUES('Кава-Чай', 'Кава, чай, цукор, молоко');
INSERT INTO `kinds_of_purchase` (`name`, `description`) VALUES('Спец.витрати', 'Витрати для спеціальних потреб');

UPDATE `kinds_of_purchase` SET `status` = 1 WHERE `id` = 1;
UPDATE `kinds_of_purchase` SET `status` = 1 WHERE `id` = 2;

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `department_active` AS
SELECT * FROM `department` WHERE `status` = 1;

INSERT INTO `department` (`name`) VALUES('Бухгалтерія');
INSERT INTO `department` (`name`) VALUES('Відділ маркетингу');
INSERT INTO `department` (`name`) VALUES('Служба безпеки');

UPDATE `department` SET `status` = 1 WHERE `id` = 1;
UPDATE `department` SET `status` = 1 WHERE `id` = 2;

CREATE TABLE  IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_employee_department_idx` (`department_id`),
  CONSTRAINT `fk_employee_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `employee_active` AS
SELECT * FROM `employee` WHERE `status` = 1;

CREATE OR REPLACE VIEW `employee_active_info` AS
SELECT 
	`e`.`id` AS `id`,
  `e`.`email` AS `email`, 
  `e`.`first_name` AS `first_name`,
  `e`.`last_name` AS `last_name`,
  `e`.`department_id` AS `department_id`,
  `d`.`name` AS `department_name` 
FROM `employee` AS `e` JOIN `department` AS `d` ON `e`.`department_id` = `d`.`id`
WHERE `e`.`status` = 1 AND `d`.`status` = 1;

INSERT INTO `employee` (`email`, `first_name`, `last_name`, `department_id`) VALUES('a1@example.com', 'Петро', 'Петренко', 1);
INSERT INTO `employee` (`email`, `first_name`, `last_name`, `department_id`) VALUES('b1@example.com', 'Іван', 'Іваненко', 1);
INSERT INTO `employee` (`email`, `first_name`, `last_name`, `department_id`) VALUES('с1@example.com', 'Микола', 'Миколенко', 1);

INSERT INTO `employee` (`email`, `first_name`, `last_name`, `department_id`) VALUES('a2@example.com', 'Сергій', 'Сергійчук', 2);
INSERT INTO `employee` (`email`, `first_name`, `last_name`, `department_id`) VALUES('b2@example.com', 'Назар', 'Назарук', 2);

UPDATE `employee` SET `status` = 1 WHERE `id` = 1;
UPDATE `employee` SET `status` = 1 WHERE `id` = 2;

UPDATE `employee` SET `status` = 1 WHERE `id` = 4;
UPDATE `employee` SET `status` = 1 WHERE `id` = 5;



CREATE TABLE  IF NOT EXISTS `norm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `year_month_UNIQUE` (`year`, `month`, `kind_id`, `department_id`),
  KEY `fk_norm_kind_idx` (`kind_id`),
  KEY `fk_norm_department_idx` (`department_id`),
  CONSTRAINT `fk_norm_kind` FOREIGN KEY (`kind_id`) REFERENCES `kinds_of_purchase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_norm_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `norm_active` AS
SELECT * FROM `norm` WHERE `status` = 1;

CREATE OR REPLACE VIEW `norm_active_info` AS
SELECT 
	`n`.`id` AS `id`,
  `n`.`kind_id` AS `kind_id`, 
  `k`.`name` AS `kind_name`,
  `n`.`department_id` AS `department_id`,
  `d`.`name` AS `department_name`,
  `n`.`year` AS `year`,
  `n`.`month` AS `month`,
  `n`.`amount` AS `amount`
FROM `norm` AS `n` JOIN `department` AS `d` ON `n`.`department_id` = `d`.`id`
  JOIN `kinds_of_purchase` AS `k` ON `n`.`kind_id` = `k`.`id`
WHERE `n`.`status` = 1 AND `d`.`status` = 1 AND `k`.`status` = 1;

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 1, 2021, 1, 1000);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 2, 2021, 1, 2000);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 1, 2021, 1, 1500);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 2, 2021, 1, 2500);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 1, 2021, 2, 1000);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 2, 2021, 2, 2000);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 1, 2021, 2, 1500);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 2, 2021, 2, 2500);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 1, 2021, 3, 1000);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 2, 2021, 3, 2000);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 1, 2021, 3, 1500);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 2, 2021, 3, 2500);

INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(1, 3, 2021, 1, 0);
INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`) VALUES(2, 3, 2021, 1, 0);


UPDATE `norm` SET `status` = 1 WHERE `id` <= 12;


CREATE TABLE  IF NOT EXISTS `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `norm_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(11,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_receipt_norm_idx` (`norm_id`),
  KEY `fk_receipt_employee_idx` (`employee_id`),
  CONSTRAINT `fk_receipt_norm` FOREIGN KEY (`norm_id`) REFERENCES `norm` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_receipt_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `receipt_active` AS
SELECT * FROM `receipt` WHERE `status` = 1;

CREATE OR REPLACE VIEW `receipt_active_info` AS
SELECT 
	`r`.`id` AS `id`,
  `r`.`date` AS `date`,
  `r`.`amount` AS `amount`,
  `r`.`description` AS `description`,
  `n`.`year` AS `year`,
  `n`.`month` AS `month`,
  `r`.`norm_id` AS `norm_id`,
  `n`.`kind_id` AS `kind_id`,
  `n`.`kind_name` AS `kind_name`, 
  `r`.`employee_id` AS `employee_id`,
  CONCAT(`e`.`last_name`, ' ', `e`.`first_name`) AS `employee_name`,
  `e`.`department_id` AS `department_id`,
  `e`.`department_name` AS `department_name`
FROM `receipt` AS `r` JOIN `employee_active_info` AS `e` ON `r`.`employee_id` = `e`.`id`
  JOIN `norm_active_info` AS `n` ON `r`.`norm_id` = `n`.`id`
WHERE `r`.`status` = 1;

INSERT INTO `receipt` (`norm_id`, `employee_id`, `date`, `amount`, `description`) VALUES(1, 1, '2021.01.02', 100, 'Олівці 10 шт');
INSERT INTO `receipt` (`norm_id`, `employee_id`, `date`, `amount`, `description`) VALUES(1, 2, '2021.01.02', 200, 'Ручки 5 шт');
INSERT INTO `receipt` (`norm_id`, `employee_id`, `date`, `amount`, `description`) VALUES(1, 4, '2021.01.03', 50, 'Файли 100 шт');
INSERT INTO `receipt` (`norm_id`, `employee_id`, `date`, `amount`, `description`) VALUES(1, 5, '2021.01.04', 300, 'Ножиці 3 шт');

UPDATE `receipt` SET `status` = 1 WHERE `id` <= 4;

