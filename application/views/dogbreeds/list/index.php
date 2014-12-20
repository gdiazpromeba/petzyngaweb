<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
?>

<div class="rightDogBreeds">
    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
    <form name="frmNavegacion" method="post" >
      <input type="hidden" name="start" value="<?php echo RequestUtils::getValue('start'); ?>" />
      <input type="hidden" name="letraInicial" value="<?php echo RequestUtils::getValue('letraInicial'); ?>" />      
      <input type="hidden" name="nombreOParte" value="<?php echo RequestUtils::getValue('nombreOParte'); ?>" />
      <input type="hidden" name="selDogSize" value="<?php echo RequestUtils::getValue('selDogSize'); ?>" />
      <input type="hidden" name="selDogFeeding" value="<?php echo RequestUtils::getValue('selDogFeeding'); ?>" />
      <input type="hidden" name="selUpkeep" value="<?php echo RequestUtils::getValue('selUpkeep'); ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }

      function navegaSigAnt(url, sentido){
    	  var inp = document.createElement("input");
    	  inp.setAttribute("type", "hidden");
    	  inp.setAttribute("name", "navegacion");
    	  inp.setAttribute("value", sentido);
          document.frmNavegacion.appendChild(inp);
          document.frmNavegacion.action=url;
          document.frmNavegacion.submit();
      }
      
    </script>
	<?php include 'formBusqueda.php'?>


              <table class="picturesTable">
               <?php
                 $keys = array_keys($dogBreeds);
                 $index=0; 
                 for ($row=0; $row <5 && $index < count($keys) ; $row++){
                   echo "<tr> \n"; 
                   for ($col=0; $col<4 && $index < count($keys) ; $col++){
                      $bean=$dogBreeds[$keys[$index]];
                      
                      echo "<td class='tdPictureContainer'> \n";
                      echo "<div class='pictureContainer'> \n";
                      echo "    <a href='javascript:void(0)' onclick=navega('" . URL . "dogbreeds/info/" .  $bean->getNameEncoded() . "')> \n";
                      echo "      <table class='pictureInternalTable'> \n";
                      echo "        <tr><td class='pictureTitle'>" . $bean->getNombre() . "</td></tr> \n";
                      echo "        <tr><td><img class='breedImage' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $dogBreeds[$keys[$index]]->getPictureUrl() . "' alt='" . $bean->getNombre() . "'></td></tr>";
                      echo "      </table> \n";
                      echo "    </a> \n";
                      echo "</div>";
                      echo "</td> \n";
                      
                      $index++;
                   }
                   echo "</tr> \n"; 
                 }
               ?>
              </table>
              
    <span class="navegacionPaginas">
      <?php 
        if ($_REQUEST['hayAnterior']){
          echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds', 'anterior')\" > << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_REQUEST['haySiguiente']){
          echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds', 'siguiente')\" >  Next >> </a> \n";
        }
        
      ?>
    </span>
</div>
