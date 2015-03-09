	<div id="busquedaShelters" style="background-color:#E8EDE9;width:330px;margin:15px;">
      <img src="<?php echo URL . 'public/img/ajax-loader.gif'; ?>" id="imgEsperaShelters" style="display:none;z-index:10;position:absolute;top:300px;left:650px;" />
	  
	  <form name="frmBusqueda"    style="display:flex;flex-direction:column;">
	    <input type="hidden" name="country2"  ng-value="storage.country2"/>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="shelterName">By Name</label>
	      <input class="busquedaInput" type="text" name="shelterName" ng-model="storage.formParams.shelterName"  />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="zipCode">By Zip Code</label>
	      <input class="busquedaInput" type="text" name="zipCode"  ng-model="storage.formParams.zipCode" />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="dogBreed">By Breed</label>
	      <div style="display:flex;flex-direction:column;">
		    <div>
		      <select class="busquedaSelect" ng-model="storage.formParams.dogBreedId"
		          ng-options="c.dogBreedId as c.dogBreedName for c in storage.dogBreeds" >
		      </select>
		    </div>	
          </div>          	      
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