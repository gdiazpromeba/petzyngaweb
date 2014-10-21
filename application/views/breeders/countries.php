 <?php require_once 'utils/Resources.php';?>
 <table border="1" style="padding:5px;">
   <tr>
     <td colspan="4" style="text-align: left">
       <span style="font-family: Oswald; font-color:olive; font-size:16px;margin:5px;">Responsible Breeders</span>
       <div style="text-align:justify;font-size:small;padding:5px" ><?php echo Resources::getText('responsible_breeders'); ?></div>
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
       <span style="font-family: Oswald; font-color:olive; font-size:16px;margin:5px;">Beware of "Puppy Mills"</span>
       <div style="text-align:justify;font-size:small;padding:5px" ><?php echo Resources::getText('puppy_mill_warning_1'); ?></div>
     </td>
   </tr>
   <tr>
     <td colspan="2" style="text-align: left">
       <span style="font-family: Oswald; font-color:olive; font-size:16px;margin:5px">See through the sales pitch</span>
       <div style="text-align:justify;font-size:small;padding:5px"><?php echo Resources::getText('puppy_mill_warning_2'); ?></div>
     </td>
    </tr>
 </table>
 <br/>