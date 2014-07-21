	<div id="busquedaShelters">
	  <div class="tituloBusqueda">Filter SHELTERS by name, sort them by distance</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'sheltersusa/index'  ?>" method="POST">
	    <table width="100%">
	      <tr>
	        <td>
	          <label class="labelBusqueda" for="usaShelterName">Shelter name</label><input class="busquedaInput" type="text" name="usaShelterName"  <?php if (isset($_SESSION['usaShelterName'])) echo "value='" . $_SESSION['usaShelterName'] . "'"; ?> />
	        </td>
	        <td>
	          <label class="labelBusqueda" for="usaZipCode">Zip Code</label><input class="busquedaInput" type="text" name="usaZipCode"  <?php if (isset($_SESSION['usaZipCode'])) echo "value='" . $_SESSION['usaZipCode'] . "'"; ?> />
	        </td>
	      	<td align="right" colspan="2">
	      	  <input type="button" onclick="javascript: resetFrmBusqueda()" value="Reset" class="busquedaBotones" />
	      	  &nbsp;
	          <input type="button" onClick="javascript: submitFrmBusqueda()" value="Search" class="busquedaBotones" />
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
        }
        
        
      </script>	  
      
      
	</div>