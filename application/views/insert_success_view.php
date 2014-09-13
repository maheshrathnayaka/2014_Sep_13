<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <?php
        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
        ?>
        <title>My Account</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">

        <?php $main_nav = 'my account' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="col-md-2" style="border-right: 1px solid #E6E6E6; min-height: 100vh; padding-right: 10px;">
                <?php $account = 'public'; ?>
                <?php require_once (APPPATH . 'views/common/nav_my_account.php'); ?>
            </div>
            <div class="col-md-10"  id="container">
                <div class="container">
                    <center><h4>Subscribed successfully !</h4></center>
                    <a href="<?php echo base_url(); ?>my_subscriptions"><button type="button" class="btn btn-primary">Go Back</button></a>
                </div>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
