	<div id="busquedaShelters">
	  <div class="tituloBusqueda">Filter SHELTERS by name, sort them by distance</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'sheltersusa/index'  ?>" method="POST">
	    <input type="hidden" name="specialBreedId" id="specialBreedId" <?php if (isset($_SESSION['specialBreedId'])) echo "value='" . $_SESSION['specialBreedId'] . "'"; ?> />
	    <table width="100%">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="usaShelterName">Name</label><input class="busquedaInput" type="text" name="usaShelterName"  <?php if (isset($_SESSION['usaShelterName'])) echo "value='" . $_SESSION['usaShelterName'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="usaZipCode">Zip</label><input class="busquedaInput" type="text" name="usaZipCode"  <?php if (isset($_SESSION['usaZipCode'])) echo "value='" . $_SESSION['usaZipCode'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
              <label class="labelBusqueda" for="dogBreedName">Breed</label><input class="busquedaInput" type="text" name="dogBreedName" id="dogBreedName" <?php if (isset($_SESSION['dogBreedName'])) echo "value='" . $_SESSION['dogBreedName'] . "'"; ?> />
            </td>
          </tr>
          <tr>
	      	<td align="right" colspan="3">
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
        }
        
        function resetFrmBusqueda(){
        	document.frmBusqueda.usaShelterName.value='';
        	document.frmBusqueda.usaZipCode.value='';
        	document.frmBusqueda.dogBreedName.value='';
        	document.frmBusqueda.specialBreedId.value='';
        }
        
        
      </script>	  
      
      
	</div>