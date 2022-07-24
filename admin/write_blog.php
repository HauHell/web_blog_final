<?php  
include "includes/database.php";
include "includes/blog.php";
include "includes/tag.php";
include "includes/category.php";

$database = new database();
$db = $database->connect();
include "includes/check_login.php";
$new_blog = new blog($db);
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
    <title>NQH Write a Blog</title>

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

<body class="animsition" onload="loadweb()">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
    <?php include "header.php"; ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include "menu.php"; ?>>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="card" style="margin-top: 100px; width:800px ;margin-left:50px" >
                   
                                    <div class="card-header">
                                        <strong>Write Blog</strong>
                                    </div>
                         <div class="card-body card-block">
                             <form action="blog.php" method="POST" class="blog.php" enctype="multipart/form-data">
                                             <div class="form-group">
                                                <label class=" form-control-label">Name</label>
                                                <input type="text"  name="name" value="" placeholder="Enter Name.." class="form-control">

                                            </div>
                                            <div class="form-group" >
                                                <label class=" form-control-label">Title</label>
                                                <input type="text"  name="title" value="" placeholder="Enter Title.." class="form-control">

                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Meta Title</label>
                                                <input type="text"  name="meta_title" value="" placeholder="Enter Meta Title.." class="form-control">

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
                                                <input type="text" id="content" name="content" value="" placeholder="Enter Content.." class="form-control">
                                            </div>
                                            <div class="form-group">
                                            <label>Main Image</label>
                                            <input type="file" name="main_image">
                                            
                                            </div>

                                            <div class="form-group">
                                                <label>Alt Image</label>
                                                <input type="file" name="alt_image">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Image</label>
                                                <input type="file" name="sub_image">
                                                
                                            </div>
                                          
                                             <div class="form-group">
                                                <label class=" form-control-label">Tag</label>
                                                <input type="text"  name="tag" value="" placeholder="Enter Tag.." class="form-control">
                                            </div>

                                          
                                    
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="create" class="btn btn-primary btn-sm">
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
<script type="text/javascript">
        function loadweb() {
                var home= document.getElementById('3');
                home.style.color="blue";
            }
    </script>
</html>
<!-- end document-->
