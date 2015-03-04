<?php require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php'; ?>

    <div style="display:flex;justify-content:center">

      
      
       <div id="columLeft" class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_03'); ?></div>
       </div>
       <div id="columLeft" class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_03'); ?></div>
       </div>
       
       <div id="columnCenter"  class="columnCenter" style="flex-direction:column" ng-controller="AdvSearchCtrl"  ng-init="initialize('usa')" >

    
		        <br/>
		        <?php 
		          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['pathCms'] .  "/resources/images/shelterLogos/" . $countryUrl . "/" . $info->getLogoUrl());
		
		          if ($width>(2 * $height)){
		            $estiloImagen="detailShelterAncha";
		          }else{
		            $estiloImagen="detailShelter";
		          }
		          ?>
		          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterLogos/" . $countryUrl . "/" . $info->getLogoUrl() ?>'  alt="<?php echo $info->getName(); ?>">
		      
		    
		    
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
	    

  
       </div> <!--  columnCenter -->
     </div>
