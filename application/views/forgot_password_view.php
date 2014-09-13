<!DOCTYPE html>
<html>
    <head>        
        <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""><meta name="author" content="">    
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>  

        <title>Forgotten Password</title>      
    </head>
    <body>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="row forgotdiv">
                <form class="form-horizontal well" method="post" id="form" action="/login/resetpassword">
                    <div class="row">
                        <h3 style="padding-left: 10px;">Reset password</h3>
                        <hr class="hr-color"> <br>
                        <h5 style="padding-left: 10px;">Have you forgotten your password ? Please enter your email address below. We will send you an email to reset your password.</h5><br><br>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label"> Email address</label>
                            <div class="col-xs-4">
                                <input class="form-control" type="email" id="forgotemail" name="forgotemail" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Get Password Reset Link</button>
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