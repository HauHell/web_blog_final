<?php  
class database{

	//DB Params
	private $dns = "mysql:host=bnxbg1os8aigeajonujv-mysql.services.clever-cloud.com;dbname=bnxbg1os8aigeajonujv";   
	private $username = "ufdkbmatcsmbxuib";
	private $password = "zhdMGMm3axbCVWCFuiil";
	private $conn;

	//DB Connect
	public function connect(){
		$this->conn = null;
		try{
			$this->conn = new PDO($this->dns,$this->username,$this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOException $e){
			echo "Connection failed: ".$e->getMessage();
		}

		return $this->conn;
	}
}
?>

