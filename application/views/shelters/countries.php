 <?php require_once 'utils/Resources.php';?>
 
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
       
       <div id="columnCenter"  class="columnCenter" style="margin-left:20px">
       
          <div class="pictureTitle" style="padding:20px">Select a country - Look for shelters!</div>
          <div style="padding:15px;text-align:justify"> <?php echo Resources::getText('animal_shelter_countries_list_content'); ?></div>
          <div style="display:flex;flex-direction:row;flex-wrap:wrap;height:500px">
            
            <div style="width:200px;height:200px">
               <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/usa">
                 <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_usa_menu.png"; ?>" />
                 <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_usa'); ?></div>
                 <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["usa"]); ?></div>
               </a>
             </div> 
             
            <div style="width:200px;height:200px">
		       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/uk">
		         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_uk_menu.png"; ?>" />
		         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_uk'); ?></div>
		         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["uk"]); ?></div>
		       </a>
            </div> 
             
            <div style="width:200px;height:200px">
		       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/japan">
		         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_japan_menu.jpg"; ?>" />
		         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_japan'); ?></div>
		         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["japan"]); ?></div>
		       </a>
            </div>
            
            <div style="width:200px;height:200px">
		       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/china">
		         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_china_menu.jpg"; ?>" />
		         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_china'); ?></div>
		         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["china"]); ?></div>
		       </a>
            </div>
            
            <div style="width:200px;height:200px">
		        <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/canada">
		          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_canada_menu.jpg"; ?>" />
		          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_canada'); ?></div>
		          <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["canada"]); ?></div>
		        </a>
            </div>
            
            <div style="width:200px;height:200px">
		        <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/india">
		          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_india_menu.jpg"; ?>" />
		          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_india'); ?></div>
		          <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["india"]); ?></div>
		        </a>
            </div>
            
            
            
          </div>
       
       </div><!--  columnCenter --> 
 
 </div><!--  contenedor principal -->