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
        <title>Messages</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <script><?php require_once('assets/js/messages_watch_ajax.js'); ?></script>
    </head>

    <body class="body-custom">

        <?php
        if (!isset($otheruser)) {
            $main_nav = 'my_account';
        }
        ?>

        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="col-md-2" style="border-right: 1px solid #E6E6E6; min-height: 100vh; padding-right: 10px;">
                <?php $account = 'messages'; ?>
                <?php require_once (APPPATH . 'views/common/nav_my_account.php'); ?>
            </div>
            <div class="col-md-10" >
                <div id="tabscenter" class="panel panel-primary">
                    <ul class="nav nav-tabs nav-justified" id="myTab">
                        <li class="active"><a href="#inbox" data-toggle="tab">  Inbox  </a></li>
                        <li><a href="#sentMsg" data-toggle="tab">  Sent Messages  </a></li>
                        <li><a href="#trashMsg" data-toggle="tab">  Trash  </a></li>
                    </ul>

                    <div class="tab-content panel-body" id="sizing">
                        <div class="tab-pane fade in active col-sm-12" id="inbox">
                            <div id="alertBox" style="padding: 3px;display: none;" class="alert alert-danger alert-dismissible small" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>Oh snap ! </strong>
                                Select at least one message to remove...
                            </div>
                            <button type="button" class="btn btn-default btn-small" onclick="move_to_trash_inbox();">
                                <span class="glyphicon glyphicon-trash"></span> Move to trash
                            </button>
                            <div class="list-group">
                                <hr>
                                <?php
                                if (sizeof($messages_inbox) == 0) {
                                    ?>
                                    <div class="alert alert-info" role="alert">
                                        <strong>No messages received !</strong> inbox is empty...
                                    </div>
                                    <?php
                                } else {
                                    $row_count_inbox = 0;
                                    foreach ($messages_inbox as $row) {
                                        $row_count_inbox++;
                                        ?>
                                        <?php
                                        if ($row['read_status'] == 'pending') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <b><span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['first_name'] . ' ' . $row['last_name'] . ' : ' . $row['sender']; ?></span></b>
                                                <b><span class=""><?php echo $row['subject']; ?></span></b>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <b><span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span></b>
                                                <b><span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span></b>
                                                <b><span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                    </span></b>
                                            </a>
                                            <?php
                                        } else if ($row['read_status'] == 'read') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['first_name'] . ' ' . $row['last_name'] . ' : ' . $row['sender']; ?></span>
                                                <span class=""><?php echo $row['subject']; ?></span>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span>
                                                <span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span>
                                                <span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                </span>
                                            </a>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <input id="row_count_inbox" name="rowCountInbox" type="hidden" value="<?php echo $row_count_inbox; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="tab-pane fade col-sm-12" id="sentMsg">
                            <div id="alertBox" style="padding: 3px;display: none;" class="alert alert-danger alert-dismissible small" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>Oh snap ! </strong>
                                Select at least one message to remove...
                            </div>
                            <button type="button" class="btn btn-default btn-small" onclick="move_to_trash_sent();">
                                <span class="glyphicon glyphicon-trash"></span> Move to trash
                            </button>
                            <div class="list-group">
                                <hr>
                                <?php
                                if (sizeof($messages_sent) == 0) {
                                    ?>
                                    <div class="alert alert-info" role="alert">
                                        <strong>No messages sent !</strong> sent section is empty...
                                    </div>
                                    <?php
                                } else {
                                    $row_count_sent = 0;
                                    foreach ($messages_sent as $row) {
                                        $row_count_sent++;
                                        ?>
                                        <?php
                                        if ($row['read_status'] == 'pending') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox_sent" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <b><span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['receiver']; ?></span></b>
                                                <b><span class=""><?php echo $row['subject']; ?></span></b>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <b><span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span></b>
                                                <b><span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span></b>
                                                <b><span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                    </span></b>
                                            </a>
                                            <?php
                                        } else if ($row['read_status'] == 'read') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox_sent[]" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['receiver']; ?></span>
                                                <span class=""><?php echo $row['subject']; ?></span>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span>
                                                <span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span>
                                                <span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                </span>
                                            </a>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <input id="row_count_sent" name="rowCountSent" type="hidden" value="<?php echo $row_count_sent; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="tab-pane fade col-sm-12" id="trashMsg">
                            <div id="alertBox" style="padding: 3px;display: none;" class="alert alert-danger alert-dismissible small" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>Oh snap ! </strong>
                                Select at least one message to remove...
                            </div>
                            <button type="button" class="btn btn-default btn-small" onclick="move_to_trash_inbox();">
                                <span class="glyphicon glyphicon-trash"></span> Remove forever
                            </button>
                            <div class="list-group">
                                <hr>
                                <?php
                                if (sizeof($messages_trash) == 0) {
                                    ?>
                                    <div class="alert alert-info" role="alert">
                                        <strong>No messages!</strong> Trash is empty...
                                    </div>
                                    <?php
                                } else {
                                    $row_count_trash = 0;
                                    foreach ($messages_trash as $row) {
                                        $row_count_trash++;
                                        ?>
                                        <?php
                                        if ($row['read_status'] == 'pending') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <b><span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['receiver']; ?></span></b>
                                                <b><span class=""><?php echo $row['subject']; ?></span></b>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <b><span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span></b>
                                                <b><span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span></b>
                                                <b><span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                    </span></b>
                                            </a>
                                            <?php
                                        } else if ($row['read_status'] == 'read') {
                                            ?>
                                            <a href="#" class="list-group-item">
                                                <input type="checkbox" name="msg_checkbox" value="<?php echo $row['id']; ?>"  id="<?php echo $row['id']; ?>">
                                                <!--<span class="glyphicon glyphicon-star-empty"></span>-->
                                                <span class="name" style="min-width: 120px;display: inline-block;"><?php echo $row['receiver']; ?></span>
                                                <span class=""><?php echo $row['subject']; ?></span>
                                                <?php
                                                $first_letters = mb_substr($row['msg'], 0, 30);
                                                ?>
                                                <span class="text-muted" style="font-size: 11px;">- <?php echo $first_letters; ?>...</span>
                                                <span class="badge pull-right"><?php echo $row['date'] . ' : ' . $row['time']; ?></span>
                                                <span class="pull-right">
                                                <!--<span class="glyphicon glyphicon-paperclip"></span>-->
                                                </span>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <p>csdifmiondsfmgnvsdo</p>
                </div>

            </div>
            <!--</div>-->
            <!--</div>-->
        </div>
        <!--</div>-->
        <script>
            jQuery(document).ready(function() {
                $(".rating-kv").rating();
            });
        </script>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
    </body>
</html>
