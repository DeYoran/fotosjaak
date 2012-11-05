<?php
require_once('config/config.php');
	class MySqlDatabaseClass
	{
		//fields
		private $db_connection;
		
		//constuctor
		public function __construct()
		{
			$this->db_connection = mysql_connect(SERVERNAME, USERNAME, PASSWORD)
				or die('MySqlDatabaseClass: '.mysql_error());
			mysql_select_db( DATABASE , $this->db_connection)
				or die('MySqlDatabaseClass: '.mysql_error());
		}
		
		public function fire_query( $query)
		{
			$result = mysql_query( $query, $this->db_connection) or die('MySqlDatabaseClass'.mysql_error());
			return $result;
		}
	}
	
	$database = new MySqlDatabaseClass();
?>