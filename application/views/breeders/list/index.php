 <?php require_once 'utils/Resources.php';?>
<div id="columnaListaShelters">
    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo $_REQUEST['start']; ?>" />
      <input type="hidden" name="firstArea" value="<?php echo $_REQUEST['firstArea']; ?>" />      
      <input type="hidden" name="secondArea" value="<?php echo $_REQUEST['secondArea']; ?>" />
      <input type="hidden" name="zipCode" value="<?php echo $_REQUEST['zipCode']; ?>" />
      <input type="hidden" name="breederName" value="<?php echo $_REQUEST['breederName']; ?>" />
      <input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" />
      
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>

    <div class="descriptiveParagraph2">
      <b><?php echo Resources::getText($headerTitleKey); ?></b>
      <br/>
      <?php echo Resources::getText($headerTextKey); ?>
    </div>
	<?php include 'formBusqueda.php'?>

    <div>
   
              <table class="sheltersTable">
               <?php
                 foreach ($breeders as $breeder){
                   echo "<tr> \n"; 
                   echo "  <td class='shelterContainer'>" . $breeder->getName() . "</td> \n";
                   if (empty($zipCode)){
                     echo "  <td class='locacion'>" . $breeder->getAdminAreas() . "</td> \n";
                   }else{//muestra también la distancia
                   	echo "  <td><table> \n";
                   	echo "    <tr><td class='locacion'>" .  $breeder->getAdminAreas() . "</td></tr> \n";
                   	echo "    <tr><td class='distancia'>" .  round($breeder->getDistancia() * $conversionFactor)  . " " . $distanceUnit . "</td></tr> \n";
                   	echo "  </table></td> \n";
                   }
                   
                   echo "  <td>  <a class='btnMoreDetails w90' href='#' onclick=navega('" . URL . "breeders/info/" . $_REQUEST['country'] . "/" . $breeder->getUrlEncoded(). "')>Details</a></td> \n";
                   echo "</tr> \n"; 
                 }
               ?>
              </table>
    </div>
    <span class="navegacionPaginas">
      <?php 
        if ($_REQUEST['hayAnterior']){
          echo "  <a href='#' onclick=navega('" . URL . "breeders/listing/" . $_REQUEST['country'] . "/previous')> << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_REQUEST['haySiguiente']){
          echo "  <a href='#' onclick=navega('" . URL . "breeders/listing/" . $_REQUEST['country'] . "/next')>  Next >> </a> \n";
        }
        
      ?>
    </span>
</div>
