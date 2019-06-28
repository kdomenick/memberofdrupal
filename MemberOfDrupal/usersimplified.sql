
/* In this example, the following fields are defined on the user account: first name, last name, home department.  Other fields are standard Drupal user account fields   */

CREATE ALGORITHM=UNDEFINED DEFINER=`your_user`@`localhost` SQL SECURITY DEFINER VIEW `usersimplified` AS 
select 	`database_name`.`users_field_data`.`name` AS `username`,
		`database_name`.`user__roles`.`roles_target_id` AS `role`,
		`database_name`.`user__field_first_name`.`field_first_name_value` AS `firstname`,
		`database_name`.`user__field_last_name`.`field_last_name_value` AS `lastname`,
		(case when (`database_name`.`users_field_data`.`status` = '1') then 'Active' when (`database_name`.`users_field_data`.`status` = '0') then 'BLOCKED' end) AS `status`,
		`database_name`.`database_name_department_field_data`.`name` AS `homedept`,
		
from ((((((`database_name`.`users_field_data` 
left join `database_name`.`user__roles` on((`database_name`.`users_field_data`.`uid` = `database_name`.`user__roles`.`entity_id`))) 
left join `database_name`.`user__field_first_name` on((`database_name`.`users_field_data`.`uid` = `database_name`.`user__field_first_name`.`entity_id`))) 
left join `database_name`.`user__field_last_name` on((`database_name`.`users_field_data`.`uid` = `database_name`.`user__field_last_name`.`entity_id`))) 
left join `database_name`.`user__field_department` on((`database_name`.`users_field_data`.`uid` = `database_name`.`user__field_department`.`entity_id`))) 
join `database_name`.`database_name_department_field_data` on((`database_name`.`user__field_department`.`field_department_target_id` = `database_name`.`database_name_department_field_data`.`id`))) 

where (`database_name`.`user__roles`.`roles_target_id` not in ('administrator','authenticated'))