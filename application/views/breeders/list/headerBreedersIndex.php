<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en" ng-app="geoFlatList">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="<?php echo Resources::getText($metaDescriptionKey); ?>" />
    <meta name="keywords" content="<?php echo Resources::getText($metaKeywordsKey); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>public/css/estiloShelters.css" rel="stylesheet"/>
    <?php if ($GLOBALS['env']=="qa") echo  "<link href='" . URL . "public/css/estiloQa.css' rel='stylesheet'/> "; ?>
    
    <!--  google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <?php require_once 'configJs.php';?> 
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> 
    
	
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js"></script>
    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script src="https://rawgithub.com/gsklee/ngStorage/master/ngStorage.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['dirWeb']; ?>/application/views/breeders/breeders.js"></script> 	


 	
    <script>
	  function initializeMap(data, country) {
		  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
		  var mapOptions = {
		    zoom: 4
		  }
		  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  var bounds = new google.maps.LatLngBounds();
		  var infowindow = new google.maps.InfoWindow({maxWidth: 400}); 

		  var locations = [];
          data.forEach(function(entry){
            var address;
            if (entry.poBox!=null){
                address = entry.poBox;
                address = address.toString();
             }else if (entry.streetAddress!=null){
                address = entry.streetAddress;
             }
             address = address.replace(/(\r\n|\n|\r)/gm,"<br/>");
        			  
        	var item=new Array(entry.name, address, entry.latitude, entry.longitude, entry.urlEncoded);
        	locations.push(item);
          });	         		 
			
	      for (i = 0; i < locations.length; i++) {  
	        marker = new google.maps.Marker({
	          position: new google.maps.LatLng(locations[i][2], locations[i][3]),
	          map: map
	        });
	        bounds.extend(marker.position);
	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
		          var contentString  ="<div style='font-weight:bold'>" + locations[i][0] + "</div><br/>";
		          contentString +="<div style='font-color:gray'>" + locations[i][1] + "</div>";
		          contentString +="<br/>";
		          contentString +="<a class='detailMapInfoBox' href='" + Global.dirAplicacion + "/breeders/info/" + country + locations[i][4] + "'>Details</a> \n";
	              infowindow.setContent(contentString);
	              infowindow.open(map, marker);
	            }
	          })(marker, i));	        
	      }
	      map.fitBounds(bounds);
	  }
		
    </script>   	  	       		   
    
    <script>

      $(document).ready(function() {

          
    	  if ($('#dogBreedName').length ) {
    		   console.log("sí, el dogbreedname existe");
    		}




           $('#dogBreedName').autocomplete({
        	   source: Global.dirCms + "/svc/conector/dogBreeds.php/selNombres",
               minLength: 2,
//                onSelect: function( event, ui ) {
//                    $("#specialBreedId").val(ui.item.id);
//                }
           });




           
      });
      
    </script>   
    
<style>
.ui-menu .ui-menu-item {
    font-size: small;
    text-align: left;
}
</style>     
   
</head>
<body>
<?php include $GLOBALS['pathWeb'] . '/application/views/_templates/analyticstracking.php' ?>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <?php include 'application/views/_templates/menu.php'?>

