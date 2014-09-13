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
        <?php
        $main_nav = 'admin';
        require_once (APPPATH . 'views/common/nav_bar.php');
        ?>
        <div class="container cont-cust">
            <script type="text/javascript">
                var count = 0;
                function create_table() {
                    count++;
                    var tbl_size = document.getElementById('numOfAttr').value;
                    if (tbl_size != "") {
                        if (!isNaN(tbl_size) && (tbl_size <= 100 && tbl_size > 0)) {
                            document.getElementById('dynamicAttributes').innerHTML = "";
                            $('#tableDiv').show();
                            for (i = 0; i < tbl_size; i++) {
                                $('#dynamicAttributes').prepend(
                                        '<tr>' +
                                        '<td><input type="text" required class="form-control" id="txtAttrName" placeholder="Attribute name..."></td>' +
                                        '<td><select class="form-control" id="selectAttributeType">' +
                                        '<option value="0">Select HTML component...</option>' +
                                        '<option value="1">Text Field</option>' +
                                        '<option value="2">Drop Down</option>' +
                                        '</select>' +
                                        '</td>' +
                                        '<td><input type="text" class="form-control" id="txtAttrDefaults" placeholder="Default values..."></td>' +
                                        '</tr>'
                                        );
                            }
                        } else {
                            $('#alertTblCrt').show();
                        }
                    }
                }
                function load_category() {
                    if (document.getElementById('selectCategoryType').value == 0 || document.getElementById('selectCategoryType').value == 1) {
                        $('#subLevel').hide();
                    } else {
                        $('#subLevel').show();
                        load_parent_cat();
                    }
                }
                function load_parent_cat() {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/admin_dash/load_prnt_cat",
                        type: 'POST',
                        success: function(data)
                        {
                            if (data)
                            {
                                $('#subLevel').html(data);
                            }
                        }
                    }
                    );
                }
                function get_sub_category() {
                    var parent_cat = document.getElementById('selectCategoryMain').value;
                    $.ajax({
                        url: "<?php echo base_url(); ?>/admin_dash/load_sub_cat",
                        type: 'POST',
                        data: {selectedCat: parent_cat},
                        success: function(data)
                        {
                            if (data)
                            {
                                $('#nextSubLevel').html(data);
                                $('#nextSubLevel').show();
                            }
                        }
                    }
                    );
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
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add new category</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="selectCategoryType" class="col-sm-3 control-label">Category is </label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="selectCategoryType" onblur="load_category();">
                                        <option value="0">Select category type...</option>
                                        <option value="1">Parent Category</option>
                                        <option value="2">Sub Category</option>
                                    </select> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtCatName" class="col-sm-3 control-label">Category Name </label>
                                <div class="col-sm-6">
                                    <input type="text" required class="form-control" id="txtCatName" placeholder="Category name...">
                                </div>
                            </div>

                            <div class="form-group" id="subLevel" style="display: none;">
                                <label for="selectCategoryType" class="col-sm-3 control-label">Category </label>
                                <div class="col-sm-6" id="divCategoryMain">
                                    <select class="form-control" id="selectCategoryMain">

                                    </select> 
                                </div>
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="button" class="btn btn-default" style="margin-top: 2px;" onclick="get_sub_category();">Sub level</button>
                                </div>
                            </div>

                            <div class="form-group" id="nextSubLevel" style="display: none;">
                                <label for="txtCatName" class="col-sm-3 control-label">Sub Category </label>
                                <div class="col-sm-6" id="divCategorySub">
                                    <select class="form-control" id="selectCategorySub">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="numOfAttr" class="col-sm-3 control-label">Number of attributes </label>
                                <div class="col-sm-6">
                                    <input type="number" min="1" max="100" required class="form-control col-sm-4" id="numOfAttr" placeholder="Number of attributes...">
                                </div>
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="button" class="btn btn-default" style="margin-top: 2px;" onclick="create_table();">Create</button>
                                </div>
                                <div id="alertTblCrt" class="alert alert-danger col-sm-offset-3 col-sm-6" style="display: none;margin-top: 2px;" role="alert">
                                    <strong>Oh snap! </strong>
                                    attributes number is not valid...
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-10" id="tableDiv" style="display: none;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Attribute Name</th>
                                                <th>HTML Component</th>
                                                <th>Default Values</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dynamicAttributes">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--<input type="number" name="qty" id="qty" class="form-control" maxlength="4" size="4" value="1" min="1" max="<? echo $ad_info['quantity'] ?>">-->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" class="btn btn-default">Add category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>