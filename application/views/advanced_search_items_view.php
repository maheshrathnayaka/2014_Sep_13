<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="Add to Cartport" content="width=device-width, initial-scale=1.0">
        <title>Search Results</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        
    </head>
    <body class="body-custom"> 
        <?php $main_nav = 'gallery' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <!-- Search Box -->
            <div class="cont-search-cust row" style="margin: 8px; margin-top: 0px;">
                <form id="searchform" class="form-horizontal" role="form" action="<?php echo base_url(); ?>browse_gallery/search_items" method="post">
                    <div class="form-group" style="margin:0 auto;">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control" id="search" placeholder="Search...">
                        </div>
                        <div class="col-md-3">
                            <select name="catid" class="form-control">
                                <option value="0">All Categories</option>
                                <?php
                                if (isset($top) && !empty($top)) {
                                    foreach ($top as $key => $row) {
                                        ?>
                                        <option value=<?php echo $row['categoryid']; ?>><?php echo $row['categoryname']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="submit"class="btn btn-primary" value="Search"/>
                            <div class="clearfix"></div>
                            <a href="<?php echo base_url(); ?>advanced_search">Advanced</a>
                        </div>    
                    </div>
                </form>   
            </div>



            <!-- Item Gallery-->
            <div>
                <?php if (!isset($ads) || empty($ads)) { ?>
                    <div class="alert alert-warning">
                        No results available!
                    </div>
                    <?php
                } else {
                    foreach ($ads as $ad) {
                        $img_url = base_url("/images/uploads") . '/' . $ad['image'];
                        ?>
                        <?php echo form_open("cart/add_cart_item"); ?>
                        <!--?php echo form_hidden('ad_id', $ad['adid']); ?-->
                        <a href = <?php echo base_url("/ad_details?adid=") . urldecode($ad['adid']); ?>>

                            <div class = "col-md-2 col-xs-4 productbox glow" id="items">
                                <div class = "img-container">
                                    <img class = "img-responsive image-center lazy" src = <?php echo $img_url; ?>>
                                </div>
                                <div class = "producttitle"><?php echo $ad['title']; ?></div>
                                <div class = "productprice">
                                    <input type="hidden" name="ad_id"  value=<?php echo $ad['adid']; ?>/>
                                    <div class = "pull-left">
                                        <input type="submit" name="submit" class="btn btn-primary btn-xs" value="Add to cart"/>
                                    </div>
                                    <div class = "pricetext"><?php echo 'Rs.' . $this->cart->format_number($ad['price']); ?></div>

                                </div>
                            </div>
                        </a>
                        <?php echo form_close(); ?>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
        <script>
<?php
require_once(APPPATH . 'assets/js/core.js');
?>
        </script>

    </body>
</html> 