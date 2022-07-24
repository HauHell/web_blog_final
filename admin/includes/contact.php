<?php  
class contact{

	//DB Stuff
	private $conn;
	private $table = "my_contact";

	//Blog Categories Properties
	public $n_contact_id;
	public $v_name;
	public $v_email;
	public $v_subject;
	public $v_message;
	
	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	//Read one record
	public function read_single(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_contact_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_contact_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//Set Properties
		if($row>0){
		$this->n_contact_id = $row['n_contact_id'];
		$this->v_name = $row['v_name'];
		$this->v_email = $row['v_email'];
		}
		else{
			return;
		}
		
	}

	//Create category
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET v_name = :name,
				  	  v_subject = :subject,
						v_message = :message,
		          	  v_email = :email";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_name = htmlspecialchars(strip_tags($this->v_name));
		$this->v_email = htmlspecialchars(strip_tags($this->v_email));
		$this->v_subject = htmlspecialchars(strip_tags($this->v_subject));
		$this->v_message = htmlspecialchars(strip_tags($this->v_message));	
		
		//Bind data
		$stmt->bindParam(':name',$this->v_name);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':subject',$this->v_subject);
		$stmt->bindParam(':message',$this->v_message);
		
		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Update category
	public function update(){
		//Create query
		$query = "UPDATE $this->table
		          SETv_name = :name,
				  	  v_subject = :subject,
						v_message = :message,
		          	  v_email = :email		          	  
		          WHERE 
		          	  n_contact_id = :get_id";
		//Prepare statement
		$stmt = $this->conn->prepare($query);
		//Clean data
		$this->v_name = htmlspecialchars(strip_tags($this->v_name));
		$this->v_email = htmlspecialchars(strip_tags($this->v_email));
		$this->v_subject = htmlspecialchars(strip_tags($this->v_subject));
		$this->v_message = htmlspecialchars(strip_tags($this->v_message));	
		
		//Bind data
		$stmt->bindParam(':name',$this->v_name);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':subject',$this->v_subject);
		$stmt->bindParam(':message',$this->v_message);
		
		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}
	
	//Delete category
	public function delete(){

		//Create query
		$query = "DELETE FROM $this->table
		          WHERE n_contact_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_contact_id = htmlspecialchars(strip_tags($this->n_contact_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_contact_id);

		//Execute query
		if($stmt->execute()){
			return true;
		}

		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}
}
?>

