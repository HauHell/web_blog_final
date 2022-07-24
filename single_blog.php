<?php 
include "admin/includes/blog.php";
include "admin/includes/tag.php";
include "admin/includes/database.php";
include "admin/includes/subcribers.php";
include "admin/includes/comment.php";
include "admin/includes/category.php";
include "admin/includes/about.php";

$database =new database;
$db=$database->connect();
$category = new category($db);
$new_blog = new blog($db);
$new_tag =new tag($db);
$new_comment = new comment($db);
$new_subcribers = new subcriber($db);
if(isset($_GET['id'])){
    $new_tag->n_blog_id= $_GET['id'];
    $new_blog->n_blog_id = $_GET['id'];
    $new_comment->n_blog_id= $_GET['id'];
    @$new_blog->read_single2();
    @$new_tag->read_single();
  
}

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
    if(isset($_POST['submit_comment'])){
        $new_comment->n_comment_parent_id=0;
        $new_comment->n_blog_id=$_GET['id'];
        $new_comment->v_comment_author_email=$_POST['c_email'];
        $new_comment->v_comment=$_POST['c_message'];
        $new_comment->d_date_created=date('y-m-d',time());
        $new_comment->d_time_created=date('h:i:s',time());
        $new_comment->create();
    }
    if(isset($_POST['submit_comment_reply'])){
        
        $new_comment->n_comment_parent_id=$_POST['blog_comment_id'];
        $new_comment->n_blog_id=$_GET['id'];
        $new_comment->v_comment_author_email=$_POST['c_email_reply'];
        $new_comment->v_comment=$_POST['c_message_reply'];
        $new_comment->d_date_created=date('y-m-d',time());
        $new_comment->d_time_created=date('h:i:s',time());
        $new_comment->create();
    }
}


?>



