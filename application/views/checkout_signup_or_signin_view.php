<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle">1</button>
            <p>Cart</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle">2</button>
            <p>Checkout</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
            <p>Payment</p>
        </div> 
    </div>
</div>

<div class="row-fluid">
    <div class="col-md-4 col-md-offset-1">
        <h4><strong>I am a registered customer</strong></h4>
        <form class="form-signin" action="<?php echo base_url(); ?>verifylogin" method="post">
            <h3 class="form-signin-heading">Please sign in</h3>
            <div class="row">
                <div class="form-group col-md-9">
                    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email address">
                    <?php echo form_error('email'); ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-9">
                    <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Password">
                    <?php echo form_error('password'); ?>
                </div>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        </form>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <h4><strong>I am a new customer</strong></h4>
        <h6>Please enter details here if you are an unregistered customer</h6>

        <h6>If you wish to register at KStore <a href="<?php echo base_url("/users"); ?>">click here</a></h6>
        <form class="form-signin">
            <h3 class="form-signin-heading">Billing Details</h3>
            <div class="form-group col-md-6 control-group">
                <label for="firstname" class="control-label" >First name</label>
                <input type="text" class="form-control" placeholder="First name">
            </div>
            <div class="form-group col-md-6 control-group">
                <label for="lasttname" class="control-label" >Last name</label>
                <input type="text" class="form-control" placeholder="Last name">
            </div>
            <div class="form-group control-group" style="margin: 15px;">
                <label for="address1" class="control-label" >Address</label>
                <input type="text" class="form-control" placeholder="Line 1">
                <label for="address2" class="control-label" ></label>
                <input type="text" class="form-control" placeholder="Line 2">
                <label for="city" class="control-label" ></label>
                <input type="text" class="form-control" placeholder="City">
            </div>

            <div class="form-group col-md-6 control-group">
                <label for="email" class="control-label" >Email Address</label>
                <input type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group col-md-6 control-group">
                <label for="lastname" class="control-label" >Phone</label>
                <input type="text" class="form-control" placeholder="Phone">
            </div>
            <div class="form-group control-group" style="margin: 15px;">
                <label for="remarks" class="control-label" >Order Notes</label>
                <textarea class="form-control" rows="3" placeholder="Notes about your order.(Special notes for delivery)"></textarea>
            </div>
            <div class="form-group control-group" style="margin: 15px;">
                <div class="control-group col-sm-1">                    
                    <input type="checkbox" value="newsletter">                    
                </div>
                <div class="col-sm-9 control-group">
                    <label class="control-label">Subscribe me for KStore news letter</label>
                </div>
            </div>
            <p>&nbsp;</p>
            
            <div class="form-group control-group" style="margin: 15px;">
                 <button class="btn btn-large btn-primary" type="submit">Place Order</button>
            </div>
        </form>
    </div>
</div>
