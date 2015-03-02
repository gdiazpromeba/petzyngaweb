<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
  require_once 'configJs.php';
?>

<div style="display:flex;justify-content:center">
    
      <div  class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_03'); ?></div>
       </div>
       <div  class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_03'); ?></div>
       </div>

       <div id="columnCenter"  class="columnCenter">
       
         <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/dogbreeds/submenuDogBreeds.php' ?>

         
         <div id="arrayLetrasTop" style="width:550px;margin-left:50px;display:table;">
           <div style='display:table-cell;width:120px;padding-right:10px'>
              <br/><a name='SelectInitial'>Select by letter</a>
            </div>
            <div style="display:table-cell;width:400px;">
                <br/>       
                <?php
                  foreach ($arrayLetras as $letter){
                  	 echo "  <div style='display:table-cell;padding-right:10px'>";
                  	 echo"     <a href='#" . $letter . "'>" . $letter . "</a>";
                  	 echo "  </div>";
                  }
                 ?>
            </div>
         </div><!-- arrayLetrasTop -->

       
          <div  ng-controller="PicTableControllerAlpha" style="margin-bottom: 20px;display:flex;flex-direction:column" ng-init="init()">
            <div ng-repeat="bloque in bloques" style="margin-left:10px;margin-top:30px">
                  <a name='{{bloque.letra}}'>{{bloque.letra}}</a> &nbsp;<a href='#SelectInitial'>Back to top</a>
	              <div style="display:flex;flex-direction:row;justify-content:center;" ng-repeat="row in bloque.rows" >
	                <div style="display:flex;flex-direction:column;" ng-repeat="cell in row.cells">
	                  <div class='pictureContainerAlpha' ng-click="itemClicked(cell.nameEncoded)">
	                    <div class="pictureTitleAlpha">{{cell.name}}</div>
	                    <div><img class="breedImageAlpha" ng-src="{{cell.pictureUrl}}"/></div>
	                  </div>
	                </div>
	              </div>
            </div>
         </div>

         <div ng-controller="DetailCtrl">
           <dog-breed-details></dog-breed-details>
         </div>
            
          
       </div><!-- columnCenter -->   
       
</div>
