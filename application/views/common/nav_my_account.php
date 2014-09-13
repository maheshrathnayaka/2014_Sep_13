<ul class="nav nav-pills nav-stacked">
    <li <?php if(isset($account)&&!empty($account)&&$account=='public'){ echo 'class="active"';}?>><a href="<?php echo base_url("/my_account"); ?>">Public Profile</a></li>
    <li <?php if(isset($account)&&!empty($account)&&$account=='edit'){ echo 'class="active"';}?>><a href="<?php echo base_url("/profileupdate"); ?>">Account Information</a></li>
    <li <?php if(isset($account)&&!empty($account)&&$account=='purchase'){ echo 'class="active"';}?>><a href="<?php echo base_url("/order_history"); ?>">Purchasing History</a></li>
    <li <?php if(isset($account)&&!empty($account)&&$account=='messages'){ echo 'class="active"';}?>><a href="<?php echo base_url("/my_messages"); ?>">Messages</a></li>
    <li <?php if(isset($account)&&!empty($account)&&$account=='subscription'){ echo 'class="active"';}?>><a href="<?php echo base_url("/my_subscriptions"); ?>">Subscriptions</a></li>
    <li <?php if(isset($account)&&!empty($account)&&$account=='wishlist'){ echo 'class="active"';}?>><a href="<?php echo base_url("/my_wishlist"); ?>">Wish List</a></li>
</ul>
