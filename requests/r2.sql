SELECT 
  `s`.`department_id` AS `ІД`,
  `s`.`department_name` AS `Відділ`,
  `s`.`kind_name` AS `Вид витрат`,
  `s`.`year` AS `Рік`,
  `s`.`month` AS `Місяць`,
  `s`.`amount` AS `Сума витрат`,
  `n`.`amount` AS `Норма витрат`
FROM 
  `sum_receipt_active_by_month_department_norm` `s` 
    JOIN `norm_active` `n` ON `s`.`norm_id` = `n`.`id`
WHERE `s`.`amount` > `n`.`amount`;
