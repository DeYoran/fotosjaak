<?php
	//require_once("./classes/MysqlDatabaseClass.php");
	require_once("./classes/Loginclass.php");
	/*$query = "INSERT INTO `logingegevens` 	(
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
*/
	$login = new LoginClass();
	/*
	$query = "select* from `logingegevens`";
	$result = $login->find_by_sql($query);
	foreach( $result as $value)
	{
		echo ($value->id."|" .
			 $value->username."|".
			 $value->password."|".	
			 $value->userrole."|".
			 $value->activated."|"."<br/>");
	}
	*/
	/*
	foreach( $login->find_all as $value)
	{
		echo ($value->id."|" .
			 $value->username."|".
			 $value->password."|".	
			 $value->userrole."|".
			 $value->activated."|"."<br/>");
	}
	*/
	echo Loginclass::find_all();
	?>
this is a databaseclass testpage