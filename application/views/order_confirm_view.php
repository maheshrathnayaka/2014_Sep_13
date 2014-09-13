<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <title>Order Confirm</title>
    </head>
    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <?php echo form_open('checkout/confirm'); ?>
            <div class="container cont-cust">
                <div class="row-fluid" style="margin-top: 60px;">
                    <h2 style="margin-left: 50px;">Your Order Summary</h2>
                    <div style="margin: 40px 50px 30px 50px;">
                        <dl class="dl-horizontal">
                            <dt class="list-padding-bottom">Your Total</dt>
                            <dd class="list-padding-bottom"><?php echo $this->cart->format_number($this->cart->total()); ?></dd>
                            <dt class="list-padding-bottom">Payment Method</dt>
                            <dd class="list-padding-bottom"><?php echo $payment_method; ?></dd>
                            <dt class="list-padding-bottom">Shipping Address</dt>
                            <dd class="list-padding-bottom">

                                <address>
                                    <strong><?php echo $fname; ?> <?php echo $lname; ?>, </strong><br>
                                    <?php echo $address1; ?> ,<br>
                                    <?php if (!empty($address2)) { ?>
                                        <?php echo $address2 . ',<br>'; ?>
                                    <?php } ?>
                                    <?php echo $city; ?><br>
                                    <?php if (!empty($phone)) { ?>
                                        <abbr title="Phone">P:</abbr> <?php echo $phone; ?>
                                    <?php } ?>
                                </address>

                            </dd>
                            <?php if (!empty($comment)) { ?>
                                <dt class="list-padding-bottom">Special Notes</dt>
                                <dd class="list-padding-bottom"><?php echo $comment; ?></dd>
                            <?php } ?>
                        </dl>
                    </div>
                    <div style="margin-left: 50px;">
                        <button  type="submit" class="btn btn-primary btn-lg">CONFIRM ORDER</button>
                    </div>
                </div>             
            </div>
    </form>
    </body>
</html>
