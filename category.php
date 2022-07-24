<?php 
include "admin/includes/blog.php";
include "admin/includes/tag.php";
include "admin/includes/database.php";
include "admin/includes/subcribers.php";
include "admin/includes/category.php";
include "admin/includes/comment.php";

$database = new database();
$db = $database->connect();
$category = new category($db);
$new_comment = new comment($db);
$new_blog = new blog($db);
$new_tag =new tag($db);
$new_subcribers = new subcriber($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['created_sub'])){
        $sub_email =$_POST['sub_email'];
        $new_subcribers->v_sub_email =$sub_email;
        $new_subcribers->d_date_created = date("Y/m/d",time());
        $new_subcribers->d_time_created = date("h:i:s",time());
        if($sub_email==""){
            
        }  
        else if($new_subcribers->create()){
      }
    }
}


?>




<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>MeetMe Personal</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
       <?php include "header.php"; ?>
        <!--================Header Menu Area =================-->
        
        <!--================Home Banner Area =================-->
        <section class="home_banner_area blog_banner" >
            <div class="banner_inner d-flex align-items-center" style="background-image: url('../meetme/img/blog/admin.jpg');background-size: cover;">
            	<div data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="blog_b_text text-center">
						<h2>MEETME  <br /> </h2>
						<p> Helps you discover new destinations, organise your trips and share your travel experiences.</p>
						
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Blog Categorie Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row">
                   
                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
        
        <!--================Blog Area =================-->
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog_left_sidebar">
                        <?php 
                                        $get_page = isset($_GET['page'])?$_GET['page']:1;
                                        $begin = (3* $get_page)-3;
                                        
                                        if(empty($_POST['key'])){
                                            $result=$new_blog->read_category($_GET['title']);
                                        }
                                        else{
                                            $result=$new_blog->read_search($_POST['key']);
                                        }
                                       
									   $num = $result->rowCount();
                                       if($num>0){
                                           while($row1 =$result->fetch()) {
                                          
                                     ?>
                            <article class="row blog_item">
                           
                               <div class="col-md-3">
                                   <div class="blog_info text-right">
                                      <?php $new_tag->n_blog_id =$row1['n_blog_id'];
                                          $new_tag->read_single();
                                          $new_comment->n_blog_id = $row1['n_blog_id'];
                                          $row_comment =$new_comment->read_single_blog();
                                          $num_comment =$row_comment->rowCount(); 
                                      ?>
                                        <div class="post_tag">
                                            <a href="#"><?php echo $new_tag->v_tag; ?></a>
                                            
                                        </div>
                                       
                                            
                                         <ul class="blog_meta list">
                                            <li><a href="#"><?php echo $row1['v_name_bloger']?><i class="lnr lnr-user"></i></a></li>
                                            <li><a href="#"><?php echo $row1['d_date_created']?><i class="lnr lnr-calendar-full"></i></a></li>
                                            <li><a href="#"><?php echo $row1['n_blog_view']?><i class="lnr lnr-eye"></i></a></li>
                                          
                                            <li><a href="#"><?php echo $num_comment ?><i class="lnr lnr-bubble"></i></a></li>
                                        </ul>
                                    </div>
                               </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="../meetme/img/blog/<?php echo $row1['v_main_image_url'];?>" alt="">
                                        <div class="blog_details">
                                            <a href="single-blog.html"><h2><?php echo $row1['v_blog_title']?></h2></a>
                                            <p><?php echo $row1['v_blog_meta_title']?></p>
                                            <a href="http://127.0.0.1:8080/webthicuoiki/meetme/single_blog.php?id=<?php echo $row1['n_blog_id']?>" class="white_bg_btn" 
                                           >View More</a>
                                        </div>
                                    </div>
                                </div>
                               
                            </article>
                            <?php } 
                                } ?>
                            <nav class="blog-pagination justify-content-center d-flex">
		                        <ul class="pagination">
		                          
		                        </ul>
		                    </nav>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                                <form action="" method="POST">
                                    <div class="input-group">
                                        <input name="key" type="text" class="form-control" placeholder="Search Posts">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                        </span>
                                    </div><!-- /input-group -->
                                </form>
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget author_widget">
                                <img class="author_img rounded-circle" src="img/profile/avatar2.jpg" width="200px" height="300px" alt="">
                                <h4>Ngo Quang Hau</h4>
                                <p>Senior blog writer</p>
                                <div class="social_icon">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-github"></i></a>
                                    <a href="#"><i class="fa fa-behance"></i></a>
                                </div>
                                <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits detractors.</p>
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Popular Posts</h3>
                                <?php 
                                
                                $result=$new_blog->read_title();
								$num = $result->rowCount();
                                
                                if($num >0){
                                    while($row = $result->fetch()){

                              
                                ?>
                                <div class="media post_item" >
                                 <a href="http://127.0.0.1:8080/webthicuoiki/meetme/single_blog.php?id=<?php echo $row['n_blog_id'] ?>"><img src="../meetme/img/blog/<?php echo $row['v_main_image_url'] ?>" width="100px" height="60px" alt="post">
                                </a>
                                    <div class="media-body">
                                        <a href="http://127.0.0.1:8080/webthicuoiki/meetme/single_blog.php?id=<?php echo $row['n_blog_id'] ?>"><h3><?php echo $row['v_blog_title'] ?></h3></a>
                                        <p><?php echo $row['d_time_created'] ?></p>
                                    </div>
                                </div>
                             <?php  
                             }}
                             ?>
                                
                                <div class="br"></div>
                            </aside>
                            <aside class="single_sidebar_widget ads_widget">
                                <a href="https://www.nike.com/vn/t/air-zoom-pegasus-39-road-running-shoes-kmZSD6/DH4071-003" target="_blank"><img class="img-fluid" src="img/profile/ads.gif" alt=""></a>
                                <div class="br"></div>
                            </aside>
                        
                            <aside class="single-sidebar-widget newsletter_widget">
                                <h4 class="widget_title">Newsletter</h4>
                                <p>
                                Here, I focus on a range of items and features that we use in life without
                                giving them a second thought.
                                </p>
                                <form class="form-group d-flex flex-row"   role="form" method="POST" action="">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                        </div>
                                        <input type="text" name="sub_email" id="mail" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                    </div>
                                    <button type="submit" name="created_sub" style="background-color:#007bff; color:#fff;" onclick="checksub()">Subcribe</button>
                                    
                            </form>	
                     
                                <p class="text-bottom">You can unsubscribe at any time</p>	
                                <div class="br"></div>							
                            </aside>
                            <aside class="single-sidebar-widget tag_cloud_widget">
                                <h4 class="widget_title">Tag Clouds</h4>
                                <ul class="list">
                                    <?php $result =$new_tag->read();
                                            $num =$result->rowCount();
                                            if($num >0){
                                                while( $row= $result->fetch())
                                                {
                                                    $new_tag_arr = explode(',', $row['v_tag']);
                                                 
                                                      foreach ($new_tag_arr as $new_tag_item) {
                                                       
                                                   
                                    ?>
                                    <li><a href="#"><?php echo  $new_tag_item; ?></a></li>
                                   
                                   <?php }}
                                    }
                                    ?>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>
        <!--================Blog Area =================-->
        
        <!--================Footer Area =================-->
       <?php include 'footer.php'; ?>>
        <!--================End Footer Area =================-->
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/counter-up/jquery.counterup.min.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/theme.js"></script>
        <script >
            function checksub(){
                if(document.getElementById("mail").value!=""){
                alert("Bạn đã đăng kí thành công");
               }
               else{
                alert("Bạn chưa nhập thông tin email");
               }
            }
            function checkpage(){
              
               var home= document.getElementById('<?php echo $get_page   ?>');
            
              home.style.backgroundColor="black";
              var next =document.getElementById('a<?php echo $_GET['page'] ?>').value;
              var prev =document.getElementById('b<?php echo $_GET['page'] ?>').value;
              var totalnext =document.getElementById('a<?php echo $_GET['page'] ?>');
              var totalprev =document.getElementById('b<?php echo $_GET['page'] ?>');
               if(next == <?php echo $total_pages?>){
                  totalnext.style.display="none";
               }
               if(prev == 1){
                  totalprev.style.display="none";
               }


              
            }

        </script>
    </body>
</html>