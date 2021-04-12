SELECT 
  `r`.`department_id` AS `ІД`,
  `r`.`department_name` AS `Відділ`,
  sum(`r`.`amount`)/`d`.`count_employee` AS `Сума витрат на одного співробітника`
FROM `receipt_active_info` `r` JOIN `department_active_info` `d` ON `r`.`department_id` = `d`.`id`
GROUP BY 
  `r`.`department_id`,
  `r`.`department_name`;