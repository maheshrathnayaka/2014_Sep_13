<html lang="en">
    <head>
      
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>K Store Management</title>
        
        <?php     
        require_once (APPPATH . 'views/common/header_th.php'); 
        ?>
    
        <script>
           
        function addKstore()
        {
            var $address=$('#geocomplete').val();
            var split = $address.split(","); 
            var $cityaddress = split[0];
        
            var $city = $cityaddress.trim();
            
            
            var $lat=$('input#lat').val();
            var $lng=$('input#lng').val();
            var $address=$('#address').val();
            var $teleNo=$('input#teleno').val();
            var $cityOnly=$city;
            
            
            
       if($lat == "")
       {
           document.getElementById("errorLatitude").style.display="block";
       }
       
       else if($lng == "")
       {
           document.getElementById("errorLongitude").style.display="block";
       }
            
       else if($address == "")
       {
           document.getElementById("errorAddress").style.display="block";
       } 
            
       else if($teleNo == "")
       {
           document.getElementById("errorTelephone").style.display="block";
       }
       
       else if($cityOnly == "")
       {
            document.getElementById("errorSearch").style.display="block";
       }
       
       else if($teleNo.length != 10)
       {
           document.getElementById("errorTelephone").style.display="block";
       }
       
       else if(isNaN($teleNo))
       {
            document.getElementById("errorTelephone").style.display="block";
       }
       
       else
       {
            $.post('http://kstoretesting.net16.net/new_k_store_management/addKStore/', {latitude: $lat, city:$cityOnly,longitude: $lng, address: $address, teleNo: $teleNo},
            function(data)
            {
               alert("Successfuly Completed");
                history.go(0);	
            });
        }
        
        }
        
        
        </script>
        
    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">

           
            
             <div class="col-xs-12">
            <div class="col-md-12 well text-center">
              <div id="title">
                <h1>K Store Management</h1>
            </div>
                
                
                <div id="details" style="border: 1px solid #dbd1d1; margin-top: 20px; padding-top: 20px;">
                              <div class="form-group">       
                                <label class="col-sm-2 control-label">Address</label> 
                                <div class="input-group"><textarea class="form-control" rows="3" id="address" name="address" style="width:381px"></textarea>
                                    
                                    <p id="errorAddress" style="color: #BB8080; display: none" >Please fill the Address !</p>
                                    
                                </div> 
                            </div>

                            <div class="form-group">                                   
                                <label class="col-sm-2 control-label">Telephone No</label> 
                                <div class="input-group"><input type="text" id="teleno" name="teleno" class="form-control input-sm">
                                    
                                    <p id="errorTelephone" style="color: #BB8080; display: none" >Invalid Telephone Number !</p>
                                    
                                </div>          
                            </div>
                    
                 <div class="form-group">                                   
                                <label class="col-sm-2 control-label">Search</label> 
                                <div class="input-group">
                                    <input type="text" id="geocomplete" placeholder="Type in an address" class="form-control input-sm"/>
                               
                                     <input id="find" type="button" value="search" class="col-sm-4">
                                     
                                     <p id="errorSearch" style="color: #BB8080; display: none" >Please fill the description !</p>
                                    
             
                                </div>
                                 
                                
                                 
                                 
                 </div>
                    
                </div>
                 
                
                <div class="map_canvas " style="width:780px;height: 400px;margin-top: 20px" >
                    
                    
                </div>
                
                <div style="border: 1px solid rgb(219, 209, 209); position: absolute; top: 365px; right: 20px; padding: 5px; left: 820px;">
                    
                    <div>
                        <label>Latitude</label>
                    <input name="lat" id="lat" type="text" value="" style="margin-left: 13px">
                    
                    <p id="errorLatitude" style="color: #BB8080; display: none" >Please select a places!</p>
                    
                    </div>
                    
                    <div>
                    <label>Longitude</label>
                    <input name="lng" id="lng" type="text" value="">
               
                    <p id="errorLongitude" style="color: #BB8080; display: none" >Please select a places!</p>
               
                    </div>
                    <a id="reset" href="#" style="display:none;">Reset Marker</a>
                </div>
                
                <input type="button" onclick="addKstore()" id="addKstore" value="Add K-Store" style="position: absolute; top: 460px; left: 820px;" class="btn btn-primary btn-lg">
                
                </div>
            </div>
             
            
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
            
    <script>
   
        <?php
        require_once(APPPATH . 'assets/js/jquery.geocomplete.js');
         ?>
        
         $(document).ready(function() 
        {
        $('#lat').attr('disabled', true);
        $('#lng').attr('disabled', true);
        });
        
        
        
        
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form ",
          componentRestrictions: { country: 'lk' },
          markerOptions: 
          {
          draggable: true
          }
        });
        
        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
          $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
          $("#reset").show();
        });
        
        
        $("#reset").click(function(){
          $("#geocomplete").geocomplete("resetMarker");
          $("#reset").hide();
          return false;
        });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        }).click();
      });
     
        
        </script>
    
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>