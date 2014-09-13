<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                        <meta name="author" content="">
                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                            <script src="http://templateplanet.info/tooltip.js"></script>
                            <script src="http://templateplanet.info/modal.js"></script>

                            <script>
                                $(document).ready(function() {
                                    $("#mytable #checkall").click(function() {
                                        if ($("#mytable #checkall").is(':checked')) {
                                            $("#mytable input[type=checkbox]").each(function() {
                                                $(this).prop("checked", true);
                                            });

                                        } else {
                                            $("#mytable input[type=checkbox]").each(function() {
                                                $(this).prop("checked", false);
                                            });
                                        }
                                    });
                                });

                                $(function() {
                                    $("[rel='tooltip']").tooltip();
                                });
                            </script>
                            <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
                            <title>Admin User Management</title>
                            </head>
                            <body class="body-plain-white">
                                <?php
                                $main_nav = 'admin';
                                require_once (APPPATH . 'views/common/nav_bar.php');
                                ?>
                                <div class="container cont-cust">

                                    <div class="well well-sm">
                                        <div class="row">
                                            <?php
                                            $visit_count = 0;
                                            foreach ($users as $user1) {
                                                if (date('Ymd') == date('Ymd', strtotime($user1['last_visited_date']))) {
                                                    $visit_count++;
                                                }
                                            }
                                            ?>
                                            <div id="result" class="col-lg-3" id="load_orders">
                                                <div class="alert alert-success text-center">

                                                    <b><?php echo $visit_count; ?> registered users have visited today.</b>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="well">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <h4>Users List</h4>
                                                <div class="table-responsive">


                                                    <table id="mytable" class="table table-bordred table-striped">
                                                        <thead>

                                                            <th><input type="checkbox" id="checkall" /></th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Visit Count</th>
                                                            <th>Last Visited</th>
                                                            <th>Ban User</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($users as $user) {
                                                                ?>
                                                                <tr>
                                                                    <td><input type="checkbox" class="checkthis" /></td>
                                                                    <td><?php echo $user['first_name']; ?></td>
                                                                    <td><?php echo $user['last_name']; ?></td>
                                                                    <td><?php echo $user['email']; ?></td>
                                                                    <td><?php echo $user['visit_count']; ?></td>
                                                                    <td><?php echo $user['last_visited_date']; ?></td>
                                                                    <td><p><button class="btn btn-danger btn-xs" name="ban[]" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>

                                                    </table>

                                                    <div class="clearfix"></div>
                                                    <ul class="pagination pull-right">
                                                        <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                                                        <li class="active"><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title custom_align" id="Heading">Ban this User</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to Ban this User?</div>

                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                                <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-remove"></span> No</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content --> 
                                    </div>
                                    <!-- /.modal-dialog --> 
                                </div>
                            </body>
                            <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
                            </html>