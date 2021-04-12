SELECT 
  `r`.`department_id` AS `ІД`,
  `r`.`department_name` AS `Відділ`,
  sum(`r`.`amount`) AS `Сума`
FROM `receipt_active_info` `r`
GROUP BY 
  `r`.`department_id`,
  `r`.`department_name`;
