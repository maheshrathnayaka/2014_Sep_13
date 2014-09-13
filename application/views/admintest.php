<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Ajax Tutorial: Dynamic Loading of ComboBox using jQuery and Ajax in PHP</title>

        <script>
<?php
require_once (APPPATH . 'views/js/jquery-1.3.2.js');
require_once (APPPATH . 'views/js/jquery.livequery.js');
?>
        </script>

        <script type="text/javascript">

            $(document).ready(function() {

                // $('#loader').hide();

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

            .parent{ padding:3px; width:150px; float:left; margin-right:12px;}
            .both{ float:left; margin:0 0px 0 0; padding:0px;}
        </style>
    </head>
    <?php include('dbcon.php'); ?>
    
    <body>

        <div style="padding-left:30px; height:710px;">

            <br clear="all" /><br clear="all" />

            <div id="show_sub_categories">
                <select name="search_category" class="parent">
                    <option value="" selected="selected">-- Categories --</option>
                    <?php
                    $query = "select * from category where parentcategory = 0";
                    $results = mysql_query($query);

                    while ($rows = mysql_fetch_assoc(@$results)) {
                        ?>
                        <option value="<?php echo $rows['categoryid']; ?>"><?php echo $rows['categoryname']; ?></option>
                        <?php }
                    ?>
                </select>	

            </div>

            <br clear="all" /><br clear="all" />

        </div>

    </body>
</html>