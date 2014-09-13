<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="Add to Cartport" content="width=device-width, initial-scale=1.0">
        <script><?php require_once('assets/js/gallery_ajax.js'); ?></script>
        <script><?php require_once('assets/js/sort_ajax.js'); ?></script>
        <?php
        if (isset($cat)) {

            $main_cat = array();
            foreach ($cat as $main_cat) {
                $main_cat = $main_cat;
            }
            if (empty($main_cat)) {
                $main_cat['categoryname'] = 'All Categories';
                $main_cat['categoryid'] = 0;
                $main_cat['isendnode'] = 0;
            }
            ?><title><?php echo $main_cat['categoryname'] ?></title>

            <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

        </head>
        <body class="body-custom"> 
            <?php $main_nav = 'gallery' ?>
            <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
            <div class="container cont-cust">


                <!-- Search Box -->
                <div class="cont-search-cust row" style="margin: 8px; margin-top: 0px;">
                    <form id="searchform" class="form-horizontal" role="form" action="<?php echo base_url(); ?>browse_gallery" method="get">
                        <div class="form-group" style="margin:0 auto;">
                            <div class="col-md-8">
                                <?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])) { ?>
                                    <input type="text" name="keyword" class="form-control" id="search1" value="<?php echo $_GET['keyword'] ?>">
                                <?php } else {
                                    ?>
                                    <input type="text" name="keyword" class="form-control" id="search" placeholder="Search...">
                                <?php } ?>

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
                            <div class="col-md-1" style="text-align: center;">
                                <input type="submit"class="btn btn-primary" value="Search"/>
                                <div class="clearfix"></div>
                                <a href="<?php echo base_url(); ?>advanced_search"><small>Advanced</small></a>
                            </div>    
                        </div>
                    </form>   
                </div>

                <!-- Category Path -->
                <ol class="breadcrumb">
                    <?php
                    if (isset($cat_path) && !empty($cat_path)) {
                        $cat_path_reversed = $reversed = array_reverse($cat_path);
                        $is_super_parent = true;
                        foreach ($cat_path_reversed as $cat_node) {
                            $is_super_parent = false;
                            $cat_name = $cat_node['categoryname'];
                            $cat_id = $cat_node['categoryid'];
                            if ($cat_id == $main_cat['categoryid']) {
                                echo '<li class="active">' . $cat_name . '</li>';
                            } else {
                                echo '<li><a href=' . base_url("/browse_gallery?catid=") . urldecode($cat_id) . '>' . $cat_name . '</a></li>';
                                echo '&nbsp;<span class="divider glyphicon glyphicon glyphicon-circle-arrow-right" style="color: dodgerblue";>&nbsp;</span>';
                            }
                        }
                        if ($is_super_parent == true) {
                            echo '<li class="active">All Categories</li>';
                        }
                    } else {
                        echo '<li class="active">All Categories</li>';
                    }
                    ?>

                    <div class="btn-group pull-right" style="padding-right: 30px;">
                        <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                            Sort Your Results <span class="caret"></span>
                        </button>                        
                        <ul class="dropdown-menu" role="menu">
                            <li><a tabindex="1" id="priceLow" onclick="sort_low()">Price:Lowest first</a></li>
                            <li><a id="priceHigh" tabindex="1" onclick="sort_high()">Price:Highest first</a></li>
                            <li><a id="recent" tabindex="1" onclick="sort_recent()">Recent posts</a></li>
                        </ul>                        
                    </div>
                </ol>

                <!-- Advanced Search (Attribute-wise)-->
                <div class="row" style="margin-right: 10px;">
                    <div class="panel panel-default searchbox" style="background-color: #FBFBFB;" >
                        <div class="panel-body">
                            <div>
                                <label class="label label-primary">Price:</label>
                                <br><br>
                                <form class="form" role="form">
                                    <label>Rs</label>
                                    <div class="form-group">
                                        <input type="pricefrom" class="form-control" id="pricefrom" placeholder="Price from...">
                                        <small id="label_price_f" style="color: red; text-decoration: none; text-align: center" hidden>Invalid price value!</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="priceto" class="form-control" id="priceto" placeholder="Price to...">
                                        <small id="label_price_t" style="color: red; text-decoration: none; text-align: center" hidden>Invalid price value!</small>
                                    </div>
                                    <div class="form-group inline">
                                        <button  type="button" onclick="refresh_page()" class="btn btn-default">>></button>

                                    </div>
                                </form>
                                <hr>
                            </div>
                            <div>
                                <label class="label label-primary">Location:</label>
                                <br><br>
                                <form class="" role="form">
                                    <div class="form-group">
                                        <label for="loctype" class="control-label">Location Type:</label>
                                        <select class="form-control" id="loctype" onChange="refresh_page_with_all_locs()">
                                            <option value="locany">Any</option>
                                            <option value="kstore">KStore Branches</option>
                                            <option value="private">Private Locations</option>
                                        </select>
                                        <br>
                                        <div id="div_city">
                                            <label for="loctype" class="control-label">City:</label>
                                            <select class="form-control" id="locname" onChange="refresh_wo_location()">
                                                <option value="0">Any</option>
                                                <?php
                                                if (isset($loc) && !empty($loc)) {
                                                    foreach ($loc as $city) {
                                                        ?>
                                                        <option><?php echo $city['city'] ?></option>       
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                            </div>
                            <div>
                                <label class="label label-primary">Seller:</label>
                                <br><br>
                                <form class="" role="form">
                                    <div class="form-group">
                                        <input type="radio" id="asellers" name="sellertype" value="all_sellers" onchange="refresh_page()" checked>All Sellers<br>
                                        <input type="radio" id="vsellers" name="sellertype" value="verified_sellers" onchange="refresh_page()">Only Verified Sellers
                                    </div>
                                </form>
                                <hr>
                            </div>

                            <?php
                            if (isset($multi_attr) && !empty($multi_attr)) {
                                foreach ($multi_attr as $attr) {
                                    ?><div class="form-group">
                                        <label class="label label-primary"><?php echo $attr['attributename'] ?></label><br>
                                        <?php
                                        if (isset(${"attr_" . $attr['attributeid']}) && !empty(${"attr_" . $attr['attributeid']})) {
                                            foreach (${"attr_" . $attr['attributeid']} as $value) {
                                                ?>
                                                <br><input type="checkbox" id="<?php echo $value['valueid'] ?>" onclick="refresh_page();"><?php echo $value['dropdownvalues'] ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <br>
                                        <hr>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>      
                    </div >

                    <div class=" gal-container">

                        <!-- Sub Categories Menu-->
                        <?php
                        if (isset($child_cats) && !empty($child_cats)) {
                            $cat_temp = array();
                            $prio_temp = array();
                            foreach ($child_cats as $key => $row) {
                                $cat_temp[$key] = $row['parentcategory'];
                                $prio_temp[$key] = $row['priority'];
                            }
                            array_multisort($cat_temp, SORT_ASC, $prio_temp, SORT_ASC, $child_cats);

                            echo '<ul class="nav nav-pills " style="border-bottom:1px solid #E1E1E1; border-top:1px solid #E1E1E1;  margin-bottom:10px; ">';
                            foreach ($child_cats as $child) {
                                $cat_name = $child['categoryname'];
                                $cat_id = $child['categoryid'];
                                if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                                    echo '<li><a href=' . base_url("/browse_gallery?keyword=") . urldecode($_GET['keyword']) . '&catid=' . urldecode($cat_id) . '>' . $cat_name . '</a></li>';
                                } else {
                                    echo '<li><a href=' . base_url("/browse_gallery?catid=") . urldecode($cat_id) . '>' . $cat_name . '</a></li>';
                                }
                                //echo '<li><a href=' . base_url("/browse_gallery?catid=") . urldecode($cat_id) . '>' . $cat_name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>

                        <!-- Item Gallery-->
                        <div id="div_gallery">
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
                </div>
            </div>

            <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

            <script>
    <?php
    require_once(APPPATH . 'assets/js/core.js');
}
?>
        </script>

    </body>
</html> 