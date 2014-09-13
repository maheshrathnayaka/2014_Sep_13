<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Kstore Management Panel</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            
            
             <div class="panel panel-primary">

                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Kstors Management</b></h3>
                    </div>
                    <div class="panel-body">
                       
                        <a href="http://kstoretesting.net16.net/new_k_store_management">
                            <div class="col-lg-3">
                                <div class="alert alert-danger text-left">
                                    <i class="fa fa-home fa-3x"></i>
                                    <b>Add KStore</b>
                                </div>
                            </div>
                        </a>
                        <a href="http://kstoretesting.net16.net/delete_k_store">
                            <div class="col-lg-3">
                                <div class="alert alert-danger text-left">
                                    <i class="fa fa-times fa-3x"></i>
                                    <b>Remove KStore</b>
                                </div>
                            </div>
                        </a>

                    </div>
              </div>
            
           
             
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
