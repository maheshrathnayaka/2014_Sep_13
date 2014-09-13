<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">

        <title>User Profile</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <script><?php require_once('assets/js/messages_ajax.js'); ?></script>
    </head>

    <body class="body-custom">

        <?php
        if (!isset($otheruser)) {
            $main_nav = 'my account';
        }
        ?>

        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="col-md-2" style="border-right: 1px solid #E6E6E6; min-height: 100vh; padding-right: 10px;">
                <?php
                if (!isset($otheruser)) {
                    $account = 'public';
                    ?>
                    <?php
                    require_once (APPPATH . 'views/common/nav_my_account.php');
                }
                ?>
            </div>
            <div class="col-md-10"  id="container">

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="well well-sm">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#">
                                        <?php
                                        if (isset($reward)) {
                                            if (!empty($reward)) {
                                                $points = $reward[0]['points'];
                                            } else {
                                                $points = '0';
                                            }
                                        }
                                        if (isset($rating)) {
                                            if (!empty($rating)) {
                                                $rating_avg = ($rating[0]['rating_avg'] * 20) . '% (' . $rating[0]['rating_cnt'] . ')';
                                            } else {
                                                $rating_avg = '<i>(Not rated)</i>';
                                            }
                                        }

                                        if (isset($user) && !empty($user)) {
                                            foreach ($user as $key => $row) {

                                                $date = explode(" ", $row['reg_date']);
                                                $img_url = base_url("/images/pro_pics") . '/' . $row['photo'];
                                                ?>
                                                <img class="media-object img-responsive" src='<?php echo $img_url; ?>' >
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><b><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></b></h4>
                                                <?php if ($row['isVerify'] == 1) { ?>
                                                    <img class = "media-object img-responsive" src = '<?php echo base_url("/images/Un.png"); ?>' >
                                                <?php }
                                                ?>
                                                <table>
                                                    <tr>
                                                        <td><b>Member since</b></td>
                                                        <td><?php echo ': ' . $date[0]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Seller Rating</b></td>
                                                        <td><?php echo ': ' . $rating_avg; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Reward Points</b></td>
                                                        <td><?php echo ': ' . $points; ?></td>
                                                    </tr>
                                                    <?php
                                                    if ($this->session->userdata('logged_in')) {
                                                        if ($row['email'] != $this->session->userdata['logged_in']['email']) {
                                                            ?>
                                                            <tr>
                                                                <td><a data-toggle="modal" href="#contactSeller"><button type="button"  class="btn btn-info btn-xs" style="float: left;">Contact Seller</button></a></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>

                                                </table>

                                                <!-- Modal Contact Seller -->
                                                <div class="modal fade" id="contactSeller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="send_message" class="form-horizontal" role="form" action="<?php echo base_url(); ?>my_messages/send_message" method="post">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Contact Seller...</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group">
                                                                        <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
                                                                        <div class="col-sm-10">
                                                                            <input required type="text" class="form-control" id="inputSubject" name="input_subject" placeholder="Subject...">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea required class="form-control" rows="7" id="inputMessage" name="input_msg" placeholder="Message..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">

                                                                            <div id="alertBox" style="display: none" class="alert alert-danger alert-dismissible" role="alert">
                                                                                <button type="button" class="close" data-dismiss="alert">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    <span class="sr-only">Close</span>
                                                                                </button>
                                                                                <strong>Oh snap ! </strong>
                                                                                Message not sent... fill the form correctly
                                                                            </div>
                                                                            <br>
                                                                            <button type="button" id="btnSendMsg" data-loading-text="Sending..." onclick="ajax_refresh();" class="btn btn-primary">Send Message</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="msg_sender" value=<?php echo $this->session->userdata['logged_in']['email']; ?>>
                                                                    <input type="hidden" name="user_id" value=<?php echo $_GET['userid']; ?>>
                                                                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs col-md-9">
                        <li class="active"><a href="#Selling" data-toggle="tab">Currently Selling</a></li>
                        <li><a href="#Sold" data-toggle="tab">Recently Sold</a></li>
                        <li><a href="#Feedbacks" data-toggle="tab">Feedbacks</a></li>
                    </ul>
                    <div class="tab-content col-md-9">
                        <br>
                        <div class="tab-pane active" id="Selling">
<?php if (isset($active_ads) && !empty($active_ads)) { ?>
                                <table class="table table-hover">
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Posted On</th>
                                    <th>Price</th>
                                    <?php
                                    foreach ($active_ads as $key => $row) {
                                        $date = explode(" ", $row['datesubmitted']);
                                        $img_url = base_url("/images/uploads") . '/' . $row['image'];
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="thumbnail"><img class = "img-responsive image-center lazy media-object" src = '<?php echo $img_url; ?>' style="max-height: 50px;"></a>
                                            </td>
                                            <td width="50%"><a href = <?php echo base_url("/ad_details?adid=") . urldecode($row['adid']); ?>><? echo $row['title']; ?></a></td>
                                            <td><? echo $date[0]; ?></td>
                                            <td><? echo 'Rs.' . $this->cart->format_number($row['price']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-warning">
                                        Currently no items are being sold by this user.
                                    </div>
                                <? }
                                ?>
                            </table>
                        </div>

                        <div class="tab-pane" id="Sold">
                            <table class="table table-hover">
<?php if (isset($sold_ads) && !empty($sold_ads)) { ?>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Sold On</th>
                                    <th>Price</th>
                                    <?php
                                    foreach ($sold_ads as $key => $row) {
                                        $date = explode(" ", $row['timestamp']);
                                        $img_url = base_url("/images/uploads") . '/' . $row['image'];
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="thumbnail"><img class = "img-responsive image-center lazy media-object" src = '<?php echo $img_url; ?>' style="max-height: 50px;"></a>
                                            </td>
                                            <td width="50%"><a href = <?php echo base_url("/ad_details?adid=") . urldecode($row['adid']); ?>><? echo $row['title']; ?></a></td>
                                            <td><? echo $date[0]; ?></td>
                                            <td><? echo 'Rs.' . $this->cart->format_number($row['price']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-warning">
                                        No items have been sold by this user.
                                    </div>
                                <? }
                                ?>
                            </table>
                        </div>

                        <div class="tab-pane" id="Feedbacks">
<?php if (isset($feedbacks) && !empty($feedbacks)) { ?>
                                <table class="table table-hover">
                                    <th>Buyer</th>
                                    <th>Item</th>
                                    <th>Feedback</th>
                                    <th>Date</th>
                                    <th>Rating</th>
                                    <?php
                                    foreach ($feedbacks as $key => $row) {
                                        $date = explode(" ", $row['timestamp']);
                                        $rating = $row['rating'];
                                        ?>
                                        <tr>
                                            <td><? echo substr($row['first_name'], 0, 1) . '***' . substr($row['first_name'], -1) ?></td>
                                            <td width="35%">
                                                <a href = <?php echo base_url("/ad_details?adid=") . urldecode($row['adid']); ?>><? echo $row['title'] ?></a>
                                            </td>
                                            <td width="30%"><? echo $row['feedback'] ?></td>
                                            <td><? echo $date[0] ?></td>
                                            <td>
                                                <?php
                                                for ($x = 0; $x < $rating; $x++) {
                                                    ?>
                                                    <span class="glyphicon glyphicon-star" style="color:blue;"></span>
                                                <? } ?>
                                                <?php
                                                for ($x = 0; $x < 5 - $rating; $x++) {
                                                    ?>
                                                    <span class="glyphicon glyphicon-star-empty"></span>
        <? } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-warning">
                                        No feedbacks are available for this user.
                                    </div>
                                <?php }
                                ?>

                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

</body>
</html>
