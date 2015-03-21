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
       
          <div class="pictureTitle" style="padding:20px">Look for breeders in these countries!</div>
          <div style="padding:15px;text-align:justify"> <?php echo Resources::getText('welcome_to_breeders'); ?></div>
          <div style="display:flex;flex-direction:row;flex-wrap:wrap;height:500px;justify-content:space-around">
            
            <div style="width:200px;height:200px">
               <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/usa">
                 <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/usa_map_menu_outline.jpeg"; ?>" />
                 <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_usa'); ?></div>
                 <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $breederCount["usa"]); ?></div>
               </a>
             </div> 
             
            <div style="width:200px;height:200px">
		       <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/canada">
		         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/canada_map_menu_outline.png"; ?>" />
		         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_canada'); ?></div>
		         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $breederCount["canada"]); ?></div>
		       </a>
            </div> 
             
            <div style="width:200px;height:200px">
		       <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/uk">
		         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/uk_map_menu_outline.jpg"; ?>" />
		         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_uk'); ?></div>
		         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $breederCount["uk"]); ?></div>
		       </a>
            </div>
            
  
            
          </div>
       
       </div><!--  columnCenter --> 
 
 </div><!--  contenedor principal -->