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
        <title>Edit Profile</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom" onload="#myModal">
        <?php $main_nav = 'my account' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust" >
            <div class="col-md-2" style="border-right: 1px solid #E6E6E6; min-height: 100vh; padding-right: 10px;">
                <?php $account = 'edit'; ?>
                <?php require_once (APPPATH . 'views/common/nav_my_account.php'); ?>
            </div>
            <div class="col-md-10" >
                <div id="tabscenter" class="panel panel-primary">
                    <ul class="nav nav-tabs nav-justified" id="myTab">
                        <li class="active"><a href="#GeneralDetails" data-toggle="tab">General Details</a></li>
                        <li><a href="#AddressUpdate" data-toggle="tab">Address</a></li>
                        <li><a href="#PasswordChange" data-toggle="tab">Change Password</a></li>
                    </ul>

                    <?php
//                    if (isset($message)) {
//                        if ($message == "Password changed successfully") {
//                            echo 'hellllllllllllllllllo';
                            ?>
                    
<!--                            <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
                                <div class = "modal-dialog">
                                    <div class = "modal-content">
                                        <div class = "modal-header">
                                            <button type = "button" class = "close" data-dismiss = "modal"><span aria-hidden = "true">&times;
                                                </span><span class = "sr-only">Close</span></button>
                                            <h4 class = "modal-title" id = "myModalLabel">Modal title</h4>
                                        </div>
                                        <div class = "modal-body">
                                            <h5>Your password change successfully</h5>
                                        </div>
                                        <div class = "modal-footer">
                                            <button type = "button" class = "btn btn-default" data-dismiss = "modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <?php
//                        }
//                    }
                    ?>
                    <div class="tab-content panel-body" id="sizing">
                        <div class="tab-pane fade in active col-sm-12" id="GeneralDetails">
                            <form role="form" action="<?php echo base_url(); ?>profileupdate/updateprofileinfogeneral" class="form-horizontal" method="POST">
                                <br>
                                <fieldset id="generaldetailsfield" disabled>
                                    <div class="form-group">
                                        <label for="inputFirstName" class="control-label col-sm-2">First Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" required class="form-control" name="inputFirstName" id="inputFirstName" placeholder="First name here" value="<?php echo $first_name; ?>">
                                        </div>
                                        <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" required class="form-control" name="inputLastName" id="inputLastName" placeholder="Last name here" value="<?php echo $last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label col-sm-2">Email</label>
                                        <div class="col-sm-4">
                                            <input type="email" required class="form-control" name="inputEmail" id="inputEmail" placeholder="Email address here" value="<?php echo $email; ?>">
                                        </div>
                                        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-4">
                                            <input type="tel" required class="form-control" name="inputPhone" id="inputPhone" placeholder="Phone number here" value="<?php echo $telephone; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSecurityQuestion" class="control-label col-sm-2">Security Question</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="inputSecurityQuestion" id="inputSecurityQuestion">
                                                <option value="What is your first best friend's name?" id="first">What is your first best friend's name?</option>
                                                <option value="What was your childhood nickname?" id="second">What was your childhood nickname?</option>
                                                <option value="In what city did you meet your spouse/significant other?" id="third">In what city did you meet your spouse/significant other?</option>
                                                <option value="What street did you live on in third grade?" id="fourth">What street did you live on in third grade?</option>
                                                <option value="What school did you attend for sixth grade?" id="fifth">What school did you attend for sixth grade?</option>
                                                <option value="In what city does your nearest sibling live?" id="sixth">In what city does your nearest sibling live?</option>
                                            </select>
                                        </div>
                                        <label for="inputSecurityAnswer" class="col-sm-2 control-label">Security Answer</label>
                                        <div class="col-sm-4">
                                            <input required type="text" name="inputSecurityAnswer" class="form-control" id="inputSecurityAnswer" placeholder="Your answer here" value="<?php echo $security_answer; ?>">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group form-horizontal" style="text-align: right; padding-right: 15px;">
                                    <button type="button" class="btn btn-primary" onclick="enableFieldsetGeneral();">Edit</button>
                                    <input type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update your information" value="Save Changes">                               
                                </div>

                            </form>
                        </div>

                        <div class="tab-pane fade col-sm-12" id="AddressUpdate">
                            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>profileupdate/updateprofileinfoaddress" method="POST">
                                <br>
                                <fieldset id="addressdetailsfield" disabled>
                                    <div class="form-group">
                                        <label for="inputLine01" class="control-label col-sm-2">Address line 1</label>
                                        <div class="col-sm-4">
                                            <input type="text" required name="inputLine01" class="form-control" id="inputLine01" placeholder="Address line 1 here..." value="<?php echo $address_1; ?>">
                                        </div>
                                        <label for="inputLine02" class="col-sm-2 control-label">Address line 2</label>
                                        <div class="col-sm-4">
                                            <input type="text" required name="inputLine02" class="form-control" id="inputLine02" placeholder="Address line 2 here..." value="<?php echo $address_2; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProvince" class="control-label col-sm-2">Province</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="inputProvince" name="inputProvince">
                                                <option value="Central Province">Central Province</option>
                                                <option value="Eastern Province">Eastern Province</option>
                                                <option value="Northern Province">Northern Province</option>
                                                <option value="Southern Province">Southern Province</option>
                                                <option value="Western Province">Western Province</option>
                                                <option value="North Western Province">North Western Province</option>
                                                <option value="North Central Province">North Central Province</option>
                                                <option value="Uva Province">Uva Province</option>
                                                <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                                            </select>
                                        </div>
                                        <label for="inputCity" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-4">
                                            <input required type="text" name="inputCity" class="form-control" id="inputCity" placeholder="City here..." value="<?php echo $city; ?>">
                                        </div>                            
                                    </div>
                                </fieldset>
                                <div class="form-group form-horizontal" style="text-align: right; padding-right: 15px;">

                                    <button type="button" class="btn btn-primary" onclick="enableFieldsetAddress();">Edit</button>
                                    <input type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update your information" value="Save Changes">

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade col-sm-12" id="PasswordChange" style="text-align: center;">
                            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>profileupdate/update_password" method="POST">
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputCurrentPassword" class="control-label col-sm-3">Current Password</label>
                                    <div class="col-sm-6">
                                        <input required type="password" name="inputCurrentPassword" class="form-control" id="inputFirstNameCurrentPassword">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputNewPassword" class="control-label col-sm-3">New Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,15}$" data-validation-pattern-message="Must have 6-15 digits including a letter and a number." required name="inputNewPassword" class="form-control" id="inputNewPassword">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1"></div>
                                    <label for="inputConfirmPassword" class="control-label col-sm-3">Confirm Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" required pattern="^(?=.*\d)(?=.*[a-zA-Z]).{6,15}$" data-validation-pattern-message="Must have 6-15 digits including a letter and a number." name="inputConfirmPassword" class="form-control" id="inputConfirmPassword">
                                    </div>
                                    <div class="col-sm-2"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10" style="text-align: right;">
                                        <input type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update your account password" value="Change Password">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once(APPPATH . 'views/common/footer_th.php'); ?>
    <script>
