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
		
		public static function find_by_sql($query)
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
			$query = "SELECT * FROM `logingegevens` WHERE `username` = '".$postarray['username']."';";
			
			$id = "";
			foreach (self::find_by_sql($query) as $value)
			{
				$id = $value->id;
			}
			
			//$id = (array_shift(self::find_by_sql($query)))->id;
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
									 '".$postarray['cellnumber']."');";
		$database->fire_query($query);
		self::send_activation_email($postarray['username'], $temppassword, $postarray['firstname'], $postarray['insertion'], $postarray['surname']);
	}
	public static function send_activation_email($email, $password, $firstname, $infix, $surname)
	{
		//echo $email."<br>".$password;exit();
		$CarbonCopy="info@gmail.com@gmail.com";
		$BlindCarbonCopy="yoran.engelberts@gmail.com";
		$ontvanger = $email;
		$onderwerp = "bevestiging registratie";
		//bericht voor plain text
		/*$bericht = "geachte meneer/mevrouw ".$firstname." ".$infix." ".$surname."\r\n\r\n
		u heeft een account aangemaakt op de website van fotosjaak \r\n
		voordat u deze kunt gebruiken, moet u deze eerst activeren, \r\n
		dit doet u door op de volgende link te klikken \r\n
		http://localhost/yorienl/blok2/activatie.php?em=".$email."&pw=".$password."\r\n
		met vriendelijke groet\r\n
		Sjaak";*/
		
		//bericht voor html
		$bericht = "geachte meneer/mevrouw <b>".$firstname." ".$infix." ".$surname."</b><br><br>
		u heeft een account aangemaakt op de website van fotosjaak <br>
		voordat u deze kunt gebruiken, moet u deze eerst activeren, <br>
		dit doet u door op de volgende link te klikken <br>
		<a href='http://localhost/yorienl/blok2/activatie.php?em=".$email."&pw=".$password."'>activeer account</a><br>
		<i>met vriendelijke groet<br>
		Sjaak</i>";
		$headers = "From: noreply@yorie.nl\r\n";
		$headers .= "Reply_to: info@yorie.nl\r\n";
		$headers .= "Cc: ".$CarbonCopy."\r\n";
		$headers .= "Bcc: ".$BlindCarbonCopy."\r\n";
		$headers .= "X-mailer: PHP/".phpversion()."\r\n";
		$headers .= "MIME-version: 1.0\r\n";
		//$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail($ontvanger,$onderwerp,$bericht,$headers);
	}
 }
?>