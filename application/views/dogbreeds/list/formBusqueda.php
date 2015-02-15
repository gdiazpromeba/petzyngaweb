	<div id="busquedaShelters" style="width:90%;margin-left:20px;">
	  <div class="tituloFormBusqueda">DOG BREEDS Advanced search</div>
	  <form name="frmBusqueda"   ng-controller="ParameterController as paramCtrl" >
	    <table width="100%">
	      <tr>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda" for="nombreOParte">By name</label><input class="busquedaInput" type="text" name="nombreOParte" ng-model="formParams.nombreOParte" />
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">By letter</label>
	          <?php	 $letraRequest = RequestUtils::getValue('letraInicial'); ?> 
	          <select name="letraInicial" class="busquedaSelect" ng-model="formParams.letraInicial" style="width:50px">
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
	          <select name="selDogSize" class="busquedaSelect" ng-model="formParams.selDogSize" style="width:80px">
	            <option value=""        <?php if ($dogSize =="")   echo "selected='selected'"; ?> >All</option>
	            <option value="toy"     <?php if ($dogSize=="toy")  echo "selected='selected'"; ?> >toy</option>
	            <option value="small"   <?php if ($dogSize=="small")  echo "selected='selected'"; ?> >small</option>
	            <option value="medium"  <?php if ($dogSize=="medium")  echo "selected='selected'"; ?> >medium</option>
	            <option value="large"   <?php if ($dogSize=="large")  echo "selected='selected'"; ?> >large</option>
	          </select>
	        </td>
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Feeding</label>
	          <?php  $dogFeeding = RequestUtils::getValue('selDogFeeding'); ?>
	          <select name="selDogFeeding" class="busquedaSelect" ng-model="formParams.selDogFeeding"  style="width:100px">
	            <option value=""         <?php if ($dogFeeding=="")   echo "selected='selected'"; ?> >All</option>
	            <option value="less"     <?php if ($dogFeeding=="less")  echo "selected='selected'"; ?> >less</option>
	            <option value="2cups"    <?php if ($dogFeeding=="2cups")  echo "selected='selected'"; ?> >2 cups/day</option>
	            <option value="more"     <?php if ($dogFeeding=="more")  echo "selected='selected'"; ?> >more</option>
	          </select>	        
	        </td>	
	        <td class="campoBusqueda">
	          <label class="labelBusqueda">Grooming</label>
	          <?php  $upkeep = RequestUtils::getValue('selUpkeep'); ?>
	          <select name="selUpkeep" class="busquedaSelect" ng-model="formParams.selUpkeep"  style="width:90px">
	            <option value=""         <?php if ($upkeep=="")        echo "selected='selected'"; ?> >All</option>
	            <option value="little"   <?php if ($upkeep=="little")  echo "selected='selected'"; ?> >little</option>
	            <option value="average"  <?php if ($upkeep=="average") echo "selected='selected'"; ?> >average</option>
	            <option value="a lot"    <?php if ($upkeep=="a lot")   echo "selected='selected'"; ?> >a lot</option>
	          </select>	        
	        </td>	                
	      </tr>
	      <tr>
	        <td>
	           <div style='text-align:left;padding-left:5px;font-size:16px'>
	             <a href='<?php  echo URL ?>dogbreeds/alphabeticalSearch' >Alphabetical Search</a>
	           </div>	        
	        </td>
	        <td/>
	        <td/>
	        <td/>
	      	<td class="campoBusqueda" style="display:flex;flex-direction:row;justify-content:flex-start;align-items:flex-end;align-content:flex-end">
	      	  <button ng-click="buttonClick()" class="busquedaBotones" >Search</button>
	      	  &nbsp;
	      	  <button ng-click="reset()" class="busquedaBotones" >Reset</button>
	        </td> 	        
	      </tr>
	      <tr> 
	        <td colspan="5">
	            <br/><br/>
			    <div class="pagination">
				    <a href="#" class="first" data-action="first">&laquo;</a>
				    <a href="#" class="previous" data-action="previous">&lsaquo;</a>
				     <input type="text" readonly="readonly" data-max-page="40" />
				    <a href="#" class="next" data-action="next">&rsaquo;</a>
				    <a href="#" class="last" data-action="last">&raquo;</a>
				</div> 
	        </td>
	      </tr>
	    </table>
	       
	    
	    
	  </form>
	  

      
      
	</div>