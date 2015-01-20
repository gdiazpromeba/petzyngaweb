<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en">
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

    <script>
      function loadSecondArea(country,firstArea){
        var dataString = 'country='+ country +'&firstArea='+ firstArea;
        //$("#"+loadType+"_loader").show();
        //$("#"+loadType+"_loader").fadeIn(400).
        //html('Please wait... <img src="image/loading.gif" />');
		$.ajax({
		     type: "POST",
		     url: Global.dirCms + "/svc/conector/areas.php/selSegundasAreasBreeders",
		     data: dataString,
		     username: 'nina', 
		     password: 'nina',
		     cache: false,
		     success: function(result){
		       //$("#"+loadType+"_loader").hide();
		       $("#secondArea").html("");
		       $("#secondArea").append(result);
               //force selection
	    	   var lastSecondArea='<?php echo $_REQUEST['secondArea']; ?>';
	    	   if (lastSecondArea!='' && lastSecondArea !=null && lastSecondArea!=undefined){
	             var secondAreas=document.frmBusqueda.secondArea;
	             //alert('el combo tiene ' + secondArea.options.length + '  elementos, y el último seleccionado es ' + lastSecondArea);
	    		 for (var i = 0; i < secondArea.options.length; i++) {
	    		   if (secondArea.options[i].value == lastSecondArea) {
	    			   secondArea.selectedIndex = i;
	    			   break;
	    		   }
	    		 }
	    	   }
		     }
		 });
      }


      function selectedFirstArea(firstArea){
          var country=document.frmBusqueda.country.value;
    	  if(firstArea!=""){
    	    loadSecondArea(country, firstArea);
    	  }else{
    	    $("#secondArea").html("<option value=''></option>");
    	  }
       }
       /**
       * after the page loaded, checks if there was a firstArea selected.
       * If there was, reloads the combo of second areas.
       * And, if there was a previous selection in this second combo, forces it again.
       */
       function checkSecondArea(){
    	   var firstArea = document.frmBusqueda.firstArea.value;
    	   if (firstArea!='' && firstArea !=null && firstArea!=undefined){
    		   var country=document.frmBusqueda.country.value;
    		   loadSecondArea(country,firstArea);
    	   }
       }

      

    	
</script>    
    

    <script>
	  function initialize() {
		  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
		  var mapOptions = {
		    zoom: 4
		  }
		  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  var bounds = new google.maps.LatLngBounds();
		  var infowindow = new google.maps.InfoWindow({maxWidth: 400}); 

		  var locations = [
          <?php 
            foreach ($breeders as $breeder){
              $legend= $breeder->getName() . "\n\n";
              $address=$breeder->get1stLine();
              $address.=  "<br/>" . $breeder->get2ndLine();
              $address = str_replace(array("\r\n", "\n", "\r"), '<br/>', $address);
              echo "[\"" .  $breeder->getName() . "\",\""   .  $address .  "\", "   . $breeder->getLatitude()  . ", " . $breeder->getLongitude() . ", '". $breeder->getUrlEncoded() . "'], \n";
            }              
          ?>
		  ];		         		 
			
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
		          contentString +="<a class='detailMapInfoBox' href='" + Global.dirAplicacion + "/shelters/info/<?php echo $_REQUEST['country']; ?>/" + locations[i][4] + "'>Details</a> \n";
	              infowindow.setContent(contentString);
	              infowindow.open(map, marker);
	            }
	          })(marker, i));	        
	      }
	      map.fitBounds(bounds);
	  }
		
	  google.maps.event.addDomListener(window, 'load', initialize);
    </script>   
    
    
    

    <script>
      $(function() {
        $( "#dogBreedName" ).autocomplete({
          source: Global.dirCms + "/svc/conector/dogBreeds.php/selNombres",
          username: 'nina',
          password: 'nina',
//           'beforeSend': function(xhr) {
//         	  //xhr.setRequestHeader("Authentication", "nina:nina")); 
//           },
          minLength: 2,
          select: function( event, ui ) {
              $("#specialBreedId").val(ui.item.id);
          }
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
<body onload="checkSecondArea()">
<?php include $GLOBALS['pathWeb'] . '/application/views/_templates/analyticstracking.php' ?>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <?php include 'application/views/_templates/menu.php'?>

    <?php include 'breederLocations.php'?>
