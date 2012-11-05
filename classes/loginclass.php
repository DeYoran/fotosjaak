<?php
	require_once('MysqlDatabaseClass.php')
	class LoginClass
	{
		//fields
		private $id;
		private $password;
		private $username;
		private $userrole;
		private $activated;
		
		public function __construct()
		{
		}
		
		public function find by sql ($query)
		{
			global $database
			$result = $database->fire_query ($query );
			
			while ( $row = mysql_fetch_object( $result) )
			{
				$object = new LoginClass();
				$object->id = $row->id;
				$object->username = $row->username;
				$object->password = $row->password;
				$object->userrole = $row->userrole;
				$object->activated = $row->activated;			
			}
		}
	}
?>