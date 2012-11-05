<?php
	require_once("./classes/MysqlDatabaseClass.php");
	$query = "INSERT INTO `logingegevens` 	(
										`id`,
										`username`,
										`password`,
										`userrole`,
										`activated`
										)
							VALUES		(NULL,
										'sjaak@yorie.nl',
										'sjakie',
										'sjaak',
										'YES')";
	$database->fire_query($query);
?>
this is a databaseclass testpage