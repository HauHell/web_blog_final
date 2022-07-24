
<section class="home_banner_area">
           	<div class="container box_1620">
           		<div class="banner_inner d-flex align-items-center">
					<div class="banner_content">
						<div class="media">
							<?php 
									$result = $new_about->read();
									$num = $result->rowCount();
									if($num >0){
									$row =$result->fetch();
									?>
							<div class="d-flex">
								<img height="800px" width="500px" src="img/profile/<?php echo $row['v_image_url'] ?>" alt="">
							</div>
							
							<div class="media-body">
								<div class="personal_text">
									
									<h6>Hello Everybody, i am</h6>
									<h3><?php echo $row['v_name']; ?></h3>
									<h4><?php echo $row['v_business']; ?></h4>
									<p><?php echo $row['v_message']; ?></p>
									<ul class="list basic_info">
										<li><a href="#"><i class="lnr lnr-calendar-full"></i><?php echo $row['d_date_born']; ?></a></li>
										<li><a href="#"><i class="lnr lnr-phone-handset"></i> <?php echo $row['v_phone']; ?></a></li>
										<li><a href="#"><i class="lnr lnr-envelope"></i><?php echo $row['v_email']; ?></a></li>
										<li><a href="#"><i class="lnr lnr-home"></i> <?php echo $row['v_adress']; ?></a></li>
									</ul>
									<ul class="list personal_social">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
		<section class="welcome_area p_120">
        	<div class="container">
        		<div class="row welcome_inner">
        			<div class="col-lg-6">
        				<div class="welcome_text">
        					<h4>About Myself</h4>
        					<p> <?php echo $row['v_about'] ;}?></p>
        					<div class="row">
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-database"></i>
        								<h4>$2.5M</h4>
        								<p>Total Donation</p>
        							</div>
        						</div>
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-book"></i>
        								<h4>30</h4>
        								<p>Total Projects</p>
        							</div>
        						</div>
        						<div class="col-md-4">
        							<div class="wel_item">
        								<i class="lnr lnr-users"></i>
        								<h4>100</h4>
        								<p>Total Volunteers</p>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-6">
        				<div class="tools_expert">
        					<div class="skill_main">
								<div class="skill_item">
									<h4>After Effects <span class="counter">70</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Winform <span class="counter">90</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>C# <span class="counter">70</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Web <span class="counter">95</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Access <span class="counter">90</span>%</h4>
									<div class="progress_br">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Welcome Area =================-->
        
        <!--================My Tabs Area =================-->
        <section class="mytabs_area p_120">
        	<div class="container">
        		<div class="tabs_inner">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Experiences</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Education</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<ul class="list">
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>February 2022 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Participating in Microsoft's CongDanSo project<br />Ho Chi Minh, Viet Nam</p>
										</div>
									</div>
								</li>
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>October 2020 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Designing vaccination software <br />Ho Chi Minh, Viet Nam</p>
										</div>
									</div>
								</li>
								<li>
								<span></span>
									<div class="media">
										<div class="d-flex">
											<p>January 2021 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Design your own website <br />Ho Chi Minh, Viet Nam</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<ul class="list">
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>August 2021 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Learn language PHP, SQL <br />HCE Economic College, Ho Chi Minh</p>
										</div>
									</div>
								</li>
								<li>
									<span></span>
									<div class="media">
										<div class="d-flex">
											<p>March 2020 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Learn Winform, Access, Web  <br />HCE Economic College, Ho Chi Minh</p>
										</div>
									</div>
								</li>
								<li>
								<span></span>
									<div class="media">
										<div class="d-flex">
											<p>January 2019 to present</p>
										</div>
										<div class="media-body">
											<h4>Achievement</h4>
											<p>Learn language C,C#<br />HCE Economic College, Ho Chi Minh</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
        		</div>
        	</div>
        </section>
        <!--================End My Tabs Area =================-->
        
        <!--================Feature Area =================-->
        <section class="feature_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>offerings to my clients</h2>
        			<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        		</div>
        		<div class="feature_inner row">
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
						<img src="img/project/web.PNG" style="width: 250px;height:200px; margin-bottom:20px;margin-left:20px">
							
        					<h4 style="text-align: center;">Web</h4>
										
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
						<img src="img/project/winform.PNG" style="width: 250px;height:200px; margin-bottom:20px;margin-left:20px">
        					<h4 style="text-align: center;">Winform</h4>
        					
        				</div>
        			</div>
        			<div class="col-lg-4 col-md-6">
        				<div class="feature_item">
						<img src="img/project/access.PNG" style="width: 250px;height:200px; margin-bottom:20px;margin-left:20px">
        					<h4 style="text-align: center;">Access</h4>
        					
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Feature Area =================-->
        
        <!--================Home Gallery Area =================-->
       
        <!--================End Home Gallery Area =================-->
        
        <!--================Testimonials Area =================-->
        <section class="testimonials_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Testimonials</h2>
        			<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        		</div>
        		<div class="testi_inner">
					<div class="testi_slider owl-carousel">
						<div class="item">
							<div class="testi_item">
								<p>Suitable For Individuals, Organizations With Little Use Needs</p>
								<h4>BASIC</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>Suitable for Small and Medium Enterprises</p>
								<h4>PROFESSIONAL</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>Suitable For Businesses, Large Corporations</p>
								<h4>VIP</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
							</div>
						</div>
					</div>
        		</div>
        	</div>
        </section>