 <?php require_once 'utils/Resources.php';?>
 <br/>
 <table class="countryPicturesTable">
   <tr>
     <td style="vertical-align">
       <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/usa/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_usa_menu.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_usa'); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/uk/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_uk_menu.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_the_uk'); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/japan/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_japan_menu.jpg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_japan'); ?></div>
       </a>
     </td>
   </tr>
   <tr>
   <tr>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/china/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_china_menu.jpg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_china'); ?></div>
       </a>
     </td>
      <td>
        <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/canada/initial">
          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_canada_menu.jpg"; ?>" />
          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_canada'); ?></div>
        </a>
      </td>
      <td>
        <a class="noUnderline" href="<?php echo URL; ?>shelters/listing/india/initial">
          <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_india_menu.jpg"; ?>" />
          <div class="itemMenuCountries"><?php echo Resources::getText('pet_shelters_in_india'); ?></div>
        </a>
      </td>
    </tr>
 </table>
 <br/>
 <div class="descriptiveParagraph2"><?php echo Resources::getText('animal_shelter_countries_list_content'); ?></div>
