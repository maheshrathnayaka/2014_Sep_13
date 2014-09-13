<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <a href="<?php echo base_url("/cart"); ?>">
                <button type="button" class="btn btn-default btn-circle">Cart</button>
            </a>
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
    <form class="form-signin" action="<?php echo base_url(); ?>supercheckout/billing" method="post">
        <div class="col-md-6"> 

            <h4 class="form-signin-heading" style="margin: 15px;">BILLING ADDRESS</h4>
            <div class="radio" style="margin: 15px;">
                <label>
                    <input type="radio" name="billingAdd" id="billingexist" value="existing" checked>
                    I want to use my existing address
                </label>
            </div>
            <div class="radio" style="margin: 15px;">
                <label>
                    <input type="radio" name="billingAdd" id="billingnew" value="newadd">
                    I want to use a new address
                </label>
            </div>
            <div id="billaddress" style="display: none;">
                <div class="form-group col-md-6 control-group">
                    <label for="billingfname" class="control-label" >First name *</label>
                    <input type="text" name="billingfname" id="billingfname" class="form-control" placeholder="First name" required disabled>
                </div>
                <div class="form-group col-md-6 control-group">
                    <label for="billinglname" class="control-label" >Last name *</label>
                    <input type="text" name="billinglname" id="billinglname" class="form-control" placeholder="Last name" required disabled>
                </div>

                <div class="form-group control-group" style="margin: 15px;">
                    <label for="billingaddress1" class="control-label" >Address *</label>
                    <input type="text" name="billingaddress1" id="billingaddress1" class="form-control" placeholder="Line 1" required disabled>
                </div>
                <div class="form-group control-group" style="margin: 15px;">
                    <label for="billingaddress2" class="control-label" ></label>
                    <input type="text" name="billingaddress2" class="form-control" placeholder="Line 2" id="addline2">
                </div>
                <div class="form-group control-group" style="margin: 15px;">
                    <label for="billingcity" class="control-label" >City *</label>
                    <input type="text" name="billingcity" id="billingcity" class="form-control" placeholder="City" required disabled>
                </div>
            </div>


            <div style="margin: 15px;">                                   

                <label class="checkbox">
                    <input type="checkbox" class="checkbox" checked="checked" id="shipaddress" name="shipaddress" value="checked">
                    Ship to the same address
                </label>

            </div>
            <div id="newshipaddress" style="display: none;">
                <h4 class="form-signin-heading" style="margin-left : 15px; margin-top: 30px;">SHIPPING ADDRESS</h4>
                
                <div class="form-group col-md-6 control-group">
                    <label for="shipfname" class="control-label" >First name *</label>
                    <input type="text" name="shipfname" id="shipfname" class="form-control" placeholder="First name" required disabled>
                </div>
                <div class="form-group col-md-6 control-group">
                    <label for="shiplname" class="control-label" >Last name *</label>
                    <input type="text" name="shiplname" id="shiplname" class="form-control" placeholder="Last name" required disabled>
                </div>

                <div class="form-group control-group" style="margin: 15px;">
                    <label for="shipaddr1" class="control-label" >Address *</label>
                    <input type="text" name="shipaddress1" id="shipaddress1" class="form-control" placeholder="Line 1" required disabled>
                </div>
                <div class="form-group control-group" style="margin: 15px;">
                    <label for="shipaddr2" class="control-label" ></label>
                    <input type="text" name="shipaddress2" class="form-control" placeholder="Line 2">
                </div>
                <div class="form-group control-group" style="margin: 15px;">
                    <label for="shipcity" class="control-label" >City *</label>
                    <input type="text" name="shipcity" id="shipcity" class="form-control" placeholder="City" required disabled>
                </div>
            </div>


            <div class="form-group col-md-12 control-group">
                <label for="remarks" class="control-label" >Order Notes to the seller</label>
                <textarea class="form-control" name="remarks" rows="3" placeholder="Leave here a message to the seller"></textarea>
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
                        <input type="checkbox" name="newsletter" value="true" checked="checked">                    
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