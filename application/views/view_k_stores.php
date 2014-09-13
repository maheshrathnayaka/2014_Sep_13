<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>K-Stores</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>

    </head>

    <body class="body-custom">
        <?php $main_nav='branches' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
        
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    
                   <div class="form-group">       
                       <label style="margin-top: 5px;" class="col-sm-2 control-label">Enter your Location :</label> 
                        <div class="input-group">
                            
                            <input type="text" class="form-control" id="start" style="width: 550px;" />

                            <p id="errorLoaction" style="color: #BB8080; display: none" >Please Enter your Location !</p>

                        </div> 
                   </div> 
                    
                      <div class="form-group">       
                       <label style="margin-top: 0px; padding-left: 60px;" class="col-sm-2 control-label">Travel Mode :</label> 
                        <div class="input-group">
                            
                            <select id="mode" style="width: 200px;">
                                <option value="DRIVING">Driving</option>
                                <option value="WALKING">Walking</option>
                                <option value="BICYCLING">Bicycling</option>
                                <option value="TRANSIT">Transit</option>
                            </select>
                            
                        </div> 
                      </div>
                    
                    <img style="position: absolute; top: -6px; width: 250px; height: 145px; left: 875px;" src="<?php echo APPPATH.'../images/googelmapLogo.png'?>" id="maplogo" />
                    
                                                        
                </div>           
            
                <div id="map-canvas" style="height: 400px; width: 700px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden; margin-top: 100px;"> </div>
                <div class="well" style="height: 400px;width: 390px ; overflow: auto;position: absolute; left: 725px; top: 144px; " id="directions-panel">
                
                    <div id="showinstruction" style="background-color: rgb(255, 241, 168); padding: 8px 5px;" text-center >
                        <p style="font-size: 14px;font-family: Roboto" >After entering your location click on a Marker <img src="<?php echo APPPATH.'../images/mapmarker.png'?>" id="markericon" />to view kstores details and distance form your current location to the selected kstores</p>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnRQMKU9QYLRQl2Ry-CGOkGSL-5vrATMU&libraries=places" type="text/javascript"></script>

<script>
    
var allMarkers=[];
var message=[];
<?php  
if (isset($mapValue)) 
{
    $count=0;
              foreach ($mapValue as $row)
              {                  
                  
                  $telephone = $row->telephone;
                  $kstoreAddress = $row->addressline;
                  $kcity=$row->city;
                  $lat=$row->lat;
                  $lng=$row->lng;
                                    
               ?>
             
               allMarkers[<?php echo $count; ?>]='<?php echo $kstoreAddress.'-'.$telephone.'-'.$lat.'-'.$lng ?>';
                <?php
                $count++;
              }
}
?>

var markers = [];
//var iterator = 0;     
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() 
{
  directionsDisplay = new google.maps.DirectionsRenderer();
  
  var colombo = new google.maps.LatLng(6.9270786, 79.85986970898443);
  
  var mapOptions = {
    zoom:10,
    center: colombo,
    componentRestrictions: { country: 'lk' }
  }
   
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directions-panel'));
  
  var input =(document.getElementById('start'));
  
  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);
  
  
  
  
  for (var i = 0; i < allMarkers.length ; i++) 
  {
      var tempAllMarkers=allMarkers[i];
      var split = tempAllMarkers.split("-");
      var tempAddress = split[0];
      var tempLat = split[2];
      var tempLng = split[3];
      
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(tempLat,tempLng),
      map: map,
      draggable: false,
      animation: google.maps.Animation.DROP
    });

    marker.setTitle((i + 1).toString());
    attachSecretMessage(marker, i,tempAddress);
  }
}

function attachSecretMessage(marker, num,adress) {
  message[num]=adress;

  var infowindow = new google.maps.InfoWindow({
    content: message[num]
  });

  google.maps.event.addListener(marker, 'click', function(e) 
  {

    infowindow.open(marker.get('map'), marker);
    calcRoute(e.latLng);
  });
}




function calcRoute(select) 
{
    var location = document.getElementById('start').value;
    var selectedMode = document.getElementById('mode').value;
    if(location != "")
    {  
        document.getElementById("errorLoaction").style.display="none";
        document.getElementById("showinstruction").style.display="none";
        
        var start = document.getElementById('start').value;
        var end = select; //document.getElementById('end').value;
        var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.TravelMode[selectedMode]
        };
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });
    }
    else
    {
        document.getElementById("errorLoaction").style.display="block";
    }
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>

        
        
    </body>
</html>


