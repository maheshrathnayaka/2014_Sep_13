<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""><meta name="author" content="">    
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>  
<style>  
<?php require_once(APPPATH . 'assets/css/login.css'); ?>
<?php require_once(APPPATH . 'assets/css/bootstrap-custom.css'); ?>	
</style>
      <title>Login-KStore</title>
      </head>
    <body>
    <div class="container">
     <div class="well middle-load" style="border: #E6E6E6 4px solid; border-radius: 4px; margin-top: 40px;">
            <?php echo form_open('verifylogin'); ?>
            <h1 class="form-signin-heading" style="text-align: center;">KStore Login</h1>
            <div class="alert alert-info">
               Please login with your Username and Password.
            </div>
            <label for="email" class="control-label">Email</label>
            <input type="text" size="20" id="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Your email...">
            <?php echo form_error('email'); ?>
            <br/>
            <label for="password" class="control-label">Password</label>
            <input type="password" size="20" id="passoword" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Password...">
            <?php echo form_error('password'); ?>
            <!--input type="checkbox" value="remember-me"> Remember me-->
            <p>&nbsp;</p>
            <a href="<?php echo base_url(); ?>login/forgetpassword"><small>Forgot your Password ?</small></a>
            <br/>
            <p>&nbsp;</p>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
         <?php echo form_close(); ?>
      </div>
    </div>
  </body>
</html>
                                             

