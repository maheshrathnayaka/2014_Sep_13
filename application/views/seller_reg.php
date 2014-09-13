<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Reg</title>
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

<div class="container" style="width:900px; margin:30px auto;">
    
    <form class="form-horizontal" id="reg-form" role="form" action="<?php echo base_url();?>/seller_reg/updateseller" method="post">

        <div class="row">


            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><b>Seller Verification</b></h3>
                </div>

                <div class="panel-body">

                 
                    
                                 <div class="form-group">
					<label class="col-sm-2 control-label">Name</label> 
                                        <div class="input-group"><input type="text" id="name" name="name" class="form-control input-sm" value="<?php echo $first_name; ?>" > </div>
                                 </div>
                    
                                <div class="form-group">
					<label class="col-sm-2 control-label">Address</label> 
                                        <div class="input-group"><textarea class="form-control" rows="3" id="Address"  name="Address"  style="width:381px"></textarea></div>
				</div>
                    
                    
                                <div class="form-group">
					<label class="col-sm-2 control-label">Phone No</label> 
                                        <div class="input-group"><input type="text" id="phoneno" name="phoneno" value="<?php echo $telephone; ?>" class="form-control input-sm"> </div>
                                </div>
                    
                                 <div class="form-group">
					<label class="col-sm-2 control-label">NIC No</label> 
					<div class="input-group"><input type="text" id="nicno" name="nicno" class="form-control input-sm">
                                        <button type="button" style="margin-top:10px ;" class="btn btn-success " value="Submit" onclick="window.open('http://kstoretesting.net16.net/seller_upload', '_blank', 'location=yes,height=370,width=320,scrollbars=yes,status=yes');">Upload</button></div>
                                </div>
                    
                                <div class="form-group">
					<label class="col-sm-2 control-label">Bank No</label> 
					<div class="input-group"><input type="text" id="bankno" name="bankno" class="form-control input-sm">
                                            <button type="button" style="margin-top:10px ;" class="btn btn-success " value="Submit" onclick="window.open('http://kstoretesting.net16.net/seller_upload', '_blank', 'location=yes,height=370,width=320,scrollbars=yes,status=yes');">Upload</button></div>
                                </div>
                    
                                     <div class="form-group">
					<label class="col-sm-2 control-label"></label>
                                        <div class="input-group">
                                        <button type="Submit" class="btn btn-success " value="Submit">Submit</button>
                                     </div>
                     </div>


                </div>

            </div>

        </div>
    </form>
</div>

    </body>
</html>