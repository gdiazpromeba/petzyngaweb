<div class="rightDogBreeds">
        <div class="descriptiveParagraph2">
          <?php echo $info->getHeaderText(); ?>
        </div>

        <table class="tableFotoInfo">
          <tr><td class="pictureTitleInfo"><?php echo $info->getNombre(); ?></td></tr>  
          <tr><td><img class="infoDetail" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/breeds/" . $info->getPictureUrl() ?>' alt="<?php echo $info->getNombre(); ?>"></td></tr>
          <tr><td class="mainFeatures"><?php echo   $info->getMainFeatures() . "!"?></td></tr>
          <tr><td class="mainFeatures"><?php echo  "Watch a <a target='_blank' href='http://www.youtube.com/watch?v=" . $info->getVideoUrl() . "'"?> >Video</td></tr>
        </table>
        <table class="features">
          <tr><td class="featureTitle">Size</td><td class="featureText"><?php echo $info->getSizeName(); ?></td></tr>  
          <tr><td class="featureTitle">Color</td><td class="featureText"><?php echo $info->getColors(); ?></td></tr>
          <tr><td class="featureTitle">Weight (pounds):</td><td class="featureText"><?php echo "from "  . $info->getWeightMin() . " to " . $info->getWeightMax() ?></td></tr>
          <tr><td class="featureTitle">Height (inches):</td><td class="featureText"><?php echo "from "  . $info->getSizeMin() . " to " . $info->getSizeMax() ?></td></tr>
          <tr><td class="featureTitle">Shedding</td><td class="featureText"><?php echo $info->getSheddingFrequencyName() . ", " . $info->getSheddingAmountName() ?></td></tr>
          <tr><td class="featureTitle">Safe around small kids</td><td class="featureText"><?php echo $info->getKids()==1?"Yes":"No"  ?></td></tr>
          <tr><td class="featureTitle">Apt for apartments</td><td class="featureText"><?php echo $info->getAppartments()==1?"Yes":"No" ?></td></tr>
          <tr><td class="featureTitle">Feeding</td><td class="featureText"><?php echo $feedingArmado; ?></td></tr>
        </table>
        <br/>
        <br/>

        
        <table>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">How friendly are they?</span>
            <img style="height:20px;" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getFriendlyRank() . ".jpg"; ?>'">
          </div>
          <div class="infoText">
            <?php echo $info->getFriendlyText(); ?>
          </div>

        </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">How active are they?</span>
            <img class="estrellas" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getActiveRank() . ".jpg"; ?>'>
          </div>
          <div class="infoText">
            <?php echo $info->getActiveText(); ?>
          </div>

        </td></tr> 
        <tr><td>&nbsp;</td></tr>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">How healthy are they?</span>
            <img class="estrellas" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getHealthyRank() . ".jpg"; ?>'>
          </div>
          <div class="infoText">
            <?php echo $info->getHealthyText(); ?>
          </div>

        </td></tr>     
        <tr><td>&nbsp;</td></tr>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">Are they good guardians?</span>
            <img class="estrellas" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getGuardianRank() . ".jpg"; ?>'>
          </div>
          <div class="infoText">
            <?php echo $info->getGuardianText(); ?>
          </div>

        </td></tr> 
        <tr><td>&nbsp;</td></tr>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">How much grooming do they need?</span>
            <img class="estrellas" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getGroomingRank() . ".jpg"; ?>'>
          </div>
          <div class="infoText">
            <?php echo $info->getGroomingText(); ?>
          </div>

        </td></tr>    
        <tr><td>&nbsp;</td></tr>
        <tr><td>

          <div class="textTitle" >
            <span class="infoTextTitle">Are they easy to train?</span>
            <img class="estrellas" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_" . $info->getTrainingRank() . ".jpg"; ?>'>
          </div>
          <div class="infoText">
            <?php echo $info->getTrainingText(); ?>
          </div>

        </td></tr>    
        </table> 
        
        <br/>
        
	    <?php
	      if (!empty($shelters)){
            echo "<br/>";
            echo "<div style='width:45%;display:inline-block'>";
            echo "<div class='pictureTitleInfo'>Shelters devoted to this breed</div>";
  
            echo "<table class='sheltersPerBreed'>";
            $keys = array_keys($shelters);
            $index=0;
            for ($row=0; $row <4 && $index < count($keys) ; $row++){
                $arr=$shelters[$keys[$index]];
            	echo "<tr> \n";
            	echo "<td> \n";
            	echo "  <a href='javascript:void(0)' onclick=navega('" . URL . "/shelters/info/usa/" . $arr['urlEncoded'] . "')>\n";
            	echo "      <div class='pictureTitle'>" . $arr['name'] . "</div> \n";
            	echo "  </a> \n";
            	echo "</td> \n";
            	echo "</tr> \n";
            	$index++;
            }
            echo "</table>"; 
            echo "</div>";
          } 
        ?>   
        

        <?php
	      if (!empty($forums)){
            echo "<div style='width:45%;display:inline-block'>";
            echo "<div class='pictureTitleInfo'>Web Forums about this breed</div>";
  
            echo "<table class='sheltersPerBreed'>";
            $keys = array_keys($forums);
            $index=0;
            for ($row=0; $row <4 && $index < count($keys) ; $row++){
                $arr=$forums[$keys[$index]];
            	echo "<tr> \n";
            	echo "<td> \n";
            	echo "  <a href='javascript:void(0)' onclick=navega('" . URL . "forums/info/" . $arr['encodedName'] . "')>\n";
            	echo "      <div class='pictureTitle'>" . $arr['name'] . "</div> \n";
            	echo "  </a> \n";
            	echo "</td> \n";
            	echo "</tr> \n";
            	$index++;
            }
            echo "</table>";
            echo "</div>";
          } 
        ?>              
        
    <!-- pequeño form y javascript para volver a la pantalla de lista con un parámetro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo RequestUtils::getValue('start'); ?>" />
      <input type="hidden" name="letraInicial" value="<?php echo RequestUtils::getValue('letraInicial'); ?>" />      
      <input type="hidden" name="nombreOParte" value="<?php echo RequestUtils::getValue('nombreOParte'); ?>" />
      <input type="hidden" name="selDogSize" value="<?php echo RequestUtils::getValue('selDogSize'); ?>" />
      <input type="hidden" name="selDogFeeding" value="<?php echo RequestUtils::getValue('selDogFeeding'); ?>" />
      <input type="hidden" name="selUpkeep" value="<?php echo RequestUtils::getValue('selUpkeep'); ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>        
        
        
                                
        </table>       
        <br/>
    <!--  </div>  -->
    
    <span class="navegacionPaginas">
	  <?php 
	      echo "  <a href='#' onclick=navega('" . URL .  "dogbreeds')> << Back to List </a> \n";
	  ?>
	  <br/>
	  <br/>
    </span> 
      
            
</div>
