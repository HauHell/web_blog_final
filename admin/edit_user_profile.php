<?php  
include "includes/database.php";
include "includes/about.php";

$database = new database();
$db = $database->connect();
include "includes/check_login.php";
$new_user = new about($db);


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['edit_user_profile'])){

        if(empty($_FILES['image_profile']['name'])){
            $image_name = $_POST['old_image_profile'];            
        }else{
            $target_file = "../img/profile/";            
            $image_name = $_FILES['image_profile']['name'];
            move_uploaded_file($_FILES['image_profile']['tmp_name'],$target_file.$image_name);
        }

        $new_user->n_about_id = $_POST['about_id'];
        $new_user->v_name = $_POST['name'];
        $new_user->v_email = $_POST['email'];
        $new_user->v_user_name = $_POST['username'];
        $new_user->v_message= $_POST['message'];
        $new_user->v_about= $_POST['about'];
        if($_POST['password']!=$_POST['old_password']){
            $new_user->v_password = md5($_POST['password']);
        }
        else{
             $new_user->v_password=$_POST['old_password'];
        }
        $new_user->v_phone = $_POST['phone'];
        $new_user->v_adress = $_POST['adress'];
        $new_user->v_business = $_POST['business'];
        $new_user->v_image_url = $image_name;
        $new_user->d_date_born =  $_POST['dateborn'];
        $new_user->d_date_updated= date("Y-m-d",time());
        $new_user->d_time_updated = date("h:i:s",time());

        if($new_user->update()){
            $flag = "Update Successfull!";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/favicon5.png" type="image/png">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>NQH Edit User Profile</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet"  href="summernote/summernote.min.css">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
    <?php include 'header.php'; ?>
        <!-- HEADER MOBILE-->
    
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include "menu.php"; ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="card" style="margin-top: 100px; width: 850px ;margin-left:100px" >
                   
                                    <div class="card-header">
                                        <strong>Edit User Profile</strong>
                                    </div>
                         <div class="card-body card-block">
                         <?php 
                                $result =$new_user->read();
                                $row_user =$result->fetch();
                                 ?>
                             <form action="" method="POST" class="" enctype="multipart/form-data" style="width: 500px;">
                             <div class="form-group">
                                            <label>Full Name</label>
                                            <input name="name" 
                                            value="<?php echo $row_user['v_name'] ?>" class="form-control" placeholder="Enter Full Name">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" value="<?php echo $row_user['v_email'] ?>" 
                                            class="form-control" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Business</label>
                                            <input name="business" value="<?php echo $row_user['v_business'] ?>" 
                                            class="form-control" placeholder="Enter Email">
                                        </div>

                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input name="dateborn" value="<?php echo $row_user['d_date_born'] ?>" 
                                            class="form-control" placeholder="Enter Email">
                                        </div>

                                       <div class="form-group">
                                            <label>Username </label>
                                            <input name="username" value="<?php echo $row_user['v_user_name'] ?>"
                                            class="form-control" placeholder="Enter UserName">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                             <input name="password" type="password" 
                                            value="<?php echo $row_user['v_password'] ?>"
                                            class="form-control" placeholder="Enter password">
                                        </div>
                                          <div class="form-group">
                                           
                                             <input name="old_password" type="hidden" 
                                            value="<?php echo $row_user['v_password'] ?>"
                                            class="form-control" placeholder="Enter password">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input name="phone" value="<?php echo $row_user['v_phone'] ?>"
                                            class="form-control" placeholder="Enter Phone Number">
                                        </div>

                                        <div class="form-group">
                                            <label>Adress</label>
                                            <input name="adress" value="<?php echo $row_user['v_adress'] ?>"
                                            class="form-control" placeholder="Enter Adress">
                                        </div>

                                        <div class="form-group">
                                            <label>Image Profile</label>
                                            <input type="file" name="image_profile">
                                            <input type="hidden" name="old_image_profile" value="<?php echo $row_user['v_image_url'] ?>">
                                        
                                        </div>

                                        <div class="form-group" >
                                            <label>Message</label>
                                             <textarea style="text-align: left;" id="summernote_profile" name="message" class="form-control" rows="3">
                                            <?php echo $row_user['v_message'] ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group" >
                                            <label>About Me</label>
                                             <textarea style="text-align: left;" id="summernote_profile" name="about" class="form-control" rows="3">
                                            <?php echo $row_user['v_about'] ?>
                                            </textarea>
                                        </div>


                                       <input type="hidden" name="about_id" value="<?php echo $row_user['n_about_id'] ?>">
                                       <button type="submit" name="edit_user_profile" class="btn btn-secondary mb-1" style="background-color: Blue;width:100px">Submit</button>
                            </form>
                            <div style="position: absolute;top:80px;left:600px">
                                    <div class="panel panel-info">
                                        <div class="panel-heading" style="color:red;font-weight:800;margin-left:37px;margin-bottom:5px">
                                            Image Profile
                                        </div>
                                        <div class="panel-body" align="center">
                                            <?php if(empty($row_user['v_image_url']))
                                            {
                                                ?>
                                            <img class="img-thumbnail" src="../img/profile/<?php echo $row_user['v_image_url'] ?>" alt="Hau" width="200px">
                                        <?php }
                                        else
                                        {
                                         ?>
                                        <img class="img-thumbnail" src="../img/profile/<?php echo $row_user['v_image_url'] ?>" alt="Hau" width="200px" >
                                        <?php 
                                        } ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                       
                  
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="summernote/summernote.min.js"></script>
  
</body>

</html>
<!-- end document-->
