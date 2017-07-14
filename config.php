<?php
class DatabaseConnection{

	public function __construct()
	{
		global $conn;
		try {
			$conn = new PDO("mysql:host=localhost;dbname=ooplogin","root","");
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			//echo "Connect Successfully";
		} 
		catch (PDOException $e) {
			echo "Connection Faled : ".$e->getMessage();
		}
	}
}

//$obj= new DatabaseConnection;



?>