<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get started with Kstore</title>

        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust" style="text-align: center;">
            <hr>
            <h1><span class="glyphicon glyphicon-ok" style="color: green"></span>&nbsp;&nbsp;Welcome to Kstore, <?php echo $first_name ?>!</h1>
            <hr>
            <div>
                <br>
                <h3> You are almost there...<br>
                    <br>
                    We have sent an confirmation email to <b><?php echo $email ?>.</b><br>
                    Confirm your email address to complete registration.<br>
                    <br>
                    <a href='<?php echo base_url(); ?>'>Go to Home Page</a>
                </h3>
            </div>

        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
    </body>
</html>	