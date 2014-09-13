<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Advanced Search</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div>
                <h3>Advanced search</h3>
            </div>
            <div class="panel panel-info col-lg-2" style="padding: 0px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Items</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search">Find Items</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search/by_seller">By Seller</a>
                        </li>
                    </ul>
                </div>

                <div class="panel-heading" style="margin-top: 5px;">
                    <h3 class="panel-title">Members</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="<?php echo base_url(); ?>advanced_search/by_member">Find a Member</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-info col-lg-9" style="padding: 0px; margin-left: 20px;">
                <div class="panel-heading">
                    <h3 class="panel-title">Find Items</h3>
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <form role="form" class="form" method="POST" action="<?php echo base_url(); ?>advanced_search/search_items_by_keyword">
                        <div class="form-group form-horizontal">
                            <label for="InputKeyword">Enter keywords</label>
                            <input type="text" name="keyword" required class="form-control col-lg-9" id="InputKeyword" placeholder="Enter keywords...">
                            <div class="clearfix"></div><br>
                            <select class="form-control input-group col-lg-3" id="category" name="category" >
                                <option value="1">All words, any order</option>
                                <option value="2">Any words, any order</option>
                                <option value="3">Exact words, exact order</option>
                                <option value="4">Exact words, any order</option>
                            </select>
                        </div>
                        <div class="clearfix"></div><br>
                        <div class="form-group">
                            <label for="InputCategory">In this category:</label>
                            <select class="form-control col-lg-3" id="selectCategory" name="selectCategory">
                                <option value="All Category">All Category</option>
                                <?php
                                if (isset($categories)) {
                                    foreach ($categories as $row) {
                                        $category_name = $row['categoryname'];
                                        ?>
                                        <option value="<?php echo $category_name; ?>"><?php echo $category_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="clearfix"></div><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="panel-heading">
                </div>
                <div class="panel-body" style="padding-left: 5px; padding-right: 5px;">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url(); ?>advanced_search/search_item_includes">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <label for="InputKeyword">Search includes</label>
                                <div class="checkbox col-sm-offset-1">
                                    <label>
                                        <input type="checkbox" name="title"  id="ckeckTitle"> Title
                                    </label>
                                </div>
                                <div class="checkbox col-sm-offset-1">
                                    <label>
                                        <input type="checkbox" name="description"  id="ckeckDescription"> Description
                                    </label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label for="InputKeyword">Price</label>
                                <div class="checkbox col-sm-offset-1">
                                    <label for="startPrice">
                                        <input type="checkbox" name="price"  id="price"> Show price
                                    </label>
                                </div>
                                <div class="checkbox col-sm-offset-1">
                                    <label for="inputStartPrice" class="col-sm-3 control-label">Starting price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="start_price" id="inputStartPrice" placeholder="From...">
                                    </div>
                                </div>
                                <br>
                                <div class="checkbox col-sm-offset-1">
                                    <label for="inputEndPrice" class="col-sm-3 control-label">Ending price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="end_price" id="inputEndPrice" placeholder="To...">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label for="InputKeyword">Item Condition</label>
                                <div class="checkbox col-sm-offset-1">
                                    <label>
                                        <input type="checkbox" name="new_item"  id="ckeckTitle"> New Item
                                    </label>
                                </div>
                                <div class="checkbox col-sm-offset-1">
                                    <label>
                                        <input type="checkbox" name="used_item"  id="ckeckDescription"> Used Item
                                    </label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label for="InputKeyword">Item Location</label>
                                <div class="checkbox col-sm-offset-1">
                                    <label>
                                        <input type="checkbox" name="new_item"  id="ckeckTitle"> Items in store
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>
