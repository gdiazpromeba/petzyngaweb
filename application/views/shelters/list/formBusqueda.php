	<div id="busquedaShelters" style="background-color:#E8EDE9;width:310px">
      <img src="<?php echo URL . 'public/img/ajax-loader.gif'; ?>" id="imgEsperaShelters" style="display:none;z-index:10;position:absolute;top:300px;left:650px;" />
	  
	  <form name="frmBusqueda"   ng-controller="AdvSearchFormParamCtrl" style="display:flex;flex-direction:column;">
	    <input type="hidden" name="specialBreedId" id="specialBreedId" <?php if (isset($_REQUEST['specialBreedId'])) echo "value='" . $_REQUEST['specialBreedId'] . "'"; ?> />
	    <input type="hidden" name="country" id="country" <?php echo "value='" . $_REQUEST['country'] . "'"; ?> />
	    <input type="hidden" name="start"  <?php echo "value='" . $_REQUEST['start'] . "'"; ?> />
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="shelterName">By Name</label>
	      <input class="shelterNameInput" type="text" name="shelterName" ng-model="formParams.shelterName"  />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="zipCode">By Zip Code</label>
	      <input class="busquedaInput" type="text" name="zipCode"  ng-model="formParams.zipCode" />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="dogBreedName">By Breed</label>
	      <input class="busquedaInput" type="text" name="dogBreedName" ng-model="formParams.dogBreedName" />
	    </div>
	    <div class="formFieldContainer">
	      <label class="labelBusqueda" for="firstArea">By Location</label>
	      <div style="display:flex;flex-direction:column;">
            <select class="busquedaSelect" name="firstArea" id="firstArea" ng-model="formParams.firstArea">
              <?php 
                foreach ($firstAreas as $area){
                  $areaSelected =  isset($_REQUEST['firstArea']) && ($area['value'] == $_REQUEST['firstArea']);
                  $selAttr=$areaSelected?" selected='selected' ":"";
                  echo "<option value='" .  $area["value"] . "' ".  $selAttr .   ">" . $area["label"] . "</option> .\n";
                }
              ?>
            </select>
            <select class="busquedaSelect" name="secondArea"  id="secondArea" ng-model="formParams.secondArea">
            </select>
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