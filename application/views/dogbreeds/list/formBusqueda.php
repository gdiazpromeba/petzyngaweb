	<div id="busqueda">
	  <div class="tituloBusqueda">DOG BREEDS Advanced search</div>
	  <form name="frmBusqueda"   ng-controller="ParameterController as paramCtrl" >
	    <table width="100%">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="nombreOParte">By name</label><input class="busquedaInput" type="text" name="nombreOParte" ng-model="formParams.nombreOParte" />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">By letter</label>
	          <?php	 $letraRequest = RequestUtils::getValue('letraInicial'); ?> 
	          <select name="letraInicial" class="busqueda" ng-model="formParams.letraInicial">
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
	          <select name="selDogSize" class="busqueda" ng-model="formParams.selDogSize">
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
	          <select name="selDogFeeding" class="busqueda" ng-model="formParams.selDogFeeding">
	            <option value=""         <?php if ($dogFeeding=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="less"     <?php if ($dogFeeding=="less")  echo "selected='selected'"; ?> >less</option>
	            <option value="2cups"    <?php if ($dogFeeding=="2cups")  echo "selected='selected'"; ?> >2 cups/day</option>
	            <option value="more"     <?php if ($dogFeeding=="more")  echo "selected='selected'"; ?> >more</option>
	          </select>	        
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Grooming</label>
	          <?php  $upkeep = RequestUtils::getValue('selUpkeep'); ?>
	          <select name="selUpkeep" class="busqueda" ng-model="formParams.selUpkeep">
	            <option value=""         <?php if ($upkeep=="")        echo "selected='selected'"; ?> >All</option>
	            <option value="little"   <?php if ($upkeep=="little")  echo "selected='selected'"; ?> >little</option>
	            <option value="average"  <?php if ($upkeep=="average") echo "selected='selected'"; ?> >average</option>
	            <option value="a lot"    <?php if ($upkeep=="a lot")   echo "selected='selected'"; ?> >a lot</option>
	          </select>	        
	        </td>
	      	<td align="right" colspan="2">
	      	  <button ng-click="buttonClick()" class="busquedaBotones" >Search</button>
	      	  &nbsp;
	      	  <button ng-click="reset()" class="busquedaBotones" >Reset</button>
	        </td>
	      </tr>
	    </table>
	    
	    <br/>
	    <div class="pagination">
		    <a href="#" class="first" data-action="first">&laquo;</a>
		    <a href="#" class="previous" data-action="previous">&lsaquo;</a>
		     <input type="text" readonly="readonly" data-max-page="40" />
		    <a href="#" class="next" data-action="next">&rsaquo;</a>
		    <a href="#" class="last" data-action="last">&raquo;</a>
		</div> 
	    <br/> 	 
	       
	    
	    
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