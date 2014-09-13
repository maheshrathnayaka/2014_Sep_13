<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#createaccount").click(function(){
                    $("#passwordview").slideToggle("slow");
                });
                
                            
                $("#billingnew").click(function(){
                    $("#billaddress").slideDown("slow");
                    $("#billingfname").removeAttr('disabled');
                    $("#billinglname").removeAttr('disabled');
                    $("#billingcity").removeAttr('disabled');
                    $("#billingaddress1").removeAttr('disabled');
                    //var $this = $("#addline2").siblings();
                    ////if($this.attr('disabled'))$this.removeAttr('disabled');
                    //else $this.attr('disabled','disabled')
                });
            
                $("#billingexist").click(function(){
                    $("#billaddress").slideUp("fast");
                    $("#billingfname").prop('disabled',true);
                    $("#billinglname").prop('disabled',true);
                    $("#billingcity").prop('disabled',true);
                    $("#billingaddress1").prop('disabled',true);
                });
            
                $("#shipaddress").click(function(){
                    $("#newshipaddress").slideToggle("slow");
                    if($("#shipfname").prop('disabled')){
                        $("#shipfname").removeAttr('disabled');
                        $("#shiplname").removeAttr('disabled');
                        $("#shipcity").removeAttr('disabled');
                        $("#shipaddress1").removeAttr('disabled');
                    }                    
                    else {
                        $("#shipfname").prop('disabled',true);
                        $("#shiplname").prop('disabled',true);
                        $("#shipcity").prop('disabled',true);
                        $("#shipaddress1").prop('disabled',true); 
                    }                    
                });               
                
            });
            
            
        </script>
        <title>Payment Details</title>
    </head>
    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>

        <div class="container cont-cust">
            <?php
            if ($this->session->userdata('logged_in')) {
                require_once (APPPATH . 'views/checkout_address_view.php');
            } else {
                require_once (APPPATH . 'views/checkout_billing_details_view.php');
            }
            ?>              
        </div>        
    </body>
</html>