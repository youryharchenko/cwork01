DELIMITER $$
USE `zf413514_db`$$
CREATE PROCEDURE `activate_norm_with_remainder` (
  IN from_year INT,
  IN from_month INT,
  IN to_year INT,
  IN to_month INT
  )
BEGIN

    UPDATE 
        `norm` `nt`, 
        (
			SELECT 
            `nf`.`year`, 
            `nf`.`month`, 
            `nf`.`kind_id`, 
            `nf`.`department_id`,
            `nf`.`amount` - COALESCE(`s`.`amount`, 0) `remainder`
			FROM `norm_active` `nf` LEFT JOIN `sum_receipt_active_by_month_department_norm` `s` 
			ON `nf`.`id` = `s`.`norm_id` AND `nf`.`amount` >= COALESCE(`s`.`amount`, 0)
		) r
    SET `nt`.`status` = 1, `nt`.`amount` = `nt`.`amount` + `r`.`remainder`
    WHERE `nt`.`year` = to_year AND `nt`.`month` = to_month
        AND `r`.`year` = from_year AND `r`.`month` = from_month
        AND `nt`.`kind_id` = `r`.`kind_id` AND `nt`.`department_id` = `r`.`department_id`;
    
    
END$$

DELIMITER ;
