<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Test Ajax Login</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <h1>Ajax Login</h1>
            <script type="text/javascript">
//                function loginFunc(){
                    $(document).ready(function(){
                        $("#frm_login").submit(function(event){
                            event.preventDefault();
                        
                            $.ajax({
                                url:'<?php base_url(); ?>/test_login/do_login',
                                type: 'POST',
                                data: {
                                    username:$("#inputEmail3").val(),
                                    password:$("#inputPassword3").val()
                                },
//                                timeout: 200,
                                success:function(data){
                                    if (data=='loggedIn') {
                                        alert("Login");
                                    }else if(data=='No'){
                                        alert('Canceled');
                                    }
                                }
                            });
                        });
                    });
//                }
            </script>

            <form class="form-horizontal" action="#" role="form" id="frm_login">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>

        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
