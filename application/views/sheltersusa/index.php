<div id="columnaListaShelters">

	<?php include 'formBusqueda.php'?>

    <div>
   
              <table class="sheltersTable">
               <?php
                 foreach ($shelters as $shelter){
                   echo "<tr> \n"; 
                   echo "  <td class='shelterContainer'>" . $shelter->getName() . "</td> \n";
                   if (empty($usaZipCode)){
                     echo "  <td class='locacion'>" . $shelter->getCityName() . ", " . $shelter->getStateName()  . "</td> \n";
                   }else{//muestra también la distancia
                   	echo "  <td><table> \n";
                   	echo "    <tr><td class='locacion'>" . $shelter->getCityName() . ", " . $shelter->getStateName()  . "</td></tr> \n";
                   	echo "    <tr><td class='distancia'>" .  round($shelter->getDistancia() * 0.621371192)  . " mi</td></tr> \n";
                   	echo "  </table></td> \n";
                   }
                   
                   echo "  <td>  <a class='btnMoreDetails w90' href='" . URL . "shelterusainfo/info/" . str_replace(" ", "_", $shelter->getUrlEncoded()) . "'>Details</a></td> \n";
                   echo "</tr> \n"; 
                 }
               ?>
              </table>
    </div>
    <span class="navegacionPaginas">
      <?php 
        if ($_SESSION['hayAnterior']){
          echo "  <a href='" . URL . "sheltersusa/anterior'> << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_SESSION['haySiguiente']){
          echo "  <a href='" . URL . "sheltersusa/siguiente'>  Next >> </a> \n";
        }
        
      ?>
    </span>
</div>
