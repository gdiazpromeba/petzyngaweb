<div id="right">

	<?php include 'formBusqueda.php'?>

    <div>
              <table class="picturesTable">
               <?php
                 $keys = array_keys($dogBreeds);
                 $index=0; 
                 for ($row=0; $row <4 && $index < count($keys) ; $row++){
                   echo "<tr> \n"; 
                   for ($col=0; $col<3 && $index < count($keys) ; $col++){
                      $bean=$dogBreeds[$keys[$index]];
                      
                      echo "<td class='tdPictureContainer'> \n";
                      echo "<div class='pictureContainer'> \n";
                      echo "  <a href='" . URL . "dogbreedinfo/info/" . str_replace(" ", "_", $bean->getNombre()) . "'>\n";                      
                      echo "    <table class='pictureInternalTable'> \n";
                      echo "      <tr><td class='pictureTitle'>" . $bean->getNombre() . "</td></tr> \n";
                      echo "      <tr><td><img class='breedImage' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $dogBreeds[$keys[$index]]->getPictureUrl() . "'></td></tr>";
                      echo "    </table> \n";
                      echo "  </a> \n";
                      echo "</div>";
                      echo "</td> \n";
                      
                      $index++;
                   }
                   echo "</tr> \n"; 
                 }
               ?>
              </table>
    </div>
    <span class="navegacionPaginas">
      <?php 
        if ($_SESSION['hayAnterior']){
          echo "  <a href='" . URL . "/dogbreeds/anterior'> << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_SESSION['haySiguiente']){
          echo "  <a href='" . URL . "/dogbreeds/siguiente'>  Next >> </a> \n";
        }
        
      ?>
    </span>
</div>
