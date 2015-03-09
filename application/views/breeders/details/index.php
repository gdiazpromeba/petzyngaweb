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
       
       <div id="columnCenter"  class="columnCenter" style="flex-direction:column">
    
		        <br/>
		        <?php 
		          list($width, $height, $type, $attr) = getimagesize( $GLOBALS['pathCms'] .  "/resources/images/breederLogos/" . $countryUrl . "/" . $info->getLogoUrl());
		
		          if ($width>(2 * $height)){
		            $estiloImagen="detailShelterAncha";
		          }else{
		            $estiloImagen="detailShelter";
		          }
		          ?>
		          <img class="<?php echo $estiloImagen; ?>"  src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/breederLogos/" . $countryUrl . "/" . $info->getLogoUrl() ?>' alt="<?php echo $info->getName(); ?>" >
		      
		    
		    
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
			    
			    <br/>
			    <br/>
			    
                <div ng-controller="RelatedDogBreedsCtrl" ng-init="setBreederId('<?php echo $info->getId(); ?>')" >
                  
                  <div ng-show="breeds.length>0"  class='shelterDescriptionTitle'>This breeder specializes on the following breeds</div>

                  <div style="display:flex;flex-direction:row;flex-wrap:wrap"  >

                    
                   
	                <div class='pictureContainerAlpha' ng-click="itemClicked(breed.nameEncoded)" ng-repeat="breed in breeds">
	                  <div data-nombreCodificado='{{breed.nameEncoded}}'></div> 
	                  <div class="pictureTitleAlpha">{{breed.name}}</div>
	                  <div><img class="breedImage" ng-src="{{breed.fullPictureUrl}}"/></div>
	                </div>              
              
                   
                
                  </div>
                  
                          
                  
                </div>
                
  


		        
		        
	   
         <div ng-controller="DetailCtrl">
           <dog-breed-details></dog-breed-details>
         </div>
         
    
	   </div><!-- center column -->

  
</div>
