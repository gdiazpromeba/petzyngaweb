 <?php require_once 'utils/Resources.php';?>
<br/>
<table class="countryPicturesTable">
   <tr>
     <td colspan="4">
       <div class="descriptiveParagraph2"><?php echo Resources::getText('welcome_to_breeders'); ?></div>
     </td>
   </td>
   <tr>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>breeders/regionallist/usa">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/usa_map_menu_outline.jpeg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_usa'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["usa"]); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>breeders/regionallist/canada">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/canada_map_menu_outline.png"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_canada'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["canada"]); ?></div>
       </a>
     </td>
     <td>
       <a class="noUnderline" href="<?php echo URL; ?>breeders/regionallist/uk">
         <img class="menuCountries" src="<?php echo $GLOBALS['dirAplicacion'] .  "/resources/images/uk_map_menu_outline.jpg"; ?>" />
         <div class="itemMenuCountries"><?php echo Resources::getText('breeders_in_the_uk'); ?></div>
         <div class="itemMenuCountries"><?php echo Resources::getText('number_breeders_available', $shelterCount["uk"]); ?></div>
       </a>
     </td>     
     <td style="text-align: left">
       <div class="textoBreeders"><?php echo Resources::getText('tips_pet_breeder'); ?></div>
     </td>
   </tr>
 </table>
 <br/>