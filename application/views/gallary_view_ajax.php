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