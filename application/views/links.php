<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
    </head>
    <?php if ($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['is_admin'] == 'yes') { ?>
        <body class="body-custom">
            <?php
            $main_nav = 'admin';
            require_once (APPPATH . 'views/common/nav_bar.php');
            ?>
            <div class="container cont-cust">
                <div class="container" style="width:900px; margin:30px auto;">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Admin Panel</b></h3>
                        </div>
                        <div class="panel-body">
                            <!--<h4><a href="<?php // echo base_url("/admin_dash/category");     ?>">Category Management</a></h4>-->
                            <!--<h4><a href="<?php // echo base_url("/adminadreview");     ?>">Ad Review</a></h4>-->
                            <!--<h4><a href="<?php // echo base_url("//check_seller");     ?>">Seller Verification</a></h4>-->
                            <!--<h4><a href="<?php // echo base_url("//k_store_management");     ?>">KStore Management</a></h4>-->
                            <!--<h4><a href="<?php // echo base_url("/send_news_letters");     ?>">Send News Letters</a></h4>-->
                            <!--<h4><a href="<?php // echo base_url("/user_management");     ?>">User Management</a></h4>-->
    <!--                        <h4><a href="<?php // echo base_url("/orders");     ?>">Order History</a></h4>-->
                            <a href="<?php echo base_url("/admin_dash/category"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-pencil fa-3x"></i><b> Category Management</b></div></div></a>
                            <a href="<?php echo base_url("/adminadreview"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-eye fa-3x"></i><b> Ad Review</b></div></div></a>
                            <a href="<?php echo base_url("//check_seller"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-certificate fa-3x"></i><b> Seller Verification</b></div></div></a>
                            <a href="<?php echo base_url("//k_store_manage_panel"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-home fa-3x"></i><b> KStore Management</b></div></div></a>
                            <a href="<?php echo base_url("/send_news_letters"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-envelope fa-3x"></i><b> Send News Letters</b></div></div></a>
                            <a href="<?php echo base_url("/user_management"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-user fa-3x"></i><b> User Management</b></div></div></a>
                            <a href="<?php echo base_url("/orders"); ?>"><div class="col-lg-4"><div class="alert alert-danger text-left"><i class="fa fa-calendar fa-3x"></i><b> Order History</b></div></div></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
        </body>
    <?php
    } else {
        echo 'Forbidden Access';
    }
    ?>
</html>

