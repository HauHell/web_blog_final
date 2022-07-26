<?php 
include "includes/database.php";
include "includes/contact.php";
include "includes/about.php";

$database =new database();
$db=$database->connect();
include "includes/check_login.php";
$new_contact = new contact($db);


if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['delete'])){
        $new_contact->n_contact_id = $_POST['contact_id'];
        if($new_contact->delete())
        {
            $flag="Delete successfully";
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
    <meta name="author" content="Hau Ngo">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>NQH Contact</title>

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

<body class="animsition" onload="loadweb()">
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
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th >Message</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                            <tr>
                                            <?php  
                                            $result =$new_contact->read();
                                            $num =$result->rowCount();
                                            if($num >0){
                                                while($row=$result->fetch())
                                                {
                                            ?>
                                                <td ><?php echo $row['n_contact_id']; ?></td>
                                                <td ><?php echo $row['v_name']; ?></td>
                                                <td ><?php echo $row['v_email']; ?></td>
                                                <td ><?php echo $row['v_subject']; ?></td>
                                                <td ><?php echo $row['v_message']; ?></td>
    
                                                <td>
                                                <button type="button" class="btn btn-secondary mb-1" name="delete" data-toggle="modal" data-target="#delete_contact<?php echo $row['n_contact_id'] ?>">Delete</button>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                        <?php  
                                          }
                                        }
                                        ?>
                                     
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
            $result = $new_contact->read();
            $num = $result->rowCount();
            if ($num > 0) {
                while ($row = $result->fetch()) {
            ?>
                    <div class="modal fade" id="delete_contact<?php echo $row['n_contact_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel">Contact</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" method="POST" action="">
                                    <div class="modal-body">
                                      <p>Are you sure you want to delete this contact? This action couldn't be restored</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="form_name" value="delete_contact">
                                        <input type="hidden" name="contact_id"  value="<?php echo $row['n_contact_id'] ?>">
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
 

</body>
<script type="text/javascript">
        function loadweb() {
                var home= document.getElementById('4');
                home.style.color="blue";
            }
    </script>
</html>
<!-- end document-->