<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon5.png" type="image/png">
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
    <body onload="hidden_form_reply()">
        
        <!--================Header Menu Area =================-->
       <?php include "header.php" ?>
        <!--================Header Menu Area =================-->
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="box_1620">
				<div class="banner_inner d-flex align-items-center">
					<div class="container">
						<div class="banner_content text-center">
							<h2>Blog Details</h2>
							<div class="page_link">
								<a href="index.html">Home</a>
								<a href="blog.html">Blog</a>
								<a href="single-blog.html">Blog Details</a>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area p_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 posts-list">
                      
                        <div class="single-post row">
                            <div class="col-lg-12">
                                <div class="feature-img">
                                    <img class="img-fluid" style="width: 1000px;height:500px" src="img/blog/<?php echo $new_blog->v_main_image_url ?>" alt="">
                                </div>									
                            </div>
                            <div class="col-lg-3  col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <a href="#"><?php echo $new_tag->v_tag; ?></a>
                                       
                                    </div>
                                    <?php 
                                     $new_comment->n_blog_id = $_GET['id'];
                                     $row_comment =$new_comment->read_single_blog();
                                     $num_comment =$row_comment->rowCount();
                                    ?>
                                    <ul class="blog_meta list">
                                        <li><a href="#"><?php echo $new_blog->v_name_bloger; ?><i class="lnr lnr-user"></i></a></li>
                                        <li><a href="#"><?php echo $new_blog->d_date_created; ?><i class="lnr lnr-calendar-full"></i></a></li>
                                        <li><a href="#"><?php echo $new_blog->n_blog_view?><i class="lnr lnr-eye"></i></a></li>
                                        <li><a href="#"><?php echo $num_comment ?><i class="lnr lnr-bubble"></i></a></li>
                                    </ul>
                                    <ul class="social-links">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 blog_details">
                                <h2><?php echo $new_blog->v_blog_title; ?></h2>
                                <p class="excert">
                                <?php echo $new_blog->v_blog_meta_title; ?>
                                </p>
                                <p>
                                <?php echo $new_blog->v_blog_content; ?>
                                </p>
                   
                            </div>
                            <div class="col-lg-12">
                               
                                <div class="row">
                                    <div class="col-6">
                                        <img class="img-fluid" style="width: 400px;height:300px" src="img/blog/<?php echo $new_blog->v_alt_image_url ?>" alt="">
                                    </div>
                                    <div class="col-6">
                                        <img class="img-fluid" style="width: 400px;height:300px" src="img/blog/<?php echo $new_blog->v_sub_image_url ?>" alt="">
                                    </div>	
                                   							
                                </div>
                            </div>
                        </div>




                        <div class="navigation-area">
                            <div class="row">
                            
                                <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <?php 
                                    $new_blog->n_blog_id =$_GET['id'];
                                    $prev=$new_blog->read_previous();
                                    $next=$new_blog->read_next();
                                    if($previous=$prev->fetch()){
                                ?>
                                    <div  class="thumb">
                                        <a href="single_blog.php?id=<?php echo $previous['n_blog_id'] ?>">
                                        <img style="width:100px ;height:70px" class="img-fluid" src="img/blog/<?php echo $previous['v_main_image_url'] ?>" alt=""></a>
                                    </div>

                                    <div  class="detials">
                                        <p>Prev Post</p>
                                        <a href="single_blog.php?id=<?php echo $previous['n_blog_id'] ?>"><h4 ><?php echo $previous['v_blog_title'] ?></h4></a>
                                    </div>
                                <?php } ?>
                                </div>
                                
                                <div  class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <?php 
                                        if($next_blog=$next->fetch()){
                                    ?>
                                    <div class="detials" >
                                        <p>Next Post</p>
                                        <a href="single_blog.php?id=<?php echo $next_blog['n_blog_id'] ?>"><h4><?php echo $next_blog['v_blog_title'] ?></h4></a>
                                    </div>
                                   
                                    <div class="thumb" >
                                        <a href="single_blog.php?id=<?php echo $next_blog['n_blog_id']?>">
                                        <img class="img-fluid" style="width:100px ;height:70px" src="img/blog/<?php echo $next_blog['v_main_image_url'] ?>" alt=""></a>
                                    </div>	
                                    <?php }?> 										
                                </div>								
                            </div>
                        </div>
                        <div class="comments-area">
                      
                          <?php 
                           
                             ?>
                               <h4><?php
                               if($num_comment>0){
                                echo $num_comment." Comments";
                               }

                                ?></h4>

                            <div class="comment-list">
                                <?php 
                                while ($row=$row_comment->fetch()){
                                    if($row['n_comment_parent_id']==0){
                                ?>
                                <form action="" method="POST">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                       
                                        <div class="desc" style="margin-bottom:40px">
                                            <h5><a href="#"><?php echo $row['v_comment_author_email'] ;?></a></h5>
                                            <p class="date"><?php echo $row['d_date_created'] ;?> </p>
                                            <p  class="comment">
                                                <?php echo $row['v_comment']; ?>
                                            </p>
                                        </div>
                                    </div>
                                   
                                    <div  class="reply-btn">
                                           <a href="#reply" onclick="reply_comment(<?php echo $row['n_blog_comment_id']; ?>)" class="btn-reply text-uppercase">reply</a> 
                                    </div>
                                </div>
                                </form>
                                    <?php 
                                    $new_comment->n_blog_comment_id =$row['n_blog_comment_id'];
                                    $row_sub_comment =$new_comment->read_single_blog_reply();
                                    while($row_sub=$row_sub_comment->fetch()){

                                    
                                    ?>
                                <div  class="comment-list left-padding">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                           
                                            <div class="desc">
                                                <h5><a href="#"><?php echo $row_sub['v_comment_author_email'] ;?></a></h5>
                                                <p class="date"><?php echo $row_sub['d_date_created'] ;?></p>
                                                <p class="comment"><?php echo $row_sub['v_comment'] ;?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }}}?> 
                            </div>
                        
                        </div>	
                         	     
                            
                          
                        <div class="comment-form" id="respond">
                            <h4>Comment</h4>
                            <form name="c_form" onsubmit="return check_respond()" id="contactForm" method="POST" action="" autocomplete="off">
                              <fieldset>
                                    <div class="form-group form-inline">
                                
                                    <div class="form-group col-lg-6 col-md-6 email">
                                        <input type="email" name="c_email" class="form-control" id="cEmail" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"  required="">
                                    </div>										
                                    </div>
                                    <div class="form-group" style="margin-left: 15px;">
                                        <textarea class="form-control mb-10" name="c_message" rows="5" id="cMessage" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                    </div>
                                    <button type="submit" name="submit_comment" class="primary-btn submit_btn">Post Comment</button>	
                                </fieldset>
                            </form>
                        </div>

                        <div id="reply" style="padding-top: 10px">
                            <div class="comment-form">
                                <h4> Repply Comment</h4>
                                <form name="c_form_reply" onsubmit="return check_reply()" id="contactForm" method="POST" action="" autocomplete="off">
                                <fieldset>
                                        <div class="form-group form-inline">
                                    
                                        <div class="form-group col-lg-6 col-md-6 email">
                                            <input type="email" name="c_email_reply" class="form-control" id="cEmail" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"  required="">
                                        </div>										
                                        </div>
                                        <div class="form-group" style="margin-left: 15px;">
                                            <textarea class="form-control mb-10" name="c_message_reply" rows="5" id="cMessage" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                        </div>
                                        <input type="hidden" name="blog_comment_id" id="comment">
                                        <button type="submit" name="submit_comment_reply" class="primary-btn submit_btn">Post Comment</button>	
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">
                           
                        <div class="br"></div>
                                <?php 
                                        $new_about = new about($db);
                                        $result = $new_about->read();
                                        $num = $result->rowCount();
                                        if($num >0){
                                        $row =$result->fetch();
                                        ?>
                            </aside>
                            
                            <aside class="single_sidebar_widget author_widget">
                               
                                     
                                <img class="author_img rounded-circle" src="img/profile/<?php echo $row['v_image_url']  ?>" width="200px" height="300px" alt="">
                                           
                                <h4><?php echo $row['v_name']  ?></h4>
                                
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
                            <?php } ?>
                            <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Popular Posts</h3>
                                <?php 
                                
                                $result=$new_blog->read_title();
								$num = $result->rowCount();
                                
                                if($num >0){
                                    while($row = $result->fetch()){

                              
                                ?>
                                <div class="media post_item">
                                    <img src="img/blog/<?php echo $row['v_main_image_url'] ?>" width="100px" height="60px" alt="post">
                                    <div class="media-body">
                                        <a href="blog.php"><h3><?php echo $row['v_blog_title'] ?></h3></a>
                                        
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
                                    <li><a href="blog.php?page=1&key=<?php echo  $new_tag_item; ?>"><?php echo  $new_tag_item; ?></a></li>
                                   
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
        <?php include "footer.php"; ?>
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
                alert("Thanks for subscribing");
               }
               else{
                alert("Please enter your email");
               }
            }
            function check_respond(){
                if(document.c_form.c_email.value==""){
                    alert("Author email not empty");
                    document.c_form.c_email.focus();
                    return false;
                }
                if(document.c_form.c_message.value==""){
                    alert("Author message not empty");
                    document.c_form.c_message.focus();
                    return false;
                }
                return true;
            }

        </script>
        <script type="text/javascript">
            var blog_comment_id;
            function reply_comment(comment_id){
             
                blog_comment_id=comment_id;
              
                document.getElementById('respond').style.display ="none";
                document.getElementById('reply').style.display="block";

                document.getElementById('comment').value=blog_comment_id;
            }
            function hidden_form_reply(){
                document.getElementById('reply').style.display="none";
            }
            function check_reply(){
                if(document.c_form_reply.c_email_reply.value==""){
                    alert("Author email not empty");
                    document.c_form_reply.c_email_reply.focus();
                    return false;
                }
                if(document.c_form_reply.c_message_reply.value==""){
                    alert("Author message not empty");
                    document.c_form_reply.c_message_reply.focus();
                    return false;
                }
                return true;
            }



        </script>
    </body>
</html>