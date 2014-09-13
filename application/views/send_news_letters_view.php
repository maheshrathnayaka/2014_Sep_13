<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Send News Letters</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>


    </head>
    <body class="body-custom">
        <?php
        $main_nav = 'admin';
        require_once (APPPATH . 'views/common/nav_bar.php');
        ?>
        <div class="container cont-cust">
            <hr>
            <h3 class="text-center">Create News Letter</h3>
            <hr>
            <form role="form" action="<?php echo base_url(); ?>send_news_letters/send_news" class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Select Category</label>
                    <div class="col-sm-8">
                        <select class="form-control input-group" id="category" name="category" >
                            <?php
                            if (isset($categories)) {
                                var_dump($categories);
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
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-sm-2 control-label">Email Title</label>
                    <div class="col-sm-8">
                        <input type="text" required class="form-control" name="inputTitle" id="inputTitle" placeholder="Title here...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMsgBody" class="col-sm-2 control-label">Email Body</label>
                    <div class="col-sm-8">
                        <textarea required rows="13" class="form-control" name="inputMsgBody" id="inputMsgBody" placeholder="Email body here..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-8 col-sm-10">
                        <button type="submit" class="btn btn-primary">Send News Letter</button>
                    </div>
                </div>
            </form>
            <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

            <script>
                $('#inputMsgBody').wysihtml5();
            </script>

            <script type="text/javascript" charset="utf-8">
                $(prettyPrint);
            </script>

            <script>
<?php
require_once(APPPATH . 'assets/js/jqBootstrapValidation.js');
?>
                $(function() {
                    $("input").not("[type=submit]").jqBootstrapValidation();
                });
            </script>
        </div>
    </body>
</html>