<?php
include 'admin/includes/contact.php';
include 'admin/includes/database.php';
include 'admin/includes/about.php';
include "admin/includes/category.php";

$database = new database;
$db =$database->connect();
$new_about = new about($db);
$new_contact =new contact($db);
$category = new category($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['send'])){
     
        $v_name =$_POST['name'];
        $v_email =$_POST['email'];
        $v_subject =$_POST['subject'];
        $v_message =$_POST['message'];
        $new_contact->v_message =$v_message;
        $new_contact->v_name =$v_name;
        $new_contact->v_subject =$v_subject;
        $new_contact->v_email =$v_email;
        if($new_contact->v_message==""|| $new_contact->v_name==""|| $new_contact->v_subject==""|| $new_contact->v_email==""){
          
        }
        else{
            $new_contact->create();
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
    <body>
        
        <!--================Header Menu Area =================-->
        <?php include 'header.php';  ?>
        <!--================Header Menu Area =================-->
        
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="box_1620">
				<div class="banner_inner d-flex align-items-center">
					<div class="container">
						<div class="banner_content text-center">
							<h2>Contact Us</h2>
							<div class="page_link">
								<a href="index.php">Home</a>
								<a href="contact.php">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area p_120">
            <div class="container">
                <div
                   style="margin-bottom:20px"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.949849184091!2d106.61956781482002!3d10.738348741961591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dd9fa888e8d%3A0x2321791a8847d2e1!2zNTkgQW4gRC4gVsawxqFuZywgUGjGsOG7nW5nIDEwLCBRdeG6rW4gNiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1658753041457!5m2!1svi!2s" width="1150" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="row">
                    <div class="col-lg-3" style="margin-right: 10px;">
                        <div class="contact_info">
                            <?php 
                            	$result = $new_about->read();
                                $num = $result->rowCount();
                                if($num >0){
                                $row =$result->fetch();
                               
                            ?>
                            <div class="info_item">
                                <i class="lnr lnr-home"></i>
                                <h6><?php echo $row['v_adress']; ?></h6>
                                <p></p>
                               
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-phone-handset"></i>
                                <h6><?php echo $row['v_phone']; ?></h6>
                                <p></p>
                               
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-envelope"></i>
                                <h6><?php echo $row['v_email']; ?></h6>
                                <p></p>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-lg-7" style="margin-left: 100px;">
                    <form method="POST" action="">
                            <div class="col-md-12 text-right">
                            <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                                <button type="submit" name="send" style="margin-left: 16px;" onclick="check_contact()" class="btn submit_btn">Send Message</button>
                            </div>
                            </form>
                      
                    </div>

                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        
        <!--================Footer Area =================-->
        <?php include 'footer.php'; ?>
        <!--================End Footer Area =================-->
        
        <!--================Contact Success and Error message Area =================-->
        <div id="success" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Thank you</h2>
                        <p>Your message is successfully sent...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals error -->

        <div id="error" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Sorry !</h2>
                        <p> Something went wrong </p>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Contact Success and Error message Area =================-->
        
        
        
        
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
        <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/counter-up/jquery.counterup.min.js"></script>
        <!-- contact js -->
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/contact.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="js/gmaps.min.js"></script>
        <script src="js/theme.js"></script>
        <script>
            function check_contact(){
                if(document.getElementById('name').value ==""){
                    alert("Please complete all information");
                }else if(document.getElementById('email').value ==""){
                    alert("Please complete all information");
                }
                else if(document.getElementById('subject').value ==""){
                    alert("Please complete all information");
                }
                else if(document.getElementById('message').value ==""){
                    alert("Please complete all information");
                }
                else{
                    alert("Thanks for contacting");
                }

            }



        </script>
    </body>
</html>