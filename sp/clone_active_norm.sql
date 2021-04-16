DELIMITER $$
USE `zf413514_db`$$
CREATE PROCEDURE `clone_active_norm` (
  IN from_year INT,
  IN from_month INT,
  IN to_year INT,
  IN to_month INT
  )
BEGIN
    DECLARE EXIT HANDLER FOR 1062 SELECT 'Duplicate keys error encountered' Message;

    INSERT INTO `norm` (`kind_id`, `department_id`, `year`, `month`, `amount`)
    SELECT `n`.`kind_id`, `n`.`department_id`, to_year, to_month, `n`.`amount`
    FROM `norm_active` `n`
    WHERE `n`.`year` = from_year AND `n`.`month` = from_month;

    SELECT COUNT(`id`) AS `Cloned` FROM `norm` `n`
    WHERE `n`.`year` = to_year AND `n`.`month` = to_month;
END$$

DELIMITER ;

