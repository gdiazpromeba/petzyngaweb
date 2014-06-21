	<div id="busqueda">
	  <div class="tituloBusqueda">Filter your DOG BREED search</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'dogbreeds/index'  ?>" method="POST">
	    <table width="100%">
	      <tr>
	        <td>
	          <label class="labelBusqueda" for="nombreOParte">Name (or part)</label><input class="busquedaInput" type="text" name="nombreOParte"  <?php if (isset($_SESSION['nombreOParte'])) echo "value='" . $_SESSION['nombreOParte'] . "'"; ?> />
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
	            <option value=""         <?php if ($_SESSION['selDogSize']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="smaller"  <?php if ($_SESSION['selDogSize']=="smaller")  echo "selected='selected'"; ?> >smaller</option>
	            <option value="medium"   <?php if ($_SESSION['selDogSize']=="medium")  echo "selected='selected'"; ?> >medium</option>
	            <option value="larger"   <?php if ($_SESSION['selDogSize']=="larger")  echo "selected='selected'"; ?> >larger</option>
	          </select>
	        </td>
	        <td>
	          <label class="labelBusqueda">Feeding</label>
	          <select name="selDogFeeding" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selDogFeeding']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="less"     <?php if ($_SESSION['selDogFeeding']=="less")  echo "selected='selected'"; ?> >less</option>
	            <option value="2cups"    <?php if ($_SESSION['selDogFeeding']=="2cups")  echo "selected='selected'"; ?> >2 cups/day</option>
	            <option value="more"     <?php if ($_SESSION['selDogFeeding']=="more")  echo "selected='selected'"; ?> >more</option>
	          </select>
	        </td>	        
	      </tr>
	      <tr>
	        <td>
	          <label class="labelBusqueda">Appartment apt</label>
	          <select name="selAppartments" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selAppartments']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="Yes"     <?php if ($_SESSION['selAppartments']=="Yes")  echo "selected='selected'"; ?> >Yes</option>
	            <option value="No"    <?php if ($_SESSION['selAppartments']=="No")  echo "selected='selected'"; ?> >No</option>
	          </select>
	        </td>
	        <td>
	          <label class="labelBusqueda">Kid safe</label>
	          <select name="selKids" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selKids']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="Yes"     <?php if ($_SESSION['selKids']=="Yes")  echo "selected='selected'"; ?> >Yes</option>
	            <option value="No"    <?php if ($_SESSION['selKids']=="No")  echo "selected='selected'"; ?> >No</option>
	          </select>
	        </td>
	        <td>
	          <label class="labelBusqueda">Upkeep</label>
	          <select name="selUpkeep" class="busqueda">
	            <option value=""         <?php if ($_SESSION['selUpkeep']=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="little"     <?php if ($_SESSION['selUpkeep']=="little")  echo "selected='selected'"; ?> >little</option>
	            <option value="average"    <?php if ($_SESSION['selUpkeep']=="average")  echo "selected='selected'"; ?> >average</option>
	            <option value="a lot"    <?php if ($_SESSION['selUpkeep']=="a lot")  echo "selected='selected'"; ?> >a lot</option>
	          </select>
	        </td>	        
	      	<td align="right">
	      	  <a href="javascript: resetFrmBusqueda()"><span class="busquedaBotones">Reset</span></a>
	      	  &nbsp;
	          <a href="javascript: submitFrmBusqueda()"><span class="busquedaBotones">Search</span></a>
	          
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