<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Advanced Search</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div>
                <h3>Advanced search</h3>
            </div>
            <div class="panel panel-info col-lg-2" style="padding: 0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Items</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search">Find Items</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search/by_seller">By Seller</a>
                        </li>
                    </ul>
                </div>
                
                <div class="panel-heading" style="margin-top: 5px;">
                    <h3 class="panel-title">Members</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search/by_member">Find a Member</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-info col-lg-9" style="padding: 0px; margin-left: 20px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Find a member</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <form role="form" class="form" method="POST" action="<?php echo base_url(); ?>advanced_search/search_items_by_name">
                        <div class="form-group form-horizontal">
                            <label for="InputKeyword">Enter email address or name</label>
                            <input type="text" name="find_name_email" required class="form-control col-lg-9" id="InputKeyword" placeholder="Enter email or name...">
                        </div>
                        <div class="clearfix"></div><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
