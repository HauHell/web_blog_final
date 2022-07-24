<?php  
class comment{

	//DB Stuff
	private $conn;
	private $table = "my_comment";

	//Blog Categories Properties
	public $n_blog_comment_id ;
	public $n_blog_id;
	public $v_comment_author_email;
	public $v_comment;
	public $d_date_created;
	public $d_time_created;
	
	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

		public function read_single_blog(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_blog_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_blog_id);
		$stmt->execute();

		return $stmt;
	}
	public function read_single_blog_reply(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_comment_parent_id = :get_blog_comment_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_blog_comment_id',$this->n_blog_comment_id);
		$stmt->execute();

		return $stmt;
	}
	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}
	public function read2(){
		$sql = "SELECT * FROM $this->table WHERE $this->table.n_blog_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_blog_id);
		$stmt->execute();

		return $stmt;
	}

	//Read one record
	public function read_single(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_blog_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_blog_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//Set Properties
		if($row>0){
		$this->n_blog_comment_id = $row['n_blog_comment_id'];
		$this->n_blog_id = $row['n_blog_id'];
		$this->v_comment = $row['v_comment'];
		$this->v_comment_author_email = $row['v_comment_author_email'];
		$this->d_time_created = $row['d_time_created'];
		$this->d_date_created = $row['d_date_created'];
		}
		else{
			return;
		}
		
	}

	//Create category
public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET n_blog_id = :blog_id,
		          	  v_comment = :comment,
					  v_comment_author_email=:comment_author_email,
					  n_comment_parent_id=:comment_parent_id,
					  d_date_created = :date_created,
					  d_time_created = :time_created";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_comment = htmlspecialchars(strip_tags($this->v_comment));
		$this->v_comment_author_email = htmlspecialchars(strip_tags($this->v_comment_author_email));
		
		//Bind data
		$stmt->bindParam(':blog_id',$this->n_blog_id);
		$stmt->bindParam(':comment',$this->v_comment);
		$stmt->bindParam(':comment_parent_id',$this->n_comment_parent_id);
		$stmt->bindParam('comment_author_email',$this->v_comment_author_email);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);

		
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
		          SET n_blog_id = :blog_id,
		          	  v_comment = :comment,
					  v_comment_author_email=comment_author_email,
					  d_date_created = :date_created,
					  d_time_created = :time_created		          	  
		          WHERE 
		          	  n_blog_comment_id = :get_id";
		//Prepare statement
		$stmt = $this->conn->prepare($query);
			//Clean data
			$this->v_comment = htmlspecialchars(strip_tags($this->v_comment));
			$this->v_comment_author_email = htmlspecialchars(strip_tags($this->v_comment_author_email));
			
			//Bind data
			$stmt->bindParam(':blog_id',$this->n_blog_id);
			$stmt->bindParam(':comment',$this->v_comment);
			$stmt->bindParam('comment_author_email',$this->v_comment_author_email);
		
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
		          WHERE n_blog_comment_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_blog_comment_id = htmlspecialchars(strip_tags($this->n_blog_comment_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_blog_comment_id);

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

