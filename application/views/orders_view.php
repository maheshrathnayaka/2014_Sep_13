<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Order History</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <style type="text/css">
            /*            .top-label {
                            margin-right: -24px;
                            margin-top: -24px;
                            position: absolute;
                            right: 50%;
                            top: 50%;
                        }*/
            .modal-dialog {
                width: 1300px;
            }
            .modal-content {
                width: 1300px;
                margin-left: +10px;
            }
        </style>
        <script type="text/javascript">
//            function orders_polling() {
//                $.ajax({
//                    url: "<?php // echo base_url();  ?>/orders/ajax_new_order_count",
//                    type: 'POST',
//                    success: function(data)
//                    {
//                        if (data)
//                        {
//                            $('#newOrders').html(data);
//                        }
//                    }
//                }
//                );
//                //orders_polling)();
//            }
        </script>
    </head>

    <body class="body-custom">
        <?php
        $main_nav = 'admin';
        require_once (APPPATH . 'views/common/nav_bar.php');
        ?>
        <div class="container cont-cust">
            <div>
                <hr>
                <h3 class="text-center">Order History</h3>
                <hr>
            </div>
            <a data-toggle="modal" href="#dayOrders">
                <div id="result" class="col-lg-6" id="load_orders">
                    <div class="alert alert-danger text-center" id="newOrders">
                        <i class="fa fa-clock-o fa-2x"></i>
                        <b><?php echo $count['order_count']; ?> new orders for today</b>
                    </div>
                </div>
            </a>

            <a data-toggle="modal" href="#allOrders">
                <div id="result" class="col-lg-6" id="load_orders">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-book fa-2x"></i>
                        <b><?php echo $all_count['order_count']; ?> all orders</b>
                    </div>
                </div>
            </a>

            <!-- Modal Day Orders -->
            <div class="modal fade" id="dayOrders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Orders for last 24 hours</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Buyer id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Payment method</th>
                                        <th>Shipping address</th>
                                        <th>Comment</th>
                                        <th>Total Price</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    foreach ($orders as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $row['buyer_id']; ?></td>
                                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['telephone']; ?></td>
                                            <td><?php echo $row['payment_method']; ?></td>
                                            <td><?php echo $row['ship_address_1'] . ', ' . $row['ship_address_2'] . ', ' . $row['ship_city']; ?></td>
                                            <td><?php echo $row['comment']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td><?php echo $row['timestamp']; ?></td>
                                        </tr>
                                        <?php
                                        $x = $x + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal All Orders -->
            <div class="modal fade" id="allOrders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">All Orders</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Buyer id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Payment method</th>
                                        <th>Shipping address</th>
                                        <th>Comment</th>
                                        <th>Total Price</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 1;
                                    foreach ($all_orders as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $row['buyer_id']; ?></td>
                                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['telephone']; ?></td>
                                            <td><?php echo $row['payment_method']; ?></td>
                                            <td><?php echo $row['ship_address_1'] . ', ' . $row['ship_address_2'] . ', ' . $row['ship_city']; ?></td>
                                            <td><?php echo $row['comment']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td><?php echo $row['timestamp']; ?></td>
                                        </tr>
                                        <?php
                                        $x = $x + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
