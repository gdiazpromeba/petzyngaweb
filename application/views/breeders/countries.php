 <?php require_once 'utils/Resources.php';?>
 <div class="descriptiveParagraph2A"><?php echo Resources::getTeasers('adopt_responsibly'); ?></div>
 <br/>
 <table class="countryPicturesTable">
   <tr>
     <td style="vertical-align">
       <a class="noUnderline" href="<?php echo URL; ?>breeders/listing/usa/initial">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/icono_mapa_usa_menu.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_usa'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["usa"]); ?></div>
       </a>
     </td>
     <td>
     </td>
     <td>
     </td>
   </tr>
   <tr>
   <tr>
     <td>
     </td>
      <td>
      </td>
      <td>
      </td>
    </tr>
 </table>
 <br/>
 <div class="descriptiveParagraph2"><?php echo Resources::getText('animal_shelter_countries_list_content'); ?></div>
