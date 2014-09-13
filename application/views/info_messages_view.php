<!DOCTYPE html>
<html>
    <head>        
        <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""><meta name="author" content="">    
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>  

        <title><?php echo $title; ?></title>      
    </head>
    <body>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            
            <div class="row forgotdiv">
                <h2><?php echo $heading_msg; ?></h2><hr>
                <br>
                <div class="row">                        
                        <?php if (isset($info)): ?>
                            <div class="alert alert-success col-md-8">
                                <?php echo($info) ?>
                            </div>
                        <?php elseif (isset($error)): ?>
                            <div class="alert alert-danger col-md-8">
                                <?php echo($error) ?>
                            </div>
                        <?php endif; ?>
                </div>                
            </div>
        </div>
    </body>        
</html>