<!DOCTYPE html>
<!-- hello !-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Category Management</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <?php include('dbcon.php'); ?>
    </head>
       <body class="body-custom">
    <div class="container cont-cust">
        <script type="text/javascript">
            $(document).on('click', '.btn-add', function(event) {
                event.preventDefault();
                var field = $(this).closest('.form-group');
                var field_new = field.clone();
                $(this)
                        .toggleClass('btn-default')
                        .toggleClass('btn-add')
                        .toggleClass('btn-danger')
                        .toggleClass('btn-remove')
                        .html('-');
                field_new.find('input').val('');
                field_new.insertAfter(field);
            });
            $(document).on('click', '.btn-remove', function(event) {
                event.preventDefault();
                $(this).closest('.form-group').remove();
            });

            $(document).ready(function() {

                //$('#loader').hide();

                $('.parent').livequery('change', function() {

                    $(this).nextAll('.parent').remove();
                    $(this).nextAll('label').remove();

                    $('#show_sub_categories').append('<img src="<?php echo base_url("/images/loader.gif"); ?>" style="float:left; margin-top:7px;" id="loader" alt="" />');

                    $.post("get_chid_categories.php", {
                        parent_id: $(this).val(),
                    }, function(response) {

                        setTimeout("finishAjax('show_sub_categories', '" + escape(response) + "')", 400);
                    });

                    return false;
                });
            });

            function finishAjax(id, response) {
                $('#loader').remove();

                $('#' + id).append(unescape(response));
            }
        </script>
        <style>
            .both h4{ font-family:Arial, Helvetica, sans-serif; margin:0px; font-size:14px;}
            #search_category_id{ padding:3px; width:200px;}
            #panelbodyattributes{padding: 5px;}
            .parent{ padding:3px; width:150px; float:left; margin-right:12px;}
            .both{ float:left; margin:0 0px 0 0; padding:0px;}
        </style>
        <div class="center-block">
            <div class="container" style="margin: 30px auto;">
                <div class="panel panel-default" style="padding: 30px">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Category</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 center-block">
                                <form role="form" action="<?php echo base_url(); ?>admin/categorydetails" method="POST">
                                    <label>Category Name</label>
                                    <div class="form-group row">
                                        <input type="text" name="categoryname" class="form-control" required>
                                    </div>
                                    <label>Parent Category</label>
                                    <div class="form-group row" id="show_sub_categories">
                                        <select name="parentcategory" class="form-control parent">
                                            <option value="" selected="selected">-- Categories --</option>
                                            <?php
                                            $query = "SELECT * FROM category WHERE parentcategory =0";
                                            $results = mysql_query($query);
                                            while ($rows = mysql_fetch_assoc(@$results)) {
                                                ?>
                                                <option value="<?php echo $rows['categoryid']; ?>"><?php echo $rows['categoryname']; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Is End Category</label>
                                        <input type="checkbox" name="isendcat">
                                    </div>

                                    <div class="panel panel-default form-group">
                                        <div class="panel-heading">Attributes</div>
                                        <div class="panel-body">
                                            <div class="form-inline input-group" id="panelbodyattributes">
                                                <div class="row">
                                                    <label>Attribute Name</label>
                                                    <input type="text" name="multipleAttribute[]" class="form-control" required>
                                                </div>
                                                <div class="row">
                                                    <label>Field Name</label>
                                                    <select name="multipleField[]" class="form-control">
                                                        <option value="Text Field">Text Field</option>
                                                        <option value="Drop Down">Drop Down</option>
                                                        <option value="Text Area">Text Area</option>
                                                        <option value="Radio Button">Radio Button</option>
                                                        <option value="Check Box">Check Box</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <label>Default Values</label>
                                                    <input type="text" name="multipleDefault[]" class="form-control">
                                                </div>
                                                <div class="row">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-add">+</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="submit" value="Add Category" class="btn-primary">
                                    </div>
                                </form>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

</body>
</html>