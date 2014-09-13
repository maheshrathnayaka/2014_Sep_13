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
        <title>Purchasing History</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

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
                    $account = 'purchase';
                    ?>
                    <?php
                    require_once (APPPATH . 'views/common/nav_my_account.php');
                }
                ?>
            </div>
            <div class="col-md-10"  id="container">

                <div class="container">
                    <div class="col-md-9">
                        <?php if (isset($purchased_items) && !empty($purchased_items)) { ?>
                            <table class="table table-hover">
                                <th>Image</th>
                                <th>Item</th>
                                <th>Review</th>
                                <th>Feedback</th>
                                <?php
                                foreach ($purchased_items as $key => $row) {
                                    $date = explode(" ", $row['datesubmitted']);
                                    $img_url = base_url("/images/uploads") . '/' . $row['image'];
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="#" class="thumbnail"><img class = "img-responsive image-center lazy media-object" src = '<?php echo $img_url; ?>' style="max-height: 50px;"></a>
                                        </td>
                                        <td width="50%"><a href = <?php echo base_url("/ad_details?adid=") . urldecode($row['adid']); ?>><? echo $row['title']; ?></a></td>
                                        <td>
                                            <? if ($row['reviewstatus'] == 1) { ?> <span class="glyphicon glyphicon-ok" style="color: green"></span> <? } else { ?>
                                                <!-- Button trigger modal -->
                                                <button class="btn btn-small btn-success" data-toggle="modal" data-target="#myModal<? echo $row['reviewnfeedbackid'] ?>">
                                                    Add
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal<? echo $row['reviewnfeedbackid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="reg-form_<? echo $row['reviewnfeedbackid'] ?>" role="form" action="<?php echo base_url(); ?>order_history/add_review" method="post">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Add a review for this product...</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea name="review" id="review" class="form-control" rows="5" required></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="review_id" value=<? echo $row['reviewnfeedbackid'] ?>>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-primary" />
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><? } ?>
                                        </td>
                                        <td>
                                            <? if ($row['feedbackstatus'] == 1) { ?> <span class="glyphicon glyphicon-ok" style="color: green"></span> <? } else {
                                                ?>
                                                <!-- Button trigger modal -->
                                                <button class="btn btn-small btn-success" data-toggle="modal" data-target="#myModal2<? echo $row['reviewnfeedbackid'] ?>">
                                                    Add
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal2<? echo $row['reviewnfeedbackid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="reg-form2_<? echo $row['reviewnfeedbackid'] ?>" role="form" action="<?php echo base_url(); ?>order_history/add_feedback" method="post">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel2">Add a feedback for this seller...</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input value="5" id="rating" name="rating" type="number" class="rating" min=0 max=5 step=1 data-size="xs" required>
                                                                    <label for="feedback" class="control-label" >Details</label>
                                                                    <textarea name="feedback" id="feedback" class="form-control" rows="5" maxlength="50" required></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="feedback_id" value=<? echo $row['reviewnfeedbackid'] ?>>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <input type="submit" class="btn btn-primary" />
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? } ?>
                                        </td>
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
                </div>
            </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function () {
        $(".rating-kv").rating();
    });
    </script>
    <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
</body>
</html>
