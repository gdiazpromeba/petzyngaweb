<div class="right">

    
 
        <?php 
          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['raizCms'] .  "/resources/images/shelterlogos/" . $info->getLogoUrl());

          if ($width>(2 * $height)){
            $estiloImagen="detailShelterAncha";
          }else{
            $estiloImagen="detailShelter";
          }
          ?>
          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterlogos/" . $info->getLogoUrl() ?>'>
      
    
    
        <br/>
        <br/>
        <div class="pictureTitleInfo"><?php echo $info->getName(); ?></div>
      
    
    

        <div class="infoText"> <?php echo $info->getDescription(); ?></div> 
      
    
    
        <br/>
        <br/>
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
			  <?php
			    $address = $info->getStreetAddress();
			    if (!empty($address)){
			      echo "Address:" .  $address ;
			      echo "<br/>";
			      echo $info->getCityName() . ", " . $info->getStateName(). " " . $info->getZip(); 
			      echo "<br/>";
			    }else{
                  echo "PO Box " . $info->getPoBox();
                }
			  ?>
    
    
        <br/>
        <br/>
        <span class="navegacionPaginas">
	      <?php 
	        echo "  <a href='" . URL . "/sheltersusa'> << Back to List </a> \n";
	      ?>
        </span> 
      
    

  
  
  
  
</div>