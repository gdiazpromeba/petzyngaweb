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
         
       
          <div  ng-controller="DogGroupCtrl" style="margin-bottom: 20px;display:flex;flex-direction:column" ng-init="init(<?php  echo $initParams; ?>)">
           
            <!-- list of dog groups -->
            <div ng-repeat="bloque in data" style="margin-left:10px;margin-top:30px" ng-show="tipoMuestra=='groups'">
                  <a class="pictureTitle" href="{{bloque.groupUrl}}">{{bloque.name}}</a>
	              <div style="display:flex;flex-direction:row;justify-content:center;">
	                <a href="{{bloque.groupUrl}}">
	                  <img class="breedImageAlpha" ng-src="{{bloque.pictureUrl}}"/>
	                </a>
	                <div class="dogPurposeDescription" ng-bind-html="bloque.description"></div>
	              </div>
            </div>
            
            <!-- a dog group plus its breeds -->
            <div style="margin-left:10px;margin-top:30px" ng-show="tipoMuestra=='group'">
                  <a class="pictureTitle" href="{{data.group.groupUrl}}">{{data.group.name}}</a>
	              <div style="display:flex;flex-direction:row;justify-content:center;">
	                <a href="{{data.group.groupUrl}}">
	                  <img class="breedImageAlpha" ng-src="{{data.group.pictureUrl}}"/>
	                </a>
	                <div class="dogPurposeDescription" ng-bind-html="data.group.description"></div>
	              </div>
	             <div ng-repeat="item in data.items" style="padding:5px">
	               <a href="{{item.link}}">{{item.dogBreedName}}</a>
	             </div>
            </div> 
            
             <!-- breed details -->
            <div style="margin-left:10px;margin-top:30px" ng-show="tipoMuestra=='breed'">
	           <div ng-controller="DetailCtrl" ng-init="populateDetails(<?php echo $breedParam; ?>);visible=true">
	             <dog-breed-details></dog-breed-details>
	           </div>
            </div> 
                      
         </div>
            
          
       </div><!-- columnCenter -->   
       
</div>
