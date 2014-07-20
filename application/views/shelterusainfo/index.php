<div class="right">
  <table border=1>
    <tr>
      <td colspan="2" style="padding-top:10px;padding-bottom:10px;">
        <?php 
          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['raizCms'] .  "/resources/images/shelterlogos/" . $info->getLogoUrl());

          if ($width>(2 * $height)){
            $estiloImagen="detailShelterAncha";
          }else{
            $estiloImagen="detailShelter";
          }
          ?>
          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterlogos/" . $info->getLogoUrl() ?>'>
      </td>
    </tr>
    <tr>
      <td colspan="2" >
        <div class="pictureTitleInfo"><?php echo $info->getName(); ?></div>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="padding-top:10px;padding-bottom:10px;">
        <div class="infoText"> <?php echo $info->getDescription(); ?></div> 
      </td>
    </tr>
    <tr>
      <td style="width:400px;height:600px">
        <div id="map-canvas" style="height:100%"></div>   
      </td>
      <td style="width:400px;height:600px" valign="top">
        <div class="pictureTitleInfo">Contact information</div>
			  <br/>
			  <?php
			    $phone = $info->getPhone();
			    if (!empty($phone)){
			      echo "Phone:" . $phone;
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <?php
			    $email = $info->getEmail();
			    if (!empty($email)){
			      echo "Email:<a href='mailto:" . $email . "'>" . $email . "</a>";
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <?php
			    $url = $info->getUrl();
			    if (!empty($url)){
			      echo "Website:<a href='" . $url . "'>" . $url . "</a>";
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <h2>Address</h2>
			  <br/>
			  <?php echo $info->getStreetAddress(); ?> 
			  <br/>
			  <?php echo $info->getCityName(); ?>,&nbsp;&nbsp;<?php echo $info->getStateName(); ?>&nbsp;&nbsp;<?php echo $info->getZip(); ?> 
			  <br/>
			  <br/>  
         
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <span class="navegacionPaginas">
	      <?php 
	        echo "  <a href='" . URL . "/sheltersusa'> << Back to List </a> \n";
	      ?>
        </span> 
      </td>
    </tr>
  </table>
  
  
  
  
</div>
