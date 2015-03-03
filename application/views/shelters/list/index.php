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
       
       <div id="columnCenter"  class="columnCenter" style="flex-direction:column">
 
 	        <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/shelters/submenuShelters.php' ?>
 	        
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
			
		    <br/>
		    <div class="pagination">
			    <a href="#" class="first" data-action="first">&laquo;</a>
			    <a href="#" class="previous" data-action="previous">&lsaquo;</a>
			     <input type="text" readonly="readonly" data-max-page="40" />
			    <a href="#" class="next" data-action="next">&rsaquo;</a>
			    <a href="#" class="last" data-action="last">&raquo;</a>
		    </div> 
		
		    <div class="marcoFijoTablaPaginada">
		      <div ng-controller="AdvSearchPicTableCtrl" ng-init="initialize('usa')">
		        <input  type="number"  id="hiddenPageNumber" style="display:none" ng-model="page"  style="width: 80px"/>
		        <div ng-repeat="fila in tableData" class="resultRowContainer">
		          <div class="shelterContainer">{{fila.name}}</div>
		          <div class="locacion">{{fila.adminArea2}}, {{fila.adminArea1}}</div>
		          <div ng-show="usaDistancia==true" class="distancia">{{fila.distanciaFormateada}}</div>
		          <a class='btnMoreDetails w90' href='{{fila.urlCompleta}}'>Details</a>
		        </div>
		      </div>
		    </div>
	
      </div>
      
    </div>
