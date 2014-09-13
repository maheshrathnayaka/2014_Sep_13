<div class="container">
    <div class="col-md-9">
        <?php if (isset($wishlist) && !empty($wishlist)) { ?>
            <table class="table table-hover">
                <th class="text-center">Image</th>
                <th class="text-center">Item</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Unit Price</th>
                <th class="text-center">Action</th>
                <?php
                foreach ($wishlist as $key => $row) {
                    $img_url = base_url("/images/uploads") . '/' . $row['image'];
                    ?>
                    <tr>
                        <td>
                            <a href="#" class="thumbnail"><img class = "img-responsive image-center lazy media-object" src = '<?php echo $img_url; ?>' style="max-height: 50px;"></a>
                        </td>
                        <td width="50%">
                            <a href = <?php echo base_url("/ad_details?adid=") . urldecode($row['adid']); ?>><? echo $row['title']; ?></a>
                        </td>
                        <td class="text-center">
                            <? echo $row['quantity']; ?>
                        </td>
                        <td class="text-center">
                            <span class="text-red"><? echo $this->cart->format_number($row['price']); ?></span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-xs" id="btn-<?php echo $row['adid']; ?>" value="<?php echo $row['adid']; ?>">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning">
                no items are there in your wish list.
            </div>
        <?php } ?>
    </div>
</div>