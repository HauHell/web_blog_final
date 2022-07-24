<?php 
class about{

    private $conn;
    private $table ="my_about";
    
    public $n_about_id;
    public $v_name;
    public $v_business;
    public $v_message;
    public $d_date_born;
    public $v_phone;
    public $v_email;
    public $v_adress;
    public $v_about;
    public $v_image_url;
	public $v_user_name;
	public $v_password;
	public $d_date_upload;
	public $d_time_upload;
    //contructor with database
    public function __construct($db){
        $this->conn =$db;
    }
	public function user_login(){
		$sql = "SELECT * FROM $this->table 
				WHERE v_user_name = :user_name
				AND v_password = :password";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_name',$this->v_user_name);
		$stmt->bindParam(':password',$this->v_password);
		$stmt->execute();

		return $stmt;
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
        $sql ="SELECT * FROM $this->table WHERE n_about_id = :get_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':get_id',$this->n_about_id);
        $stmt->execute();  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->n_about_id = $row['n_about_id'];
        $this->v_about =$row['v_about'];
        $this->v_business = $row['v_business'];
        $this->v_name =$row['v_name'];
        $this->v_message =$row['v_message'];
        $this->d_date_born =$row['d_date_born'];
        $this->v_phone =$row['v_phone'];
        $this->v_email =$row['v_email'];
		$this->v_user_name =$row['v_user_name'];
		$this->v_password =$row['v_password'];
		$this->d_date_updated =$row['d_date_updated'];
		$this->d_time_updated =$row['d_time_updated'];
        $this->v_adress =$row['v_adress'];  
        $this->v_phone =$row['v_about'];
        $this->v_image_url =$row['v_image_url'];

    }

    public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET n_about_id = :about_id,
                      v_name =:name,
                      v_about=:about,
                      v_business=:business,
                      v_message=:message,
                      d_date_born=:date_born,
                      v_phone=:phone,
                      v_email=:email,
                      v_adress=:adress,
                      v_image_url=:image_url";

                      		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_name = htmlspecialchars(strip_tags($this->v_name));
		$this->v_about = htmlspecialchars(strip_tags($this->v_about));
		$this->v_business = htmlspecialchars(strip_tags($this->v_business));
		$this->v_message = htmlspecialchars(strip_tags($this->v_message));
		$this->v_phone = htmlspecialchars(strip_tags($this->v_phone));
        $this->v_email = htmlspecialchars(strip_tags($this->v_email));
        $this->v_adress = htmlspecialchars(strip_tags($this->v_adress));
        $this->v_image_url = htmlspecialchars(strip_tags($this->v_image_url));

		//Bind data
		$stmt->bindParam(':about_id',$this->n_blog_post_id);
		$stmt->bindParam(':name',$this->v_name);
		$stmt->bindParam(':about',$this->v_about);
		$stmt->bindParam(':business',$this->v_business);
		$stmt->bindParam(':message',$this->v_message);
		$stmt->bindParam(':date_born',$this->d_date_born);
		$stmt->bindParam(':image_url',$this->v_image_url);
		$stmt->bindParam(':alt_image',$this->v_alt_image_url);
		$stmt->bindParam(':phone',$this->v_phone);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':adress',$this->v_adress);		
		

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
                      v_name =:name,
                      v_about=:about,
                      v_business=:business,
                      v_message=:message,
                      d_date_born=:date_born,
                      v_phone=:phone,
                      v_email=:email,
                      v_adress=:adress,
					  v_user_name=:user_name,
					  v_password=:password,
					  d_date_updated = :date_updated,
		          	  d_time_updated = :time_updated,
                      v_image_url=:image_url;
		          WHERE 
                  n_about_id = :about_id";

		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
        $this->v_name = htmlspecialchars(strip_tags($this->v_name));
		$this->v_about = htmlspecialchars(strip_tags($this->v_about));
		$this->v_business = htmlspecialchars(strip_tags($this->v_business));
		$this->v_message = htmlspecialchars(strip_tags($this->v_message));
		$this->v_phone = htmlspecialchars(strip_tags($this->v_phone));
        $this->v_email = htmlspecialchars(strip_tags($this->v_email));
        $this->v_adress = htmlspecialchars(strip_tags($this->v_adress));
        $this->v_image_url = htmlspecialchars(strip_tags($this->v_image_url));
		$this->v_user_name = htmlspecialchars(strip_tags($this->v_user_name));
		$this->v_password = htmlspecialchars(strip_tags($this->v_password));



		//Bind data
		$stmt->bindParam(':about_id',$this->n_about_id);
		$stmt->bindParam(':name',$this->v_name);
		$stmt->bindParam(':about',$this->v_about);
		$stmt->bindParam(':business',$this->v_business);
		$stmt->bindParam(':message',$this->v_message);
		$stmt->bindParam(':date_born',$this->d_date_born);
		$stmt->bindParam(':image_url',$this->v_image_url);
		$stmt->bindParam(':phone',$this->v_phone);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':adress',$this->v_adress);
		$stmt->bindParam(':user_name',$this->v_user_name);
		$stmt->bindParam(':password',$this->v_password);
		$stmt->bindParam(':date_updated',$this->d_date_updated);
		$stmt->bindParam(':time_updated',$this->d_time_updated);


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
		          WHERE n_about_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_about_id = htmlspecialchars(strip_tags($this->n_about_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_about_id);

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