<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <?php
        if (isset($ad) && isset($seller)) {

            foreach ($ad as $ad_info) {
                $date = explode(" ", $ad_info['datesubmitted']);
            }
            foreach ($seller as $seller_info) {
                
            }
            ?>
            <title><?php echo $ad_info['title'] ?></title>
            <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

            <style type="text/css">
    <?php
    require_once(APPPATH . 'assets/css/smoothproducts.css');
    ?>          
            </style>
            <script><?php require_once('assets/js/wishlist_ajax.js'); ?></script>
            
        </head>

        <body class="body-custom">
            <?php $GLOBALS['main_nav'] = 'ad details' ?>
            <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
            <div class="container cont-cust">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sp-wrap image-box-custom">
                            <?php
                            if (!empty($images) && isset($images)) {
                                foreach ($images as $image) {
                                    $img_url = base_url("/images/uploads") . '/' . $image['imageurl'];
                                    ?>
                                    <a href=<?php echo $img_url ?>><img src='<?php echo $img_url ?>' class="lazy" alt='<?php $img_url ?>'></a>
                                    <?php
                                }
                            } else {
                                $img_url = base_url("/images/uploads") . '/default.png';
                                ?>
                                <a href=<?php echo $img_url ?>><img src='<?php echo $img_url ?>' class="lazy" alt='<?php $img_url ?>'></a>
                            <? } ?>
                        </div>
                    </div>
                    <?php echo form_open("cart/add_cart_item"); ?>
                    <div class="col-md-7">
                        <div class="row">
                            <h3><?php echo $ad_info['title'] ?></h3>
                            <input type="hidden" name="ad_id" value=<?php echo $ad_info['adid']; ?>/>
                            <hr>
                        </div>
                        <div class="row sub-container">
                            <dl class="dl-horizontal">
                                <dt>Price:</dt>
                                <dd><?php echo $this->cart->format_number($ad_info['price']) ?></dd>
                                <dt>Available:</dt>
                                <dd><?php echo $ad_info['quantity'] . ' Pcs.' ?></dd>
                                <dt>Location:</dt>
                                <dd><?php
                if ($ad_info['locationtype'] == 'kstore') {
                    echo 'Kstore Branch - ';
                }
                echo $ad_info['location']
                    ?></dd>
                                <dt>Posted On:</dt>
                                <dd><?php echo $date[0] ?></dd>
                            </dl>
                        </div>
                        <div class="row">
                            <?php if ($ad_info['quantity'] == 0) { ?>
                                <image src="images/soldout.jpg"/>
                                <?php } else { ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="qty" class="control-label" >Quantity</label>
                                        <input type="number" name="qty" id="qty" class="form-control" maxlength="4" size="4" value="1" min="1" max="<? echo $ad_info['quantity'] ?>">
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="row">
                                            <label>  </label>
                                        </div>
                                        <div class="row">
                                            <input type="submit" name="submmit" class="btn btn-primary" value="Add to Cart"/>
                                            <button id="wish" name="wish" onclick="<?php if($this->session->userdata('logged_in')) {echo "add_to_wishlist(true," . $this->session->userdata['logged_in']['userid'] . ")";}else{echo "add_to_wishlist(false,null)";} ?>" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                                            <!--button type="button" class="btn btn-success">Buy Now</button-->
                                        </div>
                                    </div>
                                </div>
                             <?php } ?>
                        </div>
                    </div>
    <?php echo form_close(); ?>

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

    <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
                <script type="text/javascript">
                                                         
    <?php require_once (APPPATH . 'assets/js/smoothproducts.js'); ?>
        /* wait for images to load */
        $(window).load( function() {
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