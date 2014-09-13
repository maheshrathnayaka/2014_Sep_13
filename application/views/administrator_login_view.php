<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Administrator login</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

        <style type="text/css">
<?php
require_once(APPPATH . 'assets/css/charisma-app.css');
?>
        </style>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script><?php require_once('assets/js/admin_ajax.js'); ?></script>
    </head>



    <body>
        <div class="ch-container">
            <div class="row">

                <div class="row">
                    <div class="col-md-12 center login-header">
                        <h2>KStore Administration</h2>
                    </div>
                    <!--/span-->
                </div><!--/row-->

                <div class="row">
                    <div class="well col-md-5 center login-box">
                        <div class="alert alert-info">
                            Please login with your Username and Password.
                        </div>
                        <form class="form-horizontal" action="<?php echo base_url(); ?>admin/verify_user" method="post">
                            <fieldset>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                    <!--<input type="hidden" value="<?php // echo $log_status; ?>"-->
                                    <input id="inputEmail" name="inputEmail" type="email" class="form-control" required placeholder="Email...">
                                </div>
                                <div class="clearfix"></div><br>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                    <input id="inputPassword" name="inputPassword" type="password" class="form-control" required placeholder="Password...">
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix"></div>
                                    <div id="loginAdminAlert" style="display: none;" class="alert alert-danger alert-dismissible small" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>Authentication failed ! </strong><br>
                                        Please enter username and password correctly...
                                    </div>
                                <p class="center col-md-5">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </p>
                            </fieldset>
                        </form>
                    </div>
                    <!--/span-->
                </div><!--/row-->
            </div><!--/fluid-row-->

        </div><!--/.fluid-container-->

        <!-- external javascript -->

        <!--<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->

        <!-- library for cookie management -->
        <!--<script src="js/jquery.cookie.js"></script>-->
        <!-- calender plugin -->
        <!--<script src='bower_components/moment/min/moment.min.js'></script>-->
        <!--<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>-->
        <!-- data table plugin -->
        <!--<script src='js/jquery.dataTables.min.js'></script>-->

        <!-- select or dropdown enhancer -->
        <!--<script src="bower_components/chosen/chosen.jquery.min.js"></script>-->
        <!-- plugin for gallery image view -->
        <!--<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>-->
        <!-- notification plugin -->
        <!--<script src="js/jquery.noty.js"></script>-->
        <!-- library for making tables responsive -->
        <!--<script src="bower_components/responsive-tables/responsive-tables.js"></script>-->
        <!-- tour plugin -->
        <!--<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>-->
        <!-- star rating plugin -->
        <!--<script src="js/jquery.raty.min.js"></script>-->
        <!-- for iOS style toggle switch -->
        <!--<script src="js/jquery.iphone.toggle.js"></script>-->
        <!-- autogrowing textarea plugin -->
        <!--<script src="js/jquery.autogrow-textarea.js"></script>-->
        <!-- multiple file upload plugin -->
        <!--<script src="js/jquery.uploadify-3.1.min.js"></script>-->
        <!--history.js for cross-browser state change on ajax--> 
       <!--<script src="js/jquery.history.js"></script>-->
        <!-- application script for Charisma demo -->
        <!--<script src="js/charisma.js"></script>-->
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
