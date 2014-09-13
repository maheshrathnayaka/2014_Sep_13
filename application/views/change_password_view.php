<!DOCTYPE html>
<html>
    <head>        
        <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""><meta name="author" content="">    
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>  

        <title>Reset Password</title>      
    </head>
    <body>
        <div class="container cont-cust">
            <div class="row forgotdiv">
                <form class="form-horizontal well" method="post" id="form" action="/login/changepassword">
                    <div class="row">
                        <legend style="padding-left: 10px;">Change your password from here</legend>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label"> Email address</label>
                            <div class="col-xs-4">
                                <p class="form-control-static"><?php echo $email; ?></p>
                                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newpassword" class="col-sm-2 control-label"> New Password</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="password" id="newpass" name="newpass" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confpassword" class="col-sm-2 control-label"> Confirm Password</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="password" id="confpass" name="confpass" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
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
                </form>
            </div>
        </div>
    </body>        
</html>