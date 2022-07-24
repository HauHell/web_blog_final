


<header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
								<li class="nav-item"><a class="nav-link" href="about.php">About</a></li> 
								<li class="nav-item submenu dropdown">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category</a>
								
									<ul class="dropdown-menu">
									<?php
									
									$result =$category->read();
									$num = $result->rowCount();
									if($num >0){
										while($row=$result->fetch()){

									
									?>
										<li class="nav-item"><a class="nav-link" href="category.php?title=<?php echo $row['v_category_title'] ?>"><?php echo $row['v_category_title'] ?></a></li>
										<?php
										
									}
										}
									?>
									</ul>
								
								</li> 
								<li class="nav-item active"><a class="nav-link" href="blog.php?page=1">Blog</a></li>  
								<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
							</ul>
						</div> 
					</div>
            	</nav>
            </div>
        </header>