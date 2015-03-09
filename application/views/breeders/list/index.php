 <?php require_once 'utils/Resources.php';?>

     
    <div style="display:flex;justify-content:center">

      
      
       <div id="columLeft" class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_03'); ?></div>
       </div>
       <div id="columLeft" class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_03'); ?></div>
       </div>
       
       <div id="columnCenter"  class="columnCenter" style="flex-direction:column" ng-controller="AdvSearchCtrl"  ng-init="initialize(<?php echo $_REQUEST["ctrlParams"]; ?>)" >
 
 	        <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/breeders/submenuBreeders.php' ?>
 	        
 	        <div id="mapa-comment-form" style="margin-left:20px;height:460px;display:flex;flex-direction:row">
 	          <div id="map-canvas"></div>
 	          <div id="comment-form" style="width:340px;margin-top:30px;padding:5px;">
 	            <div style="color:#1e6b88;font-size:18px;font-family:'Dosis';text-align:left;padding-left:15px"><?php echo Resources::getText($headerTitleKey); ?></div>
		        <br/>
		        <div style="text-align: justify;padding-left:15px">
		          <?php echo Resources::getText($headerTextKey); ?>
		        </div>
		        <?php include 'formBusqueda.php'?>
 	          </div>
			</div>
			
			
		     <div id="paginador" style="display:flex;flex-direction:row;margin-left:300px" ng-controller="PageCtrl">
		      <button ng-click="back()" class="botonPaginador">&lsaquo;</button>
		      <div class="leyendaPaginador"">Page {{page}} of {{pageCount}}</div>
		      <button ng-click="forward()" class="botonPaginador">&rsaquo;</button> 
		    </div>
			
		    <br/>

		    

		
		    <div class="marcoFijoTablaPaginada">
		      <div>
		        <input  type="number"  id="hiddenPageNumber" style="display:none" ng-model="storage.page"  style="width: 80px"/>
		        <div ng-repeat="fila in storage.tableData" class="resultRowContainer">
		          <div class="shelterContainer"><span class="textoElementoResultado">{{fila.name}}</span></div>
		          <div class="locacion"><span class="textoElementoResultado">{{fila.locacion}}</span></div>
		          <div ng-show="usaDistancia==true" class="distancia"><span class="textoElementoResultado">{{fila.distanciaFormateada}}</span></div>
		          <a class='btnMoreDetails w90' href='{{fila.urlCompleta}}'><span class="textoElementoResultado">Details</span></a>
		        </div>
		      </div>
		    </div>
	    
	
      </div>
      
    </div>

