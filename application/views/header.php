<html>
    <head>
        <title><?PHP echo $title; ?></title>

        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->

        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">-->

        <!-- Latest compiled and minified JavaScript -->
        <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->

        <!--Latest compiled and minified jQuery-->
<!--        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
        <link rel="stylesheet" href="http://reactiveraven.github.io/jqBootstrapValidation/css/bootstrap.css">
        <!--<link href="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.2.0/bootbox.min.js">-->
        <script src="//cdn.jsdelivr.net/bootbox/4.2.0/bootbox.min.js"></script>
        <link rel="stylesheet" href="http://reactiveraven.github.io/jqBootstrapValidation/css/bootstrap.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.js">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.js">

        <script>
<?php
require_once(APPPATH . 'assets/js/jqBootstrapValidation.js');
?>
            $(function() {
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
            });
        </script>
        
        <style>
<?php
require_once (APPPATH . 'views/css/bootstrap-theme.css');
require_once (APPPATH . 'views/css/bootstrap-theme.min.css');
require_once (APPPATH . 'views/css/bootstrap.css');
require_once (APPPATH . 'views/css/bootstrap.min.css');
require_once (APPPATH . 'views/css/customstyle.css');
require_once (APPPATH . 'views/css/prettify.css');
require_once (APPPATH . 'views/css/bootstrap-wysihtml5.css');
?>
        </style>
        <script>
<?php
require_once (APPPATH . 'views/js/jquery-2.1.0.min.js');
require_once (APPPATH . 'views/js/jquery-1.3.2.js');
require_once(APPPATH . 'views/js/bootstrap.js');
require_once(APPPATH . 'views/js/bootstrap.min.js');
require_once (APPPATH . 'views/js/jquery.livequery.js');
require_once (APPPATH . 'views/js/customscript.js');

//require_once (APPPATH . 'views/js/wysihtml5-0.3.0.js');
//require_once (APPPATH . 'views/js/jquery-1.7.2.min.js');
//require_once (APPPATH . 'views/js/prettify.js');
//require_once (APPPATH . 'views/js/bootstrap3-wysihtml5.all.min.js');
?>
        </script>
    </head>
    <body class="skin-blue">
