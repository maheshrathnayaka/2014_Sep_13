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
                <?php $account = 'subscription'; ?>
                <?php require_once (APPPATH . 'views/common/nav_my_account.php'); ?>
            </div>
            <div class="col-md-10"  id="container">
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs col-md-9" >
                        <?php if (isset($redirect)) { ?>
                            <li><a href="#view_subscriptions" data-toggle="tab">My Subscriptions</a></li>
                            <li class="active"><a href="#change_subscriptions" data-toggle="tab">Change Subscriptions</a></li>
                        <?php } else { ?>
                            <li class="active"><a href="#view_subscriptions" data-toggle="tab">My Subscriptions</a></li>
                            <li><a href="#change_subscriptions" data-toggle="tab">Change Subscriptions</a></li>
                        <?php }
                        ?>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content col-md-9">
                        <?php if (isset($redirect)) { ?>
                            <div class="tab-pane fade in" id="view_subscriptions">
                            <?php } else { ?>
                                <div class="tab-pane fade in active" id="view_subscriptions">
                                <?php }
                                ?>
                                <br>
                                <div style=" border: 1px solid #E6E6E6; padding: 30px;">
                                    <?php
                                    if (isset($subscribe_category)) {
                                        foreach ($subscribe_category as $row) {
                                            $category_name = $row['categoryname'];
                                            ?>
                                            <h4><span class="label label-info"><?php echo $category_name; ?></span></h4>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php if (isset($redirect)) { ?>
                                <div class="tab-pane fade in active" id="change_subscriptions">
                                <?php } else { ?>
                                    <div class="tab-pane fade in" id="change_subscriptions">
                                    <?php }
                                    ?>
                                    <br>
                                    <?php
                                    if (isset($redirect)) {
                                        ?>
                                        <div class="alert alert-success">Subscriptions updated successfully !</div>
                                    <?php }
                                    ?>
                                    <div style=" border: 1px solid #E6E6E6; padding: 30px;">
                                        <form role="form" action="<?php echo base_url(); ?>my_subscriptions/subscriptions" class="form-horizontal" method="POST">
                                            <?php
                                            if (isset($category)) {
                                                foreach ($category as $row) {
                                                    $category_id = $row->categoryid;
                                                    $category_name = $row->categoryname;
                                                    ?>
                                                    <div class="row">
                                                        <label class="" for="<?php echo $category_id; ?>"><input type="checkbox" name="<?php echo $category_id; ?>" id="<?php echo $category_id; ?>" value="<?php echo $category_id; ?>"><?php echo $category_name; ?></label>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <hr>
                                            <div class="row">
                                                <input type="submit" class="btn btn-primary" data-placement="top" value="Subscribe">
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

                </body>
                </html>
