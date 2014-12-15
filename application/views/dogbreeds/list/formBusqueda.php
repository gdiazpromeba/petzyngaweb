	<div id="busqueda">
	  <div class="tituloBusqueda">Filter your DOG BREED search</div>
	  <form name="frmBusqueda"  action="<?php echo URL . 'dogbreeds/index'  ?>" method="post">
	    <table width="100%">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="nombreOParte">By name</label><input class="busquedaInput" type="text" name="nombreOParte"  <?php if (isset($_SESSION['nombreOParte'])) echo "value='" . $_SESSION['nombreOParte'] . "'"; ?> />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">By letter</label>
	          <?php	 $letraRequest = RequestUtils::getValue('letraInicial'); ?> 
	          <select name="letraInicial" class="busqueda">
	            <option value=""  <?php if ($letraRequest == "") echo "selected='selected'"; ?> >All</option>
	            <?php 
	              $letras = range('A', 'Z');
	              foreach ($letras as $letra){
                    echo "<option value='" . $letra .  "' ";
                    if ($letraRequest == $letra) echo "selected='selected'";
                    echo ">" . $letra . "</option> \n";
				  }
	            ?>
	          </select>
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Size</label> 
	          <?php  $dogSize=RequestUtils::getValue('selDogSize'); ?>
	          <select name="selDogSize" class="busqueda">
	            <option value=""        <?php if ($dogSize =="")   echo "selected='selected'"; ?> >All</option>
	            <option value="toy"     <?php if ($dogSize=="toy")  echo "selected='selected'"; ?> >toy</option>
	            <option value="small"   <?php if ($dogSize=="small")  echo "selected='selected'"; ?> >small</option>
	            <option value="medium"  <?php if ($dogSize=="medium")  echo "selected='selected'"; ?> >medium</option>
	            <option value="large"   <?php if ($dogSize=="large")  echo "selected='selected'"; ?> >large</option>
	          </select>
	        </td>
	      </tr>
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Feeding</label>
	          <?php  $dogFeeding = RequestUtils::getValue('selDogFeeding'); ?>
	          <select name="selDogFeeding" class="busqueda">
	            <option value=""         <?php if ($dogFeeding=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="less"     <?php if ($dogFeeding=="less")  echo "selected='selected'"; ?> >less</option>
	            <option value="2cups"    <?php if ($dogFeeding=="2cups")  echo "selected='selected'"; ?> >2 cups/day</option>
	            <option value="more"     <?php if ($dogFeeding=="more")  echo "selected='selected'"; ?> >more</option>
	          </select>	        
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Grooming</label>
	          <?php  $upkeep = RequestUtils::getValue('selUpkeep'); ?>
	          <select name="selUpkeep" class="busqueda">
	            <option value=""         <?php if ($upkeep=="")        echo "selected='selected'"; ?> >All</option>
	            <option value="little"   <?php if ($upkeep=="little")  echo "selected='selected'"; ?> >little</option>
	            <option value="average"  <?php if ($upkeep=="average") echo "selected='selected'"; ?> >average</option>
	            <option value="a lot"    <?php if ($upkeep=="a lot")   echo "selected='selected'"; ?> >a lot</option>
	          </select>	        
	        </td>
	      	<td align="right" colspan="2">
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
        	document.frmBusqueda.letraInicial.options[0].selected='selected';
        	document.frmBusqueda.selDogSize.options[0].selected='selected';
        	document.frmBusqueda.selDogFeeding.options[0].selected='selected';
        	document.frmBusqueda.nombreOParte.value='';
        }
        
        
      </script>	  
      
      
	</div>