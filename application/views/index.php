<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon.ico" type="image/x-icon"/>

        <title>KStore</title>
        <?php $this->load->helper('url'); ?>

        <style type="text/css">

            #result
            {
                position:absolute;
                width:722px;
                padding:10px;
                display:none;
                margin-top:-1px;
                border-top:0px;
                overflow:hidden;
                border:1px #CCC solid;
                background-color: white;
                z-index: 1;
            }
            .show
            {
                padding:10px; 
                border-bottom:1px #999 dashed;
                font-size:15px; 
                height:50px;
            }
            .show:hover
            {
                background:#eaf1f1;
                color:#FFF;
                cursor:pointer;
            }


            .tags_container{width:1000px;height: 150px;padding-top: 20px;padding-bottom: 10px;padding-right:10px;padding-left: 10px;text-align: left}
            .tags ul{padding:5px 5px;}
            .tags li{margin:0;padding:0;list-style:none;display:inline;}
            .tags li a{text-decoration:none;padding:0 2px;}
            .tags li a:hover{text-decoration:underline;} 

            .tag1 a{font-size:12px; color: #9c639c;}
            .tag2 a{font-size:14px; color: #cece31;}
            .tag3 a{font-size:16px; color: #9c9c9c;}
            .tag4 a{font-size:18px; color: #31ce31;}
            .tag5 a{font-size:20px; color: #6363ad;}
            .tag6 a{font-size:22px; color: #ebccd1;}
            .tag7 a{font-size:24px; color: #9c3100;}
            .tag8 a{font-size:26px; color: #76109a;}
            .tag9 a{font-size:28px; color: #799a10;}
            .tag10 a{font-size:30px; color: #9c3100;}


            <?php
            require_once('assets/css/signup.css');
            require_once('assets/css/custom-th.css');
            ?>
        </style>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">


        <script>
            $(function () { $("input").not("[type=submit]").jqBootstrapValidation(); } );
        </script>

        <script>
<?php
require_once(APPPATH . 'assets/js/jquery.min.js');
?>
        </script>
        <script>
            function changeAction(catid){
                if(catid==0){
                    document.searchform.action="/search_items";
                }
            }
        </script>


        <script>
            $(function(){
                $("#search").keyup(function() { 
                    var searchid = $("#search").val();
                    var dataString = 'search='+ searchid;
                    if(searchid!='')
                    {
                        $.ajax({
                            type: "POST",
                            url: "http://kstoretesting.net16.net/live_search",
                            data: dataString,
                            cache: false,
                            success: function(html)
                            {
                                $("#result").html(html).show();
                            }
                        });
                    }return false;    
                });

                jQuery("#result").on("click",function(e){ 
                    var $clicked = $(e.target);
                    var $name = $clicked.find('.name').html();    
                    var decoded = $("<div/>").html($name).text();
                    $('#search').val(decoded);
                });
                jQuery(document).on("click", function(e) { 
                    var $clicked = $(e.target);
                    if (! $clicked.hasClass("search")){
                        jQuery("#result").fadeOut(); 
                    }
                }); 
                $('#search').click(function(){
                    jQuery("#result").fadeIn();
                });
       
            });
        </script>


    </head>

    <body>
        <?php $GLOBALS['main_nav'] = 'index' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?> <!-- Navigation Menu -->

        <div class="container" style="margin: 20px auto;">

            <!-- Search Box -->
            <div class="cont-search-cust row">
                <form id="searchform" class="form-horizontal" role="form" action="<?php echo base_url(); ?>browse_gallery" method="get">
                    <div class="form-group" style="margin:0 auto;">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control" id="search" placeholder="Search...">
                            <div id="result">                          
                            </div>
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

            <!-- Category Menu -->

            <ul id="cat-menu" class="nav nav-pills nav-justified category-bar">
                <?php
                if (isset($cats)) {
                    $cat_temp = array();
                    $prio_temp = array();
                    foreach ($cats as $key => $row) {
                        $cat_temp[$key] = $row['parentcategory'];
                        $prio_temp[$key] = $row['priority'];
                    }
                    array_multisort($cat_temp, SORT_ASC, $prio_temp, SORT_ASC, $cats);

                    $cats_inner = $cats;
                }
                foreach ($cats as $cat) {
                    if ($cat['parentcategory'] == 0) {
                        $cat_id = $cat['categoryid'];
                        ?>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $cat['categoryname'] ?></a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach ($cats_inner as $cat_inner) {
                                    if ($cat_inner['parentcategory'] == $cat_id) {
                                        $inner_cat_id = $cat_inner['categoryid'];
                                        ?>          
                                        <li><a href='<?php echo base_url("/browse_gallery?catid=") . urldecode($inner_cat_id); ?>'><?php echo $cat_inner['categoryname'] ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>


            <!-- Products Slider -->

            <div class="row cont-slider-cust">
                <div class="row">
                    <div class="col-md-9">
                        <h3>
                            You may be interested in</h3>
                    </div>
                    <div class="col-md-3">
                        <!-- Controls -->
                        <div class="controls pull-right hidden-xs">
                            <a class="left fa fa-chevron-left btn btn-success" href="#product-slider"
                               data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#product-slider"
                               data-slide="next"></a>
                        </div>
                    </div>
                </div>
                <div id="product-slider" class="carousel slide hidden-xs" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <?php
                        if (isset($sliderads)) {
                            
                        }
                        $ad_count = 0;
                        foreach ($sliderads as $ad) {
                            if ($ad_count == 0) {
                                echo '<div class="item active">';
                                echo '<div class="row">';
                            } else if ($ad_count % 4 == 0) {
                                echo '<div class="item">';
                                echo '<div class="row">';
                            }
                            $ad_count++;
                            $img_url = base_url("/images/uploads") . '/' . $ad['image'];
                            ?>
                            <div class="col-sm-3">
                                <div class="col-item">
                                    <div class="photo">
                                        <img src='<?php echo $img_url; ?>' class="img-responsive lazy" alt='<?php echo $ad['title']; ?>' />
                                    </div>
                                    <div class="info" style="position: absolute; bottom: 0;">
                                        <div class="row">
                                            <div class="price">
                                                <h5>
                                                    <?php echo $ad['title']; ?></h5>
                                                <h5 class="price-text-color">
                                                    <?php echo 'Rs. ' . $this->cart->format_number($ad['price']); ?></h5>

                                            </div>
                                        </div>
                                        <div class="separator clear-left">
                                            <p class="">
                                                <input type="hidden" name="ad_id"  value=<?php echo $ad['adid']; ?>/>
                                                <input type="hidden" name="qty"  value=<?php echo $ad['quantity']; ?>/>
                                                <i class="fa fa-shopping-cart"></i><a href="<?php echo base_url("/ad_details?adid=") . urldecode($ad['adid']); ?>" class="hidden-sm">Add to cart</a></p>
                                            <!--p class="btn-details">
                                                <i class="fa fa-list"></i><a  class="hidden-sm" href=<!--?php echo base_url("/ad_details?adid=") . urldecode($ad['adid']); ?>>More details</a></p-->
                                        </div>
                                        <div class="clearfix">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($ad_count % 4 == 0) {
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>

                    </div>
                </div>

            </div>
            <div class="row well " style="margin-top: 20px;">
                <hr>
                <h3>We recommend these</h3>
                <hr>


                <!-- Item Gallery-->
                <div id="div_gallery">
                    <?php if (!isset($recommoendads) || empty($recommoendads)) { ?>
                        <div class="alert alert-warning">
                            No results available!
                        </div>
                        <?php
                    } else {
                        foreach ($recommoendads as $ad) {
                            $img_url = base_url("/images/uploads") . '/' . $ad['image'];
                            ?>
                            <form action="">
                                <!--?php echo form_open("cart/add_cart_item"); ?-->
                                <!--?php echo form_hidden('ad_id', $ad['adid']); ?-->
                                <!--a href = <!--?php echo base_url("/ad_details?adid=") . urldecode($ad['adid']); ?>-->

                                    <div class = "col-md-2 col-xs-4 productbox glow" id="items">
                                        <div class = "img-container">
                                            <img class = "img-responsive image-center lazy" src = <?php echo $img_url; ?>>
                                        </div>
                                        <div class = "producttitle"><?php echo $ad['title']; ?></div>
                                        <div class = "productprice">
                                            <input type="hidden" name="adid"  value=<?php echo urldecode($ad['adid']); ?>/>
                                            <div class = "pull-left">
                                                <a href = <?php echo base_url("/ad_details?adid=") . urldecode($ad['adid']); ?>>
                                                    <span class="btn btn-primary btn-xs">Add to cart</span>
                                                </a>
                                            </div>
                                            <div class = "pricetext"><?php echo 'Rs.' . $this->cart->format_number($ad['price']); ?></div>

                                        </div>
                                    </div>
                                <!--/a-->
                                <!--?php echo form_close(); ?-->
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>


            <div class="row " style="margin-top: 20px; background-color: #eaf1f1;border: 1px #dbd1d1 solid ">
                <div style="background-color: #B3DAE5;text-align: center">
                    <label><h3><b>Top 10 Tags <></b></h3></label>

                </div>
                <div class="tags_container">
                    <ul class="tags">
                        <?php
                        $maximun = $max;

                        if ($maximun < 10) {
                            $maximun = 10;
                        }
                        $factor = $maximun / 9;

                        foreach ($tag as $row2) {
                            $catid = $row2->catid;
                            $catname = $row2->catname;
                            $freq = $row2->max;

                            for ($i = 0; $i <= 9; $i++) {
                                $start = $factor * $i;
                                $end = $start + $factor;
                                if ($freq > $start && $freq <= $end) {
                                    $tag_number = $i + 1;
                                }
                            }
                            ?> 




                            <li class="tag<?php echo $tag_number; ?>">
                                <a href=" http://kstoretesting.net16.net/browse_gallery?catid=<?php echo $catid; ?>">
                                    <?php echo $catname; ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?> 
                    </ul>
                </div> 


            </div>

            <hr>

            <footer>
                <p><small><strong>&copy; Kstore 2014</strong></small></p>

            </footer>

        </div>
    </div>

</div> <!-- /container -->        


<script>
        !function ($) {
        $(function(){
            // carousel demo
            $('#product-slider').carousel()
        })
    }(window.jQuery)
</script>

<?php require_once (APPPATH . 'views/common/footer_th.php'); ?>


</body>
</html>
