 <?php require_once 'utils/Resources.php';?>
 <div class="descriptiveParagraph2A"><?php echo Resources::getTeasers('adopt_responsibly'); ?></div>
 <br/>
 <table border="1" style="padding:5px;">
   <tr>
     <td style="vertical-align">
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
     <td colspan="2" rowspan="2">
       <div style="text-align:justify;font-size:small" ><?php echo Resources::getText('puppy_mill_warning_1'); ?></div>
     </td>
   </tr>
   <tr>
     <td colspan="2">
       <div><?php echo Resources::getText('puppy_mill_warning_2'); ?></div>
     </td>
    </tr>
 </table>
 <br/>