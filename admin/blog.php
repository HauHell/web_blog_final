<?php 
include "includes/database.php";
include "includes/blog.php";
include "includes/tag.php";
include "includes/about.php";
$database =new database();
$db=$database->connect();

include "includes/check_login.php";

$new_blog = new blog($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['update'])){
       
      
      
        // Xu ly main_image
        $target_file = "../img/blog/";
      
      
        if(!empty($_FILES['main_image']['name'])){
            $main_image = $_FILES['main_image']['name'];
            move_uploaded_file($_FILES['main_image']['tmp_name'], $target_file.$main_image);
        }else{
            $main_image="";
        }

        // Xu ly alt_image
        if(!empty($_FILES['alt_image']['name'])){
            $alt_image = $_FILES['alt_image']['name'];
            move_uploaded_file($_FILES['alt_image']['tmp_name'], $target_file.$alt_image);
        }else{
            $alt_image="";
        }
        if(!empty($_FILES['sub_image']['name'])){
            $sub_image = $_FILES['sub_image']['name'];
            move_uploaded_file($_FILES['sub_image']['tmp_name'], $target_file.$sub_image);
        }else{
            $sub_image="";
        }
        if($main_image==""){
            $main_image =$_POST['old_main_image'];
        }
        if($alt_image==""){
            $alt_image =$_POST['old_alt_image'];
        }
        if($sub_image==""){
            $sub_image =$_POST['old_sub_image'];
        }
      
        //Params
        $opt=empty($_POST['opt_place'])?0:$_POST['opt_place'];
        $new_blog->v_blog_category = $_POST['select_category'];
        $new_blog->n_blog_id = $_POST['blog_id'];
        $new_blog->v_blog_title = $_POST['title'];
        $new_blog->v_blog_meta_title = $_POST['meta_title'];
        $new_blog->v_blog_content = $_POST['content'];
        $new_blog->v_name_bloger = $_POST['name'];
        $new_blog->v_main_image_url = $main_image;
        $new_blog->v_alt_image_url = $alt_image;
        $new_blog->v_sub_image_url = $sub_image;
        $new_blog->f_post_status = $opt;
        $new_blog->d_date_created = date("Y-m-d",time());
        $new_blog->d_time_created = date("h:i:s",time());
       
   
        
        //check update
        if(@$new_blog->update()){
        $flag="Update Successfully!";
        $new_tag =new tag($db);
        $new_tag->n_blog_id=$_POST['blog_id'];
        $new_tag->v_tag=$_POST['tag'];
        $new_tag->updatetag();
       
        }
        if($new_blog->v_main_image_url==""){
            $new_blog->v_main_image_url==$_POST['old_main_image'];
        }
    }
    if(isset($_POST['delete'])){
     
        $new_tag = new tag($db);
        $new_tag->n_blog_id = $_POST['blog_id'];
        if($new_tag->delete()){
            $flag = "Delete successful!";
        } 
        
        if($_POST['main_image']!=""){
            unlink("../img/blog/".$_POST['main_image']);
        }

        if($_POST['alt_image']!=""){
            unlink("../img/blog/".$_POST['alt_image']);
        }
        if($_POST['sub_image']!=""){
            unlink("../img/blog/".$_POST['sub_image']);
        }

        $new_blog->n_blog_id =  $_POST['blog_id'];
   
        if($new_blog->delete()){
            $flag = "Delete successful!";
        }    
        
    
    }
     if(isset($_POST['create'])){

        $target_file = "../img/blog/";
       
        if(!empty($_FILES['main_image']['name'])){
            $main_image = $_FILES['main_image']['name'];
            move_uploaded_file($_FILES['main_image']['tmp_name'], $target_file.$main_image);
        }else{
            $main_image="";
        }

        // Xu ly alt_image
        if(!empty($_FILES['alt_image']['name'])){
            $alt_image = $_FILES['alt_image']['name'];
            move_uploaded_file($_FILES['alt_image']['tmp_name'], $target_file.$alt_image);
        }else{
            $alt_image="";
        }
        if(!empty($_FILES['sub_image']['name'])){
            $sub_image = $_FILES['sub_image']['name'];
            move_uploaded_file($_FILES['sub_image']['tmp_name'], $target_file.$sub_image);
        }else{
            $sub_image="";
        }

   
        $new_blog->v_blog_category = $_POST['select_category'];
        $new_blog->v_blog_title = $_POST['title'];
        $new_blog->v_blog_meta_title = $_POST['meta_title'];
        $new_blog->v_blog_content = $_POST['content'];
        $new_blog->v_name_bloger = $_POST['name'];
        $new_blog->v_main_image_url = $main_image;
        $new_blog->v_alt_image_url = $alt_image;
        $new_blog->v_sub_image_url = $sub_image;
        $new_blog->f_post_status = 1;
        $new_blog->n_blog_view=0;
        $new_blog->d_date_created = date("Y-m-d",time());
        $new_blog->d_time_created = date("h:i:s",time());
       
        if($new_blog->create()){
            $flag = "Write successful!";            
        }
        
        //Write blog tag
        $new_tag = new tag($db);
        $new_tag->n_blog_id = $new_blog->last_id();
        $new_tag->v_tag = $_POST['tag'];
        $new_tag->create();
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
    <meta name="author" content="Hau Ngo">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>NQH Blog</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
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

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition"  onload="loadweb()">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
    
  <?php include 'header.php'; ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">
      
            <!-- HEADER DESKTOP-->
            <?php include "menu.php"; ?>>
            <!-- END HEADER DESKTOP-->
            <!--Form-->
     <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <?php 
                    if(isset($flag)){

                ?>
                    <div class="alert alert-success">
                        <strong ><?php echo $flag ?></strong>
                    </div>                        
                <?php 
                    }
                ?>
                    <form action="" method="POST" class="" enctype="multipart/form-data">
                        <div class="row">
                       
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                      
                                        <thead>
                                            <tr>
                                           
                                                <th>ID</th>
                                                <th >Name</th>
                                                <th>Title</th>
                                                <th>Meta Title</th>
                                                <th >Image</th>
                                                <th >Date Created</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $result =$new_blog->read();
                                        $num =$result->rowCount();
                                        if($num >0){
                                            while($row = $result->fetch())
                                            {   
                                             
                                        ?>
                                        
                                        <tbody>
                                            <tr>
                                                <td ><?php echo $row['n_blog_id'] ;?></td>
                                                <td><?php echo $row['v_name_bloger'] ;?></td>
                                                <td><?php echo $row['v_blog_title'] ;?></td>
                                                <td ><?php echo $row['v_blog_meta_title']; ?></td>
                                                <td ><?php echo $row['v_main_image_url'] ;?></td>
                                                <td ><?php echo $row['d_date_created'] ;?></td>
                                                <input type="hidden" name="main_image" value="<?php echo $row['v_main_image_url'] ?>">
                                                <input type="hidden" name="alt_image" value="<?php echo $row['v_alt_image_url'] ?>">
                                                <input type="hidden" name="sub_image" value="<?php echo $row['v_sub_image_url'] ?>">
                                                
                                                <td class="text-right"> <button type="button" onclick="location.href='../single_blog.php?id=<?php echo $row['n_blog_id']?>'" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#smallmodal">	Views </button>
                                              <button type="button" class="btn btn-secondary mb-1" onclick="location.href='edit_blog.php?id=<?php echo $row['n_blog_id']?>'" data-toggle="modal" data-target="#smallmodal">	Edit </button>
                                               <button type="button" class="btn btn-secondary mb-1" name="delete"  data-toggle="modal" data-target="#delete<?php echo $row['n_blog_id'] ?>">Delete </button></td>
                                             
										    
                                            </tr>
                                           
                                        </tbody>
                                        
                                        <?php } } ?>
                                    </table>
                                </div>
                            </div>
                      
                       
                        </div>
                        </form>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $result = $new_blog->read();
            $num = $result->rowCount();
            if ($num > 0) {
                while ($row = $result->fetch()) {
            ?>
                    <div class="modal fade" id="delete<?php echo $row['n_blog_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel">Blog</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" method="POST" action="">
                                    <div class="modal-body">
                                      <p>Are you sure you want to delete this blog? This action couldn't be restored</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="form_name" value="delete">
                                        <input type="hidden" name="main_image" value="<?php echo $row['v_main_image_url'] ?>">
                                         <input type="hidden" name="alt_image" value="<?php echo $row['v_alt_image_url'] ?>">
                                         <input type="hidden" name="sub_image" value="<?php echo $row['v_sub_image_url'] ?>">
                                        <input type="hidden" name="blog_id"  value="<?php echo $row['n_blog_id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="delete" class="btn btn-primary">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

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
    <script> 
   
</script>

</body>

    <script type="text/javascript">
        function loadweb() {
                var home= document.getElementById('2');
                home.style.color="blue";
            }
    </script>
</html>
<!-- end document-->
