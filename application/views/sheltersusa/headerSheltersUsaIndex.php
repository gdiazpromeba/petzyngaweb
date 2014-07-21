<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/estiloShelters.css" rel="stylesheet">
    <!--  google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    <script>
	  function initialize() {
		  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
		  var mapOptions = {
		    zoom: 4
		  }
		  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  var bounds = new google.maps.LatLngBounds();
		  var infowindow = new google.maps.InfoWindow(); 

		  var locations = [
          <?php 
            foreach ($shelters as $shelter){
              $legend= $shelter->getName() . "\n\n";
              $address=$shelter->getStreetAddress();
              if (!(empty($address))){
                 $legend .= $shelter->getStreetAddress();
              }else{
                 $legend .= $shelter->getPoBox();
              }
              echo "[\"" .  $legend . "\", " . $shelter->getLatitude()  . ", " . $shelter->getLongitude() . ", ". $shelter->getNumber() . "], \n";
            }              
          ?>
		  ];		         		 
			
	      for (i = 0; i < locations.length; i++) {  
	        marker = new google.maps.Marker({
	          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	          map: map
	        });
	        bounds.extend(marker.position);
	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
	              infowindow.setContent(locations[i][0]);
	              infowindow.open(map, marker);
	            }
	          })(marker, i));	        
	      }
	      map.fitBounds(bounds);
	  }
		
	  google.maps.event.addDomListener(window, 'load', initialize);
    </script>    
    
    
    
</head>
<body>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <div class="navigation-div">
       <span class="menuItem"><a href="<?php echo URL; ?>">HOME</a></span>
       <span class="menuItem"><a href="<?php echo URL; ?>dogbreeds/">DOG BREEDS</a></span>
       <span class="menuItem"><a href="<?php echo URL; ?>sheltersUsa/">SHELTERS</a></span>
    </div>

    <?php include 'shelterLocations.php'?>
