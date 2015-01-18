 <?php require_once 'utils/Resources.php';?>
  <br/>
 <table class="countryPicturesTable">
   <tr>
     <td colspan="4">
       <div class="descriptiveParagraph2"><?php echo Resources::getText('animal_shelter_countries_list_content'); ?></div>
     </td>
   </td>
   <tr>
     <td style="vertical-align">
       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/usa">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_usa_menu.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_usa'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["usa"]); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/uk">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_uk_menu.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_uk'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["uk"]); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/japan">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_japan_menu.jpg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_japan'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["japan"]); ?></div>
       </a>
     </td>
     <td rowspan="2" style="width:200px">
        <div class="textoBreeders"><?php echo Resources::getTeasers('adopt_responsibly'); ?></div>
     </td>  
   </tr>
   <tr>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/china">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_china_menu.jpg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_china'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["china"]); ?></div>
       </a>
     </td>
      <td>
        <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/canada">
          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_canada_menu.jpg"; ?>" />
          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_canada'); ?></div>
          <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["canada"]); ?></div>
        </a>
      </td>
      <td>
        <a class="noUnderline" href="<?php echo URL; ?>shelters/regionallist/india">
          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_india_menu.jpg"; ?>" />
          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_india'); ?></div>
          <div class="itemMenuCountries"><?php echo Resources::getText('number_shelters_available', $shelterCount["india"]); ?></div>
        </a>
      </td>
    </tr>
 </table>
 <br/>
 
