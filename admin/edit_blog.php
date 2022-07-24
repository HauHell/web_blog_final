<?php  
include "includes/database.php";
include "includes/blog.php";
include "includes/tag.php";
include "includes/category.php";


$database = new database();
$db = $database->connect();
include "includes/check_login.php";
$new_blog = new blog($db);

if(isset($_GET['id'])){
    
    $new_blog->n_blog_id = $_GET['id'];
    @$new_blog->read_single();
   
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Forms</title>

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
        <!-- HEADER MOBILE-->
    
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
   
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="card" style="margin-top: 100px; width:800px ;margin-left:50px" >
                   
                                    <div class="card-header">
                                        <strong>Edit Blog</strong>
                                    </div>
                         <div class="card-body card-block">
                             <form action="blog.php" method="POST" class="" enctype="multipart/form-data">
                                             <div class="form-group">
                                                <label class=" form-control-label">Name</label>
                                                <input type="text"  name="name" value="<?php echo $new_blog->v_name_bloger ?>" placeholder="Enter Name.." class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Title</label>
                                                <input type="text"  name="title" value="<?php echo $new_blog->v_blog_title ?>" placeholder="Enter Title.." class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Meta Title</label>
                                                <input type="text"  name="meta_title" value="<?php echo $new_blog->v_blog_meta_title ?>" placeholder="Enter Meta Title.." class="form-control">

                                            </div>

                                            <?php  
                                        $cate = new category($db);
                                        $result = $cate->read();
                                        ?>
                                        <div class="form-group">
                                            <label>Blog Categories</label>
                                            <select name="select_category"  class="form-control">
                                                <?php  
                                                while($rs = $result->fetch()){
                                                ?>
                                                <option value="<?php  echo $rs['v_category_title'] ?>">
                                                    <?php echo $rs['v_category_title'] ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                            <div class="form-group">
                                                <label class=" form-control-label">Content</label>
                                                <input type="text" id="content" name="content" value="<?php echo $new_blog->v_blog_content ?>" placeholder="Enter Content.." class="form-control">
                                            </div>
                                            <div class="form-group">
                                             <label>Main Image</label>
                                              <input type="file" name="main_image">
                                                  <?php  
                                                      if($new_blog->v_main_image_url!=""){
                                                 ?>
                                             <br>
                                              <img src="../img/blog/<?php echo $new_blog->v_main_image_url?>" width="400px">
                                                  <?php  
                                                      }
                                                    
                                                     ?>
                                                <input type="hidden" name="old_main_image" value="<?php echo $new_blog->v_main_image_url ?>">
                                           </div>

                                            <div class="form-group">
                                                <label>Alt Image</label>
                                                <input type="file" name="alt_image">
                                                <?php  
                                                if($new_blog->v_alt_image_url!=""){
                                                ?>
                                                <br>
                                                <img src="../img/blog/<?php echo $new_blog->v_alt_image_url?>" width="400px">
                                                <?php  
                                                }
                                              
                                                ?>
                                                <input type="hidden" name="old_alt_image" value="<?php echo $new_blog->v_alt_image_url?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Image</label>
                                                <input type="file" name="sub_image">
                                                <?php  
                                                if($new_blog->v_sub_image_url!=""){
                                                ?>
                                                <br>
                                                <img src="../img/blog/<?php echo $new_blog->v_sub_image_url?>" width="400px">
                                                <?php  
                                                }
                                              
                                                ?>
                                                <input type="hidden" name="old_sub_image" value="<?php echo $new_blog->v_sub_image_url?>">
                                            </div>

                                       
                                          
        
                                                <input type="hidden" name="date_created" value="<?php echo $new_blog->d_date_created?>">
                                                <input type="hidden" name="time_created" value="<?php echo $new_blog->d_time_created?>">
                                               
                                             <div class="form-group">
                                             <?php $new_tag =new tag($db);
                                                $new_tag->n_blog_id =$_GET['id'];
                                                $new_tag->read_single();
                                             
                                             ?>
                                                <label class=" form-control-label">Tag</label>
                                                <input type="text"  name="tag" value="<?php echo $new_tag->v_tag ?>" placeholder="Enter Meta Title.." class="form-control">

                                            </div>
                                                
                                            <div class="form-group">
                                            <label>Status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="opt_place" id="optionsRadiosInline1" value="0" 
                                                <?php echo $new_blog->f_post_status==0?"checked":"" ?>> 0
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="opt_place" id="optionsRadiosInline2" value="1"
                                                <?php echo $new_blog->f_post_status==1?"checked":"" ?>> 1
                                            </label>
                                          
                                        </div>
                                          
                                            <div class="form-group">
                                                <input type="hidden" value="<?php echo $new_blog->n_blog_id=$_GET['id'] ; ?>" name="blog_id">
                                             </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="update" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        
                                    </div>
                            </form>
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
    <script >
        $('#content').summernote({
            placeholder:'Blog summary',
            height:100
        });
     
    </script>

</body>

</html>
<!-- end document-->
