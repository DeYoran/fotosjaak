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
	
	public static function insert_into_logingegevens($postarray)
	{
		global $database;
		//genereer tijdelijk wachtwoord a.d.h. van emaildres en tijd
		date_default_timezone_set("Europe/Amsterdam");
		$date = date("Y:m:d h:i:s");
		$temppassword = MD5($date.$postarray['username']);
		$query = "insert into `logingegevens`  (`id`,
												`username`,
												`password`,
												`userrole`,
												`activated`,
												`datetime`)
										 Values(Null,
												'".$postarray['username']."',
												'".$temppassword."',
												'customer',
												'no',
												'".$date."')";
		$database->fire_query($query);
		
		//het opvragen van het zojuist gemaakte account
		$query = "SELECT * FROM `logingegevens` WHERE `username` = '".$postarray['username']."'";
		$id = array_shift(self::find_by_sql($query))->id;
		$query = "INSERT INTO `user`(`id`, 
									 `first name`,
									 `insertion`,
									 `surname`,
									 `address`,
									 `address number`,
									 `city`,
									 `zip code`,
									 `country`,
									 `phonenumber`,
									 `cellnumber`)
							 VALUES ('".$id."',
									 '".$postarray['firstname']."',
									 '".$postarray['insertion']."',
									 '".$postarray['surname']."',
									 '".$postarray['address']."',
									 '".$postarray['addressnumber']."',
									 '".$postarray['city']."',
									 '".$postarray['zipcode']."',
									 '".$postarray['country']."',
									 '".$postarray['phonenumber']."',
									 '".$postarray['cellnumber']."')";
	$database->fire_query($query);
	}
	
 }
?>