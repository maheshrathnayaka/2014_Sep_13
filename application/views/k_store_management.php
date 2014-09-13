<!doctype html>
<html>
    <head>
        <?php echo $map['js']; ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>KStore Management</title>
        <style>
<?php
require_once (APPPATH . 'assets/css/bootstrap-theme.css');
require_once (APPPATH . 'assets/css/bootstrap-theme.min.css');
require_once (APPPATH . 'assets/css/bootstrap.css');
require_once (APPPATH . 'assets/css/bootstrap.min.css');
require_once (APPPATH . 'assets/css/custom.css');
?>
        </style>

        <script>


<?php
//require_once (APPPATH . 'assets/js/jqBootstrapValidation.js');
//require_once(APPPATH . 'assets/js/bootstrap.js');
require_once(APPPATH . 'assets/js/bootstrap.min.js');
?>



        </script>
    </head>

    <body>
        
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container" style="width:900px; margin:30px auto;">
            <form class="form-horizontal" id="reg-form" role="form" action="<?php echo base_url(); ?>/k_store_management/addnewStore" method="post">
                <div class="row">


                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title"><b>K Store Management</b></h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">       
                                <label class="col-sm-2 control-label">Address</label> 
                                <div class="input-group"><textarea class="form-control" rows="3" id="Address" name="Address" style="width:381px"></textarea>
                                </div> 
                            </div>

                            <div class="form-group">                                   
                                <label class="col-sm-2 control-label">Telephone No</label> 
                                <div class="input-group"><input type="text" id="teleno" name="teleno" class="form-control input-sm">
                                </div>          
                            </div>

                            <div class="form-group">                                   
                                <label class="col-sm-2 control-label">City</label> 
                                <div class="input-group"><input type="text" id="city" name="city" class="form-control input-sm">                             
                                </div>          
                            </div>

                        </div>

                    </div>

                </div>



                <div class="row">


                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title"><b>Google Map</b></h3>
                        </div>
                        <div class="panel-body">

                            <div class="col-md-6">
                                <div class="form-group">       

                                    <?php echo $map['html']; ?>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">                                   
                                    <label class="col-sm-2 control-label">Latitude</label> 
                                    <div class="input-group"><input type="text" id="latitude" name="latitude" class="form-control input-sm">                             
                                    </div>          
                                </div>

                                <div class="form-group">                                   
                                    <label class="col-sm-2 control-label">Longitude</label> 
                                    <div class="input-group"><input type="text" id="longitude" name="longitude" class="form-control input-sm">                             
                                    </div>          
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group"> 

                                    
                                    <label>  </label>
                                    <div class="input-group">
                                       <button style="margin-left: 140px;" type="submit" class="btn btn-success " value="Submit">Add Store</button>
                                    </div>          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </body>
</html>