<?php 
class services{

    private $conn;
    private $table ="my_project";
    
    public $n_project_id;
    public $v_name_project_project;
    public $v_language_project;
    public $v_title_project;
    public $v_name_project_designer;
    public $v_image_project_url;
    public $d_date_update;
    public $d_time_update;
   
    //contructor with database
    public function __construct($db){
        $this->conn =$db;
    }
    //read multi record from table
    public function read(){
        $sql ="SELECT * FROM $this->table"  ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt; 
        
    }
    //read one record from table
    public function read_single(){
        $sql ="SELECT * FROM $this->table WHERE $this->n_project_id = :get_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(':get_id',$this->n_project_id);
        $stmt->execute();  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->n_project_id = $row['n_project_id'];
        $this->v_name_project_project =$row['vv_name_project_project'];
        $this->v_language_project = $row['v_language_project'];
        $this->v_title_project =$row['vv_title_project'];
        $this->v_name_project_designer =$row['v_name_project_designer'];
        $this->v_image_project_url =$row['v_image_project_url'];
        $this->d_date_update =$row['d_date_update'];
        $this->d_time_update =$row['d_time_update'];
       

    }

    public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET n_project_id = :project_id,
                      v_name_project =:name_project,
                      v_language_project=:language_project,
                      v_title_project=:title_project,
                      v_name_project_designer=:name_project_designer,
                      v_image_project_url=:image_project_url,
                      d_date_update=:date_update,
                      d_time_update=:time_update";

                      		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_name_project = htmlspecialchars(strip_tags($this->v_name_project));
		$this->v_language_project = htmlspecialchars(strip_tags($this->v_language_project));
		$this->v_title_project = htmlspecialchars(strip_tags($this-> v_title_project));
		$this->v_name_project_designer = htmlspecialchars(strip_tags($this->v_name_project_designer));
		$this->v_image_project_url = htmlspecialchars(strip_tags($this->v_image_project_url));
        $this->d_date_update = htmlspecialchars(strip_tags($this->d_date_update));
        $this->d_time_update = htmlspecialchars(strip_tags($this->d_time_update));
       

		//Bind data
		$stmt->bindParam(':project_id', $this->n_project_id);
		$stmt->bindParam(':name_project',$this->v_name_project);
		$stmt->bindParam(':language_project',$this->v_language_project);
		$stmt->bindParam(':title_project',$this-> v_title_project);
		$stmt->bindParam(':name_project_designer',$this->v_name_project_designer);
		$stmt->bindParam(':image_project_url',$this->v_image_project_url);
		$stmt->bindParam(':date_update',$this->d_date_update);
		$stmt->bindParam(':time_update',$this->d_time_update);		
		

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
		          SET 
                 
                      v_name_project =:name_project,
                      v_language_project=:language_project,
                      v_title_project=:title_project,
                      v_name_project_designer=:name_project_designer,
                      v_image_project_url=:image_project_url,
                      d_date_update=:date_update,
                      d_time_update=:time_update;
		          WHERE 
                  n_project_id = :project_id";

		//Prepare statement
		$stmt = $this->conn->prepare($query);

		
       //Clean data
		$this->v_name_project = htmlspecialchars(strip_tags($this->v_name_project));
		$this->v_language_project = htmlspecialchars(strip_tags($this->v_language_project));
		$this->v_title_project = htmlspecialchars(strip_tags($this-> v_title_project));
		$this->v_name_project_designer = htmlspecialchars(strip_tags($this->v_name_project_designer));
		$this->v_image_project_url = htmlspecialchars(strip_tags($this->v_image_project_url));
        $this->d_date_update = htmlspecialchars(strip_tags($this->d_date_update));
        $this->d_time_update = htmlspecialchars(strip_tags($this->d_time_update));
       

		//Bind data
		$stmt->bindParam(':project_id', $this->n_project_id);
		$stmt->bindParam(':name_project',$this->v_name_project);
		$stmt->bindParam(':language_project',$this->v_language_project);
		$stmt->bindParam(':title_project',$this-> v_title_project);
		$stmt->bindParam(':name_project_designer',$this->v_name_project_designer);
		$stmt->bindParam(':image_project_url',$this->v_image_project_url);
		$stmt->bindParam(':date_update',$this->d_date_update);
		$stmt->bindParam(':time_update',$this->d_time_update);		

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
		          WHERE n_project_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_project_id = htmlspecialchars(strip_tags($this->n_project_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_project_id);

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