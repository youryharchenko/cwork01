SELECT 
  `r`.`department_name` AS `Відділ`,
  `r`.`kind_name` AS `Вид витрат`,
  `r`.`employee_name` AS `Співробітник`,
  `r`.`amount` AS `Сума витрат`
FROM `receipt_active_info` `r`
WHERE `r`.`year` = YEAR(CURDATE()) AND `r`.`month` = MONTH(CURDATE()) ;