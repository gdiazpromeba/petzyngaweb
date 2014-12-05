<?php require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php'; ?>

<div class="contenedorDetallesShelter">

    
        <br/>
        <?php 
          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['pathCms'] .  "/resources/images/shelterLogos/" . $countryUrl . "/" . $info->getLogoUrl());

          if ($width>(2 * $height)){
            $estiloImagen="detailShelterAncha";
          }else{
            $estiloImagen="detailShelter";
          }
          ?>
          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterLogos/" . $countryUrl . "/" . $info->getLogoUrl() ?>'>
      
    
    
        <br/>
        <br/>
        <div class="shelterDescriptionTitle"><?php echo $info->getName(); ?></div>
      
    
    

        <div class="shelterDescription"> <?php echo $info->getDescription(); ?></div> 
    
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
			    echo $info->get1stLine();
                echo "<br/>";
                echo $info->get2ndLine();
                echo "<br/>";
			  ?>
	    </div>
	    
	    <?php
	      if (!empty($dogBreeds)){
            echo "<br/>";
            echo "<div class='shelterDescriptionTitle'>This shelter focuses on the following breeds</div>";
  
            echo "<table class='picturesTable'>";
            $keys = array_keys($dogBreeds);
            $index=0;
            for ($row=0; $row <4 && $index < count($keys) ; $row++){
            	echo "<tr> \n";
            	for ($col=0; $col<3 && $index < count($keys) ; $col++){
            		$bean=$dogBreeds[$keys[$index]];
            		echo "<td class='tdPictureContainer'> \n";
            		echo "<div class='pictureContainer'> \n";
            		echo "  <a href='" . URL . "dogbreeds/info/" . str_replace(" ", "_", $bean->getNombre()) . "'>\n";
            		echo "    <table class='pictureInternalTable'> \n";
            		echo "      <tr><td class='pictureTitle'>" . $bean->getNombre() . "</td></tr> \n";
            		echo "      <tr><td><img class='breedImage' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $dogBreeds[$keys[$index]]->getPictureUrl() . "'></td></tr>";
            		echo "    </table> \n";
            		echo "  </a> \n";
            		echo "</div>";
            		echo "</td> \n";
            
            		$index++;
            	}
            	echo "</tr> \n";
            }
            echo "</table>";
          } 
        ?> 
	    
		
    <!-- peque�o form y javascript para volver a la pantalla de lista con un par�metro "start" como post -->
    <form name="frmNavegacion" action=""" method="post">
      <input type="hidden" name="start" value="<?php echo RequestUtils::getValue('start'); ?>" />
      <input type="hidden" name="firstArea" value="<?php echo RequestUtils::getValue('firstArea'); ?>" />      
      <input type="hidden" name="secondArea" value="<?php echo RequestUtils::getValue('secondArea'); ?>" />  
      <input type="hidden" name="zipCode" value="<?php echo RequestUtils::getValue('zipCode'); ?>" />
      <input type="hidden" name="shelterName" value="<?php echo RequestUtils::getValue('shelterName'); ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>		
		
    
    
        <br/>
        <span class="navegacionPaginas">
	      <?php 
	        echo "  <a href='#' onclick=navega('" . URL . "shelters/listing/" . $countryUrl .  "/list')> << Back to List </a> \n";
	      ?>
        </span> 
      
    

  
  
  
  
</div>
