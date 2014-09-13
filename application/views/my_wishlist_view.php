<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <?php
        if (!$this->session->userdata('logged_in')) {
            redirect();
        }
        ?>
        <title>My Wishlist</title>
        <script>
<?php require_once(APPPATH . 'assets/js/jquery.min.js'); ?>
        </script>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <script>
            $(document).ready(function(){
                $(document).find("button[id^='btn-']").live('click', function(){
                    var num = this.id.split('-')[1];
                    //window.alert(num);
                    delete_item(num);
                });  
            });
            
            function delete_item(id){
                var data={
                    adid:id
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>/my_wishlist/delete_wishlist",
                    type: 'POST',
                    data: {
                        adsArray : data
                    },
                    success: function(data) 
                    {
                        $('#wishcontainer').html(data);                        
                    }
                }
            );
            }
        </script>

    </head>

    <body class="body-custom">
        <?php
        if (!isset($otheruser)) {
            $main_nav = 'wishlist';
        }
        ?>

        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="col-md-2" style="border-right: 1px solid #E6E6E6; min-height: 100vh; padding-right: 10px;">
                <?php
                if (!isset($otheruser)) {
                    $account = 'wishlist';
                    ?>
                    <?php
                    require_once (APPPATH . 'views/common/nav_my_account.php');
                }
                ?>
            </div>
            <div class="col-md-10"  id="wishcontainer">

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
            </div>
        </div>
    </body>
</html>
