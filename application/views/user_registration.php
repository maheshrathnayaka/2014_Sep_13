<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get started with Kstore</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>


    </head>
    <?php if ($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['is_admin'] == 'no') { 
        echo 'Forbidden Access';
    } else{
    ?>
    <body class="body-custom">	
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?> <!-- Navigation Menu -->
        <div class="container cont-cust">
            <div style="width:500px; margin:0 auto;">
                <h3 style="text-align: center;">Get Started with KStore!</h3>
                <div class="panel panel-success" >
                    <div class="panel-body" style="background-color: #FBFBFB;">
                        <div>
                            <form id="reg-form" role="form" action="<?php echo base_url(); ?>users/new_user" method="post">
                                <div>
                                    <div class="form-group col-md-6 control-group">
                                        <label for="firstname" class="control-label" >First name</label>
                                        <input type="text" name="fname" id="fname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" class="form-control" data-validation-required-message="Please enter your first name." required>
                                        <p class="help-block" ></p>
                                    </div>
                                    <div class="form-group col-md-6 control-group">
                                        <label for="lastname" class="control-label">Last name</label>
                                        <input type="text" name="lname" id="lname"  value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" class="form-control" class="form-control" required>
                                        <p class="help-block" ></p>
                                    </div>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" class="form-control" class="form-control" required>
                                    <?php if (isset($email) && $email == 1) { ?>
                                        <ul role="alert">
                                            <li style="color: #c09853;">  The email you entered is already registered. Try a different one. </li>
                                        </ul>
                                    <?php } ?>
                                    <p class="help-block" ></p>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <label for="password" class="control-label">Create your password</label>
                                    <input type="password" name="password" id="password" class="form-control" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,15}$" data-validation-pattern-message="Must have 6-15 digits including a letter and a number." required>
                                    <p class="help-block" ></p>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;"> 
                                    <label for="password_confirm" class="control-label">Confirm password</label>
                                    <input type="password" name="password_confirm" id="password_confirm"  class="form-control" data-validation-matches-match="password" data-validation-matches-message="Your passwords do not match.">
                                    <p class="help-block" ></p>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <label>Prove you're not a robot</label>
                                    <?php
                                    require_once(APPPATH . 'assets/libs/recaptchalib.php');
                                    $publickey = "6LfRQu8SAAAAAPVVhlY0EW0xSfsWB8cidMU3dPaT"; // you got this from the signup page
                                    echo recaptcha_get_html($publickey);
                                    ?>
                                    <?php if (isset($captcha) && $captcha == 1) { ?>
                                        <p class="help-block" >
                                        <ul role="alert">
                                            <li style="color: #c09853;">The characters you entered didn't match the word verification. Please try again.</li>
                                        </ul>
                                        </p>	
                                    <?php } ?>	 
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <div class="col-sm-1">
                                        <input type="checkbox" checked="true">
                                    </div>
                                    <div class="col-sm-11"> 
                                        <footer>
                                            <p><small>I have read and accepted the <a href=""><u>User Agreement</u></a> and <a href=""><u>Privacy Policy</u></a>.</small>
                                        </footer>
                                    </div>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <div class="col-sm-1">
                                        <input type="checkbox" checked="true">
                                    </div>
                                    <div class="col-sm-11"> 
                                        <footer>
                                            <small>I may receive news letters from KStore.</small></p>
                                        </footer>
                                    </div>
                                </div>
                                <div class="form-group control-group" style="margin: 15px;">
                                    <input  type="submit" class="btn btn-primary" align="center" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

            <script>
<?php
require_once(APPPATH . 'assets/js/jqBootstrapValidation.js');
?>
    $(function () { $("input").not("[type=submit]").jqBootstrapValidation(); } );
            </script>
        </div>
    </body>
    <?php } ?>
</html>