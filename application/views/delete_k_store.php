<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="See Moreport" content="width=device-width, initial-scale=1.0">
        <title>Delete KStore</title>
        <?php require_once (APPPATH . 'views/common/header_th.php'); ?>
        
        
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
                  $storeid=$row->kstoreid;
                  $telephone = $row->telephone;
                  $kstoreAddress = $row->addressline;
                  $kcity=$row->city;
                  $lat=$row->lat;
                  $lng=$row->lng;
                                    
               ?>
             
               allMarkers[<?php echo $count; ?>]='<?php echo $storeid.'-'.$lat.'-'.$lng ?>';
                <?php
                $count++;
              }
}
?>

var markers = [];
   
var map;

function initialize() 
{ 
  var colombo = new google.maps.LatLng(6.9270786, 79.85986970898443);
  
  var mapOptions = {
    zoom:10,
    center: colombo,
    componentRestrictions: { country: 'lk' }
  }
   
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  for (var i = 0; i < allMarkers.length ; i++) 
  {
      var tempAllMarkers=allMarkers[i];
      var split = tempAllMarkers.split("-");
      var kstoreId=split[0];
      var tempLat = split[1];
      var tempLng = split[2];
      
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(tempLat,tempLng),
      map: map,
      draggable: false,
      animation: google.maps.Animation.DROP
    });

    marker.setTitle((i + 1).toString());
    
    addMarker(marker,kstoreId);
  }
  

}

google.maps.event.addDomListener(window, 'load', initialize);

function addMarker(marker,storeId)
{
    google.maps.event.addListener(marker, 'click', function(e){
    
    
    deleteKstore(marker,storeId);
    
    });
}

function deleteKstore(marker,storeId) {
    var x;
    if (confirm("Do you want to Delete this Kstore!") == true) 
    {
        

        $.ajax({
        url: "http://kstoretesting.net16.net/delete_k_store/deleteKstore/" +storeId,
        type: 'POST',
        dataType: "HTML",
        success: function(data) 
        {
            if (data) 
            {
                marker.setMap(null);
            }
        }
    });
        
        
    } else {
        x = "You pressed Cancel!";
    }
    
}

    </script>

    </head>

    <body class="body-custom">
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
        <div class="container cont-cust">
            
            
            <div class="panel panel-primary">

                    <div class="panel-heading">
                        <h3 class="panel-title"><b>Delete Kstors</b></h3>
                    </div>
                    <div class="panel-body">
                       
                        <div id="map-canvas" style="height: 500px; width: 1108px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden; margin-top: 10px;"> </div>
                    </div>
              </div>
            
            
            
        </div>
        <?php require_once (APPPATH . 'views/common/footer_th.php'); ?>

    </body>
</html>

