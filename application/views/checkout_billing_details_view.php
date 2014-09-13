<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle">Cart</button>

        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle">Checkout</button>

        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle" disabled="disabled">Payment</button>

        </div> 
    </div>
</div>

<div class="row-fluid" style="padding-right: 40px; padding-top: 18px;">
    <form class="form-signin" action="<?php echo base_url(); ?>checkout/billing" method="post">
        <div class="col-md-6"> 

            <h3 class="form-signin-heading" style="margin: 15px;">BILLING DETAILS</h3>

            <div class="form-group col-md-6 control-group">
                <label for="firstname" class="control-label" >First name *</label>
                <input type="text" name="fname" class="form-control" placeholder="First name" required>
            </div>
            <div class="form-group col-md-6 control-group">
                <label for="lasttname" class="control-label" >Last name *</label>
                <input type="text" name="lname" class="form-control" placeholder="Last name" required>
            </div>

            <div class="form-group control-group" style="margin: 15px;">
                <label for="address1" class="control-label" >Address *</label>
                <input type="text" name="address1" class="form-control" placeholder="Line 1" required>
            </div>
            <div class="form-group control-group" style="margin: 15px;">
                <label for="address2" class="control-label" ></label>
                <input type="text" name="address2" class="form-control" placeholder="Line 2">
            </div>
            <div class="form-group control-group" style="margin: 15px;">
                <label for="city" class="control-label" >City *</label>
                <input type="text" name="city" class="form-control" placeholder="City" required>
            </div>

            <div class="form-group col-md-6 control-group">
                <label for="email" class="control-label" >Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <?php if (isset($email) && $email == 1) { ?>
                    <ul role="alert">
                        <li style="color: #c09853;">  The email you entered is already registered. Try a different one. </li>
                    </ul>
                <?php } ?>
            </div>
            <div class="form-group col-md-6 control-group">
                <label for="phone" class="control-label" >Phone</label>
                <input type="text" name="telephone" class="form-control" value="<?php echo set_value('telephone'); ?>" placeholder="Phone">
                <?php echo form_error('telephone'); ?>
            </div>
            <div class="form-group control-group" style="margin-left: 15px; margin-top: 120px;">
                <div class="control-group col-sm-1">                    
                    <input type="checkbox" name="createaccount" value="true" id="createaccount">                    
                </div>
                <div class="col-sm-9 control-group">
                    <label class="control-label">Create new Account at KStore</label>
                </div>
            </div>

            <div class="form-group col-md-12 control-group" id="passwordview" style="display: none;">
                <p style="padding-top: 15px;">Create an account by entering a password below.<br>
                    If you are a registered customer please login at the top of the page</p>
                <label for="password" class="control-label" >Password *</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group col-md-12 control-group">
                <label for="remarks" class="control-label" >Order Notes</label>
                <textarea class="form-control" name="remarks" rows="3" placeholder="Notes about your order.(Special notes for delivery)"></textarea>
            </div>            
            <p>&nbsp;</p>

        </div>
        <div class="col-md-5 col-md-offset-1" style="border: 2px solid black; padding: 15px;">
            <h3 class="">YOUR ORDER</h3>
            <div class="row">
                <div class="form-group" style="padding: 15px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left">Product</th>
                                <th class="col-md-2 col-md-offset-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) { ?>
                                <tr>
                                    <td>
                                        <!--
                                        <a class="thumbnail pull-left" href="#"> 
                                            <img class="media-object" src="<!?php echo base_url("/images/uploads") . '/' . $items['options']['image']; ?>" style="width: 40px; height: 40px;">
                                        </a> 
                                        -->
                                        <small><?php echo $items['name']; ?></small>
                                    </td>
                                    <td class="col-sm-2 col-sm-offset-2">
                                        <?php echo $this->cart->format_number($items['price']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr class="active">
                                <td><small>SUBTOTAL</small></td>
                                <td class="col-sm-2 col-sm-offset-2">
                                    <strong><?php echo $this->cart->format_number($this->cart->total()); ?></strong>
                                </td>                                
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table-condensed">
                        <thead>
                            <tr>
                                <td><strong>SELECT PAYMENT METHOD</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="paymentMethods" id="paymentcashondelivery" value="cash" checked>
                                            Payment on Delivery
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="paymentMethods" id="creditcardpayment" value="creditcard">
                                            Credit Card Payment
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="paymentMethods" id="getfromkstore" value="storepickup">
                                            Pick from KStore
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group control-group">
                    <div class="control-group col-sm-1">                    
                        <input type="checkbox" name="newsletter" value="true">                    
                    </div>
                    <div class="col-sm-9 control-group">
                        <label class="control-label">Subscribe me for KStore news letter</label>
                    </div>
                </div>
            </div>
            <div style="padding-top: 30px; padding-bottom: 10px;">
                <input type="submit" class="btn btn-primary btn-place-order" style="" value="Place Order"/>
            </div>

        </div>
    </form>
</div>