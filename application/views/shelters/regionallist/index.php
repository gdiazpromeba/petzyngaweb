 <?php require_once 'utils/Resources.php';?>
 
<div style="display:flex;justify-content:center">
    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo $_REQUEST['start']; ?>" />
      <input type="hidden" name="firstArea" value="<?php echo $_REQUEST['firstArea']; ?>" />      
      <input type="hidden" name="secondArea" value="<?php echo $_REQUEST['secondArea']; ?>" />
      <input type="hidden" name="zipCode" value="<?php echo $_REQUEST['zipCode']; ?>" />
      <input type="hidden" name="shelterName" value="<?php echo $_REQUEST['shelterName']; ?>" />
      <input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" />
      
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

    <div class="columnLeft">
      <div class="stickitColumna"><?php echo Resources::getText("india_no_kill_tradition"); ?></div>
      <div class="stickitColumna"><?php echo Resources::getText("peta_position_on_no_kill"); ?></div>
    </div>
    <div class="columnRight">
      <div class="stickitColumna"><?php echo Resources::getText("mspca_angell"); ?></div>
      <div class="stickitColumna"><?php echo Resources::getText("saluki"); ?></div>
    </div>

    <div id="columnCenter"  class="columnCenter" style="margin-left:10px">
	  
      <div id="arrayRegiones" style="width:550px;margin-left:50px;display:table;">
           <div style='display:table-cell;width:120px;padding-right:10px;padding-top:12px;vertical-align:top;'>
              <br/><a name='SelectInitial'>Select your area</a>
            </div>
            <div style="display:table-cell;width:400px;">
                <?php
                  echo "  <div style='display:flex;flex-wrap:wrap;justify-content:space-between;padding-top:30px;'>";
                  foreach ($arrayAreas as $area){
                  	 echo "  <div style='padding-right:10px'>";
                  	 echo"     <a href='#" . $area . "'>" . $area . "</a>";
                  	 echo "  </div>";
                  }
                  echo "  </div>";
                  echo "  <br/>";
                  echo "  <div style='text-align:left;padding-top:10px;'>";
                  echo "       <a href='" . URL . "shelters/advancedList/" . $_REQUEST['country'] .  "'>Advanced Search</a>"; 
                  echo "  </div>";
                 ?>
            </div>
      </div><!-- arrayRegiones -->	
      <br/>
      <br/>
      <br/>
      <table class="sheltersTable"  border="1" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" summary="">
               <?php
                 $cols =3;
                 foreach ($arrayAreas as $area){
                   echo "<tr><td>";
                   echo "<br/>";
                   echo "<br/>";
                   echo " <a style='font-size:24px' name='" . $area . "'>" . $area . "</a> &nbsp;&nbsp;<a href='#SelectInitial'>Back to top</a>" ;
                   echo "</td></tr>";
                   echo "<tr><td>";
                   echo "  <table width='100%'  border='1' style='border-collapse:collapse;' cellpadding='0' cellspacing='0' summary=''>\n";
                   $index=0;
                   $sheltersArea=$mapAreas[$area];
                   $filas=floor(count($sheltersArea) / $cols);
                   if (($filas * $cols)<count($sheltersArea)) $filas++;
                   for ($i=0; $i<$filas; $i++){
                   	echo "  <tr> \n";
                   	for ($e=0; $e<$cols; $e++){
                   		if ($index>=count($sheltersArea)) break;
                   		$bean=$sheltersArea[$index];
                   		$index++;
                   		echo "<td class='tdPictureContainer'> \n";
                   		echo "      <div data-nombreCodificado='" .  $bean->getUrlEncoded() . "'/>";
                   		echo "      <a href='javascript:void(0)' onclick=navega('" . URL . "shelters/info/"  . $_REQUEST['country'] . "/" . $bean->getUrlEncoded() . "')> \n";
                   		echo "      <table class='pictureInternalTable'> \n";
                   		echo "        <tr><td class='pictureTitleAlpha'>" . $bean->getName() . "</td></tr> \n";
                   		echo "      </table> \n";
                   		//echo "    </a> \n";
                   		echo "</td> \n";
                   	}
                   	echo "  </tr> \n";
                   }
                   echo "  </table>";
                   echo "</td></tr>";
                 }
               ?>
      </table>        

    </div><!-- columnCenter -->
</div>