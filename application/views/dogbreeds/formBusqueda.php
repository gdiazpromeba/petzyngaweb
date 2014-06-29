	<div id="busqueda">
	  <div class="tituloBusqueda">Filter your DOG BREED search</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'dogbreeds/index'  ?>" method="POST">
	    <table width="100%">
	      <tr>
	        <td>
	          <label class="labelBusqueda" for="nombreOParte">Breed name</label><input class="busquedaInput" type="text" name="nombreOParte"  <?php if (isset($_SESSION['nombreOParte'])) echo "value='" . $_SESSION['nombreOParte'] . "'"; ?> />
	        </td>
	        <td>
	          <label class="labelBusqueda">Initial</label>
	          <select name="letraInicial" class="busqueda">
	            <option value=""  <?php if ($_SESSION['letraInicial']=="") echo "selected='selected'"; ?> >All</option>
	          <?php 
	            $letras = range('A', 'Z');
	            foreach ($letras as $letra){
                  echo "<option value='" . $letra .  "' ";
                  if ($_SESSION['letraInicial']==$letra) echo "selected='selected'";
                  echo ">" . $letra . "</option> \n";
				}
	          ?>
	          </select>
	        </td>
	        <td>
	          <label class="labelBusqueda">Size</label> 
	          <select name="selDogSize" class="busqueda">
	            <option value=""        <?php if ($_SESSION['selDogSize']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="toy"     <?php if ($_SESSION['selDogSize']=="toy")  echo "selected='selected'"; ?> >toy</option>
	            <option value="small"   <?php if ($_SESSION['selDogSize']=="small")  echo "selected='selected'"; ?> >small</option>
	            <option value="medium"  <?php if ($_SESSION['selDogSize']=="medium")  echo "selected='selected'"; ?> >medium</option>
	            <option value="large"   <?php if ($_SESSION['selDogSize']=="large")  echo "selected='selected'"; ?> >large</option>
	          </select>
	        </td>
	        <td class="busqueda">
	        </td>	        
	      </tr>
	      <tr>
	        <td>
	          <label class="labelBusqueda">Feeding</label>
	          <select name="selDogFeeding" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selDogFeeding']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="less"     <?php if ($_SESSION['selDogFeeding']=="less")  echo "selected='selected'"; ?> >less</option>
	            <option value="2cups"    <?php if ($_SESSION['selDogFeeding']=="2cups")  echo "selected='selected'"; ?> >2 cups/day</option>
	            <option value="more"     <?php if ($_SESSION['selDogFeeding']=="more")  echo "selected='selected'"; ?> >more</option>
	          </select>	        
	        </td>
	        <td>
	          <label class="labelBusqueda">Grooming</label>
	          <select name="selUpkeep" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selUpkeep']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="little"     <?php if ($_SESSION['selUpkeep']=="little")  echo "selected='selected'"; ?> >little</option>
	            <option value="average"    <?php if ($_SESSION['selUpkeep']=="average")  echo "selected='selected'"; ?> >average</option>
	            <option value="a lot"    <?php if ($_SESSION['selUpkeep']=="a lot")  echo "selected='selected'"; ?> >a lot</option>
	          </select>	        
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
        	document.frmBusqueda.letraInicial.options[0].selected='selected';
        	document.frmBusqueda.selDogSize.options[0].selected='selected';
        	document.frmBusqueda.selDogFeeding.options[0].selected='selected';
        	document.frmBusqueda.selAppartments.options[0].selected='selected';
        	document.frmBusqueda.selKids.options[0].selected='selected';
        	document.frmBusqueda.selUpkeep.options[0].selected='selected';
        	document.frmBusqueda.nombreOParte.value='';
        }
        
        
      </script>	  
      
      
	</div>