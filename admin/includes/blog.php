<?php  
class blog{

	//DB Stuff
	private $conn;
	private $table = "my_blog";
	private $table2 ="my_tag";

	//Blog Properties
	public $n_blog_id;
	public $v_blog_title;
	public $v_blog_meta_title;
	public $v_blog_content;
	public $v_main_image_url;
	public $v_alt_image_url;
    public $v_sub_image_url;
	public $f_post_status;
	public $d_date_created;
	public $d_time_created;
	public $v_name_bloger ;
	public $n_blog_view;
	public $v_blog_category;

	//Last id insert
	public $last_insert_id;

	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table  order by $this->table.n_blog_id desc";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}
	public function read_title(){
		$sql = "SELECT * FROM $this->table order by $this->table.n_blog_id desc LIMIT 5 ";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

		public function read_search($key){
		$sql = "SELECT * FROM $this->table join $this->table2 on $this->table.n_blog_id = $this->table2.n_blog_id where v_blog_title like '%$key%' or v_tag like '%$key%'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	public function read2($begin){
		$sql = "SELECT * FROM $this->table, $this->table2 WHERE $this->table.n_blog_id =$this->table2.n_blog_id and f_post_status=1 order by $this->table.n_blog_id desc LIMIT $begin,3  ";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}
	public function read_category($search){
		$sql = "SELECT * FROM $this->table where v_blog_category ='$search'";
		
		$stmt = $this->conn->prepare($sql);
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
		$this->n_blog_id = $row['n_blog_id'];
		$this->v_blog_title=$row['v_blog_title'];
		$this->v_blog_meta_title=$row['v_blog_meta_title'];
		$this->v_blog_content=$row['v_blog_content'];
		$this->v_main_image_url=$row['v_main_image_url'];
		$this->v_alt_image_url=$row['v_alt_image_url'];
        $this->v_sub_image_url=$row['v_sub_image_url'];
		$this->f_post_status=$row['f_post_status'];
		$this->d_date_created=$row['d_date_created'];
		$this->d_time_created=$row['d_time_created'];
		$this->v_name_bloger =$row['v_name_bloger'];
		$this->n_blog_view =$row['n_blog_view'];
		$this->v_blog_category =$row['v_blog_category'];

		

				
	}
	public function read_single2(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_blog_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_blog_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Set Properties
		$this->n_blog_id = $row['n_blog_id'];
		$this->v_blog_title=$row['v_blog_title'];
		$this->v_blog_meta_title=$row['v_blog_meta_title'];
		$this->v_blog_content=$row['v_blog_content'];
		$this->v_main_image_url=$row['v_main_image_url'];
		$this->v_alt_image_url=$row['v_alt_image_url'];
        $this->v_sub_image_url=$row['v_sub_image_url'];
		$this->f_post_status=$row['f_post_status'];
		$this->d_date_created=$row['d_date_created'];
		$this->d_time_created=$row['d_time_created'];
		$this->v_name_bloger =$row['v_name_bloger'];
		$this->n_blog_view =$row['n_blog_view'];
		$this->v_blog_category =$row['v_blog_category'];

		$this->n_blog_view+=1;
		$sql="UPDATE $this->table SET n_blog_view=$this->n_blog_view WHERE n_blog_id=$this->n_blog_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

				
	}

	//Create blog_post
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET 
		          	  v_blog_title = :blog_title,
		          	  v_blog_meta_title = :blog_meta_title,
		          	  v_blog_content = :blog_content,
		          	  v_main_image_url = :main_image_url,
		          	  v_sub_image_url = :sub_image_url,
		          	  v_alt_image_url = :alt_image_url,
					f_post_status =:post_status,
					  v_name_bloger =:name_bloger,
					  v_blog_category =:blog_category,
					  n_blog_view =:blog_view,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_blog_title = htmlspecialchars(strip_tags($this->v_blog_title));
		$this->v_name_bloger = htmlspecialchars(strip_tags($this->v_name_bloger));
		$this->v_blog_meta_title = htmlspecialchars(strip_tags($this->v_blog_meta_title));
		$this->v_blog_content = htmlspecialchars(strip_tags($this->v_blog_content));
		$this->v_blog_category = htmlspecialchars(strip_tags($this->v_blog_category));

		//Bind data
		$stmt->bindParam(':blog_title',$this->v_blog_title);
		$stmt->bindParam(':blog_meta_title',$this->v_blog_meta_title);
		$stmt->bindParam(':blog_content',$this->v_blog_content);
		$stmt->bindParam(':blog_category',$this->v_blog_category);
		$stmt->bindParam(':main_image_url',$this->v_main_image_url);
		$stmt->bindParam(':sub_image_url',$this->v_sub_image_url);
		$stmt->bindParam(':post_status',$this->f_post_status);
		$stmt->bindParam(':alt_image_url',$this->v_alt_image_url);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		$stmt->bindParam(':name_bloger',$this->v_name_bloger);
		$stmt->bindParam(':blog_view',$this->n_blog_view);

		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	//Update blog_post
	public function update(){
		//Create query
		$query = "UPDATE $this->table
		          SET  v_blog_title = :blog_title,
		          	  v_blog_meta_title = :blog_meta_title,
		          	  v_blog_content = :blog_content,
		          	  v_main_image_url = :main_image_url,
		          	  v_sub_image_url = :sub_image_url,
		          	  v_alt_image_url = :alt_image_url,
						f_post_status = :post_status,
					  v_name_bloger =:name_bloger,
					v_blog_category =:blog_category,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created
		          WHERE 
		          	  	n_blog_id = :get_id";

		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_blog_title = htmlspecialchars(strip_tags($this->v_blog_title));
		$this->v_name_bloger = htmlspecialchars(strip_tags($this->v_name_bloger));
		$this->v_blog_meta_title = htmlspecialchars(strip_tags($this->v_blog_meta_title));
		$this->v_blog_content = htmlspecialchars(strip_tags($this->v_blog_content));
		$this->v_blog_category = htmlspecialchars(strip_tags($this->v_blog_category));

		

		//Bind data
		$stmt->bindParam(':get_id',$this->n_blog_id);
		$stmt->bindParam(':blog_title',$this->v_blog_title);
		$stmt->bindParam(':blog_meta_title',$this->v_blog_meta_title);
		$stmt->bindParam(':blog_category',$this->v_blog_category);
		$stmt->bindParam(':blog_content',$this->v_blog_content);
		$stmt->bindParam(':main_image_url',$this->v_main_image_url);
		$stmt->bindParam(':sub_image_url',$this->v_sub_image_url);
		$stmt->bindParam(':alt_image_url',$this->v_alt_image_url);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		$stmt->bindParam(':name_bloger',$this->v_name_bloger);
		$stmt->bindParam(':post_status',$this->f_post_status);
	

		//Execute query
		if($stmt->execute()){
			return true;

		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}

	//Delete blog_post
	public function delete(){

		//Create query
		$query = "DELETE FROM $this->table
		          WHERE n_blog_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_blog_id = htmlspecialchars(strip_tags($this->n_blog_id));
		

		//Bind data
		$stmt->bindParam(':get_id',$this->n_blog_id);

		//Execute query
		if($stmt->execute()){
			return true;
		}

		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}

	public function last_id(){
		$this->last_insert_id = $this->conn->lastInsertId();
		return $this->last_insert_id;
		
	}
	public function read_previous(){
		$sql ="SELECT * FROM $this->table WHERE n_blog_id =(SELECT max(n_blog_id) FROM $this->table WHERE n_blog_id <:current_id)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":current_id",$this->n_blog_id);
		$stmt->execute();

		return $stmt;
	}

	public function read_next(){
		$sql ="SELECT * FROM $this->table WHERE n_blog_id =(SELECT min(n_blog_id) FROM $this->table WHERE n_blog_id >:current_id)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":current_id",$this->n_blog_id);
		$stmt->execute();

		return $stmt;
	}

	public function previous_id($number){
		$sql="SELECT n_blog_id,v_blog_title FROM $this->table WHERE $this->table.n_blog_id = $number-1 ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	
	}
	public function next_id($number){
		$sql="SELECT n_blog_id,v_blog_title FROM $this->table WHERE ($this->table.n_blog_id)-1 = $number ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	
	}

}
?>

