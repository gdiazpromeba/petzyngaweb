	<div id="busquedaShelters">
      <img src="<?php echo URL . 'public/img/ajax-loader.gif'; ?>" id="imgEsperaShelters" style="display:none;z-index:10;position:absolute;top:300px;left:650px;" />
	  <div class="tituloBusqueda">Filter SHELTERS by name, sort them by distance</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'shelters/listing/' . $countryUrl . '/initial'  ?>" method="POST">
	    <input type="hidden" name="specialBreedId" id="specialBreedId" <?php if (isset($_SESSION['specialBreedId'])) echo "value='" . $_SESSION['specialBreedId'] . "'"; ?> />
	    <table width="100%">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="shelterName">By Name</label><input class="shelterNameInput" type="text" name="shelterName"  <?php if (isset($_SESSION['shelterName'])) echo "value='" . $_SESSION['shelterName'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="zipCode">By Zip Code</label><input class="busquedaInput" type="text" name="zipCode"  <?php if (isset($_SESSION['zipCode'])) echo "value='" . $_SESSION['zipCode'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
              <label class="labelBusqueda" for="dogBreedName">By Breed</label><input class="busquedaInput" type="text" name="dogBreedName" id="dogBreedName" <?php if (isset($_SESSION['dogBreedName'])) echo "value='" . $_SESSION['dogBreedName'] . "'"; ?> />
            </td>
	        <td class="campoBusqueda">
              <label class="labelBusqueda" for="firstArea">By Location</label>
              <select class="busquedaSelect" name="firstArea">
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
	      	<td align="right" colspan="4">
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
        	document.frmBusqueda.shelterName.value='';
        	document.frmBusqueda.zipCode.value='';
        	document.frmBusqueda.dogBreedName.value='';
        	document.frmBusqueda.specialBreedId.value='';
        	document.frmBusqueda.firstArea.value='';
        	document.frmBusqueda.submit();
        }
        
        
      </script>	  
      
      
	</div>