<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Verification</title>
        <style>
<?php
require_once (APPPATH . 'assets/css/bootstrap-theme.css');
require_once (APPPATH . 'assets/css/bootstrap-theme.min.css');
require_once (APPPATH . 'assets/css/bootstrap.css');
require_once (APPPATH . 'assets/css/bootstrap.min.css');
require_once (APPPATH . 'assets/css/custom.css');
?>
        </style>
        <script>
<?php
//require_once (APPPATH . 'assets/js/jqBootstrapValidation.js');
//require_once(APPPATH . 'assets/js/bootstrap.js');
require_once(APPPATH . 'assets/js/bootstrap.min.js');
?>
        </script>
    </head>

    <body class="body-custo ">
        <?php
        $main_nav = 'admin';
        require_once (APPPATH . 'views/common/nav_bar.php');
        ?>
        <div class="container" style=" margin:70px auto;">

            <form class="form-horizontal" id="reg-form" role="form" action="<?php echo base_url(); ?>/check_seller/check" method="post">

                <div class="row">


                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Check Seller</b></h3>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label> 
                                <div class="input-group">
                                    <input type="text" id="email" name="email" class="form-control input-sm">
                                    <button style="margin-top:10px ;" type="Submit" class="btn btn-success " value="Submit">Check</button>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>
            </form>
        </div>

    </body>
</html>