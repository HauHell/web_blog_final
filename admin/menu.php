<?php
include "includes/about.php";

$new_user = new about($db);

$new_user->n_about_id = $_SESSION['user_id'];
$new_user->read_single();

?>

<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                <div class="header-button">

                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image" style="width: 50px;height:50px ;">
                                <img src="../img/profile/<?php echo $new_user->v_image_url ?>" alt="" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"><?php echo $new_user->v_name ?></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="../img/profile/<?php echo $new_user->v_image_url ?>" alt="" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#"><?php echo $new_user->v_name ?></a>
                                        </h5>
                                        <span class="email"><?php echo $new_user->v_email ?></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="edit_user_profile.php">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>

                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="logout.php">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>