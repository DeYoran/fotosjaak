<?php
	require_once('MysqlDatabaseClass.php');
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
		
		public static function find_by_sql ($query)
		{
			global $database;
			$result = $database->fire_query ($query );
			$object_array = array();
			while ( $row = mysql_fetch_object( $result) )
			{
				$object = new LoginClass();
				$object->id = $row->id;
				$object->username = $row->username;
				$object->password = $row->password;
				$object->userrole = $row->userrole;
				$object->activated = $row->activated;
				$object_array[] = $object;
			}
		return $object_array;
		}
	 public static function find_all()
	 {
	 $query = "Select * from `logingegevens`";
	 $result = self::find_by_sql($query);
	 $output = '';
	 foreach ($result as $value)
	{
	$output .=  $value->id."|" .
				$value->username."|".
				$value->password."|".	
				$value->userrole."|".
				$value->activated."|"."<br/>";
	}
		return $output;
	 }
	public static function emailaddress_exists($emailadress)
	{
		//echo $emailadress;exit();
		global $database;
		$query = "SELECT * FROM `logingegevens` WHERE `username` = '".$emailadress."'";
		$result = $database->fire_query($query);
		//$var (bewering) ? "waar" : "niet waar"
		return (mysql_num_rows($result) > 0) ? true : false;
	}
 }
?>