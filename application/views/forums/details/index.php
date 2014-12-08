<div class="contenedorDetallesShelter">

    
        <br/>
        <?php 
          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['pathCms'] .  "/resources/images/forumLogos/" . $info->getPictureUrl());

          if ($width>(2 * $height)){
            $estiloImagen="detailShelterAncha";
          }else{
            $estiloImagen="detailShelter";
          }
          ?>
          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/forumLogos/" . $info->getPictureUrl() ?>'>
      
    
    
        <br/>
        <br/>
        <div class="shelterDescriptionTitle"><?php echo $info->getName(); ?></div>
      
    
    

        <div class="shelterDescription"> <?php echo $info->getDescription(); ?></div> 
    
        <br/>
        <div class="shelterDescriptionTitle">Website URL</div>
        <div class="shelterContactInfo">
			  <br/>
			  <?php
			    $url = $info->getUrl();
			    if (!empty($url)){
			      echo "<a href='" . $url . "'>" . $url . "</a>";
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
	    </div>
	    
  
  
</div>
