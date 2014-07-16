<div id="right">

	<?php include 'formBusqueda.php'?>

    <div>
              <table class="picturesTable">
               <?php
                 foreach ($shelters as $shelter){
                   echo "<tr> \n"; 
                   echo "  <td class='shelterContainer'>" . $shelter->getName() . "</td> \n";
                   echo "  <td>" . $shelter->getCityName() . ", " . $shelter->getStateName()  . "</td> \n";
                   echo "  <td>  <a href='" . URL . "shelterusainfo/info/" . str_replace(" ", "_", $shelter->getName()) . "'>\n";
                   echo "</tr> \n"; 
                 }
               ?>
              </table>
    </div>
    <span class="navegacionPaginas">
      <?php 
        if ($_SESSION['hayAnterior']){
          echo "  <a href='" . URL . "/sheltersusa/anterior'> << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_SESSION['haySiguiente']){
          echo "  <a href='" . URL . "/sheltersusa/siguiente'>  Next >> </a> \n";
        }
        
      ?>
    </span>
</div>
