<script>
    function viewCart(){
        //alert("cart");                    
        
        
        $.ajax({
            url: "<?php echo base_url(); ?>/cart/show_ajax",
            type: 'POST',
            success: function(data) 
            {
                if (data) 
                {
                    $("#cart-container").fadeToggle("slow");
                    $("#cart-container").html(data).show();
                }
            }
        }
    );
    }
</script>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="navbar-brand" href='<?php echo base_url(); ?>'><strong>KStore</strong></a>
        </div>
        <div class="row">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata('logged_in') && $this->session->userdata['logged_in']['is_admin'] == 'yes') { ?>
                        <li <?php
                    if (isset($main_nav) && $main_nav == 'admin') {
                        echo 'class="active"';
                    }
                        ?>><a href="<?php echo base_url("/admin_dash"); ?>">Admin Panel</a></li>
                        <?php } ?>
                    <li <?php
                    if (isset($main_nav) && $main_nav == 'gallery') {
                        echo 'class="active"';
                    }
                    ?>><a href="<?php echo base_url("/browse_gallery?catid=0"); ?>">Buy</a></li>      
                    <?php if ($this->session->userdata('logged_in')) { ?>
                        <li <?php
                    if (isset($main_nav) && $main_nav == 'post ads') {
                        echo 'class="active"';
                    }
                        ?>><a href="<?php echo base_url("/new_ad_post"); ?>">Sell</a></li>
                        <?php } else {
                            ?>
                        <li <?php
                        if (isset($main_nav) && $main_nav == 'post ads') {
                            echo 'class="active"';
                        }
                            ?>><a href="<?php echo base_url("/login"); ?>">Sell</a></li>
                        <? } ?>
                        <?php if ($this->session->userdata('logged_in')) { ?>
                        <li <?php
                        if (isset($main_nav) && $main_nav == 'my account') {
                            echo 'class="active"';
                        }
                            ?>><a href="<?php echo base_url("/my_account"); ?>">My Account</a></li>
                        <? } ?>
                    <li <?php
                        if (isset($main_nav) && $main_nav == 'branches') {
                            echo 'class="active"';
                        }
                        ?>><a href="<?php echo base_url("/view_k_stores"); ?>">Branches</a></li>
                    <li <?php
                        if (isset($main_nav) && $main_nav == 'faq') {
                            echo 'class="active"';
                        }
                        ?>><a href="<?php echo base_url("/faq"); ?>">FAQ</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="form">
                    <?php
                    if ($this->session->userdata('logged_in')) {
                        $first_name = $this->session->userdata['logged_in']['first_name'];
                        $last_name = $this->session->userdata['logged_in']['last_name'];
                        ?>
                        <div class="form-group">
                            <a href="<?php echo base_url("/cart"); ?>" class="hidden-sm label label-primary">View Cart</a>

                            <large>
                                <i class="fa fa-shopping-cart" style="margin-right: 20px; margin-left: 5px; color: #000"></i>
                            </large>
                            <small><?php echo 'Hi ' . $first_name . '!' ?></small><label  style="margin-right: 10px;"></label>
                            <a class="link-login label label-info" href="<?php echo base_url("/home/logout"); ?>">Log out</a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="form-group">
                            <a href="<?php echo base_url("/cart"); ?>" class="hidden-sm label label-primary">View Cart</a>
                            <div id="cart-container" class="cart-container"></div>
                            <large>
                                <i class="fa fa-shopping-cart" style="margin-right: 20px; margin-left: 5px; color: #000"></i>
                            </large>
                            <a class="link-login label label-info" href="<?php echo base_url("/users"); ?>">Register</a>
                            <a class="link-login label label-info" href="<?php echo base_url("/login"); ?>">Log in</a>
                        </div>
                        <?php
                    }
//}
                    ?>  
                </form>
            </div><!--/.navbar-collapse -->
        </div><!--/.row -->
    </div>
</div>