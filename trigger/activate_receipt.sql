DELIMITER $$
USE `zf413514_db`$$
CREATE TRIGGER `activate_receipt`
    BEFORE UPDATE
    ON `receipt` FOR EACH ROW
BEGIN
	
	IF (OLD.`status` = 0 AND NEW.`status` = 1) THEN
		IF ((SELECT `n`.`amount`
			FROM `norm_active` `n`
			WHERE `n`.`id` = NEW.`norm_id`) = 0) THEN
			
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Blocked!!!';
        
		END IF;
	END IF;
END$$

DELIMITER ;