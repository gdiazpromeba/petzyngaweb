 <?php require_once 'utils/Resources.php';?>
 <table border="0" style="padding:5px;">
   <tr>
     <td colspan="4" style="text-align: left">
       <span class="tituloBreeders">Responsible Breeders</span>
       <div class="textoBreeders"><?php echo Resources::getText('responsible_breeders'); ?></div>
     </td>
   </tr>
   <tr>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/usa/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/usa_map_menu_outline.jpeg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_usa'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["usa"]); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/canada/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/canada_map_menu_outline.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_canada'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["canada"]); ?></div>
       </a>
     </td>
     <td colspan="2" rowspan="2" style="text-align: left">
       <span class="tituloBreeders">Beware of "Puppy Mills"</span>
       <div class="textoBreeders"><?php echo Resources::getText('puppy_mill_warning_1'); ?></div>
     </td>
   </tr>
   <tr>
     <td colspan="2" style="text-align: left">
       <span class="tituloBreeders">See through the sales pitch</span>
       <div class="textoBreeders"><?php echo Resources::getText('puppy_mill_warning_2'); ?></div>
     </td>
    </tr>
   <tr>
     <td colspan="4" style="text-align: center">
       <table width="100%">
         <tr>
           <td><img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/china_map_menu_outline.gif"; ?>" /></td>
           <td><img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/uk_map_menu_outline.jpg"; ?>" /></td>
           <td><img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/india_map_menu_outline.jpg"; ?>" /></td>
           <td><img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/japan_map_menu_outline.jpg"; ?>" /></td>
         </tr>
         <tr>
           <td colspan="4" style="text-align: center">More countries coming soon ...</td>
         </tr>  
       </table>
     </td>
    </tr>
    
    
 </table>
 <br/>