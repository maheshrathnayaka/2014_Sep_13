<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Advertisment Review - Advertisment List</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
    </head>
    <body class="body-custom">
        <?php
        $main_nav = 'admin';
        require_once (APPPATH . 'views/common/nav_bar.php');
        ?>
        <div class="container cont-cust">
            <div class="container" style="margin: 30px auto">
                <div class="panel panel-default">
                    <div class="panel-heading">Pending Advertisments</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <?PHP
//    if (isset($titlearray)) {
//        echo 'set';
//    }else {
//        echo 'not';
//    }
//    while ($rows = mysql_fetch_assoc(@$results)){
//    $this->load->model('adminadreview_model');
//    $result=$data['titlearray']=$this->adminadreview_model->get_pending_ads();
                            foreach ($titlearray as $rows) {
                                ?> 
                                <tr><td><a href=<?PHP echo base_url("/adapprovalview?adid=") . urlencode($rows['adid']); ?>><?PHP echo $rows['title']; ?></a></td></tr>
                            <?PHP }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>