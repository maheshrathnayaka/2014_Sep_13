<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <?php
        if (isset($ad) && isset($seller) && isset($images)) {
            foreach ($ad as $ad_info) {
                
            }
            foreach ($seller as $seller_info) {
                
            }
            ?>
            <title><?php echo $ad_info['title'] ?></title>

            <style type="text/css">
    <?php
    require_once(APPPATH . 'assets/css/bootstrap.css');
    require_once(APPPATH . 'assets/css/bootstrap.min.css');
    require_once(APPPATH . 'assets/css/smoothproducts.css');
    require_once(APPPATH . 'assets/css/customTh.css');
    ?>          
            </style>

            <script>
    <?php
    require_once(APPPATH . 'assets/js/jquery.min.js');
    require_once(APPPATH . 'assets/js/bootstrap.min.js');
    ?>
            </script>
        </head>

        <body class="body-custom">
            <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
            <div class="container cont-ad-cust">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sp-wrap image-box-custom">
                            <?php
                            foreach ($images as $image) {
                                $img_url = base_url("/images/uploads") . '/' . $image['imageurl'];
                                ?>
                                <a href=<?php echo $img_url ?>><img  alt="" src=<?php echo $img_url ?>></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <h3><?php echo $ad_info['title'] ?></h3>
                            <hr>
                        </div>
                        <div class="row sub-container">
                            <dl class="dl-horizontal">
                                <dt>Price:</dt>
                                <dd><?php echo $this->cart->format_number($ad_info['price']) ?></dd>
                                <dt>Available Quantity:</dt>
                                <dd><?php echo $ad_info['quantity'] ?></dd>
                                <dt>Location:</dt>
                                <dd><?php echo $ad_info['location'] ?></dd>
                                <dt>Seller:</dt>
                                <dd><?php echo $seller_info['email'] ?></dd>
                            </dl>
                        </div>
                        <div class="row">
                            <a href="<?PHP echo base_url("/adapprovalview/approving?status=active&adid=") . urlencode($ad_info['adid']); ?>" class="btn btn-success">Approve Ad</a>
                            <a href="<?PHP echo base_url("/adapprovalview/approving?status=reject&adid=") . urlencode($ad_info['adid']); ?>" class="btn btn-success">Reject Ad</a>
                        </div>
                    </div>

                </div>
                <div class="row" style="margin-top:30px;">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#description" data-toggle="tab">Item Details</a></li>
                        <li><a href="#seller" data-toggle="tab">Seller Details</a></li>
                        <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane  tab-content-custom active" id="description">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Item Specification</h3>
                                </div>
                                <!-- Attributes -->
                                <div class="panel-body">
                                    <dl class="dl-horizontal">
                                        <?php
                                        if (isset($mul_specs) && !empty($mul_specs)) {
                                            foreach ($mul_specs as $spec) {
                                                ?>
                                                <dt><?php echo $spec['attributename'] ?></dt>
                                                <dd><?php echo $spec['dropdownvalues'] ?></dd>
                                                <?
                                                }
                                                }
                                                if (isset($sin_specs) && !empty($sin_specs)) {
                                                foreach ($sin_specs as $spec) {
                                                ?>
                                                <dt><?php echo $spec['attributename'] ?></dt>
                                                <dd><?php echo $spec['attributevalue'] ?></dd>
                                                <?
                                                }
                                                }
                                                ?>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Description</h3>
                                        </div>
                                        <div class="panel-body">
                                            <pre scrolling="no" class="description-cont"><?php echo $ad_info['description'] ?></pre>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane tab-content-custom" id="seller">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Seller Details</h3>
                                        </div>
                                        <div class="panel-body">
                                            <dl class="dl-horizontal">
                                                <dt>Name:</dt>
                                                <dd><a href = <?php echo base_url("/my_account?userid=") . urldecode($seller_info['userid']); ?>><?php echo $seller_info['first_name'] . ' ' . $seller_info['last_name'] ?></a></dd>
                                                <dt>Email:</dt>
                                                <dd><?php echo $seller_info['email'] ?></dd>
                                                <dt>Contact No:</dt>
                                                <dd><?php echo $seller_info['telephone'] ?></dd>
                                                <dt>Location:</dt>
                                                <dd><?php echo $seller_info['city'] ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane tab-content-custom" id="reviews">
                                    <?
                                    if (isset($reviews) && !empty($reviews)) {
                                    foreach ($reviews as $key => $row) {
                                    ?>
                                    <blockquote>
                                        <p>
                                        <pre scrolling="no" ><? echo $row['review']; ?></pre>
                                        </p>
                                        <footer><? echo substr($row['first_name'], 0, 1) . '***' . substr($row['first_name'], -1); ?></footer>
                                    </blockquote>
                                    <?
                                    }
                                    } else {
                                    ?>
                                    <div class="alert alert-warning">
                                        No reviews are available for this item!
                                    </div>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
            <?php
            require_once(APPPATH . 'assets/js/smoothproducts.js');
            ?>
                            /* wait for images to load */
                            $(window).load(function() {
                                $('.sp-wrap').smoothproducts();
                            });
                        </script>
                    </div>
                    <?php
                } else {
                    echo "You tried to access this page in wrong way!";
                }
                ?>
    </body>
</html> 