<hr>
<h3 class="text-center">Your Shopping Cart</h3>
<hr>

<?php
if (!$this->cart->contents()) { ?>
    <div class="alert alert-warning">You don't have any items in your cart.</div>        
<?php } else { ?>
    <?php echo form_open('cart/update_cart', 'cart_form'); ?>
    <div class="panel panel-success">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <table class="table table-hover">
                        <thead> 
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th class="text-center">In stock</th>
                                <th class="text-center">Price</th>
                                <th class="text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) { ?>         
                                <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                                <tr>
                                    <td class="col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo base_url("/images/uploads") . '/' . $items['options']['image']; ?>" style="width: 57px; height: 57px;"> </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#"><?php echo $items['name']; ?></a></h4>
                                            </div>
                                        </div></td>
                                    <td class="col-md-1" style="text-align: center">
                                        <input type="text" name="qty[]" class="form-control" id="quantity" value=<?php echo $items['qty']; ?>>
                                    </td>
                                    <td class="col-md-1 text-center">
                                        <!--?php if ($this->cart->has_options($items['rowid']) == TRUE): ?-->
                                        <!--?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?-->
                                        <?php echo $items['options']['stock']; ?>
                                        <input type="hidden" name="stock[]" value=<?php echo $items['options']['stock']; ?>>
                                        <!--?php endforeach; ?-->
                                        <!--?php endif; ?-->
                                    </td>
                                    <td class="col-md-1 text-center">
                                        <strong>
                                            <?php echo $this->cart->format_number($items['price']); ?>
                                        </strong>
                                    </td>
                                    <td class="col-md-1">                                        
                                        <strong>
                                            <?php echo $this->cart->format_number($items['subtotal']); ?>
                                        </strong>                                        
                                    </td>
                                    <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-danger" id="btn-<?php echo $items['rowid']; ?>">
                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                        </button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>

                            <tr>
                                <td class="text-left">
                                    <label style="font-size:11px">Note: If the quantity is set to zero, the item will be removed from the cart.</label></td>
                                <td>   </td>
                                <td></td>
                                <td><h3>Total</h3></td>
                                <td class="text-center"><h3>
                                        <strong>
                                            <?php echo $this->cart->format_number($this->cart->total()); ?>
                                        </strong></h3></td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>


                                <td>                                        
                                    <input type="submit" name="continue" class="btn btn-default" value="Continue Shopping"/>                                     
                                </td>
                                <td>                                        
                                    <input type="submit" name="update" class="btn btn-default" value="Update Cart"/>                                        
                                </td>
                                <td>
                                    <input type="submit" name="checkout" class="btn btn-success" value="Checkout"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        echo form_close();
    }
    ?>
</div>  


