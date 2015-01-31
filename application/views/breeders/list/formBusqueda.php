	<div id="busquedaBreeders" style="width:90%;margin:0 auto">
      <img src="<?php echo URL . 'public/img/ajax-loader.gif'; ?>" id="imgEsperaShelters" style="display:none;z-index:10;position:absolute;top:300px;left:650px;" />
	  <div class="tituloFormBusqueda">Filter BREEDERS by name, sort them by distance</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'breeders/advancedList/' . $_REQUEST['country'] . '/initial'  ?>" method="get">
	    <input type="hidden" name="specialBreedId" id="specialBreedId" <?php if (isset($_REQUEST['specialBreedId'])) echo "value='" . $_REQUEST['specialBreedId'] . "'"; ?> />
	    <input type="hidden" name="country" <?php echo "value='" . $_REQUEST['country'] . "'"; ?> />
	    <input type="hidden" name="start"  <?php echo "value='" . $_REQUEST['start'] . "'"; ?> />
	    <table style="width:100%;padding-top:5px;">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="breederName">By Name</label><input class="shelterNameInput" type="text" name="breederName"  <?php if (isset($_REQUEST['breederName'])) echo "value='" . $_REQUEST['breederName'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="zipCode">By Zip Code</label><input class="busquedaInput" type="text" name="zipCode" id="zipCode" <?php if (isset($_REQUEST['zipCode'])) echo "value='" . $_REQUEST['zipCode'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
              <label class="labelBusqueda" for="dogBreedName">By Breed</label><input class="busquedaInput" type="text" name="dogBreedName" id="dogBreedName" <?php if (isset($_REQUEST['dogBreedName'])) echo "value='" . $_REQUEST['dogBreedName'] . "'"; ?> />
            </td>
	        <td class="campoBusqueda">
              <label class="labelBusqueda" for="firstArea">By Location</label>
              <select class="busquedaSelect" name="firstArea" id="firstArea">
              <?php 
                foreach ($firstAreas as $area){
                  $areaSelected =  isset($_REQUEST['firstArea']) && ($area['value'] == $_REQUEST['firstArea']);
                  $selAttr=$areaSelected?" selected='selected' ":"";
                  echo "<option value='" .  $area["value"] . "' ".  $selAttr .   ">" . $area["label"] . "</option> .\n";
                }
              ?>
              </select>
            </td>
          </tr>
          <tr>
            <td/><td/><td/>
	        <td class="campoBusqueda">
              <select class="busquedaSelect" name="secondArea"  id="secondArea" >
              </select>
            </td>
            
          </tr>
          <tr>
            <td class="campoBusqueda">
                <div style='text-align:left;display:block;'>
                  <?php  echo"<a href='" . URL . "breeders/regionalList/" .  $_REQUEST['country'] .  "'>Search by location</a>"; ?>
                </div>
            </td>
            <td/>
            <td/>
	      	<td class="campoBusqueda" align="right">
              <input type="button" onClick="javascript: submitFrmBusqueda()" value="Search" class="busquedaBotones" />	      	  
	      	  &nbsp;
	          <input type="button" onclick="javascript: resetFrmBusqueda()" value="Reset" class="busquedaBotones" />
	        </td>
	      </tr>
	    </table>
	  </form>
	  
	  
      <script type="text/javascript">
        function submitFrmBusqueda(){
          document.frmBusqueda.submit();
          var espera=document.getElementById('imgEsperaShelters');
          espera.style.display="block";
        }
        
        function resetFrmBusqueda(){
        	document.frmBusqueda.breederName.value='';
        	document.frmBusqueda.zipCode.value='';
        	document.frmBusqueda.dogBreedName.value='';
        	document.frmBusqueda.specialBreedId.value='';
        	document.frmBusqueda.firstArea.value='';
        	document.frmBusqueda.secondArea.value='';
        	document.frmBusqueda.submit();
        }
        
        
      </script>	  
      
      
	</div>