<?php require_once (APPPATH . 'views/js/customscript.js'); ?>
    </script>
</body>
</html>





<?php //require_once 'header.php';  ?>
<?php //require_once 'footer.php';  ?>
<?php //require_once (APPPATH . 'views/common/nav_bar.php');   ?>
<!--<div id="tabscenter" class="container panel panel-primary">
    <ul class="nav nav-tabs nav-justified" id="myTab">
        <li class="active"><a href="#GeneralDetails" data-toggle="tab">General Detail Update</a></li>
        <li><a href="#AddressUpdate" data-toggle="tab">Update Address</a></li>
        <li><a href="#PasswordChange" data-toggle="tab">Password Change</a></li>
    </ul>

    <div class="tab-content panel-body" id="sizing">
        <div class="tab-pane fade in active col-sm-12" id="GeneralDetails">
            <form role="form" action="<?php echo base_url(); ?>profileupdate/updateprofileinfogeneral" class="form-horizontal" method="POST">
                <br>
                <fieldset id="generaldetailsfield" disabled>
                    <div class="form-group">
                        <label for="inputFirstName" class="control-label col-sm-2">First Name</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="inputFirstName" id="inputFirstName" placeholder="First name here" value="<?php echo $first_name; ?>">
                        </div>
                        <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-4">
                            <input type="text" required class="form-control" name="inputLastName" id="inputLastName" placeholder="Last name here" value="<?php echo $last_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-sm-2">Email</label>
                        <div class="col-sm-4">
                            <input type="email" required class="form-control" name="inputEmail" id="inputEmail" placeholder="Email address here" value="<?php echo $email; ?>">
                        </div>
                        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-4">
                            <input type="tel" required class="form-control" name="inputPhone" id="inputPhone" placeholder="Phone number here" value="<?php echo $telephone; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSecurityQuestion" class="control-label col-sm-2">Security Question</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputSecurityQuestion" id="inputSecurityQuestion">
                                <option value="What is your first best friend's name?" id="first">What is your first best friend's name?</option>
                                <option value="What was your childhood nickname?" id="second">What was your childhood nickname?</option>
                                <option value="In what city did you meet your spouse/significant other?" id="third">In what city did you meet your spouse/significant other?</option>
                                <option value="What street did you live on in third grade?" id="fourth">What street did you live on in third grade?</option>
                                <option value="What school did you attend for sixth grade?" id="fifth">What school did you attend for sixth grade?</option>
                                <option value="In what city does your nearest sibling live?" id="sixth">In what city does your nearest sibling live?</option>
                            </select>
                        </div>
                        <label for="inputSecurityAnswer" class="col-sm-2 control-label">Security Answer</label>
                        <div class="col-sm-4">
                            <input type="text" name="inputSecurityAnswer" class="form-control" id="inputSecurityAnswer" placeholder="Your answer here" value="<?php echo $security_answer; ?>">
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <div class="col-sm-12 center">
                        <div id="buttonleftdivGeneralEnable"><button type="button" class="btn btn-primary" onclick="enableFieldsetGeneral();">Edit</button></div>
                        <div id="buttonleftdivGeneralUpdate"><input type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update your information" value="Update Informaton"></div>
                    </div>
                </div>

            </form>
        </div>

        <div class="tab-pane fade col-sm-12" id="AddressUpdate">
            <form role="form" class="form-horizontal" action="<?php echo base_url(); ?>profileupdate/updateprofileinfoaddress" method="POST">
                <br>
                <fieldset id="addressdetailsfield" disabled>
                    <div class="form-group">
                        <label for="inputLine01" class="control-label col-sm-2">Line 01</label>
                        <div class="col-sm-4">
                            <input type="text" name="inputLine01" class="form-control" id="inputLine01" placeholder="Address line 01 here" value="<?php echo $address_1; ?>">
                        </div>
                        <label for="inputLine02" class="col-sm-2 control-label">Line 02</label>
                        <div class="col-sm-4">
                            <input type="text" name="inputLine02" class="form-control" id="inputLine02" placeholder="Address line 02 here" value="<?php echo $address_2; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProvince" class="control-label col-sm-2">Province</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="inputProvince" name="inputProvince">
                                <option value="Central Province">Central Province</option>
                                <option value="Eastern Province">Eastern Province</option>
                                <option value="Northern Province">Northern Province</option>
                                <option value="Southern Province">Southern Province</option>
                                <option value="Western Province">Western Province</option>
                                <option value="North Western Province">North Western Province</option>
                                <option value="North Central Province">North Central Province</option>
                                <option value="Uva Province">Uva Province</option>
                                <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                            </select>
                        </div>
                        <label for="inputCity" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-4">
                            <input type="text" name="inputCity" class="form-control" id="inputCity" placeholder="City here" value="<?php echo $city; ?>">
                        </div>                            
                    </div>
                </fieldset>
                <div class="form-group">
                    <div class="col-sm-offset-6">
                        <div id="buttonleftdivAddressEnable"><button type="button" class="btn btn-primary" onclick="enableFieldsetAddress();">Edit</button></div>
                        <div id="buttonleftdivAddressUpdate"><input type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Update your information" value="Update Address"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade col-sm-12" id="PasswordChange">
            <form role="form" class="form-horizontal">
                <br>
                <div class="form-group">
                    <label for="inputFirstNameCurrentPassword" class="control-label col-sm-3">Current Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="inputFirstNameCurrentPassword" class="form-control" id="inputFirstNameCurrentPassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNewPassword" class="control-label col-sm-3">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="inputNewPassword" class="form-control" id="inputNewPassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputConfirmPassword" class="control-label col-sm-3">Confirm Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="inputConfirmPassword" class="form-control" id="inputConfirmPassword">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6">
                        <div id="buttonleftdivPasswordChange"><button type="button" class="btn btn-primary">Change Password</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
//    $(function() {
//        $('#myTab a:last').tab('show')
//    })
</script>
<div id="main">
    <div id="updating_form">
                <form role="form" class="form-horizontal">
                    <div class="panel panel-primary col-sm-offset-1 col-sm-10">
                        <div class="panel-heading">
                            <label class="panel-title">Update profile</label>
                        </div>
                        <br>
                        <div class="">
                            <fieldset disabled>
                                <div class="panel-body">
                                    <div id="addressSettings">
        
                                    </div>
                                </div>
        
                            </fieldset>
                        </div>
                    </div>
                </form>
    </div>
</div>-->
