<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Tag Cloud</title>
        <style type="text/css">
            .tags_container{width:1000px;height: 300px;padding-top: 20px;padding-bottom: 10px;padding-right:10px;padding-left: 10px;text-align: left}
            .tags ul{padding:5px 5px;}
            .tags li{margin:0;padding:0;list-style:none;display:inline;}
            .tags li a{text-decoration:none;padding:0 2px;}
            .tags li a:hover{text-decoration:underline;} 

            .tag1 a{font-size:12px; color: #9c639c;}
            .tag2 a{font-size:14px; color: #cece31;}
            .tag3 a{font-size:16px; color: #9c9c9c;}
            .tag4 a{font-size:18px; color: #31ce31;}
            .tag5 a{font-size:20px; color: #6363ad;}
            .tag6 a{font-size:22px; color: #ebccd1;}
            .tag7 a{font-size:24px; color: #9c3100;}
            .tag8 a{font-size:26px; color: #76109a;}
            .tag9 a{font-size:28px; color: #799a10;}
            .tag10 a{font-size:30px; color: #9c3100;}

        </style>

        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            <div class="col-md-12 well text-center">


                <img src="<?php echo base_url("/images/topTags.png"); ?>" hight="155px" width="1000px"/>
                <div style="border-bottom: 1px solid rgb(219, 209, 209); border-right: 1px solid rgb(219, 209, 209); border-left: 1px solid rgb(219, 209, 209); width: 1000px; margin-left: 50px; padding-bottom: 40px;">

                    <div class="tags_container">
                        <ul class="tags">
                            <?php
                            $maximun = $max;
                            
                            if ($maximun < 10) {
                                $maximun = 10;
                            }
                            $factor = $maximun / 9;

                            foreach ($tag as $row2) {
                                $catid = $row2->catid;
                                $catname = $row2->catname;
                                $freq = $row2->max;

                                for ($i = 0; $i <= 9; $i++) {
                                    $start = $factor * $i;
                                    $end = $start + $factor;
                                    if ($freq > $start && $freq <= $end) {
                                        $tag_number = $i + 1;
                                    }
                                }
                                ?> 




                                <li class="tag<?php echo $tag_number; ?>">
                                <a href=" http://kstoretesting.net16.net/browse_gallery?catid=<?php echo $catid; ?>">
                                <?php echo $catname; ?>
                                </a>
                                </li>
                                    <?php
                                }
                                ?> 
                        </ul>
                    </div> 


                </div>
            </div>

        </div>
<?php require_once (APPPATH . 'views/common/footer_th.php'); ?>
    </body>

</html>