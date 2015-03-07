	<div id="busquedaBreeders" style="background-color:#E8EDE9;width:330px;margin:15px;">
      <img src="<?php echo URL . 'public/img/ajax-loader.gif'; ?>" id="imgEsperaShelters" style="display:none;z-index:10;position:absolute;top:300px;left:650px;" />
	  
	  <form name="frmBusqueda"    style="display:flex;flex-direction:column;">
	    <input type="hidden" name="country2"  ng-model="storage.country2"/>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="breederName">By Name</label>
	      <input class="busquedaInput" type="text" name="breederName" ng-model="storage.formParams.breederName"  />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="zipCode">By Zip Code</label>
	      <input class="busquedaInput" type="text" name="zipCode"  ng-model="storage.formParams.zipCode" />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="dogBreedName">By Breed</label>
	      <input class="busquedaInput"  type="text" name="dogBreedName" id="dogBreedName" ng-model="storage.formParams.dogBreedName" />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="firstArea">By Location</label>
	      <div style="display:flex;flex-direction:column;">
		    <div>
		      
		      <select class="busquedaSelect" ng-model="storage.formParams.firstArea"
		          ng-options="c.value as c.label for c in storage.firstAreas" >
		      </select>
		    </div>	
		    <div>
		      <select class="busquedaSelect" ng-model="storage.formParams.secondArea"
		          ng-options="c.value as c.label for c in storage.secondAreas">
		      </select>
		    </div>		          
          </div>          	      
	    </div>
	    <div class="formFieldContainer">
	      <div style="display:flex;flex-direction:row;margin-left:90px">
            <input type="button" ng-click="buttonClick()" value="Search" class="busquedaBotones" />	      	  
	        &nbsp;
	        <input type="button" ng-click="reset()" value="Reset" class="busquedaBotones" />
	      </div>
	    </div>
	  </form>

	</div>