<div class="right">

    
 
        <?php 
          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['raizCms'] .  "/resources/images/shelterLogos/" . $info->getLogoUrl());

          if ($width>(2 * $height)){
            $estiloImagen="detailShelterAncha";
          }else{
            $estiloImagen="detailShelter";
          }
          ?>
          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterLogos/" . $info->getLogoUrl() ?>'>
      
    
    
        <br/>
        <br/>
        <div class="shelterDescriptionTitle"><?php echo $info->getName(); ?></div>
      
    
    

        <div class="shelterDescription"> <?php echo $info->getDescription(); ?></div> 
      
    
    
        <br/>
        <br/>
        <div class="shelterDescriptionTitle">Contact information</div>
        <div class="shelterContactInfo">
			  <br/>
			  <?php
			    $phone = $info->getPhone();
			    if (!empty($phone)){
			      echo $phone;
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <?php
			    $email = $info->getEmail();
			    if (!empty($email)){
			      echo "<a href='mailto:" . $email . "'>" . $email . "</a>";
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <?php
			    $url = $info->getUrl();
			    if (!empty($url)){
			      echo "<a href='" . $url . "'>" . $url . "</a>";
			      echo "<br/>";
			      echo "<br/>";
			    }
			  ?>
			  <?php
			    $address = $info->getStreetAddress();
			    if (!empty($address)){
			      echo $address ;
			    }else{
                  echo "PO Box " . $info->getPoBox();
                }
                echo "<br/>";
                echo $info->getCityName() . ", " . $info->getStateCode(). " " . $info->getZip();
                echo "<br/>";
                
			  ?>
	    </div>
		
    
    
        <br/>
        <br/>
        <span class="navegacionPaginas">
	      <?php 
	        echo "  <a href='" . URL . "/sheltersusa'> << Back to List </a> \n";
	      ?>
        </span> 
      
    

  
  
  
  
</div>
